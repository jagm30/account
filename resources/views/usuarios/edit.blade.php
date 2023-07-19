@extends('layouts.app') 
@section('contenidoprincipal') 
  <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required value="{{ $usuario->name }}">
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Correo electronico</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required value="{{ $usuario->email }}">
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
            <button type="submit" class="btn btn-primary" id="btn_guardaregistro">Guardar cambios</button>
          </div>  
      </div>
    </form>   
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
  
  $("#menuecliente").addClass("nav-item menu-open");
  $("#menuecliente2").addClass("nav-link active");
  $("#menuconsultacliente").addClass("important nav-link active"); 
  

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