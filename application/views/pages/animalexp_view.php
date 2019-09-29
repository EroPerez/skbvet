<div class="row">
    <div class="col-md-12">
        <div id="order3" class="admin-form theme-primary">
            <!--panel-heading section--> 
            <div class="panel panel-primary panel-border  heading-border">
                <div class="panel-heading"><span class="panel-title"><?php echo $title; ?></span></div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- INICIO FORM LICENCES-->
                        <form id="form-farm" method="post" action="/">
                            <div class="panel-body p25">

                                <div class="row">
                                    <!--Farmer details  -->
                                    <div class="col-md-8 col-xs-8" style="padding:2px; border:1px;"> 
                                        <div class="section row"> 
                                            <div class="col-md-12 col-xs-12"> 
                                                <div class="section-divider"><span>Licence No</span></div>
                                                <label for="animalimp_licenceNo" class="field prepend-icon">
                                                    <input id="animalimp_licenceNo" type="tel" name="animalimp_licenceNo" placeholder="Licence No" class="gui-input phone-group">
                                                    <input id="animalimp_recn" type="hidden" />
                                                    <input id="edit" type="hidden" />
                                                    <input id="page" type="hidden" />
                                                    <label for="animalimp_licenceNo" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                                                </label>
                                            </div> 
                                            <div class="col-md-12 col-xs-12">
                                                <div class="section-divider"><span> Date</span></div>
                                                <label for="animalimp_date" class="field prepend-picker-icon">
                                                    <input id="animalimp_date" type="text" name="animalimp_date" placeholder="Licence Date" class="gui-input">
                                                </label>
                                            </div>
                                            <!--  </div> -->
                                            <!-- <div class="section row"> -->
                                            <div class="col-md-12 col-xs-12">
                                                <div class="section-divider"><span>Exporter</span></div>
                                                <label class="field select">
                                                    <select id="animalimp_importer" name="animalimp_importer" placeholder="">
                                                        <?php foreach ($trader as $key_trader => $value_trader) { ?>
                                                            <option value="<?php echo $value_trader['recn']; ?>"><?php echo $value_trader['name']; ?></option>
                                                        <?php } ?>
                                                    </select><i class="arrow"></i>
                                                </label>
                                            </div>


                                            <div class="col-md-12 col-xs-12">

                                                <div class="section-divider"><span>Fee</span></div>
                                                <label for="animalimp_fee" class="field prepend-icon">
                                                    <input id="animalimp_fee" type="tel" name="animalimp_fee" placeholder="Fee" class="gui-input phone-group">
                                                    <label for="animalimp_fee" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                                                </label>
                                            </div>
                                        </div>
                                    </div>   
                                    <!--Actions-->
                                    <div class="col-md-4 col-xs-4" tyle="padding:2px; border:1px;" >
                                        <div  class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-icon"></span>
                                                <span class="panel-title" style="font-size: 12px;">Actions</span>
                                            </div>
                                            <div class="panel-body">
                                                <div class="section row" >
                                                    <div class="col-md-12" style="padding:0px"> 
                                                        <div class="col-md-6"> 
                                                            <a href = "javascript:back_licence();" class="btn btn-xs btn-success btn-block"><i class="glyphicon glyphicon-chevron-left"></i><span >Back</span></a>
                                                        </div> 
                                                        <div class="col-md-6" >
                                                            <a href = "javascript:forward_licence();" class="btn btn-xs btn-info btn-block"><span >Next<i class="glyphicon glyphicon-chevron-right"></i></span></a>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="section-divider"><span></span></div>
                                                <!--prueba de botones -->
                                                <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                    <div class="col-xs-12 pln"><a id="add_licence" href="javascript:save_licence();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="glyphicon glyphicon-save"></i> Save Licence</a></div>
                                                    <div class="col-xs-12 pln"><a id="edit_licence" href="javascript:edit_licence();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="fa fa-edit"></i> Edit Licence</a></div>
                                                    <div class="col-xs-12 pln"><a id="deletelicence"  data-toggle="modal" data-target = "#eliminarlicence" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block disabled"><i class="fa fa plus"></i> Delete Licence</a></div>
                                                    <div class="col-xs-12 pln"><a id="new_licence" href="javascript: new_licence();" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-plus"></i> New Licence</a></div>
                                                    <div class="col-xs-12 pln"><a id="listfarm" href="<?= site_url('animalexp') ?>" data-form-skin="success" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-list"></i> Back to List</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  

                                </div> 
                                <div class="section row" id="commodityDetails">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="section row p5">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="section-divider"><span>Commodity</span></div>
                                                <div class="gj-margin-top-20">
                                                    <div class="gj-float-right" style="padding-bottom: 10px;">
                                                        <button type="button" id="btnAddanimalimp" class="btn btn-alert" data-toggle="modal" onclick="limpiar_addmodal_animal()" data-target="#animalimp_Modal"><i class="fa fa-plus" ></i>Add New</button>
                                                    </div>
                                                </div>

                                                <table id="table_animalimp" class="table table-hover">
                                                    <thead>
                                                        <tr class="primary">
                                                            <th>Date </th>
                                                            <th>status</th>
                                                            <th>Species:Breed</th>
                                                            <th>Quantity</th>
                                                            <th>Country/Destination</th>
                                                            <th></th>
                                                            <th></th>												  
                                                        </tr>
                                                    </thead>
                                                    <tbody id="body_table">

                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>

                            </div> 

                            <!-- end .panel-body section-->
                        </form>

                    </div>

                    <!-- end: .panel-->
                </div>

            </div>
        </div>
    </div>  
</div>
<!-- Modal Eliminar licence-->

<div class="modal fade" tabindex="-1" id="eliminarlicence"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete animal importer licence</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this licence!!!</h4>
                    <p>Are you sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="delete_licence()">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Eliminar animal -->

<div class="modal fade" tabindex="-1" id="eliminaranimal"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete live animal details register</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this live animal!!!</h4>
                    <p>Are your sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="delete_tradeliveanimaldetails()">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--modal animalimp-->
<div id="animalimp_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Live Animal</h4>
            </div>
            <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                <!-- AQUI-->
                <form  role="form" id="form-order3" method="post" action="/">    
                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="section-divider"><span class="label label-rounded label-info">Country</span></div>
                                <label class="field select" id="animalimp_label">
                                    <select id="animalimp_origin" name="animalimp_origin" placeholder="animalimp">
                                        <option value="">Select a destination</option>
                                        <?php foreach ($country as $key_country => $value_country) { ?>
                                            <option value="<?php echo $value_country['recn']; ?>"><?php echo $value_country['name']; ?></option>
                                        <?php } ?>
                                    </select><i class="arrow"></i>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="section-divider"><span>Date </span></div>
                                <label for="animalimp_dateadd" class="field prepend-picker-icon"><input id="animalimp_dateadd" type="text" name="animalimp_dateadd" placeholder="Date Added" class="gui-input">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="section-divider"><span>Export Status</span></div>
                            <div class="section mv15">
                                <div class="option-group field">
                                    <label class="option option-primary">
                                        <input name="animalimp_status" id="animalimp_status1" value="1" checked="" type="radio"><span class="radio"></span>New Export
                                    </label>
                                    <label class="option option-primary">
                                        <input name="animalimp_status" id="animalimp_status2" value="2" type="radio"><span class="radio"></span>Re Export
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <div class="section-divider"><span>Species</span></div>
                                <input id="recntpd" type="hidden" />
                                <input id="recntp" type="hidden" />
                                <input id="c_edit" type="hidden" />
                                <label class="field select" >
                                    <select id="animalimp_species" name="animalimp_species" placeholder="Species">
                                        <?php foreach ($species as $key_unit => $value_species) { ?>
                                            <option value="<?php echo $value_species['recn']; ?>"><?php echo $value_species['name']; ?></option>
                                        <?php } ?>
                                    </select><i class="arrow"></i>
                                </label>

                            </div>
                            <div class="col-md-6">
                                <div class="section-divider"><span>Breed</span></div>
                                <label class="field select" id="breeds">
                                    <select id="animalimp_breeds" name="animalimp_breeds" placeholder="Breeds">
                                        <!-- set here -->
                                    </select><i class="arrow"></i>
                                </label>

                            </div>
                        </div>
                    </div> 
                    <!--Treatment -->

                    <div class="section row" >

                        <div class="section row" >
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="section-divider"><span>Quantity </span></div>
                                    <label for="animalimp_quantity" class="field prepend-icon">
                                        <input id="animalimp_quantity" type="text" name="animalimp_quantity" placeholder="Quantity" class="gui-input">
                                        <label for="animalimp_quantity" class="field-icon"><i class="fa fa-user"></i></label>
                                    </label>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="section-divider"><span>Comments</span></div>
                            <label class="field prepend-icon">
                                <textarea id="animalimp_comment" name="animalimp_comment" placeholder="Comments" class="gui-textarea"></textarea>
                                <label for="animalimp_comment" class="field-icon"><i class="imoon imoon-keyboard"></i></label>
                            </label>
                        </div>
                    </div>
                    <!--end treatment --> 
                    <div class="section row">
                        <div class="col-md-6">
                            <div class="section-divider"><span>Consignee of Sender</span></div>
                            <label for="animalimp_sender" class="field prepend-icon">
                                <input id="animalimp_sender" type="text" name="animalimp_sender" placeholder="Sender name" class="gui-input phone-group">
                                <label for="animalimp_sender" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                            </label>
                        </div>


                        <div class="col-md-6">
                            <div class="section-divider"><span>Consignee of Receiver</span></div>
                            <label for="animalimp_receiver" class="field prepend-icon">
                                <input id="animalimp_receiver" type="text" name="animalimp_receiver" placeholder="Receiver name" class="gui-input phone-group">
                                <label for="animalimp_receiver" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                            </label>
                        </div>
                    </div> 

                </form>

                <!--END-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick = "save_tradeliveanimaldetails()"  data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> <!--end modal content -->

    </div>
</div> <!--end modal -->       