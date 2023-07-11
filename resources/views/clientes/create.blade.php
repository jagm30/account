@extends('layouts.app') 
@section('contenidoprincipal') 




     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Datos de contacto</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
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
                  <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
              </div>  
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Teléfono</label>
                  <input type="text" class="form-control" id="telefono" placeholder="Password">
                </div>
              </div>                
            </div>
          </div>
        </form>
      </div>
      <!-- /.card -->

     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Empresa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
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
                  <input type="email" class="form-control" id="emailfactura" placeholder="Enter email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="telefono">Domicilio fiscal</label>
                  <input type="text" class="form-control" id="domicilio" placeholder="Ingrese el domicilio fiscal">
                </div>
                <div class="form-group">
                  <label for="telefono">Codigo postal</label>
                  <input type="text" class="form-control" id="codigopostal" placeholder="Ingrese el Codogio postal">
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
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
      <!-- /.card -->


@endsection
@section("scriptpie")
<script>
  (function ($) {
    
  

 $(document).on("click", "#btneditar", function () {
    //alert("accediendo a la edicion..."+$(this).attr('data-id'));
    var id_cliente = $(this).attr('data-id');
    $("#id_cliente").val(id_cliente);
     // alert(id_cliente);
    $.ajax({
           url:"/clientes/"+id_cliente,
           async: false,
           dataType:"json",
           success:function(html){                
              
              $("#nombre-e").val(html.nombre);    
              $("#email-e").val(html.email);
              $("#telefono-e").val(html.telefono);
              $("#razonsocial-e").val(html.razonsocial);
              $("#rfc-e").val(html.rfc);
              $("#domicilio-e").val(html.domicilio);  
              $("#codigopostal-e").val(html.codigopostal);
              $("#emailfactura-e").val(html.emailfactura);           


           }
        })
  });

  $('#btn_guardarcambio').click(function() {   
    var id_cliente  = $("#id_cliente").val();
    var nombre      = $("#nombre-e").val();
    var email       = $("#email-e").val();
    var telefono    = $("#telefono-e").val();    
    var razonsocial = $("#razonsocial-e").val();
    var rfc         = $("#rfc-e").val();
    var domicilio   = $("#domicilio-e").val();
    var codigopostal= $("#codigopostal-e").val();
    var emailfactura= $("#emailfactura-e").val();

   /* if (nombre.length == 0 || email.length == 0 ) {
      alert("No pueden haber campos vacios.");
      return false;
    }   */
      $.ajax({
         url:"/clientes/edicion/"+id_cliente+"/"+nombre+"/"+email+"/"+telefono+"/"+razonsocial+"/"+rfc+"/"+domicilio+"/"+codigopostal+"/"+emailfactura,
         dataType:"json",
         success:function(html){
          alert(html.data);
          $("#formmodal")[0].reset();
          $('#modal-default').modal('toggle');
          location.reload();
         }
      })
      
  }); 

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

    alert(nombre);
    alert(email);
    alert(telefono);
    alert(razonsocial);
    alert(rfc);
    alert(domicilio);
    alert(codigopostal);
    alert(emailfactura);
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
            $("#formmodal")[0].reset();
            $('#modal-agregar').modal('toggle');
            location.reload();          
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