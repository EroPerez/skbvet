         <!-- Begin: CONTENT-->
          <!-- Demo Content: Panels + Text-->
      <div class="row">
            <div class="col-md-12">
              <div id="order3" role="tabpanel" class="admin-form theme-primary ">
                <!--panel-heading section--> 
                <div class="panel panel-primary heading-border">
                  
                      <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-8">
                        <!-- INICIO FORM FARMER-->
                        <form id="form-order4" method="post" action="/">
                          <div class="panel-body p25">
                          <!--Fila uno  -->
                          <div class="row">
                             <div class="col-md-12">
                                          <div class="col-md-6">
                                           <div class="section-divider"><span>Date</span></div>
                                            <label for="comimp_date" class="field prepend-picker-icon">
                                              <input id="comimp_date" type="text" name="comimp_date" placeholder="Date" class="gui-input">
                                            </label>
                                          </div>
                                          <div class="col-md-6">
                                           <div class="section-divider"><span>Licence No</span></div>
                                            <div class="section">
                                              <label for="licenceNo" class="field prepend-icon">
                                                <input id="licenceNo" type="text" name="licenceNo" placeholder="Licence No" class="gui-input">
                                                <label for="licenceNo" class="field-icon"><i class="fa fa-user"></i></label>
                                              </label>
                                            </div>
                                          </div>
                                 
                             </div> 
                          </div> 
                          <!--end fila uno-->  
                          <!--Fila dos  -->
                          <div class="row">
                             <div class="col-md-12">
                                  <div class="section row">
                                          <div class="col-md-6">
                                           <div class="section-divider"><span>Trader</span></div>
                                            <label class="field select">
                                              <select id="comimp_trader" name="comimp_trader" placeholder="Trader">
                                                <option value="">Select with single arrow</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                              </select><i class="arrow"></i>
                                            </label>
                                          </div>
                                          <div class="col-md-6">
                                           <div class="section-divider"><span>Fee</span></div>
                                            <div class="section">
                                              <label for="compimp_fee" class="field prepend-icon">
                                                <input id="compimp_fee" type="text" name="compimp_fee" placeholder="Fee" class="gui-input">
                                                <label for="compimp_fee" class="field-icon"><i class="fa fa-user"></i></label>
                                              </label>
                                            </div>
                                          </div>
                                  </div>
                             </div> 
                          </div> 
                          </form>
                          <!--end fila dos-->  
                          <!--Fila tres  -->
                          <div class="section row">
                             <div class="col-md-12">
                                   <div class="gj-margin-top-10">
                                      <div class="gj-float-left">
                                          <form class="display-inline">
                                              <input id="txtQuery" type="text" class="gj-frm-ctrl gj-display-inline-block" />
                                              <button id="btnSearch" type="button" class="gj-btn">Search</button>
                                              <button id="btnClear" type="button" class="gj-btn">Clear</button>
                                          </form>
                                      </div>
                                      <div class="gj-float-right">
                                          <button id="btnAdd" type="button" class="gj-btn">Add New Record</button>
                                      </div>
                                  </div>
                                  <div class="gj-clear-both"></div>
                                  <div class="gj-margin-top-10">
                                       <table id="compimp_table"></table> 
                                  </div>
                                  <!--Dialog modal -->
                                  <div id="dialog" class="admin-form">
                                      <input type="hidden" id="ID" />
                                      <form>
                                          <div>
                                              <div class="section-divider"><span>Date</span></div>
                                              <label for="com_date" class="field prepend-picker-icon">
                                              <input id="com_date" type="text" name="com_date" placeholder="Date" class="gui-input">
                                            </label>
                                          </div>
                                          <div class="gj-margin-top-10">
                                          <div class="section-divider"><span>Contry</span></div>
                                              <label class="field select">
                                              <select id="com_contry" name="com_contry" placeholder="Contry">
                                                <option value="">Select with single arrow</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                              </select><i class="arrow"></i>
                                            </label>
                                          </div>
                                          <div class="gj-margin-top-10">
                                          <div class="section-divider"><span>Commodity</span></div>
                                              <label class="field select">
                                              <select id="com_commodity" name="com_commodity" placeholder="Commodity">
                                                <option value="">Select with single arrow</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                              </select><i class="arrow"></i>
                                            </label>
                                          </div>
                                          <div class="gj-margin-top-10">
                                             <div class="section-divider"><span>Weigth</span></div> 
                                              <label for="com_weight" class="field prepend-icon">
                                                <input id="com_weight" type="text" name="com_weight" placeholder="weight" class="gui-input">
                                                <label for="com_weight" class="field-icon"><i class="fa fa-user"></i></label>
                                              </label>
                                          </div>
                                          <div class="gj-margin-top-10">
                                              <button type="button" id="btnSave" class="gj-btn">Save</button>
                                              <button type="button" id="btnCancel" class="gj-btn">Cancel</button>
                                          </div>
                                     </form>
                                </div>
                               <!--End Dialog modal -->
                             </div> 
                          </div> 
               <!--end fila tres--> 
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
                                            <a href="#modal-comimp" class="btn btn-xs btn-success btn-block"><i class="glyphicon glyphicon-chevron-left"></i><span >Back</span></a>
                                          </div> 
                                          <div class="col-md-6" >
                                            <a href="#" class="btn btn-xs btn-info btn-block"><span >Next<i class="glyphicon glyphicon-chevron-right"></i></span></a>
                                          </div>
                                        </div> 
                                      </div>
                                      
                                      <div class="section-divider"><span></span></div>
                                      <div >
                                       <span class="panel-icon"></span>
                                        <button type="submit" class="btn btn-xs btn-primary btn-block"><i class="glyphicon glyphicon-save"></i> Save Farmer</button>
                                      </div></br>
                                       <div >
                                       <span class="panel-icon"></span>
                                        <button type="button" class="btn btn-xs btn-primary btn-block btn-dark"><i class="glyphicon glyphicon-remove"></i> Delete Farmer</button>
                                      </div></br>
                                       <div >
                                       <span class="panel-icon"></span>
                                        <button type="button" class="btn btn-xs btn-primary btn-block btn-danger"><i class="glyphicon glyphicon-plus"></i> New Farmer</button>
                                      </div>
                                    </div>
                                    
                                     <div class="section-divider"><span>Search</span></div>
                                    <div class="sidebar-widget search-widget" style="padding:10px; margin-bottom:10px">
                                      <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                                       <input id="sidebar-search" type="text" placeholder="Search..." class="form-control"/>
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