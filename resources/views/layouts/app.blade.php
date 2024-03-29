<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FACTURACION</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->

  <link rel="stylesheet" href="/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

</head>
<body class="hold-transition sidebar-mini">
<style type="text/css">
  [class*=sidebar-dark-] {
    background-color: indigo;
  }

  [class*=sidebar-dark] .btn-sidebar, [class*=sidebar-dark] .form-control-sidebar {
    background-color: white;
    border: 1px solid #56606a;
    color: black;
  }
</style>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Facturación</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/images/1.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library  menu-is-opening menu-open-->
        
        @guest
        @else
        @if(Auth::user()->tipo_usuario == 'admin' or Auth::user()->tipo_usuario == 'superadmin')
        
    
          <li class="nav-item" id="menucatserv">
            <a href="#" class="nav-link" id="menucatserv1">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                CATÁLOGO
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/catservicios" class="nav-link" id="menucatserv2">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/catservicios/create" class="nav-link" id="menucatserv3">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Registrar</p>
                </a>
              </li>                                     
            </ul>
          </li>
          <li class="nav-item" id="menuservicio">
            <a href="#" class="nav-link" id="menuservicio2">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                SERVICIOS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/servicios" class="nav-link" id="menuconsultaservicio">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/servicios/create" class="nav-link" id="menuregistraservicio">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Registrar</p>
                </a>
              </li>                                     
            </ul>
          </li>
          <li class="nav-item" id="menuecliente">
            <a href="#" class="nav-link" id="menuecliente2">
              <i class="nav-icon fas fa-users"></i>
              <p>
                CLIENTES
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/clientes" class="nav-link" id="menuconsultacliente">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/clientes/create" class="nav-link" id="menuregistracliente">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Registrar</p>
                </a>
              </li>                                     
            </ul>
          </li>
          <li class="nav-item" id="menuusuario">
            <a href="#" class="nav-link" id="menuusuario2">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                USUARIOS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/usuarios" class="nav-link" id="menuconsultausuario">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/usuarios/create" class="nav-link" id="menuregistrausuario">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registrar</p>
                </a>
              </li>                        
            </ul>
          </li>
                          
        @endif
        @if(Auth::user()->tipo_usuario == 'contador' )
          <li class="nav-item" id="menucatserv">
            <a href="#" class="nav-link" id="menucatserv1">
              <i class="nav-icon fas fa-bars"></i>
              <p>
                CATÁLOGO
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/catservicios" class="nav-link" id="menucatserv2">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/catservicios/create" class="nav-link" id="menucatserv3">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registrar</p>
                </a>
              </li>                                     
            </ul>
          </li>
          <li class="nav-item" id="menucontadorservicio">
            <a href="#" class="nav-link" id="menucontadorservicio1">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                SERVICIOS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/servicios" class="nav-link" id="menucontadorservicio1_1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li>                                    
            </ul>
          </li>
          <li class="nav-item" id="menucontador">
            <a href="#" class="nav-link" id="menucontadorcliente">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                CLIENTES
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/contador" class="nav-link" id="menucontadorcliente1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/clientes/create" class="nav-link" id="menucontadorcliente2">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Registrar</p>
                </a>
              </li>                                     
            </ul>
          </li>          
          <li class="nav-item" id="menucontadoredocta">
            <a href="#" class="nav-link" id="menucontadoredocta1">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                ESTADO DE CUENTA
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/contador/cuentaclientes" class="nav-link" id="menucontadoredocta1_1">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li>                                    
            </ul>
          </li>         
        @endif
          <!-- 
            Inicia vista de clientes!            
          --> 
          @if(Auth::user()->tipo_usuario=="cliente")
          <li class="nav-item" id="menucliedocuenta">
            <a href="/servicios/estadoCuenta/{{Auth::user()->id}}" class="nav-link" id="menucliedocuenta2">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Estado de cuenta
              </p>
            </a>
          </li> 
          <li class="nav-item" id="servicioscliente">
            <a href="/servicios/" class="nav-link" id="servicioscliente2">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Mis servicios
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Mis facturas
              </p>
            </a>
          </li> 
          @endif
          @endguest
          <li class="nav-item" style="background-color: darkslateblue;">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                CERRAR
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li> 
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">

        @yield('contenidoprincipal')


      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>-->
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [{
                  extend:    'copyHtml5',
                  text:      '<i class="fa fa-files-o"></i>',
                  titleAttr: 'Copy'
                }, 
                {
                  extend:    'excelHtml5',
                  text:      '<i class="fa fa-file-excel"></i>',
                  titleAttr: 'Excel'
                }, 
                {
                  extend:    'pdfHtml5',
                  text:      '<i class="fa fa-file-pdf"></i>',
                  titleAttr: 'PDF'
                }, 
                {
                  extend:    'print',
                  text:      '<i class="fa fa-print"></i>',
                  titleAttr: 'PDF'
                },
                {
                  extend:    'colvis',
                  text:      '<i class="fa fa-bars"></i>',
                  titleAttr: 'mostrar / ocultar'
                }]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  bsCustomFileInput.init();
});
</script>
@yield("scriptpie")
</body>
</html>
