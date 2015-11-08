<?php
use App\Http\Helpers\ModuleHelper;
?>
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
                    <li class="active"><a href="#tab_modules" data-toggle="tab">Modules</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_modules">

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Module Name</th>
                                    <th>Description</th>
                                    <th>Vendor</th>
                                    <th>Version</th>
                                    <th>Status</th>
                                </tr>
                                @foreach($modules as $module)
                                <tr>
                                    <td>{{$module['name']}}</td>
                                    <td>{{$module['description']}}</td>
                                    <td>{{$module['vendor']}}</td>
                                    <td>{{$module['version']}}</td>
                                    <td style='width:120px;'>
                                        @if(ModuleHelper::isModuleEnabled($module['package']))
                                            <a type="button" class="btn btn-success btn-flat" href='{{URL::to('/settings/disable-module/'.$module['package'])}}'><i class="fa fa-check"></i> Enabled</a>
                                        @else
                                            <a type="button" class="btn btn-danger btn-flat" href='{{URL::to('/settings/enable-module/'.$module['package'])}}'><i class="fa fa-times"></i> Disabled</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        </div>
    </div>
</section>
@stop

