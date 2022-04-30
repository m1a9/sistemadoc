<script type="text/javascript">
	let app = new Vue({
		el: '#app',
		data:{
          idlocal:'',

          cboloc:'0',
          cbosuba:'0',
          txtnoma:'',
          txtcorr:'',
          txtsigla:'',
          txttel:'',
          txtanexo:'',

          cboloce:'0',
          cbosubae:'0',
          txtnomae:'',
          txtcorre:'',
          txtsiglae:'',
          txttele:'',
          txtanexoe:'',

          buscar:'',
          locales:[],
          area:[],
          local:[],
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
        cambiararea: function () {
          if (this.cboloc!=0) {
            var url='/api/locales/'+this.cboloc+'/areas';
            axios.get(url).then(response=>{
              this.area=response.data.area;
              console.log(response.data);
            }).catch(error=>{  
            })
          }else{
            this.cbosuba=0;
            this.area=[];
          }
        },
   			guardar: function () {
   				var url='area';
       		var data = new  FormData();
          if (this.cboloc!=0 && this.txtnoma.trim()!="" && this.txtcorr.trim()!="" && this.txtsigla.trim()!="" && this.txttel.trim()!="" && this.txtanexo.trim()!="") {
          data.append('cboloc', this.cboloc);
          data.append('txtnoma', this.txtnoma);
          data.append('txtcorr', this.txtcorr);
          data.append('txtsigla', this.txtsigla);
          data.append('txttel', this.txttel);
          data.append('txtanexo', this.txtanexo);

          if (this.cbosuba==0) {
              data.append('cbosuba','');
          }else{
            data.append('cbosuba', this.cbosuba);
          }
          

          axios.post(url,data).then(response=>{
              if(String(response.data.result)=='1'){
                this.getLocales(this.thispage);
                toastr.success(response.data.msj);
                this.cerrarFormNuevo();
              }else{
                toastr.warning(response.data.msj); 
              }
              console.log(response.data);
          }).catch(error=>{  
          })
          }else{
            toastr.success("Debe llenar todos los campos");
          }
   			},
   			getLocales: function (page) {
            var busca=this.buscar;
       			var url = 'area?page='+page+'&busca='+busca;
       			axios.get(url).then(response=>{
           		this.locales= response.data.locales.data;
              this.pagination= response.data.pagination;
              this.local=response.data.local;
              console.log(response.data.locales.data);
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
          this.idlocal=local.ida1;
          this.cboloce=local.idlocare1;
          this.cbosubae=local.idareare1;
          this.txtnomae=local.nomare1;
          this.txtcorre=local.corare1;
          this.txtsiglae=local.sigare1;
          this.txttele=local.telare1;
          this.txtanexoe=local.aneare1;

          this.diveditar=true;
          this.divnuevo=false;
        },
        limpiar:function(){
          this.cboloc='0';
          this.cbosuba='0';
          this.txtnoma='';
          this.txtcorr='';
          this.txtsigla='';
          this.txttel='';
          this.txtanexo='';
        },
        editarlocal:function () {  
          var url="area/"+this.idlocal;
          var data = new  FormData();
          if (this.cboloce!=0 && this.txtnomae.trim()!="" && this.txtcorre.trim()!="" && this.txtsiglae.trim()!="" && this.txttele.trim()!="" && this.txtanexoe.trim()!="") {
          data.append('cboloce', this.cboloce);
          data.append('txtnomae', this.txtnomae);
          data.append('txtcorre', this.txtcorre);
          data.append('txtsiglae', this.txtsiglae);
          data.append('txttele', this.txttele);
          data.append('txtanexoe', this.txtanexoe);
          data.append('cbosubae', this.cbosubae);
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
