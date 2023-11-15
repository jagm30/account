@extends('layouts.app') 
@section('contenidoprincipal') 
  <form method="POST" action="{{ route('servicios.update', $servicio->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
                  <label for="telefono">Cliente</label>
                  <select class="form-control" id="id_cliente" name="id_cliente" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                      <option value="{{ $cliente->id }}" @if($servicio->id_cliente == $cliente->id) selected="true" @endif>{{ $cliente->nombre }}</option>
                    @endforeach
                  </select>
                </div>
              </div>  
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Descripcion</label>
                  
                  <select class="form-control" id="descripcion" name="descripcion" required="">
                    <option value="">Selecciona un servicio</option>
                    @foreach($catservicios as $catservicio)
                      <option value="{{ $catservicio->id }}" @if($catservicio->id == $servicio->descripcion)selected="true" @endif>{{ $catservicio->descripcion }}</option>
                    @endforeach
                  </select>
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Fecha de contrato</label>
                  <input type="date" class="form-control" id="fecha_contrato" name="fecha_contrato" required value="{{ $servicio->fecha_contrato }}">
                  <input type="hidden" class="form-control" id="status" name="status" value="activo" required>
                </div>
              </div>                
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Modalidad</label>
                  <select class="form-control" id="modalidad" name="modalidad" required>
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

              <div class="col-md-6" id="contnrecurrente" style="@if($servicio->modalidad == 'recurrente') display: none;@endif" >
                <div class="form-group">
                  <label for="telefono">Fecha Vencimiento</label>
                  <input type="date" class="form-control" id="fecha_finaliza" name="fecha_finaliza"  value="{{ $servicio->fecha_finaliza }}">
                </div>                
            </div>
            <div class="col-md-6" >
                <div class="form-group">
                  <label for="telefono">Precio</label>
                  <input type="number" class="form-control" id="precio" name="precio" required value="{{ $servicio->precio }}">
                </div>                
            </div>          
            </div>
          </div>

    </div>
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
                  <label for="constanciasituacion">Contrato @if($servicio->contrato_doc!='') <a href="{{ Storage::url($servicio->contrato_doc) }}" target="_blank">Descargar  contrato<img src="/images/logo_situacionfiscal.png" width="50" height="50"></a> @endif</label>
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
            <button type="submit" class="btn btn-primary" id="btn_guardaregistro">Guardar cambios</button>
          </div>          
          
      </div>
  </form>   
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
  
$("#menuservicio").addClass("nav-item menu-open");
  $("#menuservicio2").addClass("nav-link active");
  $("#menuconsultaservicio").addClass("important nav-link active"); 
  
  
 /* $('#btn_guardaregistro').click(function() {    
    
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