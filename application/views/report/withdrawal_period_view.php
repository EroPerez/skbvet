<div class="row">
    <div class="col-md-12">
        <div id="order3" class="admin-form theme-primary">
            <!--panel-heading section--> 
            <div class="panel panel-primary panel-border  heading-border">
                <div class="panel-heading" style="margin-bottom: 15px"><span class="panel-title"><?php echo $title; ?></span></div>

                
            </div>
            <div class="section row">
                <div class="col-md-12 col-xs-12">
                    <div class="section row p25">
                        <div class="col-md-12 col-xs-12">

                            <div class="row">

                               <div class="col-md-12" style="padding-bottom: 20px;">
                                    <div class="col-md-2">
                                        <button type="button" id="save_animal" class="btn  btn-warning btn-block" onclick="printTable()"><i class="glyphicon glyphicon-print"></i> Print Report</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" id="save_animal" class="btn  btn-info btn-block" onclick="exportExcel()"><i class="glyphicon glyphicon-floppy-save"></i>EXCEL</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" id="save_animal" class="btn  btn-system btn-block" onclick="exportPDF()"><i class="glyphicon glyphicon-floppy-save"></i>PDF</button>
                                    </div>


                                </div>
                            </div>

                            <div id="report">
                            <table id="table_animalimp" class="table table-hover">
                                <thead>
                                    <tr class="primary">
                                        <th>Id of Animal </th>
                                        <th>Name of farmer</th>
                                        <th>Time left (Withdrawal)</th>
                                     											  
                                    </tr>
                                </thead>
                                <tbody id="body_table22">
                                   <?php foreach ($withdrawal_period as $value):?>
                                    <tr>
                                        <?php foreach ($value as $key => $value2): ?>
                                        
                                        <td><?= $value2?> </td>
                                        <?php endforeach;?>                                        
                                    </tr>
                                    
                                    <?php endforeach;?>     
                                </tbody>
                            </table></div>
                        </div> 
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>           