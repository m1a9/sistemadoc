<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">Complete el Formulario para Inicializar un Trámite</h3>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="form-group col-md-12">
				<label>Expediente</label>
				<select v-model="cbonuex" class="form-control" @change="cambiar()">
					<option value="0">Seleccione</option>
					<option value="1">Nuevo</option>
					<option value="2">Existente</option>
				</select>
			</div>
		</div>
		<div class="row" v-if="divbuscarexpe">
			<div class="form-group col-md-12">
				<label>Buscar</label>
				<div class="input-group">
					<input type="text" class="form-control" v-model="txtbusexpe">
					<div class="input-group-append">
						<button class="btn btn-primary" id="btnbuscli"><i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row" v-if="divnuevoexpe">
			<div class="col-md-6">
				<div class="row">
					<div class="form-group col-md-6 col-sm-6">
						<label>Número</label>
						<input type="text" class="form-control" autocomplete="off">
					</div>
					<div class="form-group col-md-6 col-sm-6">
						<label>Prioridad</label>
						<select class="form-control">
							<option value="0">Seleccione</option>
							<option value="1">Nomal</option>
							<option value="2">Urgente</option>
							<option value="2">Muy Urgente</option>
						</select>
					</div>
				</div>
				<div class="form-group col-md-12 col-sm-12">
					<label>Documento</label>
					<input type="text" class="form-control" autocomplete="off">
				</div>
				<div class="form-group col-md-12 col-sm-12">
					<label>Descripción</label>
					<textarea class="form-control" rows="5"></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="form-group col-md-8 col-sm-8">
						<label>Tipo de Dcocumento</label>
						<select class="form-control">
							<option value="0">Seleccione</option>
						</select>
					</div>
					<div class="form-group col-md-4 col-sm-4">
						<label>Confidencial</label>
						<select class="form-control">
							<option value="0">Seleccione</option>
							<option value="1">Si</option>
							<option value="2">No</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-8 col-sm-8">
						<label>Archivo</label>
						<input type="file" class="form-control">
					</div>
					<div class="form-group col-md-4 col-sm-4">
						<label>Folios</label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group col-md-12 col-sm-12">
					<label>Asunto</label>
					<textarea class="form-control" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group">
				<center>
					<button id="btnguardar" class="btn btn-info">Guardar</button>
					<button id="btncancelar" class="btn btn-danger">Cancelar</button>
				</center>
			</div>
		</div>
		<div class="row" v-if="divexisexpe">
			<div class="col-md-6">
				<div class="row">
					<div class="form-group col-md-12 col-sm-12">
						<label>Número</label>
						<input type="text" class="form-control" autocomplete="off" disabled>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-8 col-sm-8">
						<label>Tipo de Dcocumento</label>
						<select class="form-control">
							<option value="0">Seleccione</option>
						</select>
					</div>
					<div class="form-group col-md-4 col-sm-4">
						<label>Confidencial</label>
						<select class="form-control">
							<option value="0">Seleccione</option>
							<option value="1">Si</option>
							<option value="2">No</option>
						</select>
					</div>
				</div>
				<div class="form-group col-md-12 col-sm-12">
					<label>Documento</label>
					<input type="text" class="form-control" autocomplete="off">
				</div>

			</div>
			<div class="col-md-6">

				<div class="row">
					<div class="form-group col-md-8 col-sm-8">
						<label>Archivo</label>
						<input type="file" class="form-control">
					</div>
					<div class="form-group col-md-4 col-sm-4">
						<label>Folios</label>
						<input type="text" class="form-control">
					</div>
				</div>
				<div class="form-group col-md-12 col-sm-12">
					<label>Descripción</label>
					<textarea class="form-control" rows="5"></textarea>
				</div>
			</div>
			<div class="form-group">
				<center>
					<button id="btnguardar" class="btn btn-info">Guardar</button>
					<button id="btncancelar" class="btn btn-danger">Cancelar</button>
				</center>
			</div>
		</div>
	</div>
</div>