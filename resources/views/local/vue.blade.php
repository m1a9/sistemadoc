<script type="text/javascript">
	let app = new Vue({
		el: '#app',
		data:{
          idlocal:'',

          cbodistr:'0',
          txtnomloc:'',
          txtdirloc:'',

          cbodistre:'0',
          txtnomloce:'',
          txtdirloce:'',

          buscar:'',
          locales:[],
          distritos:[],
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
   			this.getLocales(this.thispage);
        
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
        buscarlocal:function() {
          this.getLocales(this.thispage);
        },
   			guardar: function () {
   				var url='local';
       		var data = new  FormData();
          if (this.cbodistr!=0 && this.txtnomloc.trim()!="" && this.txtdirloc.trim()!="") {
          data.append('cbodistr', this.cbodistr);
          data.append('txtnomloc', this.txtnomloc);
          data.append('txtdirloc', this.txtdirloc);
          axios.post(url,data).then(response=>{
              if(String(response.data.result)=='1'){
                this.getLocales(this.thispage);
                toastr.success(response.data.msj);
                this.cerrarFormNuevo();
              }else{
                toastr.warning(response.data.msj); 
              }
          }).catch(error=>{  
          })
          }else{
            toastr.warning("Debe llenar todos los campos");
          }
   			},
   			getLocales: function (page) {
            var busca=this.buscar;
       			var url = 'local?page='+page+'&busca='+busca;
       			axios.get(url).then(response=>{
           		this.locales= response.data.locales.data;
              console.log(response.data.locales.data);
              this.pagination= response.data.pagination;
              this.distritos=response.data.distritos;
              console.log(response.data.distritos);
              if(this.locales.length==0 && this.thispage!='1'){
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
          this.limpiar();
          this.divnuevo=false;
          this.diveditar=false;
          this.cancelFormNuevo();
        },
        cancelFormNuevo: function () {
          this.limpiar();
          $('#txtcate').focus();
        },
        cerrarFormeditar: function () {
          this.limpiar();
          this.diveditar=false;
          this.divnuevo=false;
        },
        seleccionarlocal:function (local) {
          this.idlocal=local.id;
          this.txtnomloce=local.name;
          this.txtdirloce=local.direccion;
          this.cbodistre=local.iddis;
          this.diveditar=true;
          this.divnuevo=false;
        },
        limpiar:function(){
          this.idlocal='';
          this.cbodistr='0';
          this.txtnomloc='';
          this.txtdirloc='';
          this.cbodistre='0';
          this.txtnomloce='';
          this.txtdirloce='';
        },
        editarlocal:function () {  
          var url="local/"+this.idlocal;
          var data = new  FormData();
          if (this.cbodistre!=0 && this.txtnomloce.trim()!="" && this.txtdirloce.trim()!="") {
            data.append('cbodistre', this.cbodistre);
            data.append('txtnomloce', this.txtnomloce);
            data.append('txtdirloce', this.txtdirloce);
            data.append('_method', 'PUT');
            axios.post(url, data).then(response=>{
              if(response.data.result=='1'){   
                  this.getLocales(this.thispage);
                  toastr.success(response.data.msj);  
                  this.cerrarFormeditar();
              }else{
                  toastr.warning(response.data.msj); 
              }
          }).catch(error=>{
          })
        }else{
          toastr.success("Debe llenar todos los campos");
        }
        },

		},
	});
</script>
