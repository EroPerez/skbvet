<!-- Demo Content: Panels + Text-->
<div class="row">
    <div class="col-md-12">
        <div id="order3" class="admin-form theme-primary">
            <!--panel-heading section--> 
            <div class="panel panel-primary panel-border  heading-border">
                <div class="panel-heading"><span class="panel-title"><?php echo $title; ?></span></div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- INICIO FORM CASE-->
                        <form id="form-case" method="post" action="/">
                            <div class="panel-body p25">
                                <input id="reccase" type="hidden" />
                                <input id="page" type="hidden" /> 
                                <div class="row">
                                    <!--Farmer details  -->
                                    <div class="col-md-8" style="padding:2px; border:1px;"> 
                                        <div class="section row">
                                            <div class="col-md-6">
                                                <div class="section-divider"><span>Farm</span></div>
                                                <label class="field select">
                                                    <select id="case_farm" name="case_farm" placeholder="" readonly="readonly">

                                                    </select><i class="arrow"></i>
                                                </label>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="section-divider"><span>Livestock id</span></div>
                                                <label class="field select">
                                                    <select id="case_livestockid" name="case_livestockid" placeholder="" readonly="readonly">

                                                    </select><i class="arrow"></i>
                                                </label>
                                            </div>
                                        </div>  
                                        <div class="section row">
                                            <div class="col-md-6">
                                                <div class="section-divider"><span>Case No</span></div>
                                                <label for="case_CaseNo" class="field prepend-icon">
                                                    <input id="case_CaseNo" type="tel" name="case_CaseNo" placeholder="Case No" class="gui-input phone-group" readonly="readonly">
                                                    <label for="case_CaseNo" class="field-icon"><i class="glyphicon glyphicon-tag"></i></label>
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="section-divider"><span>Case Date</span></div>
                                                <label for="case_datepicker6" class="field prepend-picker-icon">
                                                    <input id="case_datepicker6" type="text" name="case_datepicker6" placeholder="Case Date" class="gui-input" >
                                                </label>
                                            </div>
                                        </div>
                                        <div class="section row">
                                            <div class="col-md-6">
                                                <div class="section-divider"><span>Veterinarian</span></div>
                                                <label class="field select">
                                                    <select id="case_veterinarian" name="case_veterinarian" placeholder="" readonly="readonly">

                                                    </select><i class="arrow"></i>
                                                </label>
                                            </div> 
                                        </div>

                                        <div class="section-divider"><span>Illness Details</span></div>

                                        <div class="row" id="illnessDetails">
                                            <div class="col-md-12">
                                                <!--Aqui poner -->
                                                <div class="tab-block mb25">
                                                    <ul class="nav nav-tabs tabs-bg">
                                                        <li class="active"><a aria-expanded="true" href="#tab_illness" data-toggle="tab">Illness</a></li>
                                                        <li class=""><a aria-expanded="false" href="#tab_bill" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Bill</a></li>

                                                    </ul>
                                                    <div class="tab-content admin-form">
                                                        <div id="tab_illness" class="tab-pane active">
                                                            <div class="section row p25">
                                                                <div class="col-md-12">
                                                                    <div class="gj-margin-top-20">
                                                                        <div class="gj-float-right" style="padding-bottom: 10px;">
                                                                            <button type="button" id="btnAddillness" class="btn btn-alert" data-toggle="modal" onclick="limpiar_addmodal_illness()" data-target="#illness_Modal"><i class="fa fa-plus" ></i>Add New Illness</button>
                                                                        </div>
                                                                    </div>

                                                                    <table id="table_illness" class="table table-hover">
                                                                        <thead>
                                                                            <tr class="primary">
                                                                                <th>Livestock id</th>
                                                                                <th>Date of Illness</th>
                                                                                <th>Illness</th>
                                                                                <th>Treatment</th>
                                                                                <th>Action</th>
                                                                                <th></th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="body_table">

                                                                        </tbody>
                                                                    </table>

                                                                </div> 

                                                            </div>
                                                        </div> <!-- fin del tab-->
                                                        <div id="tab_bill" class="tab-pane">
                                                            <div class="section row p25">
                                                                <div class="col-md-12">
                                                                    <!-- <div class="col-md-10"> -->
                                                                    <div class="gj-margin-top-20">
                                                                        <div class="gj-float-left" style="padding-bottom: 10px;">
                                                                            <button  type="button" class="btn btn-xs btn-info" onclick="recalculate_bill()"><i class="fa fa-file"></i> Recalculate</button>
                                                                            <span class="lbl-text">Bill Total: </span><i class="fa fa-usd"></i><label id="i_bill_total"></label>
                                                                        </div>
                                                                        <div class="gj-float-right" style="padding-bottom: 10px;">
                                                                            <button type="button" id="btnAddbill" class="btn btn-alert" data-toggle="modal" onclick="limpiar_addmodal_trans()" data-target="#transaction_Modal"><i class="fa fa-plus" ></i>Add New Transaction</button>
                                                                        </div>
                                                                    </div>

                                                                    <table id="table_bill" class="table table-hover">
                                                                        <thead>
                                                                            <tr class="primary">                                                                               
                                                                                <th>Date</th>
                                                                                <th>Charges</th>
                                                                                <th>Payment</th>
                                                                                <th>Balance</th>
                                                                                <th colspan="2" class="text-center">Action</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="body_table_t">

                                                                        </tbody>
                                                                    </table>
                                                                    <!-- </div> -->


                                                                </div> 

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- end aqui -->                        
                                                <!-- livestock datagrid -->


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
                                                            <a href="javascript:backward_case();" class="btn btn-xs btn-success btn-block"><i class="glyphicon glyphicon-chevron-left"></i><span >Back</span></a>
                                                        </div> 
                                                        <div class="col-md-6" >
                                                            <a href="javascript:forward_case();" class="btn btn-xs btn-info btn-block"><span >Next<i class="glyphicon glyphicon-chevron-right"></i></span></a>
                                                        </div>
                                                    </div> 
                                                </div>

                                                <div class="section-divider"><span></span></div>
                                                <!--prueba de botones -->
                                                <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                    <div class="col-xs-12 pln"><a id="addcase" href="javascript:save_case();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="glyphicon glyphicon-save"></i> Save Case</a></div>
                                                    <div class="col-xs-12 pln"><a id="editcase" href="javascript:edit_case();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block disabled"><i class="fa fa-edit"></i> Edit Case</a></div>
                                                    <div class="col-xs-12 pln"><a id="deletecase" data-toggle="modal" data-target = "#delete_modal_case" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block disabled"><i class="fa fa-eraser"></i> Delete Case</a></div>
                                                    <div class="col-xs-12 pln"><a id="newcase" onclick="javascript:new_case();" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-plus"></i> New Case</a></div>
                                                    <div class="col-xs-12 pln"><a id="listfarm" href="<?= site_url('illness') ?>" data-form-skin="success" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-list"></i> Back to List</a></div>
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

<div class="modal fade" tabindex="-1" id="eliminarillness"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete illness</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this Illness!!!</h4>
                    <p>Are your sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="delete_illness()">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" id="delete_modal_case"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete case</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this case!!!</h4>
                    <p>Are your sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="javascript:delete_case();">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" id="eliminartrans"  role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><b>Delete transaction</b></h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-block alert-danger fade in">

                    <h4>Delete this transaction!!!</h4>
                    <p>Are your sure?</p>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="delete_trans()">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal illness-->
<div id="illness_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Illness</h4>
            </div>
            <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                <!-- AQUI-->
                <form  role="form" id="form-order3" method="post" action="/">    
                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="section-divider"><span>ILLNESS DETAILS</span></div>
                            <div class="col-md-6">
                                <div class="section-divider"><span class="label label-rounded label-info">Illness</span></div>
                                <label class="field select" id="illness_label">
                                    <select id="sele_illness" name="sele_illness" placeholder="Illness">
                                        <?php foreach ($illness_n as $key_unit => $value_illness) { ?>
                                            <option value="<?php echo $value_illness['recn']; ?>"><?php echo $value_illness['name']; ?></option>
                                        <?php } ?>
                                    </select><i class="arrow"></i>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="section-divider"><span>Date of Illness</span></div>
                                <label for="illness_dateadd" class="field prepend-picker-icon"><input id="illness_dateadd" type="text" name="illness_dateadd" placeholder="Date Added" class="gui-input">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="section-divider"><span>Clinical Summary</span></div>
                            <label class="field prepend-icon">
                                <textarea id="clinical_summary"  name="clinical_summary" placeholder="Clinical Summary" class="gui-textarea"></textarea>
                                <label for="clinical_summary" class="field-icon"><i class="imoon imoon-location2"></i></label>
                            </label>
                        </div>
                    </div>
                    <!--Treatment -->
                    <div class="section-divider"><span>TREATMENT DETAILS</span></div>
                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="section-divider"><span>Treatment</span></div>
                                <label class="field select" id="illness_label">
                                    <select id="sele_treatment" name="sele_treatment" placeholder="Treatment">
                                        <?php foreach ($treatname as $key_unit => $value_treatname) { ?>
                                            <option value="<?php echo $value_treatname['recn']; ?>"><?php echo $value_treatname['name']; ?></option>
                                        <?php } ?>
                                    </select><i class="arrow"></i>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="section-divider"><span>Date of treatment</span></div>
                                <label for="treatment_dateadd" class="field prepend-picker-icon"><input id="treatment_dateadd" type="text" name="treatment_dateadd" placeholder="Date Added" class="gui-input">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="section row" >
                        <div class="col-md-12">
                            <label for="withdrawl_period" class="field prepend-icon">
                                <input id="withdrawl_period" type="text" name="withdrawl_period" placeholder="Withdrawl period in days" class="gui-input">
                                <label for="withdrawl_period" class="field-icon"><i class="fa fa-user"></i></label>
                            </label>
                        </div>
                    </div>
                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="section-divider"><span>Response to Treatment</span></div>
                            <label class="field prepend-icon">
                                <textarea id="response_treatment" name="response_treatment" placeholder="Response to treatment" class="gui-textarea"></textarea>
                                <label for="response_treatment" class="field-icon"><i class="imoon imoon-location2"></i></label>
                            </label>
                        </div>
                    </div>
                    <!--end treatment --> 
                </form>

                <!--END-->
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_illness()" data-dismiss="modal">Save</button>
            </div>
        </div> <!--end modal content -->

    </div>
</div> <!--end modal -->
<!-- Modal vista -->
<div id="illness_view_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Illness view</h4>
            </div>
            <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                <!-- AQUI-->


                <!--END-->
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_illness()" data-dismiss="modal">Save</button>
            </div>
        </div> <!--end modal content -->

    </div>
</div> <!--end modal -->
<!-- Finde Modal vista -->
<!--modal transaction-->
<div id="transaction_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Transaction</h4>
            </div>
            <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                <!-- AQUI-->
                <form  role="form" id="form-transaction" method="post">    
                    <div class="section row" >
                        <div class="col-md-12">
                            <div class="section-divider"><span>Transaction Type</span></div>
                            <div class="section mv15">
                                <div class="option-group field">
                                    <label class="option option-primary">
                                        <input name="i_transact_radio" id="i_transact_radio" value="1"  type="radio"><span class="radio"  ></span>Add Charge to Bill
                                    </label>
                                    <label class="option option-primary">
                                        <input name="i_transact_radio" id="i_transact_radio" type="radio" value="2" ><span class="radio"></span>Make a Payment
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="section-divider"><span>Amount</span></div>
                                <label for="farmer_lastname" class="field prepend-icon">
                                    <input id="amount_trans" readonly="readonly" type="text" name="amount_trans" placeholder="Amount" class="gui-input">
                                    <label for="amount_trans" class="field-icon"><i class="fa fa-user"></i></label>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <div class="section-divider" id="date_type"><span id="label_trans_form">Date of Charge</span></div>
                                <label for="trans_dateadd" class="field prepend-picker-icon"><input id="trans_dateadd" type="text" name="trans_dateadd" placeholder="Date Added" class="gui-input">
                                </label>
                            </div>
                        </div>
                    </div>

                </form>

                <!--END-->
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" disabled="" id='save_trans_button' onclick="save_transaction_bill()"  data-dismiss="modal">Save</button>
            </div>
        </div> <!--end modal content -->

    </div>
</div> <!--end modal -->
