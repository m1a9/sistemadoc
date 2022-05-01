<div class="card card-primary">
	<div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
	   <h3 class="card-title">Gestión de locales</h3>
	   <a type="button" class="btn" style="float: right;background-color: #3c8dbc;" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
		 Volver</a>
	  </div> 
   <div class="card-body" style="border: 1px solid #3c8dbc;">
	   <div class="form-group">
         <input type="file" @change="getArchivo">
			 <button type="button" class="btn" style="background-color: #3c8dbc; color: white;" @click="subir()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Nuevo Local</button>
	   </div>
   </div>
</div>