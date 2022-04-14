<div class="card card-primary">
	<div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
	   <h3 class="card-title">Gestión de Paises</h3>
	   <a type="button" class="btn" style="float: right;background-color: #3c8dbc;" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
		 Volver</a>
	  </div> 
   <div class="card-body" style="border: 1px solid #3c8dbc;">
	   <div class="form-group">
			 <button onclick="onComboSelect()" type="button" class="btn" style="background-color: #3c8dbc; color: white;" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true"  ></i> Nuevo Departamento</button>
	   </div>
   </div>
</div>

{{-- -- editar --}}
<div class="card" v-if="diveditar" style="border: 1px solid #00a65a;">
   <div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
	   Editar Categoria
   </div>
   <div class="card-body" style="border: 1px solid #00a65a;">
	<div class="form-group">
		<label>Pais</label>
		<select name="cboPaises" id="cboPaises" class="form-control">
			<option value="">Selecciona</option>
			<option v-for="ps, key in pais" v-bind:value="ps.id">@{{ ps.name }}</option>
		</select>

		<label>Departamento</label>
		<select name="cboDepartamentos" id="cboDepartamentos" class="form-control">
			<option value="">Selecciona</option>
			<option v-for="ps, key in depa" v-bind:value="ps.id">@{{ ps.name }}</option>
		</select>

		<label>Provincias</label>
		<select name="cboProvincias" id="cboProvincias" class="form-control">
			<option value="">Selecciona</option>
			<option v-for="ps, key in provi" v-bind:value="ps.id">@{{ ps.name }}</option>
		</select>

		<label>Distritos</label>
		<input type="text" class="form-control" id="txtdistr" name="name" v-model="newDistri">
	</div>
	   <div class="card-footer bg-transparent">
		   <button class="btn btn-primary" v-on:click="update()">Guardar cambio</button>
		   <button class="btn btn-primary" v-on:click="cerrarFormeditar()">Cerrar</button>
	   </div>
   </div>
</div>

{{-- -- Crear --}}
{{-- <form v-on:submit.prevent="createDepartamento"> --}}
<div class="card" v-if="divnuevo" style="border: 1px solid #00a65a;">
   <div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
	   Registrar Departamento
   </div>
   <div class="card-body" style="border: 1px solid #00a65a;">
	<div class="form-group">
		<label>Pais</label>
		<select name="cboPaises" id="cboPaises" class="form-control">
			<option value="">Selecciona</option>
			<option v-for="ps, key in pais" v-bind:value="ps.id">@{{ ps.name }}</option>
		</select>

		<label>Departamento</label>
		<select name="cboDepartamentos" id="cboDepartamentos" class="form-control">
			<option value="">Selecciona</option>
			<option v-for="ps, key in depa" v-bind:value="ps.id">@{{ ps.name }}</option>
		</select>

		<label>Provincias</label>
		<select name="cboDepartamentos" id="cboProvincias" class="form-control">
			<option value="">Selecciona</option>
			<option v-for="ps, key in provi" v-bind:value="ps.id">@{{ ps.name }}</option>
		</select>

		<label>Distrito</label>
		<input type="text" class="form-control" id="txtdistr" name="name" v-model="newDistri">
	</div>
	   <div class="card-footer bg-transparent">
		   <button class="btn btn-primary" v-on:click="guardar()">Guardar</button>
		   <button class="btn btn-primary" v-on:click="cancelFormNuevo()">Cancelar</button>
		   <button class="btn btn-primary" v-on:click="cerrarFormNuevo()">Cerrar</button>
	   </div>
   </div>
</div>
{{-- </form> --}}
<div class="card" style="border: 1px solid #3c8dbc;">
   <div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
	   <h3 class="card-title">Lista de Departamentos</h3>
	   <div class="card-tools">
		   <input type="text" class="form-control form-control-sm" v-model="buscar" v-on:keyup="buscarcategoria" placeholder="Buscar...">
	   </div>
   </div>
   <div class="card-body table-responsive">
	   <table class="table table-hover table-bordered table-striped">
		   <thead>
			   <tr>
				   <th style="border:1px solid #ddd;padding: 5px; width: 10%;">#</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 17.5%;">Distritos</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 17.5%;">Provincias</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 17.5%;">Departamento</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 17.5%;">Pais</th>
				   <th style="border:1px solid #ddd;padding: 5px; width: 20%;">Gestión</th>
				   
			   </tr>
		   </thead>
		   <tbody>
			   <tr v-for="cat, key in distritos">
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{key+pagination.from}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.name}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.proviname}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.depaname}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.paisname}}</td>
				   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">
					   <center>
					   <a href="#" 
					   onclick="onComboSelect()" 
					   class="btn btn-warning btn-sm" v-on:click.prevent="editar(cat)" data-placement="top" data-toggle="tooltip" title="Editar Departamento">
						   <i class="fa fa-edit"></i></a>
						  <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteDepa(cat)" data-placement="top" data-toggle="tooltip" title="Borrar Departamento">
							  <i class="fa fa-trash"></i>
						  </a>
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
function onComboSelect(){
		console.log('funciona');
$(function() {
        $('#cboPaises').on('change', onSeleccionaPais);
        $('#cboDepartamentos').on('change', onSeleccionaDepa);
        $('#cboDepartamentos').attr('disabled', true);
        $('#cboProvincias').attr('disabled', true);

    });

    function onSeleccionaPais() {
        var paises_id = $(this).val();
		var html_select = '<option>Selecciona</option>'
        if (!paises_id){
            $('#cboDepartamentos').html(html_select);
            $('#cboProvincias').html(html_select);

		}else{

        $.get('/api/paises/' + paises_id + '/departamentos', function(data) {
			$('#cboDepartamentos').attr('disabled', false);
            var html_select = '<option value="">Selecciona</option>'
            for (var i = 0; i < data.length; ++i)
                html_select += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
            $('#cboDepartamentos').html(html_select);
        });}
    }

	function onSeleccionaDepa(){
		var departamentos_id = $(this).val();
		var html_select = '<option>Selecciona</option>';
		if(!departamentos_id){
			$('#cboProvincias').html(html_select);
        }else{

		$.get('/api/departamentos/'+departamentos_id+'/provincias',function(data){
			$('#cboProvincias').attr('disabled', false);
			var html_select = '<option value="">Selecciona</option>'
			for(var i=0; i<data.length; ++i)
				html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
				$('#cboProvincias').html(html_select);
		});}
	}
}
</script>