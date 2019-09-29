<div class="row">
    <div class="col-md-12">
        <div id="order3" class="admin-form theme-primary">
            <!--panel-heading section--> 
            <div class="panel panel-primary panel-border  heading-border">
                <div class="panel-heading" style="margin-bottom: 15px"><span class="panel-title"><?php echo $title; ?></span></div>
                <div class="col-md-12 col-xs-12" tyle="padding:2px; border:1px;" >
                    <div  class="panel">
                        <div class="panel-heading">
                            <span class="panel-icon"></span>
                            <span class="panel-title" style="font-size: 12px">Filter</span>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="">
                                <div class="section row" >
                                    <div class="col-md-12" style="padding:0px"> 

                                        <div class="col-md-3" >
                                            <div class="section-divider"><span>Period</span></div>
                                            <label class="field select">
                                                <select id="time_filter" name="time_filter" placeholder="Quarantine" onchange="OnFilterTime()">

                                                    <option value='0'>Quarter</option>
                                                    <option value="1">Yearly</option>
                                                </select><i class="arrow"></i>
                                            </label>
                                        </div>
                                        <div class="col-md-3" id='date_cmp'>
                                            <div class="section-divider"><span> Date</span></div>
                                            <label for="comimp_date" class="field prepend-picker-icon">
                                                <input id="comimp_date" type="text" name="comimp_date" placeholder="Start Date" class="gui-input">
                                            </label>

                                        </div>

                                        <div class="col-md-3" id='year_cmp' >
                                            <div class="section-divider"><span>Year</span></div>
                                            <label class="field select">
                                                <select id="year_filter" name="year_filter" placeholder="Quarantine">
                                                    <?php
                                                    $year = 2000;
                                                    while ($year < 2050):
                                                        $year = $year + 1;
                                                        ?>
                                                        <?php
                                                        $selected = '';
                                                        if ($year == $year_filter):
                                                            ?>
                                                            <?php $selected = 'selected="true"'; ?>
                                                        <?php endif; ?>     

                                                        <option value='<?= $year ?>' <?= $selected ?>><?= $year ?></option>
                                                    <?php endwhile; ?>

                                                </select><i class="arrow"></i>
                                            </label>
                                        </div>
                                        <div class="col-md-4" >
                                            <div class="section-divider"><span>Operation</span></div>
                                            <button type="submit" id="btnAddcomimp" class="btn btn-primary" data-toggle="modal"  data-target="#comimp_Modal"><i class="fa fa-search-plus"></i>Filter</button>

                                        </div>
                                    </div> 
                                </div>
                            </form>

                        </div>
                    </div>
                </div> 

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
                                            <th>Destination</th>
                                            <th>Origin</th>
                                            <th>Consignee of Sender</th>
                                            <th>Consignee of Receiver</th>
                                            <th>ID of Animal</th>
                                            <th></th>
                                            <th></th>												  
                                        </tr>
                                    </thead>
                                    <tbody id="body_table">
                                         <?php foreach ($animals as $value):?>
                                    <tr>
                                        <?php foreach ($value as $key => $value2): ?>
                                        
                                        <td><?= $value2?></td>
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