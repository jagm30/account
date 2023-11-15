@extends('layouts.app') 
@section('contenidoprincipal') 
  <form method="POST" action="/servicios" accept-charset="UTF-8" name="formcliente" enctype="multipart/form-data">
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Datoss de contacto</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {{ csrf_field() }}
          <!--<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Cliente</label>
                  <select class="form-control" id="id_cliente" name="id_cliente" required>
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>                    
                  </select>
                </div>
              </div>  
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Descripcion</label>
                  <select class="form-control" id="descripcion" name="descripcion" required="">
                    <option value="">Selecciona un servicio</option>
                    @foreach($catservicios as $servicio)
                      <option value="{{ $servicio->id }}">{{ $servicio->descripcion }}</option>
                    @endforeach
                  </select>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Fecha de contrato</label>
                  <input type="date" class="form-control" id="fecha_contrato" name="fecha_contrato" required value="{{ $date }}">
                  <input type="hidden" class="form-control" id="status" name="status" value="activo" required>
                </div>
              </div>                
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Modalidad</label>
                  <select class="form-control" id="modalidad" name="modalidad" required>
                    <option value="norecurrente">Una sola exhibición</option>
                    <option value="recurrente">Recurrente</option>
                  </select>
                </div>
              </div>     
              <div class="col-md-6" id="contrecurrente" style="display: none;">
                <div class="form-group">
                  <label for="telefono">Fecha recurrente</label>
                  <input type="date" class="form-control" id="fecha_recurrente" name="fecha_recurrente"  >
                </div>
              </div>
              <div class="col-md-6" id="contrecurrente2" style="display: none;">
                <div class="form-group">
                  <label for="telefono">Vencimiento recurrente</label>
                  <input type="date" class="form-control" id="fechaf_recurrente" name="fechaf_recurrente"  >
                </div>
              </div>

              <div class="col-md-6" id="contnrecurrente" >
                <div class="form-group">
                  <label for="telefono">Fecha Vencimiento</label>
                  <input type="date" class="form-control" id="fecha_finaliza" name="fecha_finaliza"  >
                </div>                
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                  <label for="telefono">Precio</label>
                  <input type="number" class="form-control" id="precio" name="precio" required >
                </div>                
            </div>
          </div>
      </div>
      <!-- /.card -->

     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Contrato</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->                
          <div class="card-body">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">                            
                <div class="form-group">
                  <label for="constanciasituacion">Contrato</label>
                  <input type="hidden" name="id_usuario" id="id_usuario" value="{{ Auth::user()->id}}">
                  <div class="input-group">
                    <div class="custom-file">                      
                      <input type="file" class="form-control" id="contrato_doc" name="contrato_doc">
                      <label class="custom-file-label" for="contrato_doc">Seleccionar archivo</label>
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
          
      </div>
    </form>   
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
  $("#menucontador").addClass("nav-item menu-open");
  $("#menucontadorcliente").addClass("nav-link active");
  $("#menucontadorcliente1").addClass("important nav-link active"); 
  
/* $('#btn_guardaregistro').click(function() {    
    
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

  });*/

  $("#modalidad" ).change(function() {  
      var modalidad       = $('#modalidad').val();
      if(modalidad=='recurrente'){
        $('#contrecurrente').show();
        $('#contrecurrente2').show();
        $('#contnrecurrente').hide();
        $('#fecha_finaliza').val('');
      }else{
        $('#contnrecurrente').show();
        $('#contrecurrente').hide();
        $('#contrecurrente2').hide();
        $('#fecha_recurrente').val('');
        $('#fechaf_recurrente').val('');        
      }
      
      //almacen
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