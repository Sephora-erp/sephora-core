@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <h2 class="page-header"><i class="fa fa-cog"></i> Settings</h2>
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active animated fadeIn"><a href="#tab_modules" data-toggle="tab"><i class="fa fa-th-large"></i> Modules</a></li>
                    <li class="animated fadeIn"><a href="#tab_general" data-toggle="tab"><i class="fa fa-indent"></i> Company Info</a></li>
                    <li class="pull-right animated fadeIn"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_modules">
                        @include('settings.modules')
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_general">
                        @include('settings.general')
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        </div>
    </div>
</section>
@stop

