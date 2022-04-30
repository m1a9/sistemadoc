<div class="card card-primary">
	<div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
	   <h3 class="card-title">Gestión de locales</h3>
	   <a type="button" class="btn" style="float: right;background-color: #3c8dbc;" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
		 Volver</a>
	  </div> 
   <div class="card-body" style="border: 1px solid #3c8dbc;">
	   <div class="form-group">
			 <button type="button" class="btn" style="background-color: #3c8dbc; color: white;" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Nuevo Local</button>
	   </div>
   </div>
</div>
<div class="card" v-if="diveditar" style="border: 1px solid #00a65a;">
   <div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
	   Editar Local
   </div>
   <div class="card-body" style="border: 1px solid #00a65a;">
   	   	<div class="row">
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Local</label>
   				<select class="form-control" v-model="cboloce" @change="cambiararea()">
   					<option value="0">Seleccione</option>
					<option v-for="loc in local" v-bind:value="loc.id">@{{ loc.name }}</option>
   				</select>
   			</div>
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Subárea</label>
   				<select class="form-control" id="cbodistre" v-model="cbosuba">
   					<option value="0">Seleccione</option>
					<option v-for="ar in area" v-bind:value="ar.id">@{{ ar.name }}</option>
   				</select>
   			</div>
   		</div>
   		<div class="row">
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Área</label>
   				<input class="form-control" type="text" v-model="txtnomae">
   			</div>
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Correo</label>
   				<input class="form-control" type="text" v-model="txtcorre">
   			</div>
   		</div>
   		<div class="row">
   			<div class="form-group col-md-3 col-sm-6">
   				<label>Sigla</label>
   				<input class="form-control" type="text" v-model="txtsiglae">
   			</div>
   			<div class="form-group col-md-3 col-sm-6">
   				<label>Telefono</label>
   				<input class="form-control" type="text" v-model="txttele">
   			</div>
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Anexo</label>
   				<input class="form-control" type="text" v-model="txtanexoe">
   			</div>
   		</div>
	   <div class="card-footer bg-transparent">
		   <button class="btn btn-info" v-on:click="editarlocal()">Guardar cambio</button>
		   <button class="btn btn-light" v-on:click="cerrarFormeditar()">Cerrar</button>
	   </div>
   </div>
</div>
<div class="card" v-if="divnuevo" style="border: 1px solid #00a65a;">
   <div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
	   Registro de áreas
   </div>
   <div class="card-body" style="border: 1px solid #00a65a;">
   		<div class="row">
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Local</label>
   				<select class="form-control" v-model="cboloc" @change="cambiararea()">
   					<option value="0">Seleccione</option>
					<option v-for="loc in local" v-bind:value="loc.id">@{{ loc.name }}</option>
   				</select>
   			</div>
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Subárea</label>
   				<select class="form-control" id="cbodistr" v-model="cbosuba">
   					<option value="0">Seleccione</option>
					<option v-for="ar in area" v-bind:value="ar.id">@{{ ar.name }}</option>
   				</select>
   			</div>
   		</div>
   		<div class="row">
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Área</label>
   				<input class="form-control" type="text" v-model="txtnoma">
   			</div>
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Correo</label>
   				<input class="form-control" type="text" v-model="txtcorr">
   			</div>
   		</div>
   		<div class="row">
   			<div class="form-group col-md-3 col-sm-6">
   				<label>Sigla</label>
   				<input class="form-control" type="text" v-model="txtsigla">
   			</div>
   			<div class="form-group col-md-3 col-sm-6">
   				<label>Telefono</label>
   				<input class="form-control" type="text" v-model="txttel">
   			</div>
   			<div class="form-group col-md-6 col-sm-6">
   				<label>Anexo</label>
   				<input class="form-control" type="text" v-model="txtanexo">
   			</div>
   		</div>
	   <div class="card-footer bg-transparent">
		   <button class="btn btn-info" v-on:click="guardar()">Guardar</button>
		   <button class="btn btn-warning" v-on:click="cancelFormNuevo()">Cancelar</button>
		   <button class="btn btn-light" v-on:click="cerrarFormNuevo()">Cerrar</button>
	   </div>
   </div>
</div>
<div class="card" style="border: 1px solid #3c8dbc;">
   <div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
	   <h3 class="card-title">Lista de Áreas</h3>
	   <div class="card-tools">
		   <input type="text" class="form-control form-control-sm" v-model="buscar" v-on:keyup="buscarlocal" placeholder="Buscar...">
	   </div>
   </div>
   <div class="card-body table-responsive">
	   <table class="table table-hover table-bordered table-striped">
		   <thead>
			   <tr>
				   <th style="border:1px solid #ddd;padding: 5px; width: 5%;">#</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 25%;">Local</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 20%;">Área</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 20%;">Subárea</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 20%;">Dirección</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 10%;">Gestion</th>
			   </tr>
		   </thead>
		   <tbody>
			   <tr v-for=" local,key in locales">
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{key+pagination.from}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{local.nomloc}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{local.nomare1}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{local.nomare2}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{local.direccion}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">
					   <center>
					   <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="seleccionarlocal(local)" data-placement="top" data-toggle="tooltip" title="Editar local">
						   <i class="fa fa-edit"></i></a>
						  </center>
					  </td>
			   </tr>
		   </tbody>
	   </table>
   </div>
   <div style="padding: 15px;">
	   <div><h6>Registros por Página: @{{ pagination.per_page }}</h6></div>
			<nav aria-label="Page navigation example">
				  <ul class="pagination">
				   <li class="page-item" v-if="pagination.current_page>1">
						<a class="page-link" href="#" @click.prevent="changePage(1)">
							 <span><b>Inicio</b></span>
					   </a>
					 </li>
					 <li class="page-item" v-if="pagination.current_page>1">
						  <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page-1)">
						   <span>Atras</span>
						 </a>
				   </li>
				   <li class="page-item" v-for="page in pagesNumber" v-bind:class="[page=== isActived ? 'active' : '']">
						<a class="page-link" href="#" @click.prevent="changePage(page)">
							 <span>@{{ page }}</span>
					   </a>
					 </li>
					 <li class="page-item" v-if="pagination.current_page< pagination.last_page">
						  <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page+1)">
						   <span>Siguiente</span>
						 </a>
					 </li>
					 <li class="page-item" v-if="pagination.current_page< pagination.last_page">
						  <a class="page-link" href="#" @click.prevent="changePage(pagination.last_page)">
						   <span><b>Ultima</b></span>
						 </a>
					 </li>
				 </ul>
			 </nav>
			 <div><h6>Registros Totales: @{{ pagination.total }}</h6></div>
	 </div>
</div>