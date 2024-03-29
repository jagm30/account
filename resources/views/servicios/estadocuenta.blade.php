@extends('layouts.app') 
@section('contenidoprincipal') 

  <div class="row">
    <div class="col-12">            
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Usuarios</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">Fecha de contrato</th>   
                <th scope="col">Servicio</th>                    
                <th scope="col">Precio</th>                    
                <th scope="col">Estado</th>                    
                <th scope="col">Fecha de pago</th>
                <th scope="col">Metodo de pago</th>
                <th scope="col">Status pago</th>
                <th scope="col">Accion</th>
                
            </tr>
            </thead>
            <tbody>                
              @foreach ($servicios as $servicio)                        
                <tr>                            
                  <td>{{ $servicio->fecha_contrato }}</td>                            
                  <td>{{ $servicio->descripcion }}</td>
                  <td>{{ $servicio->precio }}</td>
                  <td >{{ $servicio->status }}</td>
                  <td>{{ $servicio->fechapago }}</td>
                  <td>{{ $servicio->formapago }}</td>                           
                  <td>
                    @if($servicio->statuspago == 'Pagado' ) {{ $servicio->statuspago }} @endif
                    @if($servicio->statuspago != 'Pagado') 
                    <p style="color: red;">{{ $servicio->statuspago }}</p>
                    <a href="/pagoservicios/{{$servicio->ids}}"><button type="button" class="btn btn-success" id="btneditar"  data-id="{{$servicio->ids}}" data-toggle="modal" data-target="#modal-default">Pagar</button></a>  @endif
                  </td>
                  <td>@if(Auth::user()->tipo_usuario=="cliente" && $servicio->statuspago =='Pagado')                           
                    <a href="#"><button type="button" class="btn btn-warning" id="btnfacturar"  data-id="{{$servicio->ids}}" data-toggle="modal" data-target="#modal-default">Facturar</button></a>
                    @endif</td>
                </tr>                    
              @endforeach                
            </tbody>
            <tfoot>
            <tr>
                <th scope="col">Fecha de contrato</th>   
                <th scope="col">Servicio</th>                    
                <th scope="col">Precio</th>                    
                <th scope="col">Estado</th>                    
                <th scope="col">Fecha de pago</th>
                <th scope="col">Metodo de pago</th>
                <th scope="col">Status pago</th>
                <th scope="col">Accion</th>                                     
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


@endsection
@section("scriptpie")
<script>
  (function ($) {

  $("#menucliedocuenta").addClass("nav-item menu-open");
  $("#menucliedocuenta2").addClass("nav-link active");

 $(document).on("click", "#btneditar", function () {
    //alert("accediendo a la edicion..."+$(this).attr('data-id'));
    var id_usuario = $(this).attr('data-id');
     // alert(id_usuario);
    $.ajax({
           url:"/usuarios/"+id_usuario,
           async: false,
           dataType:"json",
           success:function(html){                
              $("#id_usuario").val(html.id);
              $("#nombre-e").val(html.name);
              $("#email-e").val(html.email);
              $("#tipo_usuario-e option[value='"+ html.tipo_usuario +"']").attr("selected",true);              
           }
        })
  });

  $('#btn_guardarcambio').click(function() {    
    var id_usuario      = $("#id_usuario").val();
    var nombre          = $('#nombre-e').val();
    var email           = $('#email-e').val();    
    var password        = String($('#password-e').val());
    var tipo_usuario    = $('#tipo_usuario-e').val();
    var rpassword       = String($('#rpassword-e').val());
    
    if (nombre.length == 0 || email.length == 0 ) {
      alert("No pueden haber campos vacios.");
      return false;
    }    
   // alert(password);
    if(password !== rpassword){
      alert("la contraseña no coincide");
      return false;
    }else{
     // alert("son iguales");
    }

    if(password=='' && rpassword == ''){
      password = 'ninguno';
    }
      $.ajax({
         url:"/usuarios/edicion/"+id_usuario+"/"+nombre+"/"+email+"/"+password+"/"+tipo_usuario,
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
    
    var nombre          = $('#nombre').val();
    var email           = $('#email').val();    
    var password        = $('#password').val();
    var tipo_usuario    = $('#tipo_usuario').val();
    if(nombre=='' || email == '' || password == ''){
      alert("no se permiten campos vacios");
      return false;
    }
      $.ajax({
          url: "/usuarios",
          type: "POST",
          data: {
              _token: $("#csrf").val(),
              type: 1,
              nombre:         nombre,
              email:          email,
              password:       password,
              tipo_usuario:   tipo_usuario
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
    var id_servicio = $(this).attr('data-id');
    if (confirm("Desea eliminar el registro!"+id_servicio) == true) {
      $.ajax({
            type: "get",
            url: "{{ url('servicios/delete') }}"+'/'+ id_servicio,
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