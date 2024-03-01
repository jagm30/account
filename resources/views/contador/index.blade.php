@extends('layouts.app') 
@section('contenidoprincipal') 

<div class="row">
    <div class="col-12">            
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Clientes registrados</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th scope="col">Razón social</th>                    
                <th scope="col">Email</th>                    
                <th scope="col">Telefono</th>                    
                <th scope="col">Status</th>                                 
                <th scope="col">Accion</th>                          
            </tr>
            </thead>
            <tbody>                
              @foreach ($clientes as $cliente)                        
                <tr>                            
                  <td>{{ $cliente->razonsocial }}</td>
                  <td>{{ $cliente->email }}</td>                            
                  <td>{{ $cliente->telefono}}</td>
                  <td style="text-align: center;">@if($cliente->status=='activo')<i class="fa fa-check" aria-hidden="true" style="color: green;"></i>@endif @if($cliente->status=='inactivo')<i class="fa fa-times" aria-hidden="true" style="color: red;"></i>@endif</td>
                  <!--<td>@if( $cliente->constanciasituacion !='')<a href="{{ Storage::url($cliente->constanciasituacion) }}" target="_blank">Descargar <img src="/images/logo_situacionfiscal.png" width="50" height="50"></a> @endif</td>--> 
                  <td>
                  @if(Auth::user()->tipo_usuario !="cliente")                               
                    <a href="/clientes/{{$cliente->id}}/edit" class="btn btn-success" id="btneditar"  data-id="{{$cliente->id}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  @endif
                    <a href="/contador/createservicio/{{ $cliente->id }}" class="btn btn-warning" id="btneditar"  data-id="{{$cliente->id}}" alt="Agregar servicio"> <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                  </td>                                              
                </tr>                    
              @endforeach                
            </tbody>
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
    
  $("#menucontador").addClass("nav-item menu-open");
  $("#menucontadorcliente").addClass("nav-link active");
  $("#menucontadorcliente1").addClass("important nav-link active"); 

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