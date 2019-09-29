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
                            <input id="surv_recn" type="hidden" />
                            <div class="panel-body p25">

                                <div class="row">
                                    <!--Farmer details  -->
                                    <div class="col-md-8 col-xs-8" style="padding:2px; border:1px;"> 
                                        <div class="section row"> 

                                            <div class="col-md-12 col-xs-12">
                                                <div class="section-divider"><span> Date</span></div>
                                                <label for="surv_date" class="field prepend-picker-icon">
                                                    <input id="surv_date" type="text" name="surv_date" placeholder="Surveillance Date" class="gui-input disabled">
                                                    <input id="page" type="hidden" />
                                                </label>
                                            </div>
                                            <!--  </div> -->
                                            <!-- <div class="section row"> -->
                                            <div class="col-md-12 col-xs-12">
                                                <div class="section-divider"><span>Farm</span></div>
                                                <label for="surv_farm" class="field select">
                                                    <select id="surv_farm" name="srv_farm" placeholder="">
                                                        <?php foreach ($farms as $key_farm => $value_farm) { ?>
                                                            <option value="<?php echo $value_farm['recn']; ?>"><?php echo $value_farm['farmName']; ?></option>
                                                        <?php } ?>
                                                    </select><i class="arrow"></i>
                                                </label>
                                            </div>


                                            <div class="col-md-12 col-xs-12">
                                                <div class="section-divider"><span>Test Type</span></div>
                                                <label class="field select">
                                                    <select id="srv_test" name="srv_test" placeholder="">
                                                        <?php foreach ($tests as $key_test => $value_test) { ?>
                                                            <option value="<?php echo $value_test['recn']; ?>"><?php echo $value_test['name']; ?></option>
                                                        <?php } ?>
                                                    </select><i class="arrow"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="section row" id="showAnimal">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="section row p25">
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="section-divider"><span>Livestocks</span></div>
                                                        <div class="gj-margin-top-20">
                                                            <div class="gj-float-right" style="padding-bottom: 10px;">
                                                                <button type="button" id="btnAddanimalimp" class="btn btn-alert" data-toggle="modal" onclick="limpiar_addmodal_animal()" data-target="#animalimp_Modal"><i class="fa fa-plus" ></i>Add New</button>
                                                            </div>
                                                        </div>

                                                        <table id="table_animalimp" class="table table-hover">
                                                            <thead>
                                                                <tr class="primary">
                                                                    <th>Livestock ID</th>
                                                                    <th>Test Result</th>
                                                                    <th colspan="2" class="text-center">Action</th>                                                                    											  
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
                                                            <a href = "javascript:back_surv();" class="btn btn-xs btn-success btn-block"><i class="glyphicon glyphicon-chevron-left"></i><span >Back</span></a>
                                                        </div> 
                                                        <div class="col-md-6" >
                                                            <a href = "javascript:forward_surv();" class="btn btn-xs btn-info btn-block"><span >Next<i class="glyphicon glyphicon-chevron-right"></i></span></a>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="section-divider"><span></span></div>
                                                <!--prueba de botones -->
                                                <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                    <div class="col-xs-12 pln"><a id="add_surv" href="javascript:save_surv();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="glyphicon glyphicon-save"></i> Save Surveillance</a></div>
                                                    <div class="col-xs-12 pln"><a id="edit_surv" href="javascript:edit_surv();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="fa fa-edit"></i> Edit Surveillance</a></div>
                                                    <div class="col-xs-12 pln"><a id="delete_surv"  data-toggle="modal" data-target = "#eliminarlicence" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block disabled"><i class="fa fa plus"></i> Delete Surveillance</a></div>
                                                    <div class="col-xs-12 pln"><a id="new_surv" href="javascript:new_surv();" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-plus"></i> New Surveillance</a></div>
                                                    <div class="col-xs-12 pln"><a id="list_surv" href="<?= site_url('surveillance') ?>" data-form-skin="success" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-list"></i> Back to List</a></div>
                                                </div>
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
                <h4 class="modal-title"><b>Delete surveillance</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this surveillance tests!!!</h4>
                    <p>Are your sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="delete_surv()">Delete</button>
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
                <h4 class="modal-title"><b>Delete live animal details record</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete surveillance for this live animal!!!</h4>
                    <p>Are you sure?</p>

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
                <h4 class="modal-title">Livestock</h4>
            </div>
            <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                <!-- AQUI-->
                <form  role="form" id="form-order3" method="post" action="/">    

                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="col-md-6">

                                <div class="section-divider"><span>Livestock</span></div>
                                <input id="recntpd" type="hidden" />
                                <input id="recntp" type="hidden" />
                                <input id="c_edit" type="hidden" />
                                <label class="field select" >
                                    <select id="animal_farm" name="animal_farm" placeholder="Select Livestock">

                                    </select><i class="arrow"></i>
                                </label>

                            </div>
                            <div class="col-md-6">
                                <div class="section-divider"><span>Test result</span></div>
                                <label class="field select" for="test_result">
                                    <select id="test_result" name="test_result" placeholder="Select test result">
                                        <option value='Positive'>Positive</option>
                                        <option value='Negative'>Negative</option>
                                    </select><i class="arrow"></i>
                                </label>

                            </div>
                        </div>
                    </div> 

                </form>

                <!--END-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick = "save_tradeliveanimaldetails()" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> <!--end modal content -->

    </div>
</div> <!--end modal -->       