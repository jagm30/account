@extends('layouts.app') 
@section('contenidoprincipal') 
<!-- Main content -->
  <div class="row">
    <div class="col-12">            
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Catalogo de servicios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Id</th>                    
              <th>Descripción</th>   
             <th>Acción</th>                            
            </tr>
            </thead>
            <tbody>                
              @foreach ($catservicios as $servicios)                        
                <tr>                            
                  <td>{{ $servicios->id }}</td>                            
                  <td>{{ $servicios->descripcion }}</td>
                  <td>                                
                    <a href="/catservicios/{{$servicios->id}}/edit"><button type="button" class="btn btn-success" id="btneditar"   data-target="#largeModal">Editar</button></a>                                                                            
                  </td>                        
                </tr>                    
              @endforeach                
            </tbody>
            <tfoot>
            <tr>
              <th>Id</th>                    
              <th>Descripción</th>   
              <th>Acción</th>                    
           
            </tr>
            </tfoot>
          </table>
        </div>
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
  $("#menucatserv2").addClass("important nav-link active"); 
  
})(jQuery);
</script>
@endsection