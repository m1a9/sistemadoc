<script type="text/javascript">
    let app = new Vue({
        el: '#app',
        data: {
            iddepa:'',
            tipoDoc:'',
            tipoSoli:'',
            tipoUser:'',
            docu:'',
            apell:'',
            nom:'',
            direcc:'',
            cel:'',
            correo:'',
            password:'',
            cboTipoDoc:'',
            cboTipoUser:'',
            cboTipoSoli:'',
            tipouser: [],
            tipodocumento: [],
            tiposoli:[],
            usuarios:[],
            buscar:'',
            pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
          },
          idper:'0',
          offset: 9,
          thispage:'1',
          divnuevo:false,
          diveditar:false,


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
            guardar1: function() {
                var url = 'usu';
                if ($("#cboTipoUser").val() != null) {
                    this.tipoUser = $("#cboTipoUser").val();
                }
                if ($("#cboTipoSoli").val() != null) {
                    this.tipoSoli = $("#cboTipoSoli").val();
                }
                if ($("#cboTipoDoc").val() != null) {
                    this.tipoDoc = $("#cboTipoDoc").val();
                }
                console.log(this.tipoUser);
                var data = new FormData();
                data.append('tipoDoc', this.tipoDoc);
                data.append('docu', this.docu);
                data.append('tipoUser', this.tipoUser);
                data.append('tipoSoli', this.tipoSoli);
                data.append('apell', this.apell);
                data.append('nom', this.nom);
                data.append('direcc', this.direcc);
                data.append('cel', this.cel);
                data.append('correo', this.correo);
                data.append('password', this.password);

                axios.post(url, data).then(response => {
                    if (String(response.data.result) == '1') {
                        this.getProvincia(this.thispage);
                        if (response.data.exi == '0') {
                            alertify.error(response.data.msj);
                            console.log('repetido');
                        } else {
                            this.cerrarFormNuevo();
                            alertify.success(response.data.msj);
                            console.log('repetido2');

                        }
                    } else {
                        $('#' + response.data.selector).focus();
                        $('#' + response.data.selector).css("border", "1px solid red");
                        alertify.error(response.data.msj);
                        console.log('repetido3');

                    }
                }).catch(error => {})
            },
            guardar: function() {
                var url = 'usu';
                if ($("#cboTipoUser").val() != null) {
                    this.tipoUser = $("#cboTipoUser").val();
                }
                if ($("#cboTipoSoli").val() != null) {
                    this.tipoSoli = $("#cboTipoSoli").val();
                }
                if ($("#cboTipoDoc").val() != null) {
                    this.tipoDoc = $("#cboTipoDoc").val();
                }
                var data = new FormData();
                data.append('tipoDoc', this.tipoDoc);
                data.append('docu', this.docu);
                data.append('tipoUser', this.tipoUser);
                data.append('tipoSoli', this.tipoSoli);
                data.append('apell', this.apell);
                data.append('nom', this.nom);
                data.append('direcc', this.direcc);
                data.append('cel', this.cel);
                data.append('correo', this.correo);
                data.append('password', this.password);
                axios.post(url, data).then(response => {
                    if (String(response.data.result) == '1') {
                        this.getProvincia(this.thispage);
                        if (response.data.exi == '0') {
                            alertify.error(response.data.msj);
                            console.log('repetido');
                        } else {
                            this.cerrarFormNuevo();
                            alertify.success(response.data.msj);
                            console.log('repetido2');

                        }
                    } else {
                        $('#' + response.data.selector).focus();
                        $('#' + response.data.selector).css("border", "1px solid red");
                        alertify.error(response.data.msj);
                        console.log('repetido3');

                    }
                }).catch(error => {})
            },
            getProvincia: function(page) {
                var busca = this.buscar;
                var url = 'usu?page=' + page + '&busca=' + busca;
                var url2='user';
                axios.get(url).then(response => {
                    this.usuarios = response.data.usuarios.data;
                    this.pagination = response.data.pagination;
                    if (this.usuarios.length == 0 && this.thispage != '1') {
                        var a = parseInt(this.thispage);
                        a--;
                        this.thispage = a.toString();
                        this.changePage(this.thispage);
                    }
                })
                axios.get(url).then(response => {
                    this.tipouser = response.data.tipouser;
                })
                axios.get(url).then(response => {
                    this.tipodocumento = response.data.tipodocumento;
                })
                axios.get(url).then(response => {
                    this.tiposoli = response.data.tiposoli;
                })

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
                this.docu = '';
                $('#txtdocu').focus();
            },
            cerrarFormeditar: function() {
                this.diveditar = false;
                this.divnuevo = false;
            },
            editar: function(prov) {
                this.diveditar = true;
                this.divnuevo = false;
                $('#txtcorreo').focus();
                this.iddepa = prov.id;
                this.docu = prov.documentoid;
                this.cboTipoDoc = prov.idtipodoc;
                this.cboTipoUser = prov.idtipouser;
                this.cboTipoSoli = prov.idtiposoli;
                this.apell = prov.apellidos;
                this.nom = prov.nombres;
                this.direcc = prov.direccion;
                this.cel = prov.celular;
                this.correo = prov.correo;
                this.password = prov.password;
                this.idper = prov.idper;
                console.log(this.idper);
                

            },
            deleteUser: function(prov) {
                console.log('funciona');
                this.idper = prov.idper;
                swal.fire({
                    title: '¿Estás seguro?',
                    text: "Desea eliminar este Usuario",
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar'
                }).then((result) => {
                    if (result.value) {
                        var url = "usu/" + prov.id;
                        var data = new FormData();
                        data.append('tipo', 'eliminar');
                        data.append('idper', this.idper);
                        console.log(this.idper);
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
            updateUser: function() {
                var url = "usu/" + this.iddepa;
                // var url = 'usu';
                if ($("#cboTipoUser").val() != null) {
                    this.tipoUser = $("#cboTipoUser").val();
                }
                if ($("#cboTipoSoli").val() != null) {
                    this.tipoSoli = $("#cboTipoSoli").val();
                }
                if ($("#cboTipoDoc").val() != null) {
                    this.tipoDoc = $("#cboTipoDoc").val();
                }
                var data = new FormData();
                data.append('tipoDoc', this.tipoDoc);
                data.append('docu', this.docu);
                data.append('tipoUser', this.tipoUser);
                data.append('tipoSoli', this.tipoSoli);
                data.append('apell', this.apell);
                data.append('nom', this.nom);
                data.append('direcc', this.direcc);
                data.append('cel', this.cel);
                data.append('correo', this.correo);
                data.append('password', this.password);
                data.append('idper', this.idper);
                data.append('tipo', 'editar');
                data.append('_method', 'PUT');
                console.log(this.idper);
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