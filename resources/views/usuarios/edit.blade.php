@extends('layouts.app') 
@section('contenidoprincipal') 
  <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
    @csrf
    {{ method_field('PUT') }}
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Datos de contacto</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        
          <!--<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="hidden" class="form-control" id="id" name="id" placeholder="Ingrese su nombre" required value="{{ $usuario->id }}">
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required value="{{ $usuario->name }}">
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Correo electronico</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required value="{{ $usuario->email }}">
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Tipo de usuario</label>
                  <select id="tipo_usuario" name="tipo_usuario" class="form-control">
                      <option value="cliente" @if($usuario->tipo_usuario=='cliente') selected="true"@endif>Cliente</option>
                      <option value="admin" @if($usuario->tipo_usuario=='admin') selected="true"@endif>Administrador</option>
                      <option value="contador" @if($usuario->tipo_usuario=='contador') selected="true"@endif>Contador</option>
                  </select>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Contraseña</label>
                  <input type="text" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" >
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Confirma tu contraseña</label>
                  <input type="text" class="form-control" id="rpassword" name="rpassword" placeholder="Confirme su contraseña" >
                </div>
              </div>            
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="btn_guardaregistro">Guardar cambios</button>
          </div>  
      </div>
    </form>   
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
  
$("#menuusuario").addClass("nav-item menu-open");
  $("#menuusuario2").addClass("nav-link active");
  $("#menuconsultausuario").addClass("important nav-link active"); 
  
  
  $('#btn_guardaregistro').click(function() {    
    
    var nombre        = $('#nombre').val();
    var email         = $('#email').val();    
    var tipo_usuario  = $('#tipo_usuario').val();
    var password      = $('#password').val();
    var rpassword     = $('#rpassword').val();


    if (nombre == '' || nombre.length == 0 ) {
      document.getElementById("nombre").focus();
      return false;
    }
    if (email == '' || email.length == 0 ) {
      document.getElementById("email").focus();      
      return false;
    }
    if (tipo_usuario == '' || tipo_usuario.length == 0 ) {
      document.getElementById("tipo_usuario").focus();      
      return false;
    }
    if(password !== rpassword){
      alert("la contraseña no coincide");
      return false;
    }
    if(password=='' && rpassword == ''){
      password = 'ninguno';
    }
   /// $('#btn_guardaregistro').attr('disabled', true);
   // document.formcliente.submit();

  });

  $(document).on("click", "#btn-eliminar", function () {
    var id_cliente = $(this).attr('data-id');
    if (confirm("¿Desea eliminar el registro?") == true) {
      $.ajax({
            type: "get",
            url: "{{ url('clientes/delete') }}"+'/'+ id_cliente,
            success: function (data) {
              alert(data.data);
              location.reload();
            }
        });
    }
  });
})(jQuery);
</script>
@endsection