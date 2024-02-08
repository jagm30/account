@extends('layouts.app') 
@section('contenidoprincipal') 
  <form method="POST" action="/usuarios" accept-charset="UTF-8" name="formcliente" enctype="multipart/form-data">
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Datos de contacto</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {{ csrf_field() }}
          <!--<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Correo electrónico</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Tipo de usuario</label>
                  <select id="tipo_usuario" name="tipo_usuario" class="form-control">
                      <option value="cliente">Cliente</option>
                      <option value="admin">Administrador</option>
                      <option value="contador">Contador</option>
                  </select>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Contraseña</label>
                  <input type="text" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Confirma tu contraseña</label>
                  <input type="text" class="form-control" id="rpassword" name="rpassword" placeholder="Confirme su contraseña" required>
                </div>
              </div>            
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="btn_guardaregistro">Guardar usuario</button>
          </div>    
      </div>
      <!-- /.card -->
    </form>   
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
  $("#menuusuario").addClass("nav-item menu-open");
  $("#menuusuario2").addClass("nav-link active");
  $("#menuregistrausuario").addClass("important nav-link active"); 
  
 $('#btn_guardaregistro').click(function() {    
    
    var nombre      = $('#nombre').val();
    var email       = $('#email').val();    
    var telefono    = $('#telefono').val();
    var razonsocial = $('#razonsocial').val();
    var rfc         = $('#rfc').val();
    var domicilio   = $('#domicilio').val();    
    var codigopostal= $('#codigopostal').val();
    var emailfactura= $('#emailfactura').val();
    var status      = 'activo';

    if (nombre == '' || nombre.length == 0 ) {
      document.getElementById("nombre").focus();
      return false;
    }
    if (email == '' || email.length == 0 ) {
      document.getElementById("email").focus();      
      return false;
    }
    if (telefono == '' || telefono.length == 0 ) {
      document.getElementById("telefono").focus();      
      return false;
    }
    if(razonsocial == '' || razonsocial.length == 0 ) {
      document.getElementById("razonsocial").focus();      
      return false;
    }
    if(rfc == '' || rfc.length == 0 ) {
      document.getElementById("rfc").focus();      
      return false;
    } 
    if(domicilio == '' || domicilio.length == 0 ) {
      document.getElementById("domicilio").focus();      
      return false;
    }
    if(codigopostal == '' || codigopostal.length == 0 ) {
      document.getElementById("codigopostal").focus();      
      return false;
    }
    if(emailfactura == '' || emailfactura.length == 0 ) {
      document.getElementById("emailfactura").focus();      
      return false;
    }
    if(status == '' || status.length == 0 ) {
      document.getElementById("status").focus();      
      return false;
    } 
    $('#btn_guardaregistro').attr('disabled', true);
    document.formcliente.submit();

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