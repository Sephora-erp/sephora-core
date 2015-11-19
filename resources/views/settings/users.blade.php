<?php

use App\Http\Helpers\ModuleHelper;
?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <th>UID</th>
            <th>Name</th>
            <th>Username</th>
            <th style='width:50px;'>Status</th>
            <th style='width:114px;'> </th>
        </tr>
        @foreach($users as $user)
        <tr class="animated fadeInUp">
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td><label class='btn btn-success btn-xs'>Active</label></td>
            <td class='center'>
                <button class='btn btn-xs btn-danger' onclick='deleteUser({{$user->id}})'><i class='fa fa-trash'></i></button>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4"></td>
            <td class='center'>
                <button class='btn btn-xs btn-success' data-toggle='modal' data-target='#addUserModal'><i class='fa fa-plus'></i> Add new</button>
            </td>
        </tr>
    </tbody>
</table>

<!-- MODALS ZONE -->
<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action='{{URL::to('/user/create')}}' method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create a new user</h4>
                </div>
                <div class="modal-body">

                    <!-- -->
                    <div class="form-group animated fadeInUp" style='height:34px;'>
                        <label class="col-sm-4 control-label">Fullname</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" placeholder="Write here..." name='name'/>
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-group animated fadeInUp" style='height:34px;'>
                        <label class="col-sm-4 control-label">Usename (Email)</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" placeholder="Write here..." name='email'/>
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-group animated fadeInUp" style='height:34px;'>
                        <label class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" placeholder="Write here..." name='password'/>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Create & Reload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    /*
     * Ask's for delete the user
     */
    function deleteUser(userId)
    {
        if(confirm("Do you really want to delete the user?")){
            location.href = "{{URL::to('/user/delete/')}}/"+userId;
        }else{
            
        }
    }
</script>