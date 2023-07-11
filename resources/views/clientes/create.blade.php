@extends('layouts.app') 
@section('contenidoprincipal') 
  
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Datos de contacto</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
          <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Correo electronico</label>
                  <input type="email" class="form-control" id="email" placeholder="Ingrese su email">
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" class="form-control" id="telefono" placeholder="Ingrese su numero de teléfono">
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
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombre">Razón social</label>
                  <input type="text" class="form-control" id="razonsocial" placeholder="Ingrese su razon social">
                </div>
                <div class="form-group">
                  <label for="nombre">RFC</label>
                  <input type="text" class="form-control" id="rfc" placeholder="Ingrese su RFC">
                </div>
                <div class="form-group">
                  <label for="email">Correo electronico</label>
                  <input type="email" class="form-control" id="emailfactura" placeholder="Ingrese su email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Domicilio fiscal</label>
                  <input type="text" class="form-control" id="domicilio" placeholder="Ingrese el domicilio fiscal">
                </div>
                <div class="form-group">
                  <label for="telefono">Codigo postal</label>
                  <input type="text" class="form-control" id="codigopostal" placeholder="Ingrese el codigo postal">
                </div>
                <div class="form-group">
                  <label for="cconstanciasituacion">Situación fiscal</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="cconstanciasituacion">
                      <label class="custom-file-label" for="cconstanciasituacion">Seleccionar archivo</label>
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
        
      </div>
  
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
    
  

//Agregar producto
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

      $.ajax({
          url: "/clientes",
          type: "POST",
          data: {
              _token: $("#csrf").val(),
              type: 1,
              nombre:     nombre,
              email:      email,
              telefono:   telefono,
              razonsocial:razonsocial,
              rfc:        rfc,
              domicilio:  domicilio,
              codigopostal:codigopostal,
              emailfactura:emailfactura,
              status:     status
          },
          cache: false,
          success: function(dataResult){
            alert(dataResult);                
            //location.reload();          
          }
      });    
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