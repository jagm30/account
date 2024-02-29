@extends('layouts.app') 
@section('contenidoprincipal') 
  <form method="POST" action="{{ route('clientes.update', $cliente->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}" required>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}" required>
                </div>
              </div>                
            </div>
          </div>
      </div>
      <!-- /.card -->

     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Empresa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->        
        
          <div class="card-body">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Razón social</label>
                  <input type="text" class="form-control" id="razonsocial" name="razonsocial" value="{{ $cliente->razonsocial }}" required>
                </div>
                <div class="form-group">
                  <label for="nombre">RFC</label>
                  <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $cliente->rfc }}" required>
                </div>
                <div class="form-group">
                  <label for="email">Correo electrónico</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $cliente->email }}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Domicilio fiscal</label>
                  <input type="text" class="form-control" id="domicilio" name="domicilio" value="{{ $cliente->domicilio }}" required>
                </div>
                <div class="form-group">
                  <label for="telefono">Código postal</label>
                  <input type="text" class="form-control" id="codigopostal" name="codigopostal" value="{{ $cliente->codigopostal }}" required>
                </div>
                <input type="hidden" id="status" name="status" value="activo">
                <div class="form-group">
                  <label for="constanciasituacion">Constancia fiscal @if($cliente->constanciasituacion!='') <a href="{{ Storage::url($cliente->constanciasituacion) }}" target="_blank">Descargar  constancia <img src="/images/logo_situacionfiscal.png" width="50" height="50"></a> @endif</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="constanciasituacion" name="constanciasituacion">
                      <label class="custom-file-label" for="constanciasituacion">Seleccionar archivo</label>
                    </div>                   
                  </div>
                </div>
              </div>
            </div>     
                  
          </div>
          <!-- /.card-body -->

                  
          
      </div>

      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Datos de usuario</h3>
        </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" value="{{ $usuario->emailuser }}" required>
                </div>
              </div>  
              <div class="col-md-3">
                <div class="form-group">
                  <label for="email">contraseña</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="email">confirma tu contraseña</label>
                  <input type="password" class="form-control" id="rpassword" name="rpassword">
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
  @if(auth()->user()->tipo_usuario=='contador'){
    $("#menucontador").addClass("nav-item menu-open");
    $("#menucontadorcliente").addClass("nav-link active");
    $("#menucontadorcliente1").addClass("important nav-link active"); 
  }
  @else{
    $("#menuecliente").addClass("nav-item menu-open");
    $("#menuecliente2").addClass("nav-link active");
    $("#menuconsultacliente").addClass("important nav-link active"); 
  }
  @endif
  
  

//Agregar producto
  $('#btn_guardaregistro').click(function() {    
    var nombre        = $('#nombre').val();
    var email         = $('#email').val();    
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
    if(password !== rpassword){
      alert("la contraseña no coincide");
      return false;
    }
    if(password=='' && rpassword == ''){
      password = 'ninguno';
    }
  
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