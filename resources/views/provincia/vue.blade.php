<script type="text/javascript">
    let app = new Vue({
        el: '#app',
        data: {
            prov:'',
            newPais: '',
            newDepa: '',
            newProvi: '',
            iddepa:'',
            pais: [],
            depa: [],
            provincias:[],
            buscar:'',
            pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
          },
          offset: 9,
          thispage:'1',
          divnuevo:false,
          diveditar:false,

          cboPaises:'',
        cboDepartamentos:'',

		},


        created: function() {
            this.getProvincia(this.thispage);
        },
        computed: {
            isActived: function() {
                return this.pagination.current_page;
            },
            pagesNumber: function() {
                if (!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset
                var from2 = this.pagination.current_page - this.offset
                if (from < 1) {
                    from = 1;
                }

                var to = from2 + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            buscarcategoria: function() {
                this.getProvincia(this.thispage);
            },
            guardar: function() {
                var url = 'provi';
                if ($("#cboPaises").val() != null) {
                    this.newPais = $("#cboPaises").val();
                }
                if ($("#cboDepartamentos").val() != null) {
                    this.newDepa = $("#cboDepartamentos").val();
                }
                console.log(this.newPais);
                var data = new FormData();
                data.append('newPais', this.newPais);
                data.append('newDepa', this.newDepa);
                data.append('newProvi', this.newProvi);
                axios.post(url, data).then(response => {
                    if (String(response.data.result) == '1') {
                        this.getProvincia(this.thispage);
                        if (response.data.exi == '0') {
                            alert(response.data.msj);
                        } else {
                            this.cerrarFormNuevo();
                            alert(response.data.msj);
                        }
                    } else {
                        $('#' + response.data.selector).focus();
                        $('#' + response.data.selector).css("border", "1px solid red");
                        alert(response.data.msj);
                    }
                }).catch(error => {})
            },
            getProvincia: function(page) {
                var busca = this.buscar;
                var url = 'provi?page=' + page + '&busca=' + busca;
                var url2='provi';
                axios.get(url).then(response => {
                    this.provincias = response.data.provincias.data;
                    this.pagination = response.data.pagination;
                    if (this.provincias.length == 0 && this.thispage != '1') {
                        var a = parseInt(this.thispage);
                        a--;
                        this.thispage = a.toString();
                        this.changePage(this.thispage);
                    }
                })
                axios.get(url).then(response => {
                    this.pais = response.data.pais;
                })
                // axios.get(url).then(response => {
                //     this.prov = response.data.prov;
                // })

            },
            changePage: function(page) {
                this.pagination.current_page = page;
                this.getProvincia(page);
                this.thispage = page;
            },
            nuevo: function() {
                this.divnuevo = true;
                this.diveditar = false;
                this.$nextTick(function() {
                    this.cancelFormNuevo();
                });
            },
            cerrarFormNuevo: function() {
                this.divnuevo = false;
                this.diveditar = false;
                this.cancelFormNuevo();
            },
            cancelFormNuevo: function() {
                this.newDepa = '';
                $('#txtprov').focus();
            },
            cerrarFormeditar: function() {
                this.diveditar = false;
                this.divnuevo = false;
            },
            editar: function(prov) {
                $('#txtprov').focus();
                this.iddepa = prov.id;
                this.newProvi = prov.name;
                this.cboPaises=prov.idpai;
                
                this.selecionar(prov.idpai,prov.iddepar);
                
                

                this.diveditar = true;
                this.divnuevo = false;
                
            },
            selecionar: function(id,idep) {
                $.get('/api/paises/' + id + '/departamentos', function(data) {
                $('#cboDepartamentos').attr('disabled', false);
                var html_select = '<option value="">Selecciona</option>'
                    for (var i = 0; i < data.length; ++i){
                        if (data[i].id==idep) {
                            html_select += '<option value="' + data[i].id + '" selected="true">' + data[i].name + '</option>';
                        }else{
                            html_select += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                        }
                    }
                    $('#cboDepartamentos').html(html_select);
                    
                });
            },
            deleteDepa: function(prov) {
                console.log('funciona');
                swal.fire({
                    title: '¿Estás seguro?',
                    text: "Desea eliminar este Categoria",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar'
                }).then((result) => {
                    if (result.value) {
                        var url = "provi/" + prov.id;
                        var data = new FormData();
                        data.append('tipo', 'eliminar');
                        data.append('_method', 'PUT');
                        axios.post(url, data).then(response => {
                            if (response.data.result == '1') {
                                this.getProvincia(this.thispage);
                                alert(response.data.msj);
                            } else {
                                alert(response.data.msj);
                            }
                        });
                    }
                }).catch(swal.noop);
            },
            update: function() {
                var url = "provi/" + this.iddepa;
                if ($("#cboPaises").val() != null) {
                    this.newPais = $("#cboPaises").val();
                }
                if ($("#cboDepartamentos").val() != null) {
                    this.newDepa = $("#cboDepartamentos").val();
                }
                var data = new FormData();
                data.append('newProvi', this.newProvi);
                data.append('newDepa', this.newDepa);
                data.append('newPais', this.newPais);
                data.append('tipo', 'editar');
                data.append('_method', 'PUT');
                axios.post(url, data).then(response => {
                    console.log(response.data.result);
                    if (response.data.result == '1') {
                        this.getProvincia(this.thispage);
                        if (response.data.exi == '0') {
                            alert(response.data.msj);
                        } else {
                            this.cerrarFormeditar();
                            alert(response.data.msj);
                        }
                    } else {
                        $('#' + response.data.selector).focus();
                        $('#' + response.data.selector).css("border", "1px solid red");
                        alert(response.data.msj);
                    }
                }).catch(error => {})
            },
        },
    });
</script>