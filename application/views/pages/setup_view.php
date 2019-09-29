<!-- Demo Content: Panels + Text-->
<div class="row">
    <div class="col-md-12">
        <div id="order3" class="admin-form theme-primary">
            <!--panel-heading section--> 
            <div class="panel panel-primary panel-border  heading-border">
                <div class="panel-heading"><span class="panel-title"><?php echo $title; ?></span></div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- INICIO FORM SETUP-->
                        <div class="tab-block mb25">
                            <ul class="nav nav-tabs tabs-bg">
                                <li class="active"><a aria-expanded="true" href="#tab_como" data-toggle="tab">Commodity</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_contry" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Country</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_illness" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Illnesses</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_species" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Species</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_traders" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Traders</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_treatments" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Treatments</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_test" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Tests</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_units" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Units</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_vets" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Vets</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_districts" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Districts</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_owners" data-toggle="tab"><i class="fa fa-bolt text-purple"></i> Owners</a></li>
                            </ul>
                            <div class="tab-content admin-form">
                                <div id="tab_como" class="tab-pane active">
                                    <!--TAB commodit -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_commod" name="select_commod" multiple="" style="height: 157px;" >

                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="commodity" class="field prepend-icon">
                                                <input id="commodity" name="commodity" placeholder="Commodity" class="gui-input" readonly="readonly">
                                                <label for="commodity" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_commodity()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_commod"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_commodity()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_commod"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_commodity()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_commod"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_commodity()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_commod"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- fin del tab-->
                                <div id="tab_contry" class="tab-pane">
                                    <!-- tab CONTRY -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_contry" name="select_contry" multiple="" style="height: 210px;" >
                                                        <?php foreach ($contry as $key_contry => $value_contry) { ?>
                                                            <option id  ="optcontry_<?php echo $value_contry['recn'] ?>" data ="<?php echo $value_contry['name'] ?>" value = "<?php echo $value_contry['recn']; ?>"><?php echo $value_contry['name']; ?></option>
                                                        <?php } ?>                                         
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="contry" class="field prepend-icon">
                                                <input id="contry" name="contry" placeholder="Contry" class="gui-input" readonly="readonly">
                                                <label for="contry" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="panel-body bg-light pt20 pbn pl30">
                                                <div class="checkbox-custom checkbox-disabled">
                                                    <input id="checkbox_local" type="checkbox" disabled = "true">
                                                    <label for="checkbox_local">Local Country</label>
                                                </div>
                                            </div>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a <a href="javascript:add_contry()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_contry()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_contry()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_contry()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_illness" class="tab-pane">
                                    <!--TAB ILLNESS -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_illness" name="select_illness" multiple="" style="height: 200px;" >
                                                        <?php foreach ($illness as $key_illness => $value_illness) { ?>
                                                            <option id  ="optillness_<?php echo $value_illness['recn'] ?>" data ="<?php echo $value_illness['name'] ?>" value = "<?php echo $value_illness['recn']; ?>"><?php echo $value_illness['name']; ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="illness" class="field prepend-icon">
                                                <input id="illness" name="illness" placeholder="Illness" class="gui-input" readonly="readonly">
                                                <label for="illness" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div> </div>
                                            <label for="illness_code" class="field prepend-icon">
                                                <input id="illness_code" name="illness_code" placeholder="Illness_code" class="gui-input" readonly="readonly">
                                                <label for="illness_code" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_illness()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_illness"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_illness()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_illness"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_illness()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_illness"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_illness()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_illness"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_species" class="tab-pane">
                                    <!--TAB SPECIES -->
                                    <div class="row">
                                        <div class="section-divider"><span>Species</span></div>
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_species" name="select_species" multiple="" style="height: 157px;" >
                                                        <?php foreach ($species as $key_species => $value_species) { ?>
                                                            <option id  ="optspecies_<?php echo $value_species['recn'] ?>" data ="<?php echo $value_species['name'] ?>" value = "<?php echo $value_species['recn']; ?>"><?php echo $value_species['name']; ?></option>
                                                        <?php } ?>     
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="species" class="field prepend-icon">
                                                <input id="species" name="species" placeholder="Species" class="gui-input" readonly="readonly">
                                                <label for="species" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_species()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_species"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_species()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_species"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_species()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_species"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_species()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_species"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="section-divider"><span>Breeds</span></div>
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_breeds" name="select_breeds" multiple="" style="height: 250px;" >
                                                        <?php foreach ($breeds as $key_breeds => $value_breeds) { ?>
                                                            <option id  ="optbreeds_<?php echo $value_breeds['recn'] ?>" data ="<?php echo $value_breeds['name'] ?>" value = "<?php echo $value_breeds['recn']; ?>"><?php echo $value_breeds['name']; ?></option>
                                                        <?php } ?>     
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="field select">
                                                <select id="species_breeds" name="species_breeds" placeholder="Species" readonly="readonly" disabled = "true" value="">
                                                    <?php foreach ($species as $key_species => $value_species) { ?>
                                                        <option id  ="optspecies_<?php echo $value_species['recn'] ?>" data ="<?php echo $value_species['name'] ?>" value = "<?php echo $value_species['recn']; ?>"><?php echo $value_species['name']; ?></option>
                                                    <?php } ?>        
                                                </select><i class="arrow"></i>
                                            </label>
                                            <div> <span></span></div>
                                            <label for="breeds" class="field prepend-icon">
                                                <input id="breeds" name="breeds" placeholder="Breeds" class="gui-input" readonly="readonly">
                                                <label for="breeds" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>	
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_breeds()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_breeds"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_breeds()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_breeds"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_breeds()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_breeds"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_breeds()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_breeds"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tab_traders" class="tab-pane">
                                    <!--TAB TRADERS --> 
                                    <div class="section-divider"><span>Trader Importer</span></div> 
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_traders" name="select_traders" multiple="" style="height: 157px;" >
                                                        <?php foreach ($itraders as $key_traders => $value_traders) { ?>
                                                            <option id  ="opttraders_<?php echo $value_traders['recn'] ?>" data ="<?php echo $value_traders['name'] ?>" value = "<?php echo $value_traders['recn']; ?>"><?php echo $value_traders['name']; ?></option>
                                                        <?php } ?>   
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="traders" class="field prepend-icon">
                                                <input id="traders" name="traders" placeholder="Traders importer" class="gui-input" readonly="readonly">
                                                <label for="traders" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>

                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_traders()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_traders"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_traders()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_traders"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_traders()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_traders"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_traders()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_traders"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section-divider"><span>Trader Exporter</span></div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_etraders" name="select_etraders" multiple="" style="height: 157px;" >
                                                        <?php foreach ($etraders as $key_etraders => $value_etraders) { ?>
                                                            <option id  ="optetraders_<?php echo $value_etraders['recn'] ?>" data ="<?php echo $value_etraders['name'] ?>" value = "<?php echo $value_etraders['recn']; ?>"><?php echo $value_etraders['name']; ?></option>
                                                        <?php } ?>   
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="etraders" class="field prepend-icon">
                                                <input id="etraders" name="traders" placeholder="Traders exporter" class="gui-input" readonly="readonly">
                                                <label for="etraders" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>

                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_etraders()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_etraders"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_etraders()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_etraders"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_etraders()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_etraders"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_etraders()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_etraders"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="tab_treatments" class="tab-pane">
                                    <!--TAB TREATMENTS -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_treatmentnames" name="select_treatmentnames" multiple="" style="height: 200px;" >
                                                        <?php foreach ($treatmentnames as $key_treatmentnames => $value_treatmentnames) { ?>
                                                            <option id  ="opttreatmentnames_<?php echo $value_treatmentnames['recn'] ?>" data ="<?php echo $value_treatmentnames['name'] ?>" value = "<?php echo $value_treatmentnames['recn']; ?>"><?php echo $value_treatmentnames['name']; ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="treatmentnames" class="field prepend-icon">
                                                <input id="treatmentnames" name="treatmentnames" placeholder="Treatmentnames" class="gui-input" readonly="readonly">
                                                <label for="treatmentnames" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <label for="default" class="field prepend-icon">
                                                <input id="default" name="default" placeholder="Default" class="gui-input" readonly="readonly">
                                                <label for="default" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_treatmentnames()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_treatmentnames"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_treatmentnames()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_treatmentnames"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_treatmentnames()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_treatmentnames"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_treatmentnames()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_treatmentnames"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_test" class="tab-pane">
                                    <!--TAB TESTS -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_testnames" name="select_testnames" multiple="" style="height: 200px;" >
                                                        <?php foreach ($testnames as $key_testnames => $value_testnames) { ?>
                                                            <option id  ="opttestnames_<?php echo $value_testnames['recn'] ?>" data ="<?php echo $value_testnames['name'] ?>" value = "<?php echo $value_testnames['recn']; ?>"><?php echo $value_testnames['name']; ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="testnames" class="field prepend-icon">
                                                <input id="testnames" name="testnames" placeholder="Test name" class="gui-input" readonly="readonly">
                                                <label for="testnames" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_testnames()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_treatmentnames"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_testnames()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_treatmentnames"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_testnames()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_treatmentnames"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_testnames()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_treatmentnames"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_units" class="tab-pane">
                                    <!--TAB UNITS -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_units" name="select_units" multiple="" style="height: 157px;" >
                                                        <?php foreach ($units as $key_units => $value_units) { ?>
                                                            <option id  ="optunits_<?php echo $value_units['recn'] ?>" data ="<?php echo $value_units['name'] ?>" value = "<?php echo $value_units['recn']; ?>"><?php echo $value_units['name']; ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="units" class="field prepend-icon">
                                                <input id="units" name="units" placeholder="Units" class="gui-input" readonly="readonly">
                                                <label for="units" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <!--<label for="units_type" class="field prepend-icon">
                <input id="units_type" name="units_type" placeholder="Type" class="gui-input" readonly="readonly">
                <label for="units_type" class="field-icon"><i class="fa fa-ticket"></i></label>
            </label>-->
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_units()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_units"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_units()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_units"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_units()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_units"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_units()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_units"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_vets" class="tab-pane">
                                    <!--TAB VETERINARY -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_vets" name="select_vets" multiple="" style="height: 157px;" >
                                                        <?php foreach ($veterinarians as $key_veterinarians => $value_veterinarians) { ?>
                                                            <option id  ="optveterinarians_<?php echo $value_veterinarians['recn'] ?>" data ="<?php echo $value_veterinarians['name'] ?>" value = "<?php echo $value_veterinarians['recn']; ?>"><?php echo $value_veterinarians['name']; ?></option>
                                                        <?php } ?>  
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="vets" class="field prepend-icon">
                                                <input id="vets" name="vets" placeholder="Vets" class="gui-input" readonly="readonly">
                                                <label for="vets" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_vets()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_vets"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_vets()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_vets"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_vets()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_vets"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_vets()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_vets"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_districts" class="tab-pane">
                                    <!--TAB DISTRICTS -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_districts" name="select_districts" multiple="" style="height: 157px;" >
                                                        <?php foreach ($districts as $key_districts => $value_districts) { ?>
                                                            <option id  ="optdistricts_<?php echo $value_districts['recn'] ?>" data ="<?php echo $value_districts['name'] ?>" value = "<?php echo $value_districts['recn']; ?>"><?php echo $value_districts['name']; ?></option>
                                                        <?php } ?>  
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="districts" class="field prepend-icon">
                                                <input id="districts" name="districts" placeholder="Districts" class="gui-input" readonly="readonly">
                                                <label for="districts" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <label for="districts_region" class="field prepend-icon">
                                                <input id="districts_region" name="districts_region" placeholder="Region" class="gui-input" readonly="readonly">
                                                <label for="districts_region" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_districts()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_districts"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_districts()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_districts"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_districts()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_districts"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_districts()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_districts"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab_owners" class="tab-pane">
                                    <!--TAB OWNERS -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="section ">
                                                <label class="field select-multiple state-success">
                                                    <select aria-invalid="false" aria-required="true" id="select_owners" name="select_owners" multiple="" style="height: 157px;" >
                                                        <?php foreach ($owners as $key_owners => $value_owners) { ?>
                                                            <option id  ="optowners_<?php echo $value_owners['recn'] ?>" data ="<?php echo $value_owners['name'] ?>" value = "<?php echo $value_owners['recn']; ?>"><?php echo $value_owners['name']; ?></option>
                                                        <?php } ?>  
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="owners" class="field prepend-icon">
                                                <input id="owners" name="owners" placeholder="Owners" class="gui-input" readonly="readonly">
                                                <label for="owners" class="field-icon"><i class="fa fa-ticket"></i></label>
                                            </label>
                                            <div class="section-divider"></div>
                                            <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                                <div class="col-xs-3 pln"><a href="javascript:add_owners()" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block item-active" id="btn_add_owners"><i class="glyphicon glyphicon-plus"></i> New</a></div>
                                                <div class="col-xs-3"><a href="javascript:edit_owners()" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block" id="btn_edd_owners"><i class="fa fa-edit"></i> Edit</a></div>
                                                <div class="col-xs-3"><a href="javascript:delete_owners()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_del_owners"><i class="fa fa-eraser"></i> Delete</a></div>
                                                <div class="col-xs-3"><a href="javascript:save_owners()" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block" id="btn_save_owners"><i class="glyphicon glyphicon-save"></i> Save</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- end: .panel-->
                </div>

            </div>
        </div>
    </div>  

    <!-- Modal Eliminar -->

    <div class="modal fade" tabindex="-1" id="eliminarlivestock"  role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b>Delete confirm</b></h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-block alert-danger fade in">

                        <h4>Delete this record!!!</h4>
                        <p>Are your sure?</p>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="delete_livestock()">Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


