<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <img class="img" src="img/logoA.png" alt="" srcset="">
    <div class='box'>
        <div class='box-form'>
          <div class='box-login-tab'></div>
          <div class='box-login-title'>
            <div class='i i-login'></div><h2>LOGIN</h2>
          </div>
          <form method="POST">
              @csrf
          <div class='box-login'>
            <div class='fieldset-body' id='login_form'>
              @error('message')
              <p class="border border-red 500 rounded-md bg-red-100 w-full
              text-red-600 p-2 my-2">
                *Error
              </p>
              @enderror
              <p class='field'>
                <label for='tpuser'>Tipo de Usuario</label>
                <select name="tipousuarios_id" id="tipousuarios_id">
                  <option value="">Seleccione</option>
                  @foreach ($tipoUser as $tpuser)
                  <option value={{$tpuser->id}}>{{$tpuser->name}}</option>
                  @endforeach
                </select>
                <span id='valida' class='i i-warning'></span>
              </p>
              <p class='field'>
                <label for='user'>CORREO</label>
                <input type='text' autocomplete="off" id='correo' name='correo' title='Username' />
                <span id='valida' class='i i-warning'></span>
              </p>
                  <p class='field'>
                <label for='pass'>PASSWORD</label>
                <input type='password' id='password' name='password' title='Password' />
                <span id='valida' class='i i-close'></span>
              </p>
      
                {{-- <label class='checkbox'>
                  <input type='checkbox' value='TRUE' title='Keep me Signed in' /> Keep me Signed in
                </label> --}}
      
                  <input type='submit' id='do_login' value='INICIAR SESIÓN' />
            </div>
          </div>
          </form> 
        </div>
      </div>
      
</body>
</html>
