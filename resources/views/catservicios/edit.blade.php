@extends('layouts.app') 
@section('contenidoprincipal') 
<!-- Main content -->
  <div class="row">
    <div class="col-12">            
      <div class="card">
        <form method="POST" action="{{ route('catservicios.update', $catservicio->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
          @csrf
          {{ method_field('PUT') }}
          <div class="card-header">
            <h3 class="card-title">Editar servicio</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">              
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nombre">Descripción del servicio</label>
                      <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$catservicio->descripcion}}" required>
                    </div>
                  </div>  
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary" id="btn_guardaregistro">Guardar</button>
          </div>  
        </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

@endsection
@section("scriptpie")
<script>
(function ($) {
  $("#menucatserv1").addClass("nav-item menu-open");
  $("#menucatserv2").addClass("nav-link active");
  $("#menucatserv3").addClass("important nav-link active"); 
  
})(jQuery);
</script>
@endsection