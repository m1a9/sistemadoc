<script type="text/javascript">
    let app = new Vue({
        el: '#app',
        data: {
            distri:'',
            newPais: '',
            newDepa: '',
            newProvi: '',
			newDistri:'',
            iddepa:'',
            pais: [],
            depa: [],
            provi:[],
			distritos:[],
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





          idpaise:'0',
          iddepars:'0',
          idprovs:'0',

		},

        created: function() {
            this.getDistrito(this.thispage);
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
                this.getDistrito(this.thispage);
            },
            guardar: function() {
                var url = 'distri';
                if ($("#cboPaises").val() != null) {
                    this.newPais = $("#cboPaises").val();
                }
                if ($("#cboDepartamentos").val() != null) {
                    this.newDepa = $("#cboDepartamentos").val();
                }
				if ($("#cboProvincias").val() != null) {
                    this.newProvi = $("#cboProvincias").val();
                }
                console.log(this.newPais);
                console.log(this.newDepa);
                console.log(this.newProvi);
                var data = new FormData();
                data.append('newPais', this.newPais);
                data.append('newDepa', this.newDepa);
                data.append('newProvi', this.newProvi);
				data.append('newDistri', this.newDistri);
                axios.post(url, data).then(response => {
                    if (String(response.data.result) == '1') {
                        this.getDistrito(this.thispage);
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
            getDistrito: function(page) {
                var busca = this.buscar;
                var url = 'distri?page=' + page + '&busca=' + busca;
                var url2='distri';
                axios.get(url).then(response => {
                    this.distritos = response.data.distritos.data;
                    console.log(response.data.distritos.data);
                    this.pagination = response.data.pagination;
                    if (this.distritos.length == 0 && this.thispage != '1') {
                        var a = parseInt(this.thispage);
                        a--;
                        this.thispage = a.toString();
                        this.changePage(this.thispage);
                    }
                })
                axios.get(url).then(response => {
                    this.pais = response.data.pais;
                })
                axios.get(url).then(response => {
                    this.distri = response.data.distri;
                })
				
            },
            changePage: function(page) {
                this.pagination.current_page = page;
                this.getDistrito(page);
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
                this.newDistri = '';
                $('#txtdistr').focus();
            },
            cerrarFormeditar: function() {
                this.diveditar = false;
                this.divnuevo = false;
            },
            editar: function(distri) {
                $('#txtdistr').focus();
                this.iddepa = distri.id;
                this.newDistri = distri.name;
                this.idpaise=distri.idpais;
                this.iddepars=distri.iddepar;
                this.idprovs=distri.idprovi;
                // this.newPais = distri.paises_id;
                // si te escucho pero no me escuchas tu creo

                this.$nextTick(function () {
                    $("#cboPaises").val(this.idpaise).trigger('change');
                    $("#cboDepartamentos").val(this.iddepars).trigger('change');
                    $("#cboProvincias").val(this.idprovs).trigger('change');
                });
                
                // $("#cboDepartamentos").val(1).trigger('change');
                // $("#cboProvincias").val(1).trigger('change');
                this.diveditar = true;
                this.divnuevo = false;
            },
            deleteDepa: function(distri) {
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
                        var url = "distri/" + distri.id;
                        var data = new FormData();
                        data.append('tipo', 'eliminar');
                        data.append('_method', 'PUT');
                        axios.post(url, data).then(response => {
                            if (response.data.result == '1') {
                                this.getDistrito(this.thispage);
                                alert(response.data.msj);
                            } else {
                                alert(response.data.msj);
                            }
                        });
                    }
                }).catch(swal.noop);
            },
            update: function() {
                var url = "distri/" + this.iddepa;
                if ($("#cboPaises").val() != null) {
                    this.newPais = $("#cboPaises").val();
                }
                if ($("#cboDepartamentos").val() != null) {
                    this.newDepa = $("#cboDepartamentos").val();
                }
				if ($("#cboProvincias").val() != null) {
                    this.newProvi = $("#cboProvincias").val();
                }
                var data = new FormData();
                data.append('newDistri', this.newDistri);
                data.append('newProvi', this.newProvi);
                data.append('newDepa', this.newDepa);
                data.append('newPais', this.newPais);
                data.append('tipo', 'editar');
                data.append('_method', 'PUT');
                axios.post(url, data).then(response => {
                    console.log(response.data.result);
                    if (response.data.result == '1') {
                        this.getDistrito(this.thispage);
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