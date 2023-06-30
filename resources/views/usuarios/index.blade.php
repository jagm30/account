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
              <th scope="col">Id</th>                    
                <th scope="col">Nombre</th>                    
                <th scope="col">Email</th>                    
                <th scope="col">Tipo de usuario</th>                                    
                <th scope="col">Acción</th>                    
                <th scope="col"></th>                                 
            </tr>
            </thead>
            <tbody>                
              @foreach ($usuarios as $usuario)                        
                <tr>                            
                  <td>{{ $usuario->id }}</td>                            
                  <td>{{ $usuario->name }}</td>                            
                  <td>{{ $usuario->email}}</td>
                  <td>{{ $usuario->tipo_usuario}}</td>                                     
                  <td>                                
                    <button type="button" class="btn btn-success" id="btneditar"  data-id="{{$usuario->id}}" data-toggle="modal" data-target="#modal-default">
                Editar
              </button>
                  </td>                            
                  <td>                                
                    <button type="button" id="btn-eliminar" name="btn-eliminar" data-id="{{$usuario->id}}" class="btn btn-danger">Borrar</button>                            
                  </td>                        
                </tr>                    
              @endforeach                
            </tbody>
            <tfoot>
            <tr>
              <th scope="col">Id</th>                    
                <th scope="col">Nombre</th>                    
                <th scope="col">Email</th>                    
                <th scope="col">Tipo de usuario</th>                                    
                <th scope="col">Acción</th>                    
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
            <button type="button" class="btn btn-primary"> Usuarios</button> <button type="button" class="btn btn-success" id="btneditar"   data-toggle="modal" data-target="#modal-agregar">Agregar usuarios</button>
          </div>
      
          <div class="card-body">
             <table id="example1" class="table table-bordered table-striped">           
            <thead>                  
              <tr>                    
                <th scope="col">Id</th>                    
                <th scope="col">Nombre</th>                    
                <th scope="col">Email</th>                    
                <th scope="col">Tipo de usuario</th>                                    
                <th scope="col">Acción</th>                    
                <th scope="col"></th>                  
                </tr>                
            </thead>                
            <tbody>                    
              @foreach ($usuarios as $usuario)                        
                <tr>                            
                  <td>{{ $usuario->id }}</td>                            
                  <td>{{ $usuario->name }}</td>                            
                  <td>{{ $usuario->email}}</td>
                  <td>{{ $usuario->tipo_usuario}}</td>                                     
                  <td>                                
                    <button type="button" class="btn btn-success" id="btneditar"  data-id="{{$usuario->id}}" data-toggle="modal" data-target="#modal-default">
                Editar
              </button>
                  </td>                            
                  <td>                                
                    <button type="button" id="btn-eliminar" name="btn-eliminar" data-id="{{$usuario->id}}" class="btn btn-danger">Borrar</button>                            
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
        <h4 class="modal-title">Registro de Usuarios</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
      </div>
      <div class="modal-body">
         <div class="row">
           <form id="formmodal">
              <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                <input id="id_usuario" type="hidden" class="form-control" name="id_usuario">
                <div class="form-group has-success col-md-12">
                    <label class="control-label" for="inputSuccess1">Nombre</label>                     
                    <input id="nombre" type="text" class="form-control" name="nombre"  required  autofocus>
                </div>
                <div class="form-group has-warning col-md-6">
                    <label class="control-label" for="inputWarning1">Email</label>
                    <input id="email" name="email" type="email" class="form-control">
                </div>
                <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError1">Tipo de usuario</label>
                    <select id="tipo_usuario" name="tipo_usuario" class="form-control">
                        <option value="cliente">Cliente</option>
                        <option value="admin">Administrador</option>
                        <option value="contador">Contador</option>
                    </select>
                </div>
                <div class="form-group has-success col-md-6">
                    <label class="control-label" for="inputSuccess1">Contraseña</label>
                    <input id="password" type="password" class="form-control" name="password"  required  autofocus>
                </div>
                <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError1">Confirma tu contraseña</label>
                    <input id="rpassword" type="password" class="form-control" name="rpassword"  required  autofocus>
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


<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Edición de usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
      </div>
      <div class="modal-body">
         <div class="row">
           <form id="formmodal" method="POST" action="/clientes">
                <input id="id_usuario" type="hidden" class="form-control" name="id_usuario">
                <div class="form-group has-success col-md-12">
                    <label class="control-label" for="inputSuccess1">Nombre</label>                     
                    <input id="nombre-e" type="text" class="form-control" name="nombre-e"  required  autofocus>
                </div>
                <div class="form-group has-warning col-md-6">
                    <label class="control-label" for="inputWarning1">E-mail</label>
                    <input id="email-e" name="email-e" type="text" class="form-control">
                </div>
                <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError1">Tipo de usuario</label>
                    <select id="tipo_usuario-e" name="tipo_usuario-e" class="form-control">
                        <option value="cliente">Cliente</option>
                        <option value="admin">Administrador</option>
                        <option value="contador">Contador</option>
                    </select>
                </div>
                <div class="form-group has-success col-md-6">
                    <label class="control-label" for="inputSuccess1">Contraseña</label>
                    <input id="password-e" type="password" class="form-control" name="password-e" autocomplete="off"  required  autofocus>
                </div>
                <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError1">Confirma tu contraseña</label>
                    <input id="rpassword-e" autocomplete="off" type="password" class="form-control" name="rpassword-e"  required  autofocus>
                </div>               
            </form>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        <button id="btn_guardarcambio" name="btn_guardarcambio" type="button" class="btn btn-primary">Save changes</button>
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
    var id_usuario = $(this).attr('data-id');
    if (confirm("Desea eliminar el registro!"+id_usuario) == true) {
      $.ajax({
            type: "get",
            url: "{{ url('usuarios/delete') }}"+'/'+ id_usuario,
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