         <!-- Demo Content: Panels + Text-->
          <div class="row">
            <div class="col-md-12">
              <div id="order3" class="admin-form theme-primary">
                <!--panel-heading section--> 
                <div class="panel panel-primary panel-border  heading-border">
                  <div class="panel-heading"><span class="panel-title"><?php echo $title; ?></span></div>
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
                                        <label for="date_addabbatoir" class="field prepend-picker-icon">
                                          <input id="date_addabbatoir"  type="text" name="date_addabbatoir" placeholder="Date Addon" class="gui-input">
                                        </label>
                                    </div>
                                <!-- end date piker --> 
                                 
                                     <div class="section">
                                       <table id="table_abbatoir" class="table table-bordered ">
                                          <thead>
                                            <tr>
                                              <th>Presenter</th>
                                              <th>Address</th>
                                            </tr>
                                          </thead>
                                          <tbody id="body_table_Presenter">
                                          </tbody>
                                       </table>
                                       
                                     </div>
                                      
                                </div>
                                <!--Actions-->
                                <div class="col-md-4" tyle="padding:2px; border:1px;" >
                                  <div class="section">
                                        <label for="abbatoir_presenter" class="field prepend-icon">
                                          <input id="abbatoir_presenter" readonly="readonly" type="text" name="abbatoir_presenter" placeholder="Presenter..." class="gui-input">
                                          <label for="abbatoir_presenter" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                  </div>
                                  <div class="section">
                                        <label for="abbatoir_address" class="field prepend-icon">
                                          <input id="abbatoir_address" readonly="readonly" type="text" name="abbatoir_address" placeholder="Address..." class="gui-input">
                                          <label for="abbatoir_address" class="field-icon"><i class="imoon imoon-location2"></i></label>
                                        </label>
                                  </div>
                                  <div class="section">
                                        <label for="abbatoir_phone" class="field prepend-icon">
                                          <input id="abbatoir_phone" readonly="readonly" type="text" name="abbatoir_phone" placeholder="Phone..." class="gui-input">
                                          <label for="abbatoir_phone" class="field-icon"><i class="glyphicon glyphicon-earphone"></i></label>
                                        </label>
                                  </div>
                                  <div class="row section">
                                    <div class="col-md-6 ">
                                       <button type="button" id="new_presenter" class="btn  btn-info btn-block"><i class="glyphicon glyphicon-plus"></i> New</button> 
                                    </div>
                                    <div class="col-md-6 ">
                                      <button type="button" id="save_presenter" class="btn  btn-system btn-block"><i class="glyphicon glyphicon-floppy-save"></i> Save Animal</button>
                                    </div>
                                       
                                  </div> 
                                </div> <!--end col 4 --> 
                           
                          </div>  <!--end row -->   
                           <div class="row">

                           </div><!--end row -->
                        </div>
                         <!-- end .panel-body section-->
                        </form>
                        
                      </div>

                      <!-- end: .panel-->
                    </div>
                     <div class="section-divider"><span></span></div>
                    <div class="row section">
                        <div class="col-md-12">
                          <div class="col-md-4 col-xs-4">
         
                           <div class="form-group">
                           <div class="section-divider"><span>Livestock ID</span></div>
                              <div class="col-md-8">
                                <select class="select2-single form-control" id="select_livestock" placeholder="Species...">
                                 <option value=""></option>
                                 <?php foreach ($livestock as $key => $value) { ?>
                                   <option value="<?php echo $value['recn']?>"><?php echo $value['IDNO'] ?></option>
                                 <?php } ?>
                                </select>
                              </div>
                            </div>       
                          </div>
                          <div class="col-md-4 col-xs-4">
                          <div class="section-divider"><span>Species</span></div>
                            <div class="section">
                                        <label for="abbatoir_Species" class="field prepend-icon">
                                          <input id="abbatoir_Species" readonly="readonly" type="text" name="abbatoir_Species" placeholder="Species..." class="gui-input">
                                          <label for="abbatoir_Species" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                  </div>
                          </div>
                          <div class="col-md-4 col-xs-4">
                          <div class="section-divider"><span>Breed</span></div>
                            <div class="section">
                                        <label for="abbatoir_Breed" class="field prepend-icon">
                                          <input id="abbatoir_Breed" readonly="readonly" type="text" name="abbatoir_breed" placeholder="Breed..." class="gui-input">
                                          <label for="abbatoir_Breed" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                  </div>
                          </div>
                        </div>
                         <div class="col-md-12">
                          <div class="col-md-4 col-xs-4">
                           <div class="section-divider"><span>Sex</span></div>
                            <div class="section">
                                        <label for="abbatoir_sex" class="field prepend-icon">
                                          <input id="abbatoir_sex" readonly="readonly" type="text" name="abbatoir_sex" placeholder="Sex..." class="gui-input">
                                          <label for="abbatoir_sex" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                  </div>
                          </div>
                          <div class="col-md-4 col-xs-4">
                           <div class="section-divider"><span>Date Birth</span></div>
                            <div class="section" >
                                        <label for="date_birth" class="field prepend-picker-icon">
                                          <input id="date_birth"  type="text" name="date_birth" placeholder="Date Birth" class="gui-input">
                                        </label>
                            </div>
                          </div>
                          <div class="col-md-4 col-xs-4">
                           <div class="section-divider"><span>Withdrawal</span></div>
                            <div class="section">
                                        <label for="abbatoir_drawal" class="field prepend-icon">
                                          <input id="abbatoir_drawal" readonly="readonly" type="text" name="abbatoir_drawal" placeholder="Withdrawal date..." class="gui-input">
                                          <label for="abbatoir_drawal" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                  </div>
                          </div>
                         
                           
                        </div>
                         <div class="col-md-12">
                          <div class="col-md-6">
                           <div class="section-divider"><span>Farm</span></div>
                            <div class="section">
                                        <label for="abbatoir_farm" class="field prepend-icon">
                                          <input id="abbatoir_farm" readonly="readonly" type="text" name="abbatoir_farm" placeholder="Farm..." class="gui-input">
                                          <label for="abbatoir_farm" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                  </div>
                          </div>
                          <div class="col-md-6">
                          <div class="section-divider"><span>Farmer</span></div>
                            <div class="section">
                                        <label for="abbatoir_farmer" class="field prepend-icon">
                                          <input id="abbatoir_farmer" readonly="readonly" type="text" name="abbatoir_farmer" placeholder="Farmer..." class="gui-input">
                                          <label for="abbatoir_farmer" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                  </div>
                          </div>
                        </div>
                         <div class="col-md-12">
                          <div class="col-md-4">
                          <div class="section-divider"><span>Address</span></div>
                             <div class="section">
                                        <label for="abbatoir_address2" class="field prepend-icon">
                                          <input id="abbatoir_address2" readonly="readonly" type="text" name="abbatoir_address2" placeholder="Address..." class="gui-input">
                                          <label for="abbatoir_address2" class="field-icon"><i class="fa fa-user"></i></label>
                                        </label>
                                  </div>
                          </div>
                          <div class="col-md-4">
                          <div class="section-divider"><span>Telephone</span></div>
                           <div class="section">
                                          <label for="abbatoir_telephone" class="field prepend-icon">
                                            <input id="abbatoir_telephone" readonly="readonly" type="text" name="abbatoir_telephone" placeholder="Telephone.." class="gui-input">
                                            <label for="abbatoir_telephone" class="field-icon"><i class="glyphicon glyphicon-earphone"></i></label>
                                          </label>
                                    </div>   
                            </div>
                          <div class="col-md-4">
                          <div class="section-divider"><span>Carcass delivered to</span></div>
                          <div class="section">
                             <label class="field select" id="calcase_label">
                                  <select id="sele_carcass" name="sele_carcass" placeholder="Carcass delivered to">
                                    <?php foreach ($carcass as $value_carcass) { ?>
                                        <option value="<?php echo $value_carcass['recn']; ?>"><?php echo $value_carcass['name']; ?></option>
                                    <?php } ?>
                                  </select><i class="arrow"></i>
                              </label>
                          </div>    
                          </div>
                        </div>
                         <div class="col-md-12">
                          <div style="padding-left: 10px; padding-right: 10px;" class="section">
                                       <table id="table_abbatoir" class="table table-hover">
                                          <thead>
                                            <tr class="primary">
                                              <th>Id Number</th>
                                              <th>Species</th>
                                              <th>Sex</th>
                                              <th>Type</th>
                                              <th>Age</th>
                                            </tr>
                                          </thead>
                                          <tbody id="body_table2">
                                          </tbody>
                                       </table>
                                       
                          </div>
                        </div>
                         <div class="col-md-12" style="padding-bottom: 20px;">
                          <div class="col-md-2">
                            <button type="button" class="btn btn-xs btn-alert "><i class="imoon imoon-print"></i> Print Report</button>
                          </div>
                          <div class="col-md-2">
                            
                          </div>
                          <div class="col-md-2">
                           <button type="button" id="new_animal" class="btn  btn-info btn-block"><i class="glyphicon glyphicon-plus"></i> New Animal</button> 
                          </div>
                          <div class="col-md-2">
                           <button type="button" id="edit_animal" class="btn  btn-warning btn-block"><i class="glyphicon glyphicon-edit"></i> Edit Animal</button> 
                          </div>
                          <div class="col-md-2">
                            <button type="button" id="save_animal" class="btn  btn-system btn-block"><i class="glyphicon glyphicon-floppy-save"></i> Save Animal</button>
                          </div>
                          
                        </div>
                    </div> 
              </div>
          </div>
        </div>  
</div>
         <!-- Modal Eliminar -->
         
     
        <!--modal-->
      