<script type="text/javascript">
	let app = new Vue({
		el: '#app',
		data:{
      		cate:'',
      		tipousus: [],
          idcat:'',
          newcat:'',
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
   			this.getTipousuario(this.thispage);
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
        buscartipousu:function() {
          this.getTipousuario(this.thispage);
        },
   			guardar: function () {
   				var url='tipousu';
       		var data = new  FormData();
          data.append('cate', this.cate);
          axios.post(url,data).then(response=>{
              if(String(response.data.result)=='1'){
               this.getTipousuario(this.thispage);
                if (response.data.exi=='0') {
                  toastr.warning(response.data.msj);
                }else{
                  this.cerrarFormNuevo();
                  toastr.success(response.data.msj); 
                } 
              }else{
                $('#'+response.data.selector).focus();
                $('#'+response.data.selector).css( "border", "1px solid red");
                  toastr.warning(response.data.msj);
              }
          }).catch(error=>{  
          })
   			},
   			getTipousuario: function (page) {
            var busca=this.buscar;
       			var url = 'tipousu?page='+page+'&busca='+busca;
       			axios.get(url).then(response=>{
           		this.tipousus= response.data.tipousuarios.data;
              this.pagination= response.data.pagination;
              if(this.tipousus.length==0 && this.thispage!='1'){
                var a = parseInt(this.thispage) ;
                a--;
                this.thispage=a.toString();
                this.changePage(this.thispage);
              }
       			})
   			},
        changePage:function (page) {
          this.pagination.current_page=page;
          this.getTipousuario(page);
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
          this.cate='';
          $('#txtcate').focus();
        },
        cerrarFormeditar: function () {
          this.diveditar=false;
          this.divnuevo=false;
        },
        editartipousu:function (cate) {
          this.idcat=cate.id;
          this.newcat=cate.name;
          this.diveditar=true;
          this.divnuevo=false;
        },
        borrartipousu:function (cate) {
          swal.fire({
             title: '¿Estás seguro?',
             text: "Desea eliminar este tipo de usuario",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Eliminar'
           }).then((result) => {
            if (result.value) {
                var url="tipousu/"+cate.id;
                var data = new  FormData();
                data.append('tipo','eliminar');
                data.append('_method', 'PUT');
                axios.post(url,data).then(response=>{
                  if(response.data.result=='1'){
                    this.getTipousuario(this.thispage);
                    toastr.success(response.data.msj);
                  }else{
                    toastr.warning(response.data.msj);
                  }
                });
            }
          }).catch(swal.noop);  
   },
        updatetipousu:function () {     
          var url="tipousu/"+this.idcat;
          var data = new  FormData();
          data.append('newcat', this.newcat);
          data.append('tipo','editar');
          data.append('_method', 'PUT');
          axios.post(url, data).then(response=>{
              if(response.data.result=='1'){   
                this.getTipousuario(this.thispage);
                if (response.data.exi=='0') {
                  toastr.warning(response.data.msj);
                }else{
                  this.cerrarFormeditar();
                  toastr.success(response.data.msj); 
                } 
              }else{
                $('#'+response.data.selector).focus();
                $('#'+response.data.selector).css( "border", "1px solid red");
                toastr.warning(response.data.msj);
              }
          }).catch(error=>{
          })
        },
		},
	});
</script>