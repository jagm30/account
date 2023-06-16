@extends('layouts.app') 
@section('contenidoprincipal') 
   
<div class="row">
  <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary"> Clientes</button> <button type="button" class="btn btn-success" id="btneditar"   data-toggle="modal" data-target="#modal-agregar">Agregar cliente</button>
          </div>
          <!-- /.box-header -->
          <div class="card-body">
             <table id="example1" class="table table-bordered table-striped" style="font-size: 10pt;">           
            <thead>                  
              <tr>                    
                <th scope="col">Nombre</th>                    
                <th scope="col">Email</th>                    
                <th scope="col">Telefono</th>                    
                <th scope="col">Direccion</th>                                    
                <th scope="col">Acción</th>                    
                <th scope="col"></th>                  
                </tr>                
            </thead>                
            <tbody>                    
              @foreach ($clientes as $cliente)                        
                <tr>                            
                  <td>{{ $cliente->apaterno }} {{ $cliente->amaterno }} {{ $cliente->nombre }}</td>
                  <td>{{ $cliente->email }}</td>                            
                  <td>{{ $cliente->telefono}}</td>
                  <td>{{ $cliente->direccion}}</td>                                     
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
          <!-- /.box-body -->
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
                    <label class="control-label" for="inputSuccess1">A. Paterno</label>                     
                    <input id="apaterno" type="text" class="form-control" name="apaterno"  required  autofocus>
                </div>
                <div class="form-group has-success col-md-4">
                    <label class="control-label" for="inputSuccess1">A. Materno</label>                     
                    <input id="amaterno" type="text" class="form-control" name="amaterno"  required  autofocus>
                </div>
                <div class="form-group has-success col-md-4">
                    <label class="control-label" for="inputSuccess1">Nombres</label>                     
                    <input id="nombres" type="text" class="form-control" name="nombres"  required  autofocus>
                </div>
                <div class="form-group has-warning col-md-6">
                    <label class="control-label" for="inputWarning1">Email</label>
                    <input id="email" name="email" type="email" class="form-control">
                </div>
                <div class="form-group has-warning col-md-6">
                    <label class="control-label" for="inputWarning1">Telefono</label>
                    <input id="telefono" name="telefono" type="email" class="form-control">
                </div>
                <div class="form-group has-warning col-md-12">
                    <label class="control-label" for="inputWarning1">Direccion</label>
                    <input id="direccion" name="direccion" type="text" class="form-control">
                </div>
                <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError1">Ciudad</label>
                    <select id="ciudad" name="ciudad" class="form-control">
                        <option value="admin">Tuxtla Gutierrez</option>
                        <option value="capturista">Chiapas</option>
                    </select>
                </div>
                <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError1">Estado</label>
                    <select id="estado" name="estado" class="form-control">
                        <option value="admin">Chiapas</option>
                        <option value="capturista">Tabasco</option>
                    </select>
                </div>
            </form>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
        <button id="btn_guardaregistro" name="btn_guardaregistro" type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <h4 class="modal-title">Edición de clientes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
      </div>
      <div class="modal-body">
         <div class="row">
           <form id="formmodal">
              
                <input id="id_cliente" type="hidden" class="form-control" name="id_cliente">
                
                <div class="form-group has-success col-md-4">
                    <label class="control-label" for="inputSuccess1">A. Paterno</label>                     
                    <input id="apaterno-e" type="text" class="form-control" name="apaterno-e"  required  autofocus>
                </div>
                <div class="form-group has-success col-md-4">
                    <label class="control-label" for="inputSuccess1">A. Materno</label>                     
                    <input id="amaterno-e" type="text" class="form-control" name="amaterno-e"  required  autofocus>
                </div>
                <div class="form-group has-success col-md-4">
                    <label class="control-label" for="inputSuccess1">Nombres</label>                     
                    <input id="nombres-e" type="text" class="form-control" name="nombres-e"  required  autofocus>
                </div>
                <div class="form-group has-warning col-md-6">
                    <label class="control-label" for="inputWarning1">Email</label>
                    <input id="email-e" name="email-e" type="email" class="form-control">
                </div>
                <div class="form-group has-warning col-md-6">
                    <label class="control-label" for="inputWarning1">Telefono</label>
                    <input id="telefono-e" name="telefono-e" type="email" class="form-control">
                </div>
                <div class="form-group has-warning col-md-12">
                    <label class="control-label" for="inputWarning1">Direccion</label>
                    <input id="direccion-e" name="direccion-e" type="text" class="form-control">
                </div>
                <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError1">Ciudad</label>
                    <select id="ciudad-e" name="ciudad-e" class="form-control">
                        <option value="admin">Tuxtla Gutierrez</option>
                        <option value="capturista">Chiapas</option>
                    </select>
                </div>
                <div class="form-group has-error col-md-6">
                    <label class="control-label" for="inputError1">Estado</label>
                    <select id="estado-e" name="estado-e" class="form-control">
                        <option value="admin">Chiapas</option>
                        <option value="capturista">Tabasco</option>
                    </select>
                </div>
            </form>
         </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
        <button id="btn_guardarcambio" name="btn_guardarcambio" type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection
@section("scriptpie")
<script>
  (function ($) {
    $('#example1').DataTable({
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados"        
      },
      "search": {
            "addClass": 'form-control input-lg col-xs-12'
      },
      "fnDrawCallback":function(){
        $("input[type='search']").attr("id", "searchBox");            
        $('#searchBox').css("width", "400px").focus();
      }
    })
  

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
              
              $("#apaterno-e").val(html.apaterno);    
              $("#amaterno-e").val(html.amaterno);
              $("#nombres-e").val(html.nombre);
              $("#email-e").val(html.email);
              $("#telefono-e").val(html.telefono);
              $("#direccion-e").val(html.direccion);           
              $("#ciudad-e option[value='"+ html.ciudad +"']").attr("selected",true);
              $("#estado-e option[value='"+ html.estado +"']").attr("selected",true);    

           }
        })
  });

  $('#btn_guardarcambio').click(function() {   
    var id_cliente  = $("#id_cliente").val();
    var apaterno    = $("#apaterno-e").val();
    var amaterno    = $("#amaterno-e").val();
    var nombre      = $("#nombres-e").val();    
    var email       = $("#email-e").val();
    var telefono    = $("#telefono-e").val();
    var direccion   = $("#direccion-e").val();
    var ciudad      = $("#ciudad-e").val();
    var estado      = $("#estado-e").val();

   /* if (nombre.length == 0 || email.length == 0 ) {
      alert("No pueden haber campos vacios.");
      return false;
    }   */
      $.ajax({
         url:"/clientes/edicion/"+id_cliente+"/"+apaterno+"/"+amaterno+"/"+nombre+"/"+email+"/"+telefono+"/"+direccion+"/"+ciudad+"/"+estado,
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
    
    var apaterno  = $('#apaterno').val();
    var amaterno  = $('#amaterno').val();    
    var nombres   = $('#nombres').val();
    var email     = $('#email').val();
    var telefono  = $('#telefono').val();
    var direccion = $('#direccion').val();    
    var ciudad    = $('#ciudad').val();
    var estado    = $('#estado').val();
    var status    = 'activo';

      $.ajax({
          url: "/clientes",
          type: "POST",
          data: {
              _token: $("#csrf").val(),
              type: 1,
              apaterno:   apaterno,
              amaterno:   amaterno,
              nombre:     nombres,
              email:      email,
              telefono:   telefono,
              direccion:  direccion,
              ciudad:     ciudad,
              estado:     estado,
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