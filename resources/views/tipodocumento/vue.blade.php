<script type="text/javascript">
	let app = new Vue({
		el: '#app',
		data:{
      		cate:'',
      		tipodocs: [],
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
   			this.getTipodocumento(this.thispage);
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
        buscartipodoc:function() {
          this.getTipodocumento(this.thispage);
        },
   			guardar: function () {
   				var url='tipodoc';
       		var data = new  FormData();
          data.append('cate', this.cate);
          axios.post(url,data).then(response=>{
              if(String(response.data.result)=='1'){
               this.getTipodocumento(this.thispage);
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
   			getTipodocumento: function (page) {
            var busca=this.buscar;
       			var url = 'tipodoc?page='+page+'&busca='+busca;
       			axios.get(url).then(response=>{
           		this.tipodocs= response.data.tipodocumentos.data;
              this.pagination= response.data.pagination;
              if(this.tipodocs.length==0 && this.thispage!='1'){
                var a = parseInt(this.thispage) ;
                a--;
                this.thispage=a.toString();
                this.changePage(this.thispage);
              }
       			})
   			},
        changePage:function (page) {
          this.pagination.current_page=page;
          this.getTipodocumento(page);
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
        editartipodoc:function (cate) {
          this.idcat=cate.id;
          this.newcat=cate.name;
          this.diveditar=true;
          this.divnuevo=false;
        },
        borrartipodoc:function (cate) {
          swal.fire({
             title: '¿Estás seguro?',
             text: "Desea eliminar este tipo de documento",
             type: 'info',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Si, Eliminar'
           }).then((result) => {
            if (result.value) {
                var url="tipodoc/"+cate.id;
                var data = new  FormData();
                data.append('tipo','eliminar');
                data.append('_method', 'PUT');
                axios.post(url,data).then(response=>{
                  if(response.data.result=='1'){
                    this.getTipodocumento(this.thispage);
                    alert(response.data.msj);
                  }else{
                    alert(response.data.msj);
                  }
                });
            }
          }).catch(swal.noop);  
   },
        updatetipodoc:function () {     
          var url="tipodoc/"+this.idcat;
          var data = new  FormData();
          data.append('newcat', this.newcat);
          data.append('tipo','editar');
          data.append('_method', 'PUT');
          axios.post(url, data).then(response=>{
              if(response.data.result=='1'){   
                this.getTipodocumento(this.thispage);
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