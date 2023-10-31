@extends('layouts.app') 
@section('contenidoprincipal') 
  
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
                  <label for="telefono">Cliente</label>
                  <select class="form-control" id="id_cliente" name="id_cliente" readonly>
                      <option value="{{ $servicio->id_cliente }}" >{{ $servicio->nomcliente }}</option>
                  </select>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Fecha de creación</label>
                  <input type="text" class="form-control" id="creacion" name="creacion" readonly value="{{ $servicio->creacion }}">
                  <input type="hidden" class="form-control" id="id_servicio" name="id_servicio" value="{{ $servicio->ids }}" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Servicio</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese la descripción del servicio" readonly value="{{ $servicio->descripcion}}">
                </div>
              </div>  
              <div class="col-md-4">
                <div class="form-group">
                  <label for="nombre">Fecha de contrato</label>
                  <input type="date" class="form-control" id="fecha_contrato" name="fecha_contrato" readonly value="{{ $servicio->fecha_contrato }}">
                </div>
              </div>                
              <div class="col-md-4">
                <div class="form-group">
                  <label for="telefono">Modalidad</label>
                  <select class="form-control" id="modalidad" name="modalidad" readonly>
                    <option value="norecurrente" @if($servicio->modalidad == 'norecurrente') selected="true" @endif>Una sola exhibición</option>
                    <option value="recurrente" @if($servicio->modalidad == 'recurrente') selected="true" @endif>Recurrente</option>
                  </select>
                </div>
              </div>     
              <div class="col-md-6" id="contrecurrente" style="@if($servicio->modalidad == 'norecurrente') display: none;@endif">
                <div class="form-group">
                  <label for="telefono">Fecha recurrente</label>
                  <input type="date" class="form-control" id="fecha_recurrente" name="fecha_recurrente"  value="{{ $servicio->fecha_recurrente }}">
                </div>
              </div>
              <div class="col-md-6" id="contrecurrente2" style="@if($servicio->modalidad == 'norecurrente') display: none;@endif">
                <div class="form-group">
                  <label for="telefono">Vencimiento recurrente</label>
                  <input type="date" class="form-control" id="fechaf_recurrente" name="fechaf_recurrente"  value="{{ $servicio->fechaf_recurrente }}">
                </div>
              </div>

              <div class="col-md-4" id="contnrecurrente" style="@if($servicio->modalidad == 'recurrente') display: none;@endif" >
                <div class="form-group">
                  <label for="telefono">Fecha Vencimiento</label>
                  <input type="date" class="form-control" id="fecha_finaliza" name="fecha_finaliza"  value="{{ $servicio->fecha_finaliza }}" readonly>
                </div>                
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                  <label for="telefono">Precio</label>
                  <input type="number" class="form-control" id="precio" name="precio" required value="{{ $servicio->precio }}" readonly>
                </div>                
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                  <label for="constanciasituacion">Contrato <br> @if($servicio->contrato_doc!='') <a href="{{ Storage::url($servicio->contrato_doc) }}" target="_blank">Descargar  contrato<img src="/images/logo_situacionfiscal.png" width="50" height="50"></a> @endif</label>
                </div>                
            </div>          

              <div class="col-md-4">                            
                <div class="form-group">
                  <label for="constanciasituacion">Estado actual del servicio: <b style="color: green;">{{ $servicio->statusservicio}}</b></label>
                  <select class="form-control" id="statusservicio" name="statusservicio" >
                    <option value="Activo" @if($servicio->statusservicio == 'Activo') selected="true" @endif>Activo</option>
                    <option value="Finalizado" @if($servicio->statusservicio == 'Finalizado') selected="true" @endif>Finalizado</option>
                    <option value="Suspendido" @if($servicio->statusservicio == 'Suspendido') selected="true" @endif>Suspendido</option>
                  </select>
                </div>
              </div>

            </div>  
            </div>
          </div>

    </div>
    <div class="card card-primary">
        <div class="card-header" style="background-color: green;">
          <h3 class="card-title">Datos del pago</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->                
          <div class="card-body">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-4">                            
                <div class="form-group">
                  <label for="constanciasituacion">Fecha de pago</label>
                  <input type="date" class="form-control" id="fecha_finaliza" name="fecha_finaliza"  value="{{ $servicio->fechapago }}" readonly>
                </div>
              </div>
              <div class="col-md-4">                            
                <div class="form-group">
                  <label for="constanciasituacion">Forma de pago</label>
                  <input type="text" class="form-control" id="fecha_finaliza" name="fecha_finaliza"  value="{{ $servicio->formapago }}" readonly>
                </div>
              </div>
              <div class="col-md-4">                            
                <div class="form-group">
                  <label for="constanciasituacion">Estado de pago</label>
                  <select class="form-control" id="statuspago" name="statuspago" >
                    <option value="Revision" @if($servicio->statuspago == 'Revision') selected="true" @endif>Revision</option>
                    <option value="Pagado" @if($servicio->statuspago == 'Pagado') selected="true" @endif>Pagado</option>
                    <option value="Cancelado" @if($servicio->statuspago == 'Cancelado') selected="true" @endif>Cancelado</option>
                  </select>
                </div>
              </div>

            </div>                       
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button class="btn btn-primary" id="btn_guardaregistro">Guardar cambios</button>
          </div>          
          
      </div>

  
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
  
$("#menucontadoredocta").addClass("nav-item menu-open");
  $("#menucontadoredocta2").addClass("nav-link active");
  $("#menucontadoredocta1_1").addClass("important nav-link active"); 
  
  
  $('#btn_guardaregistro').click(function() {        
   var id_servicio        = $('#id_servicio').val();
   var statusservicio     = $('#statusservicio').val();
   var statuspago         = $('#statuspago').val();
    $.ajax({
        type: "get",
        url: "{{ url('contador/cuentacliente/update') }}"+'/'+id_servicio+'/'+statusservicio+'/'+statuspago,
        success: function (data) {
          alert(data.data);
          location.reload();
        }
    });

  });

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