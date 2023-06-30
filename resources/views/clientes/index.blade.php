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
              <th scope="col">Nombre</th>                    
                <th scope="col">Email</th>                    
                <th scope="col">Telefono</th>                    
                <th scope="col">RFC</th>                                    
                <th scope="col">Accion</th>                    
                <th scope="col"></th>                                
            </tr>
            </thead>
            <tbody>                
              @foreach ($clientes as $cliente)                        
                <tr>                            
                  <td>{{ $cliente->nombre }}</td>
                  <td>{{ $cliente->email }}</td>                            
                  <td>{{ $cliente->telefono}}</td>
                  <td>{{ $cliente->rfc}}</td>                                     
                  <td>                                
                    <button type="button" class="btn btn-success" id="btneditar"  data-id="{{$cliente->id}}" data-toggle="modal" data-target="#modal-default">
                Editar
              </button>
                  </td>                            
                  <td>                                
                    <button type="button" id="btn-eliminar" name="btn-eliminar" data-id="{{$cliente->id}}" class="btn btn-danger">Borrar</button>                            
                  </td>                        
                </tr>                    
              @endforeach                
            </tbody>
            <tfoot>
            <tr>
              <th scope="col">Nombre</th>                    
                <th scope="col">Email</th>                    
                <th scope="col">Telefono</th>                    
                <th scope="col">RFC</th>                                    
                <th scope="col">Accion</th>                    
                <th scope="col"></th>                        
           
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

<!--
  <div class="row">
  <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary"> Clientes</button> <button type="button" class="btn btn-success" id="btneditar"   data-toggle="modal" data-target="#modal-agregar">Agregar cliente</button>
          </div>

          <div class="card-body">
             <table id="example1" class="table table-bordered table-striped" style="font-size: 10pt;">           
            <thead>                  
              <tr>                    
                <th scope="col">Nombre</th>                    
                <th scope="col">Email</th>                    
                <th scope="col">Telefono</th>                    
                <th scope="col">RFC</th>                                    
                <th scope="col">Accion</th>                    
                <th scope="col"></th>                  
                </tr>                
            </thead>                
            <tbody>                    
              @foreach ($clientes as $cliente)                        
                <tr>                            
                  <td>{{ $cliente->nombre }}</td>
                  <td>{{ $cliente->email }}</td>                            
                  <td>{{ $cliente->telefono}}</td>
                  <td>{{ $cliente->rfc}}</td>                                     
                  <td>                                
                    <button type="button" class="btn btn-success" id="btneditar"  data-id="{{$cliente->id}}" data-toggle="modal" data-target="#modal-default">
                Editar
              </button>
                  </td>                            
                  <td>                                
                    <button type="button" id="btn-eliminar" name="btn-eliminar" data-id="{{$cliente->id}}" class="btn btn-danger">Borrar</button>                            
                  </td>                        
                </tr>                    
              @endforeach                
            </tbody>            
           </table>                
          
        </div>
    </div>
  </div>
</div> 


<div class="modal fade" id="modal-agregar" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Registro de clientes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
      </div>
      <div class="modal-body">
         <div class="row">
           <form id="formmodal">              
                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}"> 
                <div class="form-group has-success col-md-4">
                    <b>Datos de contacto</b><br>
                    <label class="control-label" for="inputSuccess1">Nombres</label>                     
                    <input id="nombre" type="text" class="form-control" name="nombre"  required  autofocus>
                    <label class="control-label" for="inputWarning1">Email</label>
                    <input id="email" name="email" type="email" class="form-control">
                    <label class="control-label" for="inputWarning1">Telefono</label>
                    <input id="telefono" name="telefono" type="text" class="form-control">                    
                </div>
                <div class="form-group has-success col-md-4">
                  <b>Datos de Facuración</b><br>
                    <label class="control-label" for="inputWarning1">Razón social</label>
                    <input id="razonsocial" name="razonsocial" type="text" class="form-control">
                
                    <label class="control-label" for="inputWarning1">RFC</label>
                    <input id="rfc" name="rfc" type="text" class="form-control">
                                                    
                </div>
                <div class="form-group has-success col-md-4">
                  <b>-</b><br>                                 
                    <label class="control-label" for="inputWarning1">Codigo postal</label>
                    <input id="codigopostal" name="codigopostal" type="text" class="form-control">
                    <label class="control-label" for="inputWarning1">Email facturass</label>
                    <input id="emailfactura" name="emailfactura" type="email" class="form-control">
                </div>

                <div class="form-group has-success col-md-8">
                  <label class="control-label" for="inputWarning1">Domicilio Fiscal</label>
                  <input id="domicilio" name="domicilio" type="text" class="form-control">
                </div>
                <div class="form-group has-warning col-md-12">
                    <label class="control-label" for="inputWarning1">Constancia de situacion Fiscal</label>
                    <input id="constanciasitucion" name="constanciasitucion" type="file" class="form-control">
                </div>
                <div class="form-group hasrror col-md-4">
                    <label class="control-label" for="inputWarning1">Nombre de usuario</label>
                    <input id="username" name="username" type="text" class="form-control">
                </div>
                <div class="form-group hasrror col-md-4">
                    <label class="control-label" for="inputWarning1">Contraseña</label>
                    <input id="password" name="password" type="text" class="form-control">
                </div>
                <div class="form-group hasrror col-md-4">
                    <label class="control-label" for="inputWarning1">Repetir contraseña</label>
                    <input id="rpassword" name="rpassword" type="text" class="form-control">
                </div>
            </form>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        <button id="btn_guardaregistro" name="btn_guardaregistro" type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
    
  </div>
  
</div>


<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Edición de clientes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
      </div>
      <div class="modal-body" style="font-size: 12pt;">
         <div class="row">
           <form id="formmodal">
              
                <input id="id_cliente" type="hidden" class="form-control" name="id_cliente">   
                <div class="form-group has-success col-md-4">
                    <b>Datos de contacto</b><br>
                    <label class="control-label" for="inputSuccess1">Nombres</label>                     
                    <input id="nombre-e" type="text" class="form-control" name="nombre-e"  required  autofocus>
                    <label class="control-label" for="inputWarning1">Email</label>
                    <input id="email-e" name="email-e" type="email" class="form-control">
                    <label class="control-label" for="inputWarning1">Telefono</label>
                    <input id="telefono-e" name="telefono-e" type="email" class="form-control">                    
                </div>
                <div class="form-group has-success col-md-4">
                  <b>Datos de Facuración</b><br>
                    <label class="control-label" for="inputWarning1">Razón social</label>
                    <input id="razonsocial-e" name="razonsocial-e" type="email" class="form-control">
                
                    <label class="control-label" for="inputWarning1">RFC</label>
                    <input id="rfc-e" name="rfc-e" type="text" class="form-control">

                    
                                 
                </div>
                <div class="form-group has-success col-md-4">
                  <b>-</b><br>                   
                
                    <label class="control-label" for="inputWarning1">Codigo postal</label>
                    <input id="codigopostal-e" name="codigopostal-e" type="text" class="form-control">
                    <label class="control-label" for="inputWarning1">Email facturass</label>
                    <input id="emailfactura-e" name="email-e" type="email" class="form-control">
                </div>

                <div class="form-group has-success col-md-8">
                  <label class="control-label" for="inputWarning1">Domicilio Fiscal</label>
                  <input id="domicilio-e" name="domicilio-e" type="text" class="form-control">
                </div>
                <div class="form-group has-warning col-md-12">
                    <label class="control-label" for="inputWarning1">Constancia de situacion Fiscal</label>
                    <input id="constanciasitucion-e" name="email-e" type="file" class="form-control">
                </div>
                <div class="form-group has-error col-md-4">
                    <label class="control-label" for="inputWarning1">Nombre de usuario</label>
                    <input id="username-e" name="username-e" type="text" class="form-control">
                </div>
                <div class="form-group has-error col-md-4">
                    <label class="control-label" for="inputWarning1">Contraseña</label>
                    <input id="password-e" name="password-e" type="text" class="form-control">
                </div>
                <div class="form-group has-error col-md-4">
                    <label class="control-label" for="inputWarning1">Repetir contraseña</label>
                    <input id="rpassword-e" name="rpassword-e" type="text" class="form-control">
                </div>
            </form>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        <button id="btn_guardarcambio" name="btn_guardarcambio" type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
    
  </div>
  
</div> -->

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