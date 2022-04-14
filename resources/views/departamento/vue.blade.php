<script type="text/javascript">
	let app = new Vue({
		el: '#app',
		data:{
          depa:'',
      		departamentos: [],
		    	pais: [],
          iddepa:'',
          newDepa:'',
          newPais:'',
          buscar:'',
          cbopaise:'',
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
   			this.getDepartamento(this.thispage);
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
        buscardepartamento:function() {
          this.getDepartamento(this.thispage);
        },
   			guardar: function () {
   				var url='departamento';
           if($("#cboPaises").val()!=null){
                this.newPais=$("#cboPaises").val();
            }
            console.log(this.newPais);
       		var data = new  FormData();
          data.append('newPais', this.newPais);
          data.append('newDepa', this.newDepa);
          axios.post(url,data).then(response=>{
              if(String(response.data.result)=='1'){
               this.getDepartamento(this.thispage);
                if (response.data.exi=='0') {
                  alert(response.data.msj);
                }else{
                  this.cerrarFormNuevo();
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
   			getDepartamento: function (page) {
           		 var busca=this.buscar;
       			var url = 'departamento?page='+page+'&busca='+busca;
       			axios.get(url).then(response=>{
           		this.departamentos= response.data.departamentos.data;
              this.pagination= response.data.pagination;
              if(this.departamentos.length==0 && this.thispage!='1'){
                var a = parseInt(this.thispage) ;
                a--;
                this.thispage=a.toString();
                this.changePage(this.thispage);
              }
       			})
				   axios.get(url).then(response=>{
           			this.pais= response.data.pais;
       			})
   			},
         changePage:function (page) {
          this.pagination.current_page=page;
          this.getDepartamento(page);
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
          this.newDepa='';
          $('#txtdepa').focus();
        },
        cerrarFormeditar: function () {
          this.diveditar=false;
          this.divnuevo=false;
        },
        editar:function (depa) {
          this.diveditar=true;
          this.divnuevo=false;

          $('#txtdepa').focus();
          this.iddepa=depa.id;
          this.newDepa=depa.name;
          this.newPais=depa.idpa;
          this.cbopaise=depa.idpa;
          
          
        },
        deleteDepa:function (depa) {
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
                var url="departamento/"+depa.id;
                var data = new  FormData();
                data.append('tipo','eliminar');
                data.append('_method', 'PUT');
                axios.post(url,data).then(response=>{
                  if(response.data.result=='1'){
                    this.getDepartamento(this.thispage);
                    alert(response.data.msj);
                  }else{
                    alert(response.data.msj);
                  }
                });
            }
          }).catch(swal.noop);  
   },
        update:function () {     
          var url="departamento/"+this.iddepa;
          if($("#cboPaises").val()!=null){
                this.newPais=$("#cboPaises").val();
            }
          var data = new  FormData();
          data.append('newDepa', this.newDepa);
          data.append('newPais', this.newPais);
          console.log(this.newPais);
          data.append('tipo','editar');
          data.append('_method', 'PUT');
          axios.post(url, data).then(response=>{
            console.log(response.data.result);
              if(response.data.result=='1'){   
                this.getDepartamento(this.thispage);
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