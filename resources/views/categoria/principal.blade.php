<div class="card card-primary">
     <div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
        <h3 class="card-title">Gestión de Categorias</h3>
        <a type="button" class="btn" style="float: right;background-color: #3c8dbc;" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
          Volver</a>
   	</div> 
    <div class="card-body" style="border: 1px solid #3c8dbc;">
        <div class="form-group">
          	<button type="button" class="btn" style="background-color: #3c8dbc; color: white;" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Nuevo Categoria</button>
        </div>
	</div>
</div>
 <div class="card" v-if="diveditar" style="border: 1px solid #00a65a;">
	<div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
		Editar Categoria
	</div>
	<div class="card-body" style="border: 1px solid #00a65a;">
		<div class="form-group">
			<label>Categoria</label>
			<input type="text" class="form-control" id="txtcatee" v-model="newcat" autocomplete="off">
		</div>
		<div class="card-footer bg-transparent">
			<button class="btn btn-info" v-on:click="updatecategoria()">Guardar cambio</button>
			<button class="btn btn-light" v-on:click="cerrarFormeditar()">Cerrar</button>
		</div>
	</div>
</div>
<div class="card" v-if="divnuevo" style="border: 1px solid #00a65a;">
	<div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
		Registrar Categoria
	</div>
	<div class="card-body" style="border: 1px solid #00a65a;">
		<div class="form-group">
			<label>Categoria</label>
			<input type="text" class="form-control" v-model="cate" id="txtcate">
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
		<h3 class="card-title">Lista de categorias</h3>
		<div class="card-tools">
			<input type="text" class="form-control form-control-sm" v-model="buscar" v-on:keyup="buscarcategoria" placeholder="Buscar...">
		</div>
	</div>
	<div class="card-body table-responsive">
		<table class="table table-hover table-bordered table-striped">
			<thead>
				<tr>
					<th style="border:1px solid #ddd;padding: 5px; width: 10%;">#</th>
					<th style="border:1px solid #ddd;padding: 5px; width: 70%;">Categoria</th>
					<th style="border:1px solid #ddd;padding: 5px; width: 20%;">Gestión</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="cat, key in categorias">
					<td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{key+pagination.from}}</td>
					<td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.name}}</td>
					<td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">
						<center>
						<a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editarcategoria(cat)" data-placement="top" data-toggle="tooltip" title="Editar categoria">
							<i class="fa fa-edit"></i></a>
               			<a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="borrarcategoria(cat)" data-placement="top" data-toggle="tooltip" title="Borrar categoria">
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



