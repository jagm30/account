@extends('layouts.app') 
@section('contenidoprincipal') 
  <form method="POST" action="/clientes" accept-charset="UTF-8" name="formcliente" enctype="multipart/form-data">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Correo electronico</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su numero de teléfono" required>
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
                  <input type="text" class="form-control" id="razonsocial" name="razonsocial" placeholder="Ingrese su razon social" required>
                </div>
                <div class="form-group">
                  <label for="nombre">RFC</label>
                  <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ingrese su RFC" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" required>
                </div>
                <div class="form-group">
                  <label for="email">Correo electronico</label>
                  <input type="email" class="form-control" id="emailfactura" name="emailfactura" placeholder="Ingrese su email" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Domicilio fiscal</label>
                  <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Ingrese el domicilio fiscal" required>
                </div>
                <div class="form-group">
                  <label for="telefono">Codigo postal</label>
                  <input type="text" class="form-control" id="codigopostal" name="codigopostal" placeholder="Ingrese el codigo postal" required>
                </div>
                <input type="hidden" id="status" name="status" value="activo">
                <div class="form-group">
                  <label for="constanciasituacion">Situación fiscal</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="constanciasituacion" name="constanciasituacion">
                      <label class="custom-file-label" for="constanciasituacion">Seleccionar archivo</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Cargar</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>     
                  
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="btn_guardaregistro">Guardar</button>
          </div>        

          <div class="col-sm-12">
            <div class="position-relative p-3 bg-green" style="height: 80px">
              <div class="ribbon-wrapper ribbon-lg">
                <div class="ribbon bg-danger">
                  Importante
                </div>
              </div>
              La cuenta de usuario se crea automaticamente, el nombre de usuario se toma de los datos personales del campo correo electronico y la contraseña es el RFC.<br />
            </div>
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
    $("#menucontadorcliente2").addClass("important nav-link active"); 
  }
  @else{
    $("#menuecliente").addClass("nav-item menu-open");
    $("#menuecliente2").addClass("nav-link active");
    $("#menuregistracliente").addClass("important nav-link active"); 
  }
  @endif

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
      //document.getElementById("cajaerror-e").innerHTML = '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Alerta!</h4>Ingrese el No. de factura.</div>';
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

  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
})(jQuery);
</script>
@endsection