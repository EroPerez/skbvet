           <div class="row">
            <div class="col-md-12">
              <div id="order3" class="admin-form theme-primary">
                <!--panel-heading section--> 
                <div class="panel panel-primary heading-border">
                  <!-- <div class="panel-heading"><span class="panel-title"><i class="glyphicon glyphicon-home"></i>   Farmer's Information</span>
                  </div>
                  end .panel-heading section-->
                      <div class="row">
                        <div class="col-md-12">
                        <!-- INICIO FORM FARMER-->
                        <form id="form-farm" method="post" action="/">
                          <div class="panel-body p25">
                            
                          <div class="row">
                            
                                <!--Farmer details  -->
                                <div class="col-md-8" style="padding:2px; border:1px;"> 
                                <!-- date piker -->
                                    <div class="section" style="padding:10px">
                                        <label for="date_addfarmer" class="field prepend-picker-icon">
                                          <input id="date_addfarmer"  type="text" name="date_addfarmer" placeholder="Date Addon" class="gui-input">
                                        </label>
                                    </div>
                                <!-- end date piker --> 
                                  <div class="section-divider"><span>Farmer Details</span></div>
                                     <div class="section">
                                        <label for="farmer_firstname" class="field prepend-icon">
                                         <input id="recfarmer" type="hidden" />
                                         <input id="edit" type="hidden" />
                                          <input id="farmer_firstname" readonly="readonly" type="text" name="farmer_firstname" placeholder="First name..." class="gui-input">
                                          <label for="farmer_firstname" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                      </div>
                                      <!-- end section-->
                                      <div class="section">
                                        <label for="farmer_lastname" class="field prepend-icon">
                                          <input id="farmer_lastname" readonly="readonly" type="text" name="farmer_lastname" placeholder="Last name..." class="gui-input">
                                          <label for="farmer_lastname" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                      </div>
                                      <!-- end section-->
                                      <!-- text area  address-->
                                      <div class="section">
                                        <label class="field prepend-icon">
                                          <textarea id="farmer_address" readonly="readonly" name="farmer_address" placeholder="Address" class="gui-textarea"></textarea>
                                          <label for="farmer_address" class="field-icon"><i class="imoon imoon-location2"></i></label><!--<span class="input-footer"><strong>Hint:</strong>Don't be negative or off topic! just be awesome...</span>-->
                                        </label>
                                      </div>
                                       <!-- end section address-->
                                       <!-- phone number -->
                                        <div class="section row">
                                          <div class="col-md-12">
                                            <label for="farmer_phone" class="field prepend-icon">
                                              <input id="farmer_phone" readonly="readonly" type="tel" name="farmer_phone" placeholder="Phone number" class="gui-input phone-group">
                                              <label for="farmer_phone" class="field-icon"><i class="fa fa-phone"></i></label>
                                            </label>
                                          </div>
                                        </div>
                                       <!--en phone -->
                                       <!--Farme details  -->
                                       <div class="section-divider"><span>Farm Details</span></div>
                                         <div class="section">
                                          <label for="farmname" class="field prepend-icon">
                                           <input id="recfarm" type="hidden" />
                                            <input id="farmname" type="text" name="farmname" readonly="readonly" placeholder="farm name..." class="gui-input">
                                            <label for="farmname" class="field-icon"><i class="fa fa-home"></i></label>
                                          </label>
                                        </div>
                                        <div class="section">
                                          <label for="farm_location" class="field prepend-icon">
                                            <input id="farm_location" type="text" readonly="readonly" name="farm_location" placeholder="Location..." class="gui-input">
                                            <label for="farm_location" class="field-icon"><i class="glyphicon glyphicon-globe"></i></label>
                                          </label>
                                        </div>
                                      <div class="section row">
                                          <div class="col-md-6">
                                          <div class="section-divider"><span>Parish</span></div>
                                            <label class="field select">
                                              <select id="farm_parish" name="farm_parish" placeholder="Parish">
                                                <?php foreach ($parish as $key_parish => $value_parish) { ?>
                                                        <option value="<?php echo $value_parish['recn']; ?>"><?php echo $value_parish['name']; ?></option>
                                                      <?php } ?>
                                              </select><i class="arrow"></i>
                                            </label>
                                          </div>
                                          <div class="col-md-6">
                                          <div class="section-divider"><span>Size</span></div>
                                             <div class="section row">
                                                 <div class="col-md-6">
                                                    <label for="size" class="field prepend-icon">
                                                      <input id="farm_size" type="text" name="farm_size" placeholder="size..." class="gui-input">
                                                      <label for="farm_size" class="field-icon"><i class="imoon imoon-meter"></i></label>
                                                    </label>  
                                                 </div>
                                                 <div class="col-md-6">
                                                  <label class="field select">
                                                    <select id="farm_sizeunit" name="farm_sizeunit" placeholder="Units">
                                                      <?php foreach ($sizeunits as $key_unit => $value_unit) { ?>
                                                        <option value="<?php echo $value_unit['recn']; ?>"><?php echo $value_unit['name']; ?></option>
                                                      <?php } ?>
                                                      
                                                    </select><i class="arrow"></i>
                                                  </label>
                                                 </div> 
                                             </div> 
                                          </div>
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
                                            <a href="javascript:back_farmers();" class="btn btn-xs btn-success btn-block"><i class="glyphicon glyphicon-chevron-left"></i><span >Back</span></a>
                                          </div> 
                                          <div class="col-md-6" >
                                            <a href="javascript:forward_farmers();" class="btn btn-xs btn-info btn-block"><span >Next<i class="glyphicon glyphicon-chevron-right"></i></span></a>
                                          </div>
                                        </div> 
                                      </div>
                                      
                                      <div class="section-divider"><span></span></div>
                                       <!--prueba de botones -->
                                         <div id="skin-switcher" class="row tray-bin btn-dimmer mb20">
                                            <div class="col-xs-12 pln"><a id="addfarm" href="javascript:save_farmers();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block "><i class="glyphicon glyphicon-save"></i> Save Farmer</a></div>
                                            <div class="col-xs-12 pln"><a id="editfarm" href="javascript:edit_farmers();" data-form-skin="primary" class="btn btn-primary btn-gradient btn-alt btn-block "><i class="fa fa-edit"></i> Edit Farmer</a></div>
                                            <div class="col-xs-12 pln"><a id="deletefarm" href="javascript:delete_farmers();" data-form-skin="success" class="btn btn-success btn-gradient btn-alt btn-block"><i class="fa fa-eraser"></i> Delete Farmer</a></div>
                                            <div class="col-xs-12 pln"><a id="newfarm" onclick="javascript:new_farmers();" data-form-skin="info" class="btn btn-info btn-gradient btn-alt btn-block item-active"><i class="glyphicon glyphicon-plus"></i> New Farmer</a></div>
                                            
                                          </div>
                                       <!--fin de preubas-->
                                      <!-- 
                                      <div >
                                       <span class="panel-icon"></span>
                                        <button type="button" id="addfarm" onclick="javascript:add_farmers();" class="btn btn-xs btn-primary btn-block disabled"><i class="glyphicon glyphicon-save"></i> Save Farmer</button>
                                      </div></br>
                                       <div >
                                       <span class="panel-icon"></span>
                                        <button type="button" id="deletefarm" onclick="javascript:delete_farmers();" class="btn btn-xs btn-primary btn-block btn-dark disabled" ><i class="glyphicon glyphicon-remove"></i> Delete Farmer</button>
                                      </div></br>
                                       <div >
                                       <span class="panel-icon"></span>
                                        <button type="button" id="newfarm" onclick="javascript:new_farmers();" class="btn btn-xs btn-primary btn-block btn-danger active"><i class="glyphicon glyphicon-plus"></i> New Farmer</button>
                                      </div>
                                      -->
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
                    <div class="section-divider"><span>Livestock Details</span></div>
                    <div class="row">
                        <div class="col-md-12">
                          
                          <!-- livestock datagrid -->
                          <div class="section row p25">
                             <div class="col-md-12">
                                   <div class="gj-margin-top-20">
                                      
                                      <div class="gj-float-right">
                                          <button type="button" id="btnAdd" class="btn btn-alert" data-toggle="modal" onclick="limpiar_addmodal()" data-target="#livestock_Modal"><i class="fa fa-plus" ></i>Add New Livestock</button>
                                          
                                      </div>
                                  </div>

                              <table id="table_livestock" class="table table-hover">
                                <thead>
                                  <tr class="primary">
                                    <th>Id No</th>
                                    <th>Species</th>
                                    <th>Breeds</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th >Edit</th>
                                    <th >Delete</th>
                                    
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
          </div>
        </div>  

         <!-- Modal Eliminar -->
         
      <div class="modal fade" tabindex="-1" id="eliminarlivestock"  role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><b>delete livestock</b></h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-block alert-danger fade in">

                            <h4>delete this Livestock!!!</h4>
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
        <!--modal-->
        <div id="livestock_Modal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">LiveStock</h4>
              </div>
              <div class="modal-body admin-form" style="max-height:calc(100vh - 210px); overflow-y: auto;">
                 <!-- AQUI-->
                   <form  role="form" id="form-order3" method="post" action="/">    
                        <div class="section row" >
                          <div class="col-md-12">
                            <div class="col-md-6">
                              <div class="section-divider"><span>Farm</span></div>
                                <label class="field prepend-icon">
                                    <input id="livestock_farm" type="text" name="livestock_farm" class="gui-input" readonly="readonly">
                                </label>
                              </div>
                           
                            <div class="col-md-6">
                                <div class="section-divider"><span>Farmer</span></div>
                                <label class="field prepend-icon">
                                    <input id="livestock_farmers" type="text" name="livestock_farmers" class="gui-input" readonly="readonly">
                                </label>
                            </div>
                          </div>
                        </div>

                        <div class="section row" >
                          <div class="col-md-12">
                          <div class="section-divider"><span>Date Added</span></div>
                            <label for="livestock_dateadd" class="field prepend-picker-icon"><input id="livestock_dateadd" type="text" name="livestock_dateadd" placeholder="Date Added" class="gui-input">
                            </label>
                          </div>
                        </div>
                         <div class="section row" >
                          <div class="col-md-12">
                          <div class="section-divider"><span>ID #</span></div>
                              <label for="livestock_id" class="field prepend-icon">
                                <input id="livestock_id" type="text" name="livestock_id" placeholder="Id..." class="gui-input">
                               <label for="livestock_id" class="field-icon"><i class="imoon imoon-meter"></i></label>
                              </label> 
                           
                          </div>
                        </div>
                        <div class="section row" >
                          <div class="col-md-12">
                           <div class="col-md-6">
                                 
                          <div class="section-divider"><span>Species</span></div>
                            
                              <label class="field select" >
                                  <select id="livestock_species" name="livestock_species" placeholder="Species">
                                    <?php foreach ($species as $key_unit => $value_species) { ?>
                                        <option value="<?php echo $value_species['recn']; ?>"><?php echo $value_species['name']; ?></option>
                                    <?php } ?>
                                  </select><i class="arrow"></i>
                              </label>
                            
                            </div>
                            <div class="col-md-6">
                               <div class="section-divider"><span>Breed</span></div>
                              <label class="field select" id="breeds">
                                  <select id="livestock_breeds" name="livestock_breeds" placeholder="Breeds">
                                   <!-- set here -->
                                  </select><i class="arrow"></i>
                              </label>
                            
                          </div>
                        </div>
                       </div> 
                  <!--sex date -->
                        <div class="section row" >
                          <div class="col-md-12">
                            <div class="col-md-6">
                              <div class="section-divider"><span>Sex</span></div>
                                    <label class="field select" >
                                        <select id="livestock_sex" name="livestock_farm" placeholder="Farm">
                                          <option value="F">Female</option>
                                          <option value="M">Male</option>
                                          <option value="A">Altered</option>
                                        </select><i class="arrow"></i>
                                    </label>
                            </div>

                             <div class="col-md-6">
                                
                             <div class="section-divider"><span>Date of Birth</span></div> 
                                    <label for="livestock_datebirth" class="field prepend-picker-icon">
                                      <input id="livestock_datebirth" type="text" name="livestock_datebirth" placeholder="Date of Birth" class="gui-input">
                                    </label>
                            </div>
                        </div>
                         <div class="section row" >
                          <div class="col-md-12"  style="padding:20px ">
                             <label>Withdrawal date:</label>
                          </div>
                         </div> 
                         <div class="section row" >
                          <div class="col-md-12">
                            <div class="col-md-6">
                            <div class="section-divider"><span>Origen</span></div> 
                              <div class="section mb15" style="padding-bottom:5px">
                                    <div class="option-group field">
                                      <label class="option option-primary">
                                        <input id="rlivestock" name="rlivestock" value="1" checked="" type="radio"><span class="radio"></span>Local
                                      </label>
                                      <label class="option option-primary">
                                        <input id="rlivestock" name="rlivestock" value="2" type="radio"><span class="radio"></span>Overseas
                                      </label>
                                    </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="section-divider"><span>Contry of Origen </span></div> 
                               <label class="field select" >
                                  <select id="livestock_contry" name="livestock_contry" placeholder="Contry"  disabled="true" >
                                     <?php foreach ($contry as $key_count => $value_cout) { /*if ($value_cout['type'] !== '1'){*/   ?>

                                        <option data-type-contry="<?php echo $value_cout['type']; ?>" value="<?php echo $value_cout['recn']; ?>"><?php echo $value_cout['name']; ?></option>
                                    <?php /*}*/} ?>
                                  </select><i class="arrow"></i>
                              </label>
                            </div>
                          </div>
                         </div>  
                   <div class="section-divider"><span>Origen Details</span></div> 
                         <div class="section row" >
                          <div class="col-md-12">
                            <div class="col-md-6">
                            <div class="section-divider"><span>Arrival Date </span></div>
                                <label for="livestock_datearrival" class="field prepend-picker-icon">
                                    <input id="livestock_datearrival" type="text" name="livestock_datearrival" disabled="true" placeholder="Arrival Date" class="gui-input">
                                  </label>
                            </div>
                             <div class="col-md-6">
                             <div class="section-divider"><span>Quarantine Period </span></div>
                             <div class="col-md-3">
                               
                                <input id="livestock_quara_period" type="text" name="livestock_quara_period"  class="gui-input" disabled="true">
                               
                              </label> 
                             </div>
                             <div class="col-md-6">
                             
                              <label class="field select">
                                  <select id="livestock_Quarantine_unit" name="livestock_Quarantine_unit" placeholder="Quarantine" disabled="true">
                                    <option value="">Select</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                  </select><i class="arrow"></i>
                              </label>
                            </div>
                            </div>
                          </div>
                        </div>
                  </form>
                   <div class="section row" >
                          <div class="col-md-12">
                          <div class="section-divider"><span>Transfer history</span></div>
                               <table id="table_livestock_tranf" class="table">
                                <thead>
                                  <tr class="primary">
                                    <th>Transfer...</th>
                                    <th>Transferred from</th>
                                    <th>Transferred to</th>
                                  </tr>
                                </thead>
                                <tbody id="body_tranfer">
                                  <td></td>
                                  <td>No transfers...</td>
                                  <td></td>
                                </tbody>
                              </table>
                           
                          </div>
                        </div>
                 <!--END-->
              </div>
              <div class="modal-footer">
                <button style="float:left" type="button" class="btn btn-info" data-dismiss="modal" disabled="true"><i class="fa fa-file"></i> Show documents</button>
                <button style="float:left" type="button" class="btn btn-info" data-dismiss="modal" disabled="true"> <i class="fa fa-medkit"></i> Show Illness</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_livestock()"  data-dismiss="modal">Save</button>
              </div>
            </div>

          </div>
        </div>
       