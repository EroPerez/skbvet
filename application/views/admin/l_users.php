<!-- Demo Content: Panels + Text-->
<div class="row">
    <div class="col-md-12">
        <div id="order3" class="admin-form theme-primary">
            <!--panel-heading section--> 
            <div class="panel panel-primary panel-border  heading-border">
                <div class="panel-heading"><span class="panel-title"></span></div>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <!-- INICIO tablas-->
                        <div class="content" style="margin: 10px;">
                            <div class="gj-float-right" style="padding-bottom: 10px;">
                                <button type="button" id="btnAdd" class="btn btn-alert" data-toggle="modal" onclick="limpiar_addmodal()" data-target="#adduser_Modal"><i class="fa fa-plus" ></i>Add User</button>

                            </div>
                            <table id="table_user" class="table table-hover">
                                <thead>
                                    <tr class="primary">
                                        <th>Username</th>
                                        <th>Role Levels</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody id="body_table">

                                </tbody>
                            </table>
                        </div>
                        <!-- -->
                    </div>

                    <!-- end: .panel-->
                </div>

                <!--end permisos --> 
            </div>
        </div>
    </div> 
</div>  

<!-- Modal Eliminar -->

<div class="modal fade" tabindex="-1" id="eliminaruser"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete confirm</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this user!!!</h4>
                    <p>Are you sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="delete_user()">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" id="edituser"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Edit User</b></h4>
            </div>
            <div class="modal-body">
                <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                    <!-- AQUI-->
                    <form  role="form" id="form-edituser" method="post" action="/">    
                        <div class="section row" >

                            <div class="col-md-12 col-xs-12">
                                <div class="section-divider"><span>Password</span></div>
                                <label class="field prepend-icon">
                                    <input id="ch_password" type="password" name="ch_password" class="gui-input">
                                </label>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div class="section-divider"><span>Retry Password</span></div>
                                <label class="field prepend-icon">
                                    <input id="ch_retry_password" type="password" name="ch_retry_password" class="gui-input">
                                </label>
                            </div>
                            <div class="section row" >
                                <div class="col-md-6 col-xs-6">
                                    <div class="section-divider"><span>Activate</span></div>
                                    <div class="checkbox-custom fill mb5">
                                        <input id="checkboxactive" value='1' checked="" type="checkbox">
                                        <label for="checkboxactive">Active</label>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-xs-6">
                                    <div class="section-divider"><span>Rol level</span></div>

                                    <label class="field select" >
                                        <select id="edit_level_role" name="edit_level_role" placeholder="Level role">
                                            <?php foreach ($role as $key => $value) { ?>
                                                <option value="<?php echo $value['idlevels']; ?>"><?php echo $value['rolename']; ?></option>
                                            <?php } ?>
                                        </select><i class="arrow"></i>
                                    </label>
                                </div> 
                            </div> 
                        </div>

                    </form>

                    <!--END-->
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="editar_user()">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal-->
<div id="adduser_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                <!-- AQUI-->
                <form  role="form" id="form-order3" method="post" action="/" enctype="multipart/form-data">    
                    <div class="section row" >
                        <div class="col-md-12 col-xs-12">

                            <div class="section-divider"><span>User name</span></div> 
                            <label class="field prepend-icon">
                                <input id="user_name" type="text" name="user_name" class="gui-input" >
                            </label>
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <div class="section-divider"><span>Password</span></div>
                            <label class="field prepend-icon">
                                <input id="password" type="password" name="password" class="gui-input">
                            </label>
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <div class="section-divider"><span>Confirm Password</span></div>
                            <label class="field prepend-icon">
                                <input id="retry_password" type="password" name="retry_password" class="gui-input">
                            </label>
                        </div>
                    </div>

                    <div class="section row" >
                        <div class="col-md-12 col-xs-12">

                            <div class="section-divider"><span>Rol level</span></div>

                            <label class="field select" >
                                <select id="level_role" name="level_role" placeholder="Level role">
                                    <?php foreach ($role as $key => $value) { ?>
                                        <option value="<?php echo $value['idlevels']; ?>"><?php echo $value['rolename']; ?></option>
                                    <?php } ?>
                                </select><i class="arrow"></i>
                            </label>

                        </div>

                    </div>
                    <!--                    <div class="section row" >
                                            <div class="col-md-12 col-xs-12">
                    
                                                <div class="section-divider"><span>Upload photo</span></div>
                    
                                                 File Uploaders
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="section">
                                                            <label class="field prepend-icon append-button file"><span class="button">Choose Photo</span>
                                                                <input id="file1" type="file" name="file1" onchange="document.getElementById('uploader1').value = this.value;" class="gui-file">
                                                                <input id="uploader1" type="text" placeholder="Please select a photo" class="gui-input">
                                                                <label class="field-icon"><i class="fa fa-upload"></i></label>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="section">
                                                            <button type="button" id="btnupload" class="btn btn-sm btn-info">Upload</button>
                                                        </div>
                                                    </div>
                    
                                                </div>
                    
                                            </div>
                    
                                        </div>-->
                </form>

                <!--END-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_user()"  data-dismiss="modal">Save</button>
            </div>
        </div>

    </div>
</div>
<!--<div >
    <div style='background-color: #E5F3FB;border-bottom: 1px solid #f8a760;width: 100px;text-align: right'>asdsadas
    </div>
    sdsdsdsd
</div>-->