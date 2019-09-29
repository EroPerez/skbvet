<script>

    var map;
    var chartanimal, chartcase, chartfarm;
    var serialsurv, serialanimalimport, serialmeatlimport;
    var serialissued;

    AmCharts.ready(function () {
        map = new AmCharts.AmMap();
        map.balloon.color = "#000000";
        var dataProvider = {
            mapVar: AmCharts.maps.stKittsNevisHigh,
            getAreasFromMap: true,
            images: <?= $mapItems ?>
        };
        map.dataProvider = dataProvider;
        map.areasSettings = {
            autoZoom: true,
            selectedColor: "#FFF176",
            rollOverOutlineColor: "#0E588C",
            color: "#8AB5D1",
            rollOverColor: "#FFF176",
            outlineColor: "#0E588C",
            selectable: true,
        };
        map.zoomControl = {
            zoomControlEnabled: false
        }
        map.export = {
            "enabled": true
        };
        map.responsive = {
            "enabled": true
        };

//        map.smallMap = new AmCharts.SmallMap();

        map.write("mapdiv");

        $('circle').on('click', function () {
            $('#KittStates li').children().removeClass('active-region');
            hideGroups();
        });

        map.addListener("clickMapObject", function (event) {
            hideGroups();

            switch (event.mapObject.id) {
                case "KN-11":
                    map.showGroup("Peter");
                    break;
                case "KN-02":
                    map.showGroup("Anne");
                    break;
                case "KN-06":
                    map.showGroup("John");
                    break;
                case "KN-03":
                    map.showGroup("George");
                    break;
                case "KN-09":
                    map.showGroup("Paul");
                    break;
                case "KN-13":
                    map.showGroup("Thomas");
                    break;
                case "KN-08":
                    map.showGroup("Mary");
                    break;
                case "KN-01":
                    map.showGroup("Christchurch");
                    break;
                case "KN-15":
                    map.showGroup("Trinity");
                    break;
            }
        });

// PIE CHART Animal    
        chartanimal = new AmCharts.AmPieChart();
        chartanimal.color = '#FFFFFF';
        chartanimal.dataLoader = {
            "url": "<?= site_url('dashboard/dashboard/animalByDistricts') ?>",
            "showCurtain": false
        };
        chartanimal.titleField = "name";
        chartanimal.valueField = "total";
        chartanimal.gradientRatio = [0, 0, 0, -0.2, -0.4];
        chartanimal.innerRadius = "30%";
        chartanimal.gradientType = "radial";
        chartanimal.labelRadius = -30;
        chartanimal.labelText = "[[percents]]%";
        chartanimal.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
        // this makes the chart 3D
        chartanimal.depth3D = 15;
        chartanimal.angle = 30;
        chartanimal.fontSize = 8.5;
        chartanimal.export = {
            "enabled": true
        };
        chartanimal.responsive = {
            "enabled": true
        };

        // PIE CHART Case    
        chartcase = new AmCharts.AmPieChart();
        chartcase.color = '#FFFFFF';
        chartcase.dataLoader = {
            "url": "<?= site_url('dashboard/dashboard/caseByDistricts') ?>",
            "showCurtain": false
        };
        chartcase.titleField = "name";
        chartcase.valueField = "total";
        chartcase.gradientRatio = [0, 0, 0, -0.2, -0.4];
        chartcase.gradientType = "radial";
        chartcase.labelRadius = -30;
        chartcase.sequencedAnimation = true;
        chartcase.startEffect = "elastic";
        chartcase.innerRadius = "30%";
        chartcase.startDuration = 2;
        chartcase.labelText = "[[percents]]%";
        chartcase.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
        // this makes the chart 3D
        chartcase.depth3D = 15;
        chartcase.angle = 30;
        chartcase.fontSize = 9;
        chartcase.export = {
            "enabled": true
        };
        chartcase.responsive = {
            "enabled": true
        };
        // PIE CHART farm    
        chartfarm = new AmCharts.AmPieChart();
        chartfarm.color = '#FFFFFF';
        chartfarm.dataLoader = {
            "url": "<?= site_url('dashboard/dashboard/farmByDistricts') ?>",
            "showCurtain": false
        };
        chartfarm.titleField = "name";
        chartfarm.valueField = "total";
        chartfarm.gradientRatio = [0, 0, 0, -0.2, -0.4];
        chartfarm.gradientType = "radial";
        chartfarm.labelRadius = -30;
        chartfarm.sequencedAnimation = true;
        chartfarm.startEffect = "elastic";
        chartfarm.innerRadius = "30%";
        chartfarm.startDuration = 2;
        chartfarm.labelText = "[[percents]]%";
        chartfarm.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
        // this makes the chart 3D
        chartfarm.depth3D = 15;
        chartfarm.angle = 30;
        chartfarm.fontSize = 8.5;
        chartfarm.export = {
            "enabled": true
        };
        chartfarm.responsive = {
            "enabled": true
        };
        // LEGEND
        legendAnimal = new AmCharts.AmLegend();
        legendAnimal.align = "center";
        legendAnimal.markerType = "circle";
        legendAnimal.color = "white";
        chartanimal.addLegend(legendAnimal);

        legendcase = new AmCharts.AmLegend();
        legendcase.align = "center";
        legendcase.markerType = "square";
        legendcase.color = "white";
        chartcase.addLegend(legendcase);

        legendfarm = new AmCharts.AmLegend();
        legendfarm.align = "center";
        legendfarm.markerType = "diamond";
        legendfarm.color = "white";
        chartfarm.addLegend(legendfarm);

        // WRITE
        chartanimal.write("chartdivanimal");
        chartcase.write("chartdivcase");
        chartfarm.write("chartdivfarm");

        // SERIAL CHART surve
        serialsurv = new AmCharts.AmSerialChart();
        serialsurv.dataLoader = {
            "url": "<?= site_url('dashboard/dashboard/totalAnimalTestedByFarm') ?>",
            "format": "json",
            "showErrors": true,
            "noStyles": true,
            "async": true
        };
        serialsurv.categoryField = "farmName";
        serialsurv.color = '#FFFFFF';
//        serialsurv.startDuration = 1;
        // the following two lines makes chart 3D
        serialsurv.depth3D = 30;
        serialsurv.angle = 60;
        serialsurv.export = {
            "enabled": true
        };
        serialsurv.responsive = {
            "enabled": true
        };
        // AXES
        // category
        var categoryAxis = serialsurv.categoryAxis;
        categoryAxis.labelRotation = 90;
        categoryAxis.dashLength = 5;
        categoryAxis.gridAlpha = 0.2;
        categoryAxis.gridPosition = "start";
        categoryAxis.gridColor = "#FFFFFF";
        categoryAxis.axisColor = "#FFFFFF";
        categoryAxis.axisAlpha = 0.5;

        // value
        var valueAxis = new AmCharts.ValueAxis();
        valueAxis.stackType = "3d"; // This line makes chart 3D stacked (columns are placed one behind another)
        valueAxis.gridAlpha = 0.2;
        valueAxis.gridColor = "#FFFFFF";
        valueAxis.axisColor = "#FFFFFF";
        valueAxis.axisAlpha = 0.5;
        valueAxis.dashLength = 5;
        valueAxis.title = 'Animal tested';
        serialsurv.addValueAxis(valueAxis);

        // GRAPH
        var graph = new AmCharts.AmGraph();
        graph.valueField = "total";
        graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
        graph.type = "column";
        graph.lineAlpha = 0;
        graph.fillAlphas = 1;
        graph.lineColor = "#D2CB00";
        serialsurv.addGraph(graph);

        // CURSOR
        var chartCursor = new AmCharts.ChartCursor();
        chartCursor.cursorAlpha = 0;
        chartCursor.zoomable = false;
        chartCursor.categoryBalloonEnabled = false;
        serialsurv.addChartCursor(chartCursor);

        serialsurv.creditsPosition = "top-right";

        // WRITE
        serialsurv.write("serialdivsurv");

        // SERIAL CHART Import animal
        serialanimalimport = new AmCharts.AmSerialChart();
        serialanimalimport.categoryField = "species";
        serialanimalimport.color = '#FFFFFF';
//        animalimport.startDuration = 1;
        serialanimalimport.dataLoader = {
            "url": "<?= site_url('dashboard/dashboard/numberOfAnimalImportedBySpecies') ?>",
            "format": "json",
            "showErrors": true,
            "noStyles": true,
            "async": true
        };
        serialanimalimport.export = {
            "enabled": true
        };
        serialanimalimport.responsive = {
            "enabled": true
        };

        // AXES
        // category
        var categoryAxis1 = serialanimalimport.categoryAxis;
        categoryAxis1.labelRotation = 90;
        categoryAxis1.dashLength = 5;
        categoryAxis1.gridAlpha = 0.2;
        categoryAxis1.gridPosition = "start";
        categoryAxis1.gridColor = "#FFFFFF";
        categoryAxis1.axisColor = "#FFFFFF";
        categoryAxis1.axisAlpha = 0.5;

        // value
        var valueAxis1 = new AmCharts.ValueAxis();
        valueAxis1.title = "Number Animal Imported";
        valueAxis1.gridAlpha = 0.2;
        valueAxis1.gridColor = "#FFFFFF";
        valueAxis1.axisColor = "#FFFFFF";
        valueAxis1.axisAlpha = 0.5;
        valueAxis1.dashLength = 5;

        serialanimalimport.addValueAxis(valueAxis1);

        // GRAPH
        var graph1 = new AmCharts.AmGraph();
        graph1.valueField = "total";
        graph1.balloonText = "<b>[[category]]: [[value]]</b>";
        graph1.type = "column";
        graph1.lineAlpha = 0;
        graph1.fillAlphas = 1;
        serialanimalimport.addGraph(graph1);

        // CURSOR
        var chartCursor1 = new AmCharts.ChartCursor();
        chartCursor1.cursorAlpha = 0;
        chartCursor1.zoomable = false;
        chartCursor1.categoryBalloonEnabled = false;
        serialanimalimport.addChartCursor(chartCursor1);

        serialanimalimport.creditsPosition = "top-right";

        // WRITE
        serialanimalimport.write("chartdivAnimalimport");

        // SERIAL CHART Import meat
        serialmeatlimport = new AmCharts.AmSerialChart();
        serialmeatlimport.categoryField = "commodity";
        serialmeatlimport.color = '#FFFFFF';
//        animalimport.startDuration = 1;
        serialmeatlimport.dataLoader = {
            "url": "<?= site_url('dashboard/dashboard/totaloMeatImportedByCommodity') ?>",
            "format": "json",
            "showErrors": true,
            "noStyles": true,
            "async": true
        };
        serialmeatlimport.export = {
            "enabled": true
        };
        serialmeatlimport.responsive = {
            "enabled": true
        };

        // AXES
        // category
        var categoryAxis2 = serialmeatlimport.categoryAxis;
        categoryAxis2.labelRotation = 90;
        categoryAxis2.dashLength = 5;
        categoryAxis2.gridAlpha = 0.2;
        categoryAxis2.gridPosition = "start";
        categoryAxis2.gridColor = "#FFFFFF";
        categoryAxis2.axisColor = "#FFFFFF";
        categoryAxis2.axisAlpha = 0.5;

        // value
        var valueAxis2 = new AmCharts.ValueAxis();
        valueAxis2.title = "Number Meat Imported";
        valueAxis2.gridAlpha = 0.2;
        valueAxis2.gridColor = "#FFFFFF";
        valueAxis2.axisColor = "#FFFFFF";
        valueAxis2.axisAlpha = 0.5;
        valueAxis2.dashLength = 5;

        serialmeatlimport.addValueAxis(valueAxis2);

        // GRAPH
        var graph2 = new AmCharts.AmGraph();
        graph2.valueField = "total";
        graph2.balloonText = "<b>[[category]]: [[value]]</b>";
        graph2.type = "column";
        graph2.lineAlpha = 0;
        graph2.fillAlphas = 1;
        serialmeatlimport.addGraph(graph2);

        // CURSOR
        var chartCursor2 = new AmCharts.ChartCursor();
        chartCursor2.cursorAlpha = 0;
        chartCursor2.zoomable = false;
        chartCursor2.categoryBalloonEnabled = false;
        serialmeatlimport.addChartCursor(chartCursor2);

        serialmeatlimport.creditsPosition = "top-right";

        // WRITE
        serialmeatlimport.write("chartdivMeatimport");

        // SERIAL CHART
        serialissued = new AmCharts.AmSerialChart();
        serialissued.marginLeft = 10;
        serialissued.categoryField = "year";
        serialissued.dataDateFormat = "YYYY";
        serialissued.color = '#FFFFFF';
//        animalimport.startDuration = 1;
        serialissued.dataLoader = {
            "url": "<?= site_url('dashboard/dashboard/numberSpecimenPermitIssuedByYear') ?>",
            "format": "json",
            "showErrors": true,
            "noStyles": true,
            "async": true
        };
        serialissued.export = {
            "enabled": true
        };
        serialissued.responsive = {
            "enabled": true
        };

        // listen for "dataUpdated" event (fired when serialissued is inited) and call zoomChart method when it happens
        serialissued.addListener("dataUpdated", zoomChart);

        // AXES
        // category
        var categoryAxisIssued = serialissued.categoryAxis;
        categoryAxisIssued.parseDates = true; // as our data is date-based, we set parseDates to true
        categoryAxisIssued.minPeriod = "YYYY"; // our data is yearly, so we set minPeriod to YYYY
        categoryAxisIssued.dashLength = 3;
        categoryAxisIssued.minorGridEnabled = true;
        categoryAxisIssued.minorGridAlpha = 0.1;

        // value
        var valueAxisIssued = new AmCharts.ValueAxis();
        valueAxisIssued.axisAlpha = 0;
        valueAxisIssued.inside = true;
        valueAxisIssued.dashLength = 3;
        serialissued.addValueAxis(valueAxisIssued);

        // GRAPH
        graphIssued = new AmCharts.AmGraph();
        graphIssued.type = "smoothedLine"; // this line makes the graphIssued smoothed line.
        graphIssued.lineColor = "#d1655d";
        graphIssued.negativeLineColor = "#637bb6"; // this line makes the graphIssued to change color when it drops below 0
        graphIssued.bullet = "round";
        graphIssued.bulletSize = 8;
        graphIssued.bulletBorderColor = "#FFFFFF";
        graphIssued.bulletBorderAlpha = 1;
        graphIssued.bulletBorderThickness = 2;
        graphIssued.lineThickness = 2;
        graphIssued.valueField = "total";
        graphIssued.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>";
        serialissued.addGraph(graphIssued);

        // CURSOR
        var chartCursorIssued = new AmCharts.ChartCursor();
        chartCursorIssued.cursorAlpha = 0;
        chartCursorIssued.cursorPosition = "mouse";
        chartCursorIssued.categoryBalloonDateFormat = "YYYY";
        serialissued.addChartCursor(chartCursorIssued);

        // SCROLLBAR
        var chartScrollbar = new AmCharts.ChartScrollbar();
        serialissued.addChartScrollbar(chartScrollbar);

        serialissued.creditsPosition = "bottom-right";

        // WRITE
        serialissued.write("chartdivissued");
    });
    // this method is called when chart is first inited as we listen for "dataUpdated" event
    function zoomChart() {
        // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
        serialissued.zoomToDates(new Date(2000, 0), new Date('now'));
    }
    function selectArea(area) {

        hideGroups();
        map.clickMapObject(map.getObjectById($(area).data("region")));
        $('#KittStates li').children().removeClass('active-region');
        $(area).addClass('active-region');
        switch ($(area).data("region")) {
            case "KN-11":
                map.showGroup("Peter");
                break;
            case "KN-02":
                map.showGroup("Anne");
                break;
            case "KN-06":
                map.showGroup("John");
                break;
            case "KN-03":
                map.showGroup("George");
                break;
            case "KN-09":
                map.showGroup("Paul");
                break;
            case "KN-13":
                map.showGroup("Thomas");
                break;
            case "KN-08":
                map.showGroup("Mary");
                break;
            case "KN-01":
                map.showGroup("Christchurch");
                break;
            case "KN-15":
                map.showGroup("Trinity");
                break;
            default:
                break;
        }
    }
    ;
    function hideGroups() {
        map.hideGroup("Peter");
        map.hideGroup("Anne");
        map.hideGroup("John");
        map.hideGroup("George");
        map.hideGroup("Paul");
        map.hideGroup("Thomas");
        map.hideGroup("Mary");
        map.hideGroup("Christchurch");
        map.hideGroup("Trinity");
    }
</script>
<style>


    #KittStates li {
        cursor: pointer;
    }

    @media (max-width: 992px) {
        #KittStates{
            display: none !important;
        }
        #mapdiv{
            width: 100% !important;
        }
    }

</style>

<!-- Admin-panels-->
<div class="admin-panels">
    <div class="row">
        <div class="col-lg-12 admin-grid">
            <!-- Geo Map + Table Stats-->
            <div id="p9" class="panel panel-blue tags-wrapper">
                <div class="panel-heading"><span class="panel-title">Districts Geography</span></div>
                <div class="panel-body relative" style="padding-top: 10px;padding-bottom: 46px;height: 538px;">
                    <ul class="tags-list list-unstyled" id="KittStates">
                        <?php foreach ($parish as $par) { ?>
                            <li><a onclick="selectArea(this);" data-region="<?php echo $par['region']; ?>"><?php echo $par['name']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div id="mapdiv" style="width: 75%; height: 100%;" class="hide-jzoom"></div>
                </div>              
            </div>
        </div>        

    </div>
    <div class="row">
        <div class="col-lg-4 admin-grid">           
            <div id="p10" class="panel panel-blue tags-wrapper">
                <div class="panel-heading"><span class="panel-title">Animal by Districts</span></div>
                <div class="panel-body relative" style="padding-top: 10px; padding-bottom: 46px;height: 538px;">
                    <div id="chartdivanimal" style="width: 100%; height: 100%;"></div>
                </div>              
            </div>
        </div>  
        <div class="col-lg-4 admin-grid">

            <div id="p11" class="panel panel-blue tags-wrapper">
                <div class="panel-heading"><span class="panel-title">Illness Case by Districts</span></div>
                <div class="panel-body relative" style="padding-top: 10px;padding-bottom: 46px;height: 538px;">
                    <div id="chartdivcase" style="width: 100%; height: 100%;"></div>
                </div>              
            </div>
        </div>   
        <div class="col-lg-4 admin-grid">

            <div id="p12" class="panel panel-blue tags-wrapper">
                <div class="panel-heading"><span class="panel-title">Farm by Districts</span></div>
                <div class="panel-body relative" style="padding-top: 10px;padding-bottom: 46px;height: 538px;">
                    <div id="chartdivfarm" style="width: 100%; height: 100%;"></div>

                </div>              
            </div>
        </div>   

    </div>
    <div class="row">
        <div class="col-lg-12 admin-grid">

            <div id="p13" class="panel panel-blue tags-wrapper">
                <div class="panel-heading"><span class="panel-title">Animal Tested By Farm</span></div>
                <div class="panel-body relative" style="padding-top: 10px;padding-bottom: 46px;height: 538px;">

                    <div id="serialdivsurv" style="width:100%; height: 100%;" class="hide-jzoom"></div>
                </div>              
            </div>
        </div>        

    </div>
    <div class="row">
        <div class="col-lg-6 admin-grid">

            <div id="p14" class="panel panel-blue tags-wrapper">
                <div class="panel-heading"><span class="panel-title">Number Of Animal Imported By Species</span></div>
                <div class="panel-body relative" style="padding-top: 10px;padding-bottom: 46px;height: 538px;">

                    <div id="chartdivAnimalimport" style="width:100%; height: 100%;"></div>
                </div>              
            </div>
        </div>   
        <div class="col-lg-6 admin-grid">

            <div id="p15" class="panel panel-blue tags-wrapper">
                <div class="panel-heading"><span class="panel-title">Number Of Meat Imported By Commodity</span></div>
                <div class="panel-body relative" style="padding-top: 10px;padding-bottom: 46px;height: 538px;">

                    <div id="chartdivMeatimport" style="width:100%; height: 100%;"></div>
                </div>              
            </div>
        </div>        

    </div>
    <div class="row">
        <div class="col-lg-12 admin-grid">

            <div id="p16" class="panel panel-blue tags-wrapper">
                <div class="panel-heading"><span class="panel-title">Number Specimen Permit Issued Yearly</span></div>
                <div class="panel-body relative" style="padding-top: 10px;padding-bottom: 46px;height: 538px;">

                    <div id="chartdivissued" style="width:100%; height: 100%;"></div>
                </div>              
            </div>
        </div>        

    </div>
</div>
