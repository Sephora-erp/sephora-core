<?php

use App\Http\Helpers\MenusHelper;
use App\Http\Helpers\HookHelper;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sephora | Alpha</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/css/AdminLTE.min.css">
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/css/custom.css">
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/css/animate.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <!-- datatables css -->
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="{{URL::to('/')}}/theme/plugins/datatables/jquery.dataTables.css">

        <!-- css hook -->

        <?php
        HookHelper::fireHook('headerCss', null);
        ?>
        <!-- //css hook -->

        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-green-light sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-lg"><b>Sephora</b> ERP</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown messages-menu" id='messageTxtMenu'>
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="" class="user-image" alt="User Image">
                                    <span class="hidden-xs">User name</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="" class="img-circle" alt="User Image">
                                        <p>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{URL::to('/settings')}}" class="btn btn-default btn-flat">Ajustes</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{URL::to('/auth/logout')}}" class="btn btn-default btn-flat">Cerrar sesión</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{URL::to('/images')}}/.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>User name</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- Role checking -->
                    <!-- search form -->
                    <form action="{{URL::to('/client/search')}}" method="post" class="sidebar-form">
                        {!! csrf_field() !!}
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Searcher">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- //Role checking -->

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <!-- Menus!! -->
                        <?= MenusHelper::getMenu() ?>
                        <!-- //Menus!! -->

                        <!-- Element -->
                        <li class="treeview">
                            <a href="{{URL::to('/settings')}}">
                                <i class="fa fa-cogs"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <!-- //Element -->

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 0.0.1
                </div>
                <strong>Copyright &copy; 2015 <a href="http://inforfenix.com">Inforfenix</a>.</strong> Centro de formación
            </footer>

            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div><!-- ./wrapper -->

        <!-- Datatables -->
        <script></script>
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="{{URL::to('/')}}/plugins/datatables/jquery.dataTables.js"></script>
        <script src="{{URL::to('/')}}/plugins/datatables/dataTables.bootstrap.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
$.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="{{URL::to('/')}}/theme/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{URL::to('/')}}/theme/js/angular.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="{{URL::to('/')}}/theme/plugins/morris/morris.min.js"></script>
        <!-- Chart js -->
        <script src="{{URL::to('/')}}/theme/js/chartjs/Chart.Core.js"></script>
        <script src="{{URL::to('/')}}/theme/js/chartjs/Chart.Bar.js"></script>
        <script src="{{URL::to('/')}}/theme/js/chartjs/Chart.Line.js"></script>
        <!-- Sparkline -->
        <script src="{{URL::to('/')}}/theme/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="{{URL::to('/')}}/theme/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="{{URL::to('/')}}/theme/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{URL::to('/')}}/theme/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="{{URL::to('/')}}/theme/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="{{URL::to('/')}}/theme/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{URL::to('/')}}/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="{{URL::to('/')}}/theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="{{URL::to('/')}}/theme/plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{URL::to('/')}}/theme/js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{URL::to('/')}}/theme/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{URL::to('/')}}/theme/js/demo.js"></script>
        <!-- Extra libs -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    </body>
</html>