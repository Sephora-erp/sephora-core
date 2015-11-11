<?php
use App\Http\Helpers\ModuleHelper;
use App\Http\Helpers\TriggerHelper;
?>
@extends('template')
@section('content')
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <h2 class="page-header"><i class="fa fa-cog"></i> Hello Dolly</h2>
    <?php
    TriggerHelper::fireTrigger('pageLoad', null);
    ?>
</section>
@stop

