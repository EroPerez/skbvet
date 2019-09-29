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

				                 <div class="section-divider"><span>SETTING ROLE</span></div>
				                    <div class="panel">
				                  <div class="panel-body p25 pb10">
				                       <form role="form" class="form-horizontal">
				                                <div class="form-group">
				                                  <label class="col-md-3 control-label">Roles</label>
				                                  <div class="col-md-8">
				                                    <select class="select2-single form-control">
				                                      <?php foreach ($role as $key => $value) { ?>
				                                        <option value="<?php echo $value['idlevels'] ?>"><?php echo $value['rolename'] ?></option>
				                                     <?php }  ?>
				                                    </select>
				                                  </div>
				                                </div>
				                       </form>

				                     </div>  
				                     </div>


				                  </div>
				                 </div> 
				                                <!--tab permisos -->
                              <div class="row">
                                    <div class="col-md-12">
                                      <!--Aqui poner -->
                                      <div class="tab-block mb25">
                                      <ul class="nav nav-tabs tabs-bg">
                                        <li class="active"><a aria-expanded="true" href="#tab_farm_farmers" data-toggle="tab">Farm and Farmers</a></li>
                                        <li class=""><a aria-expanded="false" href="#tab_management" data-toggle="tab">Case management</a></li>
                                        <li class=""><a aria-expanded="false" href="#tab_abbatoir" data-toggle="tab">Abbatoir</a></li>
                                        <li class=""><a aria-expanded="false" href="#tab_licences" data-toggle="tab">Licences</a></li>
                                        <li class=""><a aria-expanded="false" href="#tab_maintenance" data-toggle="tab">Maintenance</a></li>
                                      </ul>
                                      <div class="tab-content admin-form">
                                        <div id="tab_farm_farmers" class="tab-pane active">
                                          <form role="form" class="form-horizontal">
                                           <div class="row">
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label for="multiselect1" class="col-md-4 control-label">Allow user to</label>
                                                  <div class="col-md-4">
                                                    <select id="multiselect1" multiple="multiple">
                                                      <option value="cheese">Cheese</option>
                                                      <option value="tomatoes">Tomatoes</option>
                                                      <option value="mozarella">Mozzarella</option>
                                                      <option value="mushrooms">Mushrooms</option>
                                                      <option value="pepperoni">Pepperoni</option>
                                                      <option value="onions">Onions</option>
                                                    </select>
                                                  </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                 <label for="multiselect1" class="col-md-4 control-label">Allo user to</label>
                                                  <div class="col-md-4">
                                                    <select id="multiselect2" multiple="multiple">
                                                      <option value="cheese">Cheese</option>
                                                      <option value="tomatoes">Tomatoes</option>
                                                      <option value="mozarella">Mozzarella</option>
                                                      <option value="mushrooms">Mushrooms</option>
                                                      <option value="pepperoni">Pepperoni</option>
                                                      <option value="onions">Onions</option>
                                                    </select>
                                                  </div>
                                                </div>
                                             </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                 <label for="multiselect1" class="col-md-4 control-label">Allo user to</label>
                                                  <div class="col-md-4">
                                                    <select id="multiselect3" multiple="multiple">
                                                      <option value="cheese">Cheese</option>
                                                      <option value="tomatoes">Tomatoes</option>
                                                      <option value="mozarella">Mozzarella</option>
                                                      <option value="mushrooms">Mushrooms</option>
                                                      <option value="pepperoni">Pepperoni</option>
                                                      <option value="onions">Onions</option>
                                                    </select>
                                                  </div>
                                                </div>
                                             </div>
                                             
                                           </div>
                                          </form> 
                                        </div> <!-- fin del tab-->
                                        <div id="tab_management" class="tab-pane">
                                           <!-- tab2 -->
                                        2
                                        </div>
                                        <div id="tab_abbatoir" class="tab-pane">
                                           <!-- tab2 -->
                                        3
                                        </div>
                                        <div id="tab_licences" class="tab-pane">
                                           <!-- tab2 -->
                                        4
                                        </div>
                                        <div id="tab_maintenance" class="tab-pane">
                                           <!-- tab2 -->
                                        5
                                        </div>
                                       
                                      </div>
                                    </div> <!-- m25 -->
                                       
                                    </div><!--col12-->
                                </div> <!--row-->
                 <!--end permisos -->   	
                         
                        <!-- -->
                        </div>

                      <!-- end: .panel-->
                    </div>
                <!--PONER AQUI EXT -->

                <!-- END -->   

              </div>
          </div>
        </div> 
       </div>  
