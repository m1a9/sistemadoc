<div class="card card-primary">
    <div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
       <h3 class="card-title">Configuración</h3>
       <a type="button" class="btn" style="float: right;background-color: #3c8dbc;" href="{{URL::to('home')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
         Volver</a>
      </div> 
   <div class="card-body" style="border: 1px solid #3c8dbc;">
       <div class="form-group">
             <button type="button" class="btn" style="background-color: #3c8dbc; color: white;" @click.prevent="nuevo()"><i class="fa fa-plus-square-o" aria-hidden="true" ></i> Modificar Contraseña</button>
       </div>
   </div>
</div>

{{-- modificar Contraseña --}}
<div class="card" v-if="divnuevo" style="border: 1px solid #00a65a;">
   <div class="card-header" style="border: 1px solid #00a65a;background-color: #00a65a; color: white;">
       Modificar Contraseña
   </div>
   @if(auth()->check())
   {{$iduser=auth()->user()->id}}
   <form action="{{route('perfilss.store',$iduser)}}" method="post">
    @csrf
    @method('put')
   <div class="card-body" style="border: 1px solid #00a65a;">
       <div class="form-group">
        @foreach ($usuarios as $user)
           <div class="row">
            <div class="col-lg-2">
                <label>Correo: </label>
            </div>
            <div class="col-lg-6">
                <label>{{$user->correo}} </label>
            </div>
        @endforeach
            <div class="col-lg-6">
                <label>Contraseña Actual</label>
                    <input type="text" class="form-control" v-model="pass1" id="pass1" name="pass1">
            </div>
            <div class="col-lg-6">
                <label>Contraseña Nueva</label>
                <input type="text" class="form-control" v-model="pass2" id="pass2" name="pass2">
            </div>
        </div>
       </div>
       <div class="card-footer bg-transparent">
           <button class="btn btn-info" type="submit">Guardar</button>
           <button class="btn btn-warning" v-on:click="cancelFormNuevo()">Cancelar</button>
           <button class="btn btn-light" v-on:click="cerrarFormNuevo()">Cerrar</button>
       </div>
   </div>
    </form>
   @endif
</div>


{{--Mostrar usuario --}}
@foreach ($usuarios as $user)
<div class="card" style="border: 1px solid #3c8dbc;">
   <div class="card-header" style="border: 1px solid #3c8dbc;background-color: #3c8dbc; color: white;">
       <h3 class="card-title">Usuario</h3>
   </div>
   <div class="card-body" style="border: 1px solid #3c8dbc;">
    <div class="form-group">
        <h4 style="text-align: center">Datos Personales del Usuario</h4>
        <div class="row">
            <div class="col-lg-2">
                <label>DNI:</label>
            </div>
            <div class="col-lg-4">
                {{-- <input type="text" class="form-control" v-model="docu" id="" value="{{$user->documentoid}}"> --}}
                <label for="">{{$user->documentoid}}</label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-2">
                <label>Apellidos:</label>
            </div>
            <div class="col-lg-4">
                {{-- <input type="text" class="form-control" v-model="apell" id="" value=""> --}}
                <label for="">{{$user->apellidos}}</label>

            </div>
            <div class="col-lg-2">
                <label>Nombres:</label>
            </div>
            <div class="col-lg-4">
                {{-- <input type="text" class="form-control" v-model="nom" id="" value="" > --}}
                <label for="">{{$user->nombres}}</label>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-2">
                <label>Dirección:</label>
            </div>
            <div class="col-lg-4">
                {{-- <input type="text" class="form-control" v-model="direcc" id="" value=""> --}}
                <label for="">{{$user->direccion}}</label>
            </div>
            <div class="col-lg-2">
                <label>Celular:</label>
            </div>
            <div class="col-lg-4">
                {{-- <input type="text" class="form-control" v-model="cel" id="cel" value="" > --}}
                <label for="">{{$user->celular}}</label>
            </div>
        </div>

        <hr size="8px" color="black" />
        <h4 style="text-align: center">Datos del Usuario</h4>
        <div class="row">
            <div class="col-lg-2">
                <label>Tipo Usuario:</label>
            </div>
            <div class="col-lg-4">
                {{-- <input type="text" class="form-control" v-model="tpuser" id="tpuser" value=""> --}}
                <label for="">{{$user->tipousuarios}}</label>
            </div>
            <div class="col-lg-2">
                <label>Correo:</label>
            </div>
            <div class="col-lg-4">
                {{-- <input  type="text" class="form-control" v-model="correo" id="" value="" > --}}
                <label for="">{{$user->correo}}</label>
            </div>
        </div>
    </div>
    </div>
</div>
@endforeach
