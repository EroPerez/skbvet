<div class="row">
    <div class="col-md-12">
        <div id="order3" class="admin-form theme-primary">
            <!--panel-heading section--> 
            <div class="panel panel-primary panel-border  heading-border">
                <div class="panel-heading"><span class="panel-title"><?php echo $title; ?></span></div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- INICIO FORM TRANFER-->
                        <div class="panel" style="padding-left: 10px; padding-right: 10px;">
                            <form id="demoform" action="#" method="post" class="hide-list-label">

                                <div class="col-xs-12 col-md-12">
                                    <div class="section-divider"><span>Date</span></div> 
                                    <label for="transfer_dateadd" class="field prepend-picker-icon">
                                        <input id="transfer_dateadd" type="text" name="transfer_dateadd" placeholder="Date Added" class="gui-input">
                                    </label>
                                </div>
                                <!--farm to and from-->
                                <div class="section row">
                                    <div class="col-xs-6 col-md-6">
                                        <div class="section-divider"><span>From</span></div>
                                        <div class="form-group">
                                            <select class="select2-info form-control" id='farm_from'>
                                                <?php foreach ($farm as $value) { ?>
                                                    <option value="<?php echo $value['recn']; ?>"><?php echo $value['farmName']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-6">
                                        <div class="section-divider"><span>To</span></div>
                                        <div class="form-group">
                                            <select class="select2-info form-control" id='farm_to'>
                                                <?php foreach ($farm as $value) { ?>
                                                    <option value="<?php echo $value['recn']; ?>"><?php echo $value['farmName']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--end -->
                                <div class="panel-body p25" id="mostrar">
                                    <select multiple='multiple' size='10' name='demo1' class='demo1' id='demo1'>
                                    </select>
                                </div>
                                <div class="panel-footer text-right">
                                    <a  href="<?= site_url('transfer') ?>" data-form-skin="success" class="btn btn-info btn-gradient ph25">
                                        <i class="glyphicon glyphicon-list"></i> Back to List
                                    </a>
                                    <button type="submit" class="btn btn-default ph25">Transfer</button>
                                </div>
                            </form>
                        </div>                      
                    </div>

                    <!-- end: .panel-->
                </div>


            </div>
        </div>
    </div> 
</div>  


