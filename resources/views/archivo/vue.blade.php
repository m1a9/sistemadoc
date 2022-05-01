<script type="text/javascript">
	let app = new Vue({
		el: '#app',
		data:{ 
      archivo:null,   
		},
		created:function () {   
		},
		methods: {
          getArchivo(event){
      if (!event.target.files.length){
          this.archivo=null;
      }else{
          this.archivo = event.target.files[0];
      }
    },
   			subir: function () {
   				var url='archivo';
       		var data = new  FormData();
          if (this.archivo!=null) {
          data.append('archivo', this.archivo);
          const config = { headers: { 'Content-Type': 'multipart/form-data' } };
          axios.post(url,data,config).then(response=>{
             console.log(response.data.result); 
          }).catch(error=>{  
          })
          }else{
            toastr.success("Debe llenar todos los campos");
          }
   			},
		},
	});
</script>
