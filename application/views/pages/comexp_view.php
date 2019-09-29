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
                                    <div class="col-md-8" style="padding:2px; border:1px;"> 
                                        <div class="section row">
                                            <div class="col-md-6">
                                                <div class="section-divider"><span>Licence No</span></div>
                                                <label for="comimp_licenceNo" class="field prepend-icon">
                                                    <input id="comimp_recn" type="hidden" />
                                                    <input id="edit" type="hidden" />
                                                    <input id="page" type="hidden" />
                                                    <input id="comimp_licenceNo" type="tel" name="comimp_licenceNo" placeholder="Licence No" class="gui-input phone-group">
                                                    <label for="comimp_licenceNo" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="section-divider"><span> Date</span></div>
                                                <label for="comimp_date" class="field prepend-picker-icon">
                                                    <input id="comimp_date" type="text" name="comimp_date" placeholder="Licence Date" class="gui-input">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="section row">
                                            <div class="col-md-6">
                                                <div class="section-divider"><span>Trader</span></div>
                                                <label class="field select">
                                                    <select id="comimp_trader" name="comimp_trader" placeholder="">
                                                        <?php foreach ($trader as $key_trader => $value_trader) { ?>
                                                            <option value="<?php echo $value_trader['recn']; ?>"><?php echo $value_trader['name']; ?></option>
                                                        <?php } ?>

                                                    </select><i class="arrow"></i>
                                                </label>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="section-divider"><span>Fee</span></div>
                                                <label for="comimp_fee" class="field prepend-icon">
                                                    <input id="comimp_fee" type="tel" name="comimp_fee" placeholder="Fee" class="gui-input phone-group">
                                                    <label for="comimp_fee" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                                                </label>
                                            </div>
                                        </div>                                         

                                    </div> <!--Fin del div col 8 -->
                                    <!--Actions-->
                                    <div class="col-md-4" tyle="padding:2px; border:1px;" >
                                        <div  class="panel">
                                            <div class="panel-heading">
                                                <span class="panel-icon"></span>
                                                <span class="panel-title" style="font-size: 12px;">Actions</span>
                                            </div>
                                            <div class="panel-body">
                                                <div class="section row" >
                                                    <div class="col-md-12" style="padding:0px"> 
                                                        <div class="col-md-6"> 
                                                            <a href="javascript: back_licence();" class="btn btn-xs btn-success btn-block"><i class="glyphicon glyphicon-chevron-left"></i><span >Back</span></a>
                                                        </div> 
                                                        <div class="col-md-6" >
                                                            <a href="javascript:forward_licence();" class="btn btn-xs btn-info btn-block"><span >Next<i class="glyphicon glyphicon-chevron-right"></i></span></a>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="section-divider"><span></span></div>
                                                <!--prueba de botones -->
                                                <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                    <div class="col-xs-12 pln"><a id="addlicence" href="javascript: save_licence();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="glyphicon glyphicon-save"></i> Save Licence</a></div>
                                                    <div class="col-xs-12 pln"><a id="editlicence" href="javascript: edit_licence();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="fa fa-edit"></i> Edit Licence</a></div>
                                                    <div class="col-xs-12 pln"><a id="deletelicence"  data-toggle="modal" data-target = "#eliminarlicence" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block disabled"><i class="fa fa plus"></i> Delete Licence</a></div>
                                                    <div class="col-xs-12 pln"><a id="newlicence" onclick="javascript: new_licence();" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-plus"></i> New Licence</a></div>
                                                    <div class="col-xs-12 pln"><a id="listfarm" href="<?=site_url('comexp')?>" data-form-skin="success" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-list"></i> Back to List</a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ELEMENTOS DEL ACTIONS -->
                                    </div> <!--end col 4 --> 
                                    <div class="row" id="commodityRow">
                                            <div class="col-md-12">
                                                <!--Aqui poner -->
                                                <div class="section row p4">
                                                    <div class="col-md-12">
                                                        <div class="section-divider"><span>Commodity</span></div>
                                                        <div class="gj-margin-top-10">
                                                            <div class="gj-float-right" style="padding-bottom: 10px;">
                                                                <button type="button" id="btnAddcomimp" class="btn btn-alert" data-toggle="modal" onclick ="limpiar_addmodal_commodity()" data-target="#comimp_Modal"><i class="fa fa-plus" ></i>Add New commodity</button>
                                                            </div>
                                                        </div>
                                                        <table id="table_comimp" class="table table-hover">
                                                            <thead>
                                                                <tr class="primary">
                                                                    <th>Date </th>
                                                                    <th>Commodity</th>
                                                                    <th>Weight</th>
                                                                    <th >Country/Destination</th>
                                                                    <th colspan="2"> Action</th>                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody id="body_table">

                                                            </tbody>
                                                        </table>

                                                    </div> 

                                                </div>
                                                <!-- end aqui -->                        
                                            </div>
                                        </div>
                                    <!-- </div>end col 12 -->
                                </div>  <!--end row -->   
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
<!-- Modal Eliminar -->

<div class="modal fade" tabindex="-1" id="eliminarlicence"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete Licence</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this licence!!!</h4>
                    <p>Are you sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick = "delete_licence()">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" id="eliminarcommodity"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete commodity</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this commodity!!!</h4>
                    <p>Are you sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="delete_tradeproductsdetails()">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--modal comimp-->
<div id="comimp_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Commodity</h4>
            </div>
            <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                <!-- AQUI-->
                <form  role="form" id="form-order3" method="post" action="/">    
                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="section-divider"><span class="label label-rounded label-info">Country</span></div>
                                <label class="field select" id="comimp_label_contry">
                                    <select id="sele_comimp_contry" name="sele_comimp_contry" placeholder="Country">
                                        <?php foreach ($country as $key_country => $value_country) { ?>
                                            <option value = "<?php echo $value_country['recn']; ?>"><?php echo $value_country['name']; ?></option>
                                        <?php } ?>
                                    </select><i class="arrow"></i>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="section-divider"><span>Date</span></div>
                                <label for="comimp_date_comm" class="field prepend-picker-icon"><input id="comimp_date_comm" type="text" name="comimp_date_comm" placeholder="Date" class="gui-input">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="section-divider"><span>Commodity</span></div>
                                <input id="recntpd" type="hidden" />
                                <input id="recntp" type="hidden" />
                                <input id="c_edit" type="hidden" />
                                <label class="field select" id="comimp_label">
                                    <select id="sele_comimp_comm" name="sele_comimp_comm" placeholder="Treatment">
                                        <?php foreach ($commodity as $key_commodity => $value_commodity) { ?>
                                            <option value="<?php echo $value_commodity['recn']; ?>"><?php echo $value_commodity['name']; ?></option>
                                        <?php } ?>
                                    </select><i class="arrow"></i>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="section-divider"><span>Weight(Kg)</span></div>
                                <label for="weight_comimp" class="field prepend-icon">
                                    <input id="weight_comimp" type="text" name="weight_comimp" placeholder="Weight" class="gui-input">
                                    <label for="weight_comimp" class="field-icon"><i class="fa fa-user"></i></label>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="section row">
                        <div class="col-md-6">
                            <div class="section-divider"><span>Consignee of Sender</span></div>
                            <label for="comimp_sender" class="field prepend-icon">
                                <input id="comimp_sender" type="text" name="comimp_sender" placeholder="Sender name" class="gui-input phone-group">
                                <label for="comimp_sender" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                            </label>
                        </div>


                        <div class="col-md-6">
                            <div class="section-divider"><span>Consignee of Receiver</span></div>
                            <label for="comimp_receiver" class="field prepend-icon">
                                <input id="comimp_receiver" type="text" name="comimp_receiver" placeholder="Receiver name" class="gui-input phone-group">
                                <label for="comimp_receiver" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                            </label>
                        </div>
                    </div> 


                    <!--end treatment --> 
                </form>

                <!--END-->
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick = "save_tradeproductsdetails()"  data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> <!--end modal content -->

    </div>
</div> <!--end modal -->
