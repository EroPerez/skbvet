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
                        <div class="row">
                            <div class="col-md-12">

                                <div class="section-divider"><span>PERMISSIONS</span></div>
                                <div class="panel">
                                    <div class="panel-body p25 pb10">
                                        <form role="form" class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label text-darken"><b>Roles: </b></label>
                                                <div class="col-md-8">

                                                    <?php foreach ($role as $key => $obj) {
                                                        $value = (array)$obj;
                                                        ?>
                                                        <label class="radio-inline mr10">
                                                            <input id="<?php echo $value['id'] ?>" name="roles" value="<?php echo $value['id'] ?>" type="radio">
                                                            <?php echo $value['display_name'] ?>
                                                        </label>

                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </form>

                                    </div>  
                                </div>


                            </div>
                        </div> 

                    </div>


                </div>

            </div>

        </div>
    </div> 
</div>  
<div class="panel">
    <div class="panel-heading">
        <ul class="nav panel-tabs-border panel-tabs panel-tabs-left">
            <li class="active"><a href="#tab2_1" data-toggle="tab">Farm and Farmers</a></li>
            <li><a href="#tab2_2" data-toggle="tab">Case management</a></li> 
            <li><a href="#tab2_3" data-toggle="tab">Abbatoir</a></li>
            <li><a href="#tab2_4" data-toggle="tab">Licences</a></li>
            <li><a href="#tab2_5" data-toggle="tab">Maintenance</a></li>
            <li><a href="#tab2_6" data-toggle="tab">Specimen</a></li>
            <li><a href="#tab2_7" data-toggle="tab">Surveillance</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content pn br-n">
            <div id="tab2_1" class="tab-pane active">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect1" class="col-md-4 control-label">Allow user to Setup</label>
                            <div class="col-md-4">
                                <select id="multiselect1" multiple="multiple">
                                    <option value="1">Species</option>
                                    <option value="2">Breeds</option>
                                    <option value="3">Districts</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect2" class="col-md-4 control-label">Allow enter and edit</label>
                            <div class="col-md-4">
                                <select id="multiselect2" multiple="multiple">
                                    <option value="1">Farms & Farmers</option>
                                    <option value="2">Livestock</option>
                                    <option value="3">Transfers</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect3" class="col-md-4 control-label">Allow view</label>
                            <div class="col-md-4">
                                <select id="multiselect3" multiple="multiple">
                                    <option value="cheese">All farms and Livestock reports</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2_2" class="tab-pane">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect4" class="col-md-4 control-label">Allow user to Setup</label>
                            <div class="col-md-4">
                                <select id="multiselect4" multiple="multiple">
                                    <option value="cheese">Veterinarians</option>
                                    <option value="tomatoes">Illnesses</option>
                                    <option value="mozarella">Treatments</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect5" class="col-md-4 control-label">Allow enter and edit</label>
                            <div class="col-md-4">
                                <select id="multiselect5" multiple="multiple">
                                    <option value="cheese">Cases</option>
<!--                                    <option value="tomatoes">Treatments</option>
                                    <option value="mozarella">Bills</option>-->

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect6" class="col-md-4 control-label">Allow view</label>
                            <div class="col-md-4">
                                <select id="multiselect6" multiple="multiple">
                                    <option value="cheese">All cases Reports</option>

                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="tab2_3" class="tab-pane">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect7" class="col-md-4 control-label">Allow enter and edit</label>
                            <div class="col-md-4">
                                <select id="multiselect7" multiple="multiple">
                                    <option value="cheese">Presenters</option>
                                    <option value="tomatoes">Livestock</option>
                                </select>
                            </div>
                        </div>          

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect8" class="col-md-4 control-label">Allow view</label>
                            <div class="col-md-4">
                                <select id="multiselect8" multiple="multiple">
                                    <option value="cheese">All Abbatoir reports</option>

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">


                    </div>
                </div>
            </div>
            <div id="tab2_4" class="tab-pane">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect9" class="col-md-4 control-label">Allow enter and edit</label>
                            <div class="col-md-4">
                                <select id="multiselect9" multiple="multiple">
                                    <option value="1">Commodity licences</option>
                                    <option value="2">Livestock licences</option>

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect10" class="col-md-4 control-label">Allow user to setup</label>
                            <div class="col-md-4">
                                <select id="multiselect10" multiple="multiple">
                                    <option value="1">Commodities</option>
                                    <option value="2">Countries</option>
                                    <option value="3">Traders</option>
                                    <option value="4">Owners</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect11" class="col-md-4 control-label">Allow view</label>
                            <div class="col-md-4">
                                <select id="multiselect11" multiple="multiple">
                                    <option value="cheese">All licence reports</option>

                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div> 
            <div id="tab2_5" class="tab-pane">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="multiselect12" class="col-md-4 control-label">Allow user to</label>
                            <div class="col-md-4">
                                <select id="multiselect12" multiple="multiple">
                                    <option value="1">Manage users</option>
                                    <option value="2">Grant permissions</option>
                                    <!--<option value="3">Setup passwords</option>-->

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">


                    </div>
                    <div class="col-md-4">


                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>