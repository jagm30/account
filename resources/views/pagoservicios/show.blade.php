@extends('layouts.app') 
@section('contenidoprincipal') 
  <form method="POST" action="/pagoservicios" accept-charset="UTF-8" name="formpagoservicios" enctype="multipart/form-data">
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Pago</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {{ csrf_field() }}
          <!--<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <input type="hidden" name="id_servicio" id="id_servicio" value="{{ $servicio->id }}">
                <input type="hidden" name="id_cliente" id="id_cliente" value="{{ $servicio->id_cliente }}">
                <input type="hidden" name="fechapago" id="fechapago" value="{{ $date }}">
                <input type="hidden" name="id_usuario" id="id_usuario" value="{{ Auth::user()->id}}">
                <input type="hidden" name="status" id="status" value="activo">
                <div class="form-group">
                  <label for="telefono">Forma de pago</label>
                  <select class="form-control" id="formapago" name="formapago" required>
                    <option value="">Seleccione</option>
                    <option value="transferencia">Transferencia</option>
                    <option value="online">pago en linea</option>
                  </select>
                </div>
              </div>  
              <div class="col-md-6" >
                <div class="form-group">
                  <label for="telefono">Precio</label>
                  <input type="number" class="form-control" id="precio" name="precio" required value="{{ $servicio->precio }}" readonly>
                </div>                
              </div>
              </div>
              
          </div>
      </div>
    <div class="card card-primary" id="contonline" style="display: none;">
        <div class="card-header">
          <h3 class="card-title">Pago</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        {{ csrf_field() }}
          <!--<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> -->
          <div class="card-body">
            <div class="row">              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Titula de tarjeta</label>
                  <input type="text" class="form-control" id="titular" name="titular" placeholder="Ingrese el nombre del titular de la tarjeta" >
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">No. de tarjeta</label>
                  <input type="text" class="form-control" id="ntarjeta" name="ntarjeta" placeholder="Ingrese el numero de tarjeta" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Vencimiento</label>
                  <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="MM/AA" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Seguridad</label>
                  <input type="text" class="form-control" id="seguridad" name="seguridad" placeholder="CVV" >
                </div>
              </div>
              
          </div>
      </div>
    </div>
      <!-- /.card -->

     <div class="card card-primary" id="conttransferencia" style="display: none;">
        <div class="card-header">
          <h3 class="card-title">Comprobante de pago</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->                
          <div class="card-body">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">   
                <div class="form-group">
                  <label>Datos de pago</label>
                  <p class="text-success">BBVA BANCOMER<br>
                  DC WEB AGENCY S.A.S<br>
                  CTA. 329080<br>
                  CLABE: 8832303992310192<br>
                  TARJETA: 4353 3898 2812 3920<br>
                  </p>
                </div>                         

                <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="comprobante" name="comprobante">
                      <label class="custom-file-label" for="comprobante">Seleccionar archivo</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Cargar</span>
                    </div>
                  </div>
              </div>
            </div>                       
          </div>
       
          
      </div>

      <div class="card card-primary">
        
        <!-- /.card-header -->
        <!-- form start -->                
          <div class="card-body">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">                            
                <div class="form-group">
                 <button type="submit" class="btn btn-primary" id="btn_guardaregistro">Registrar pago</button>
                </div>
              </div>
            </div>                       
          </div>
          <!-- /.card-body -->
     
          
      </div>
    </form>   
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
  $("#menucliedocuenta").addClass("nav-item menu-open");
  $("#menucliedocuenta2").addClass("nav-link active");


  $("#formapago").change(function() {  
      var formapago       = $('#formapago').val();
      if(formapago=='online'){
        $('#contonline').show();
        $('#conttransferencia').hide();
//        $('#fecha_finaliza').val('');
      }else{
        $('#contonline').hide();
        $('#conttransferencia').show();
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