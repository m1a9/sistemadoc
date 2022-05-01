<script type="text/javascript">
	let app = new Vue({
		el: '#app',
		data:{
      		pais:'',
      		paises: [],
          idpais:'',
          newPais:'',
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
		},
		created:function () {
   			this.getPaises(this.thispage);
        //  alertify.success('Success message');
		},
computed:{
   isActived: function(){
       return this.pagination.current_page;
   },
   pagesNumber: function () {
       if(!this.pagination.to){
           return [];
       }

       var from=this.pagination.current_page - this.offset
       var from2=this.pagination.current_page - this.offset
       if(from<1){
           from=1;
       }

       var to= from2 + (this.offset*2);
       if(to>=this.pagination.last_page){
           to=this.pagination.last_page;
       }

       var pagesArray = [];
       while(from<=to){
           pagesArray.push(from);
           from++;
       }
       return pagesArray;
   }
},
		methods: {
        buscarpaises:function() {
          this.getPaises(this.thispage);
        },
   			guardar: function () {
   				var url='pais';
       		var data = new  FormData();
          data.append('pais', this.pais);
          axios.post(url,data).then(response=>{
              if(String(response.data.result)=='1'){
               this.getPaises(this.thispage);
                if (response.data.exi=='0') {
                  //alert(response.data.msj);
                  alertify.error(response.data.msj);

                }else{
                  this.cerrarFormNuevo();
                  // alert(response.data.msj);
                 alertify.success(response.data.msj);
                }
              }else{
                $('#'+response.data.selector).focus();
                $('#'+response.data.selector).css( "border", "1px solid red");
                  // alert(response.data.msj);
                 alertify.warning(response.data.msj);


              }
          }).catch(error=>{
          })
   			},
   			getPaises: function (page) {
            var busca=this.buscar;
       			var url = 'pais?page='+page+'&busca='+busca;
       			axios.get(url).then(response=>{
           		this.paises= response.data.paises.data;
              console.log(response.data.paises.data);
              this.pagination= response.data.pagination;
              if(this.paises.length==0 && this.thispage!='1'){
                var a = parseInt(this.thispage) ;
                a--;
                this.thispage=a.toString();
                this.changePage(this.thispage);
              }
       			})
   			},
        changePage:function (page) {
          this.pagination.current_page=page;
          this.getPaises(page);
          this.thispage=page;
        },
        nuevo:function () {
          this.divnuevo=true;
          this.diveditar=false;
          this.$nextTick(function () {
            this.cancelFormNuevo();
          });
        },
        cerrarFormNuevo: function () {
          this.divnuevo=false;
          this.diveditar=false;
          this.cancelFormNuevo();
        },
        cancelFormNuevo: function () {
          this.pais='';
          $('#txtcate').focus();
        },
        cerrarFormeditar: function () {
          this.diveditar=false;
          this.divnuevo=false;
        },
        editarpaises:function (pais) {
          this.idpais=pais.id;
          this.newPais=pais.name;
          this.diveditar=true;
          this.divnuevo=false;
        },
        borrarpaises:function (pais) {
          swal.fire({
             title: '¿Estás seguro?',
             text: "Desea eliminar este Pais",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Eliminar'
           }).then((result) => {
            if (result.value) {
                var url="pais/"+pais.id;
                var data = new  FormData();
                data.append('tipo','eliminar');
                data.append('_method', 'PUT');
                axios.post(url,data).then(response=>{
                  if(response.data.result=='1'){
                    this.getPaises(this.thispage);
                    alert(response.data.msj);
                  }else{
                    alert(response.data.msj);
                  }
                });
            }
          }).catch(swal.noop);
   },
        updatepaises:function () {
          var url="pais/"+this.idpais;
          var data = new  FormData();
          data.append('newPais', this.newPais);
          data.append('tipo','editar');
          data.append('_method', 'PUT');
          axios.post(url, data).then(response=>{
              if(response.data.result=='1'){
                this.getPaises(this.thispage);
                if (response.data.exi=='0') {
                  alert(response.data.msj);
                }else{
                  this.cerrarFormeditar();
                  alert(response.data.msj);
                }
              }else{
                $('#'+response.data.selector).focus();
                $('#'+response.data.selector).css( "border", "1px solid red");
                alert(response.data.msj);
              }
          }).catch(error=>{
          })
        },
		},
	});
</script>
