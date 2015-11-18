<?php
    use App\Http\Controllers\SettingsController;
?>
<div class='row'>
    <div class='col-md-8 col-md-offset-2'>
        <form action="{{URL::to('/settings/update')}}" method="POST">
            <!-- -->
            <div class="form-group animated fadeInDown" style='height:34px;'>
                <label class="col-sm-4 control-label">Company name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_name]' value="{{SettingsController::fetchSetting('company_name')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInUp" style='height:34px;'>
                <label class="col-sm-4 control-label">Company NIF</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_nif]' value="{{SettingsController::fetchSetting('company_nif')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInDown" style='height:34px;'>
                <label class="col-sm-4 control-label">This company is subject to VAT?</label>
                <div class="col-sm-8">
                    <select class="form-control" name='general[company_uses_vat]'>
                        <option value='0' @if(SettingsController::fetchSetting('company_uses_vat') == 0) selected="selected" @endif>No</option>
                        <option value='1' @if(SettingsController::fetchSetting('company_uses_vat') == 1) selected="selected" @endif>Yes</option>
                    </select>
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInDown" style='height:34px;'>
                <label class="col-sm-4 control-label">VAT %</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_vat]' value="{{SettingsController::fetchSetting('company_vat')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInUp" style='height:34px;'>
                <label class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_address]' value="{{SettingsController::fetchSetting('company_address')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInDown" style='height:34px;'>
                <label class="col-sm-4 control-label">City</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_city]' value="{{SettingsController::fetchSetting('company_city')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInUp" style='height:34px;'>
                <label class="col-sm-4 control-label">State</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_state]' value="{{SettingsController::fetchSetting('company_state')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInDown" style='height:34px;'>
                <label class="col-sm-4 control-label">Postal Code</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_cp]' value="{{SettingsController::fetchSetting('company_cp')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInUp" style='height:34px;'>
                <label class="col-sm-4 control-label">Country</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_country]' value="{{SettingsController::fetchSetting('company_country')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInDown" style='height:34px;'>
                <label class="col-sm-4 control-label">Phone 1</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_phone_1]' value="{{SettingsController::fetchSetting('company_phone_1')}}">
                </div>
            </div>
            <!-- -->
            <div class="form-group animated fadeInUp" style='height:34px;'>
                <label class="col-sm-4 control-label">Phone 2</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Write here..." name='general[company_phone_2]' value="{{SettingsController::fetchSetting('company_phone_2')}}">
                </div>
            </div>
            <!-- -->
            
            <div class="form-group animated fadeInDown center" style='height:34px;'>
                <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-save"></i> Save settings</button>
            </div>
        </form>
    </div>
</div>