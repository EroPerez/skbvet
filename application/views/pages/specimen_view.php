<!-- Demo Content: Panels + Text-->
<div class="row">
    <div class="col-md-12">
        <div id="order3" class="admin-form theme-primary">
            <!--panel-heading section--> 
            <div class="panel panel-primary panel-border  heading-border">
                <div class="panel-heading"><span class="panel-title"><?php echo $title; ?></span></div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- INICIO FORM Specimen Ppermit-->
                        <form id="form-specimen" method="post" action="/">
                            <div class="panel-body p25">

                                <div class="row">

                                    <!--Specimen details  -->
                                    <div class="col-md-8" style="padding:2px; border:1px;"> 

                                        <!--<div class="section-divider"><span>Specimen Details</span></div>-->
                                        <div class="section">
                                            <div class="section-divider"><span>Name or Type</span></div>
                                            <label for="specimen_name" class="field prepend-icon">
                                                <input id="specimen_recn" type="hidden" />
                                                <input id="specimen_edit" type="hidden" />
                                                <input id="page" type="hidden" />
                                                <input id="specimen_name" readonly="readonly" type="text" name="specimen_name" placeholder="name or type" class="gui-input">
                                                <label for="specimen_name" class="field-icon"><i class="fa fa-user"></i></label>
                                            </label>
                                        </div>
                                        <!-- end section-->
                                        <div class="section">
                                            <div class="section-divider"><span>Sender</span></div>
                                            <label for="specimen_sender" class="field prepend-icon">
                                                <input id="specimen_sender" readonly="readonly" type="text" name="specimen_sender" placeholder="Sender name..." class="gui-input">
                                                <label for="specimen_sender" class="field-icon"><i class="fa fa-user"></i></label>
                                            </label>
                                        </div>
                                        <!-- end section-->
                                        <div class="section">
                                            <div class="section-divider"><span>Reciever</span></div>
                                            <label for="specimen_reciever" class="field prepend-icon">
                                                <input id="specimen_reciever" readonly="readonly" type="text" name="specimen_reciever" placeholder="Reciever name..." class="gui-input">
                                                <label for="specimen_reciever" class="field-icon"><i class="fa fa-user"></i></label>
                                            </label>
                                        </div>
                                        <!-- end section--> 
                                        <div class="section">
                                            <div class="section-divider"><span class="label label-rounded label-info">Destination</span></div>
                                            <label class="field select" id="specimen_label_destination">
                                                <select id="sele_specimen_destination" readonly="readonly" name="sele_specimen_destination" placeholder="Destination">
                                                    <?php foreach ($destination as $key_country => $value_country) { ?>
                                                        <option value = "<?php echo $value_country['recn']; ?>"><?php echo $value_country['name']; ?></option>
                                                    <?php } ?>
                                                </select><i class="arrow"></i>
                                            </label>
                                        </div>
                                        <div class="section" >
                                            <div class="section-divider"><span>Weight</span></div>
                                            <label for="specimen_weight" class="field prepend-icon">
                                                <input id="specimen_weight" type="number" readonly="readonly" name="specimen_weight" placeholder="Weight" class="gui-input phone-group">
                                                <label for="specimen_weight" class="field-icon"><i class="fa fa-arrows"></i></label>
                                            </label>
                                        </div>
                                        <!-- date piker -->
                                        <div class="section" >
                                            <div class="section-divider"><span>Date</span></div>
                                            <label for="date_issued_specimen" class="field prepend-picker-icon">
                                                <input id="date_issued_specimen" readonly="readonly" type="text" name="date_issued_specimen" placeholder="Date Issued" class="gui-input">
                                            </label>
                                        </div>
                                        <!-- end date piker --> 
                                        <div class="section" >
                                            <div class="section-divider"><span>Fee</span></div>
                                            <label for="specimen_fee" class="field prepend-icon">
                                                <input id="specimen_fee" type="number" readonly="readonly" name="specimen_fee" placeholder="Fee" class="gui-input phone-group">
                                                <label for="specimen_fee" class="field-icon"><i class="fa fa-money"></i></label>
                                            </label>
                                        </div>

                                    </div>
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
                                                            <a href="javascript:back_specimen();" class="btn btn-xs btn-success btn-block"><i class="glyphicon glyphicon-chevron-left"></i><span >Back</span></a>
                                                        </div> 
                                                        <div class="col-md-6" >
                                                            <a href="javascript:forward_specimen();" class="btn btn-xs btn-info btn-block"><span >Next<i class="glyphicon glyphicon-chevron-right"></i></span></a>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="section-divider"><span></span></div>
                                                <!--prueba de botones -->
                                                <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                    <div class="col-xs-12 pln"><a id="addspecimen" href="javascript:save_specimen();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="glyphicon glyphicon-save"></i> Save Specimen</a></div>
                                                    <div class="col-xs-12 pln"><a id="editspecimen" href="javascript:edit_specimen();"  data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="fa fa-edit"></i> Edit Specimen</a></div>
                                                    <div class="col-xs-12 pln"><a id="deletespecimen" data-toggle="modal" data-target="#delete_modal_specimen" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block disabledS"><i class="fa fa-eraser"></i> Delete Specimen</a></div>
                                                    <div class="col-xs-12 pln"><a id="newspecimen" onclick="javascript:new_specimen();" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-plus"></i> New Specimen</a></div>
                                                     <div class="col-xs-12 pln"><a id="listspecimen" href="<?=site_url('specimen')?>" data-form-skin="success" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-list"></i> Back to List</a></div>

                                                </div>

                                            </div>

                                        </div>
                                        <!-- ELEMENTOS DEL ACTIONS -->
                                    </div> <!--end col 4 --> 
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

<div class="modal fade" tabindex="-1" id="delete_modal_specimen"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete specimen</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this specimen!!!</h4>
                    <p>Are your sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="javascript:delete_specimen();">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->