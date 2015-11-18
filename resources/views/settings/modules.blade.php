<?php
use App\Http\Helpers\ModuleHelper;
?>
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
        <tr class="animated fadeInUp">
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