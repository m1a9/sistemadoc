<script type="text/javascript">
    let app = new Vue({
        el: '#app',
        data: {
            iddepa:'',
            docu:'',
            apell:'',
            nom:'',
            direcc:'',
            cel:'',
            correo:'',
            password:'',
            pass1:'',
            pass2:'',
            usuarios:[],
            buscar:'',
            tpuser:'',
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
        },
        methods: {
            actualizar: function() {
            alert("funciona");
            var url='perfils';
            console.log(this.pass1);
            console.log(this.pass2);
            },
            getProvincia: function(page) {
                var busca = this.buscar;
                var url = 'perfils?page=' + page + '&busca=' + busca;

                axios.get(url).then(response => {
                    this.usuarios = response.data.usuarios.data;
                    console.log(this.usuarios);
                    this.pagination = response.data.pagination;
                    if (this.usuarios.length == 0 && this.thispage != '1') {
                        var a = parseInt(this.thispage);
                        a--;
                        this.thispage = a.toString();
                        this.changePage(this.thispage);
                    }
                })
                console.log(this.usuarios);

            },
            nuevo: function() {
                $('#txtpass2').focus();
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
        },
    });
</script>