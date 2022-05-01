<div class="card card-primary">
    <div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
       <h3 class="card-title">Gestión de usuarios</h3>
       <a type="button" class="btn" style="float: right;background-color: #3c8dbc;" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
         Volver</a>
      </div> 
   <div class="card-body" style="border: 1px solid #3c8dbc;">
       <div class="form-group">
             <button type="button" class="btn" style="background-color: #3c8dbc; color: white;" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Nuevo tipo de usuario</button>
       </div>
   </div>
</div>

{{-- Editar --}}
<div class="card" v-if="diveditar" style="border: 1px solid #00a65a;">
   <div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
       Editar tipo de usuario
   </div>
   <div class="card-body" style="border: 1px solid #00a65a;">
    <div class="form-group">
        <div class="row">
         <div class="col-lg-6">
             <label>Tipo de Documento</label>
             <select name="cboTipoDoc" id="cboTipoDoc" v-model="cboTipoDoc" class="form-control"  >
                 <option value="">Selecciona</option>
                 <option v-for="ps, key in tipodocumento" v-bind:value="ps.id">@{{ps.name}}</option>
             </select>
         </div>
         <div class="col-lg-6">
             <label>Documento</label>
             <input type="text" class="form-control" v-model="docu" id="txtdocu">
         </div>
         <div class="col-lg-6">
             <label>Tipo de Usuarios</label>
             <select name="cboTipoUser" id="cboTipoUser" v-model="cboTipoUser" class="form-control"  >
                 <option value="">Selecciona</option>
                 <option v-for="ps, key in tipouser" v-bind:value="ps.id">@{{ps.name}}</option>
             </select>
         </div>

         <div class="col-lg-6">
            <label>Tipo de Solicitante</label>
            <select name="cboTipoSoli" id="cboTipoSoli" v-model="cboTipoSoli" class="form-control"  >
                <option value="">Selecciona</option>
                <option v-for="ps, key in tiposoli" v-bind:value="ps.id">@{{ps.name}}</option>
            </select>
        </div>
        
         <div class="col-lg-6">
             <label>Apellidos</label>
             <input type="text" class="form-control" v-model="apell" id="txtapell">
         </div>
        
         <div class="col-lg-6">
             <label>Nombres</label>
             <input type="text" class="form-control" v-model="nom" id="txtnom">
         </div>
         
         <div class="col-lg-7">
             <label>Dirección</label>
             <input type="text" class="form-control" v-model="direcc" id="txtdirecc">
         </div>
        
         <div class="col-lg-5">
             <label>Celular</label>
             <input type="text" class="form-control" v-model="cel" id="txtcel">  
         </div>
         <div class="col-lg-7">
             <label>Correo</label>
             <input type="text" class="form-control" v-model="correo" id="txtcorreo">  
         </div>
         <div class="col-lg-5">
             <label>Contraseña</label>
             <input type="text" class="form-control" v-model="password" id="txtpassword">  
         </div>
     </div>
    </div>
       <div class="card-footer bg-transparent">
           <button class="btn btn-info" v-on:click="updateUser()">Guardar cambio</button>
           <button class="btn btn-light" v-on:click="cerrarFormeditar()">Cerrar</button>
       </div>
   </div>
</div>

{{-- Crear --}}
<div class="card" v-if="divnuevo" style="border: 1px solid #00a65a;">
   <div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
       Registrar Usuaro
   </div>
   <div class="card-body" style="border: 1px solid #00a65a;">
       <div class="form-group">
           <div class="row">
            <div class="col-lg-6">
                <label>Tipo de Documento</label>
                <select name="cboTipoDoc" id="cboTipoDoc" v-model="tipoDoc" class="form-control"  >
                    <option value="">Selecciona</option>
                    <option v-for="ps, key in tipodocumento" v-bind:value="ps.id">@{{ps.name}}</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Documento</label>
                <input type="text" class="form-control" v-model="docu" id="txtdocu">
            </div>
            <div class="col-lg-6">
                <label>Tipo de Usuarios</label>
                <select name="cboTipoUser" id="cboTipoUser" v-model="tipoUser" class="form-control"  >
                    <option value="">Selecciona</option>
                    <option v-for="ps, key in tipouser" v-bind:value="ps.id">@{{ps.name}}</option>
                </select>
            </div>

            <div class="col-lg-6">
                <label>Tipo de Solicitante</label>
                <select name="cboTipoSoli" id="cboTipoSoli" v-model="tipoSoli" class="form-control"  >
                    <option value="">Selecciona</option>
                    <option v-for="ps, key in tiposoli" v-bind:value="ps.id">@{{ps.name}}</option>
                </select>
            </div>
           
            <div class="col-lg-6">
                <label>Apellidos</label>
                <input type="text" class="form-control" v-model="apell" id="txtapell">
            </div>
           
            <div class="col-lg-6">
                <label>Nombres</label>
                <input type="text" class="form-control" v-model="nom" id="txtnom">
            </div>
            
            <div class="col-lg-7">
                <label>Dirección</label>
                <input type="text" class="form-control" v-model="direcc" id="txtdirecc">
            </div>
           
            <div class="col-lg-5">
                <label>Celular</label>
                <input type="text" class="form-control" v-model="cel" id="txtcel">  
            </div>
            <div class="col-lg-7">
                <label>Correo</label>
                <input type="text" class="form-control" v-model="correo" id="txtcorreo">  
            </div>
            <div class="col-lg-5">
                <label>Contraseña</label>
                <input type="text" class="form-control" v-model="password" id="txtpassword">  
            </div>
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
       <h3 class="card-title">Usuario</h3>
       <div class="card-tools">
           <input type="text" class="form-control form-control-sm" v-model="buscar" v-on:keyup="buscarcategoria" placeholder="Buscar...">
       </div>
   </div>
   <div class="card-body table-responsive">
       <table class="table table-hover table-bordered table-striped">
           <thead>
               <tr>
                   <th style="border:1px solid #ddd;padding: 5px; width: 10%;">#</th>
                   <th style="border:1px solid #ddd;padding: 5px; width: 18.75%;">Correo</th>
                   <th style="border:1px solid #ddd;padding: 5px; width: 18.75%;">Apellidos</th>
                   <th style="border:1px solid #ddd;padding: 5px; width: 18.75%;">Nombres</th>
                   <th style="border:1px solid #ddd;padding: 5px; width: 18.75%;">Celular</th>
                   <th style="border:1px solid #ddd;padding: 5px; width: 15%;">Gestión</th>
               </tr>
           </thead>
           <tbody>
               <tr v-for="cat, key in usuarios">
                   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{key+pagination.from}}</td>
                   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.correo}}</td>
                   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.apellidos}}</td>
                   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.nombres}}</td>
                   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">@{{cat.celular}}</td>
                   <td style="border:1px solid #ddd;font-size: 14px; padding: 5px;">
                       <center>
                       <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editar(cat)" data-placement="top" data-toggle="tooltip" title="Editar tipo de usuario">
                           <i class="fa fa-edit"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteUser(cat)" data-placement="top" data-toggle="tooltip" title="Borrar tipo de usuario">
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

