<script type="text/javascript">
  let app = new Vue({
    el: '#app',
    data: {
      archivo: null,
      cbonuex: 0,
      txtbusexpe: '',
      divbuscarexpe: false,
      divnuevoexpe:false,
      divexisexpe:false,
    },
    created: function() {},
    methods: {
      cambiar: function() {
        if (this.cbonuex == 0) {
          this.divbuscarexpe = false;
          this.divnuevoexpe=false;
          this.divexisexpe=false;
        }
        if (this.cbonuex == 1) {
          this.divbuscarexpe = false;
          this.divnuevoexpe=true;
          this.divexisexpe=false;
        }
        if (this.cbonuex == 2) {
          this.divbuscarexpe = true;
          this.divnuevoexpe=false;
          this.divexisexpe=true;
        }

      },
      getArchivo(event) {
        if (!event.target.files.length) {
          this.archivo = null;
        } else {
          this.archivo = event.target.files[0];
        }
      },
      subir: function() {
        var url = 'archivo';
        var data = new FormData();
        if (this.archivo != null) {
          data.append('archivo', this.archivo);
          const config = {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          };
          axios.post(url, data, config).then(response => {
            console.log(response.data.result);
          }).catch(error => {})
        } else {
          toastr.success("Debe llenar todos los campos");
        }
      },
    },
  });
</script>