@extends('layouts.app') 
@section('contenidoprincipal') 
<!-- Main content -->
  <div class="row">
    <div class="col-12">            
      <div class="card">
        <form method="POST" action="/catservicios" accept-charset="UTF-8" name="formcliente" enctype="multipart/form-data">
          {{ csrf_field() }}
          <!--<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> -->
          <div class="card-header">
            <h3 class="card-title">Registrar un nuevo servicio</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">              
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nombre">Servicio</label>
                      <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
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
  $("#menucatserv").addClass("nav-item menu-open");
  $("#menucatserv1").addClass("nav-link active");
  $("#menucatserv3").addClass("important nav-link active"); 
  
})(jQuery);
</script>
@endsection