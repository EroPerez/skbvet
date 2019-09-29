/**
 * Global variabless
 */
var map;

AmCharts.ready(function() {
    map = new AmCharts.AmMap();


    map.balloon.color = "#000000";

    var dataProvider = {
        mapVar: AmCharts.maps.stKittsNevisHigh,
        getAreasFromMap:true
    };

    map.dataProvider = dataProvider;

    map.areasSettings = {
        autoZoom: true,
        selectedColor: "#CC0000",
        rollOverOutlineColor: "#8AB5D1",
        color: "#8AB5D1",
        rollOverColor: "#FFFFFF"
    };

    // map.smallMap = new AmCharts.SmallMap();

    map.write("mapdiv");

});

"use strict";

var userAgent = navigator.userAgent.toLowerCase(),
    $document = $(document),
    $calendarWidget = $('#calendar-widget'),
    $widgetMap = $('#WidgetMap'),
    i = 0,
    seriesData = [{
        name: 'Phones',
        data: [5.0, 9, 17, 22, 19, 11.5, 5.2, 9.5, 11.3, 15.3, 19.9, 24.6]
    }, {
        name: 'Notebooks',
        data: [2.9, 3.2, 4.7, 5.5, 8.9, 12.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
    }, {
        name: 'Desktops',
        data: [15, 19, 22.7, 29.3, 22.0, 17.0, 23.8, 19.1, 22.1, 14.1, 11.6, 7.5]
    }, {
        name: 'Music Players',
        data: [11, 6, 5, 15, 17.0, 22.0, 30.8, 24.1, 14.1, 11.1, 9.6, 6.5]
    }],
    $taskWidget = $('div.task-widget'),
    $taskItems = $taskWidget.find('li.task-item'),
    highColors = [bgSystem, bgSuccess, bgWarning, bgPrimary],
    $pageHeader = $('.content-header').find('b'),
    $adminForm = $('.admin-form'),
    $options = $adminForm.find('.option'),
    $switches = $adminForm.find('.switch'),
    $buttons = $adminForm.find('.button'),
    $Panel = $adminForm.find('.panel'),
    $ecomChart = $('#ecommerce_chart1'),
    $formSwitherBtn = $('#form-switcher > button'),
    $formSwitherLink = $('#skin-switcher a'),
    $animationNav = $('.animation-nav'),
    $adminFormListLink = $('.admin-form-list a');

/**
 * Initialize All Scripts
 */

$document.ready(function () {

    function getSwiperHeight(object, attr) {
        var val = object.attr("data-" + attr),
            dim;

        if (!val) {
            return undefined;
        }

        dim = val.match(/(px)|(%)|(vh)$/i);

        if (dim.length) {
            switch (dim[0]) {
                case "px":
                    return parseFloat(val);
                case "vh":
                    return $(window).height() * (parseFloat(val) / 100);
                case "%":
                    return object.width() * (parseFloat(val) / 100);
            }
        } else {
            return undefined;
        }
    }

    /**
     * Init Demo JS
     */
    Demo.init();

    /**
     * Init Theme Core
     */
    Core.init();

    /**
     * Init HighCharts
     */
    // demoHighCharts.init();
    alert("It Works!")

    $(window).trigger('resize');

    /**
     * FullCalendar v2.2.3
     * @see             http://arshaw.com/fullcalendar/
     * @license         MIT license
     */
    if ($calendarWidget.length) {
        $calendarWidget.fullCalendar({
            // contentHeight: 397,
            editable: true,
            events: [{
                title: 'Sony Meeting',
                start: '2015-05-1',
                end: '2015-05-3',
                className: 'fc-event-success',
            }, {
                title: 'Conference',
                start: '2015-05-11',
                end: '2015-05-13',
                className: 'fc-event-warning'
            }, {
                title: 'Lunch Testing',
                start: '2015-05-21',
                end: '2015-05-23',
                className: 'fc-event-primary'
            },
            ],
            eventRender: function (event, element) {
                // create event tooltip using bootstrap tooltips
                $(element).attr("data-original-title", event.title);
                $(element).tooltip({
                    container: 'body',
                    delay: {
                        "show": 100,
                        "hide": 200
                    }
                });
                // create a tooltip auto close timer
                $(element).on('show.bs.tooltip', function () {
                    var autoClose = setTimeout(function () {
                        $('.tooltip').fadeOut();
                    }, 3500);
                });
            }
        });
    }

    /**
     * jQuery UI - v1.11.0
     * @see             http://jqueryui.com
     * @license         MIT license
     * @description     sortable.js, init jQuery Sortable on Task Widget
     */
    $taskWidget.sortable({
        items: $taskItems, // only init sortable on list items (not labels)
        handle: '.task-menu',
        axis: 'y',
        connectWith: ".task-list",
        update: function (event, ui) {
            var Item = ui.item;
            var ParentList = Item.parent();

            // If item is already checked move it to "current items list"
            if (ParentList.hasClass('task-current')) {
                Item.removeClass('item-checked').find('input[type="checkbox"]').prop('checked', false);
            }
            if (ParentList.hasClass('task-completed')) {
                Item.addClass('item-checked').find('input[type="checkbox"]').prop('checked', true);
            }
        }
    });

    /**
     * Highcharts JS v4.0.4
     * @see             www.highcharts.com
     * @license         www.highcharts.com/license
     * @description     Custom Functions to handle/assign list filter behavior
     */
    if ($ecomChart.length) {
        $ecomChart.highcharts({
            credits: false,
            colors: highColors,
            chart: {
                backgroundColor: 'transparent',
                className: '',
                type: 'line',
                zoomType: 'x',
                panning: true,
                panKey: 'shift',
                marginTop: 45,
                marginRight: 1,
            },
            title: {
                text: null
            },
            xAxis: {
                gridLineColor: '#EEE',
                lineColor: '#EEE',
                tickColor: '#EEE',
                categories: ['Jan', 'Feb', 'Mar', 'Apr',
                    'May', 'Jun', 'Jul', 'Aug',
                    'Sep', 'Oct', 'Nov', 'Dec'
                ]
            },
            yAxis: {
                min: 0,
                tickInterval: 5,
                gridLineColor: '#EEE',
                title: {
                    text: null,
                }
            },
            plotOptions: {
                spline: {
                    lineWidth: 3,
                },
                area: {
                    fillOpacity: 0.2
                }
            },
            legend: {
                enabled: true,
                floating: false,
                align: 'right',
                verticalAlign: 'top',
                x: -15
            },
            series: seriesData
        });
    }

    /**
     * jVectorMap version 1.2.2
     * @see         https://github.com/bjornd/jvectormap
     * @license     MIT license
     */
    if ($widgetMap.length) {
        // Data set
        var mapData = [900, 700, 350, 500];
        // Init Jvector Map
        $widgetMap.vectorMap({
            map: 'us_lcc_en',
            //regionsSelectable: true,
            backgroundColor: 'transparent',
            series: {
                markers: [{
                    attribute: 'r',
                    scale: [3, 7],
                    values: mapData
                }]
            },
            regionStyle: {
                initial: {
                    fill: '#E8E8E8'
                },
                hover: {
                    "fill-opacity": 0.3
                }
            },
            markers: [{
                latLng: [37.78, -122.41],
                name: 'San Francisco,CA'
            }, {
                latLng: [36.73, -103.98],
                name: 'Texas,TX'
            }, {
                latLng: [38.62, -90.19],
                name: 'St. Louis,MO'
            }, {
                latLng: [40.67, -73.94],
                name: 'New York City,NY'
            }],
            markerStyle: {
                initial: {
                    fill: '#a288d5',
                    stroke: '#b49ae0',
                    "fill-opacity": 1,
                    "stroke-width": 10,
                    "stroke-opacity": 0.3,
                    r: 3
                },
                hover: {
                    stroke: 'black',
                    "stroke-width": 2
                },
                selected: {
                    fill: 'blue'
                },
                selectedHover: {}
            }
        });
        // Manual code to alter the Vector map plugin to
        // allow for individual coloring of countries
        var states = ['US-CA', 'US-TX', 'US-MO', 'US-NY'],
            colors = [bgInfo, bgPrimaryLr, bgSuccessLr, bgWarningLr],
            colors2 = [bgInfo, bgPrimary, bgSuccess, bgWarning],
            $widgetMapMarker = $widgetMap.find('.jvectormap-marker');
        for (i = 0; i < states.length; i++) {
            var $mapItem =  $("#WidgetMap path[data-code=" + states[i] + "]");
            $mapItem.css({
                fill: colors[i]
            })
        }
        for (i = 0; i < $widgetMapMarker.length; i++) {
            $($widgetMapMarker[i]).css({
                fill: colors2[i],
                stroke: colors2[i]
            })
        }
    }

    // Form Switcher
    $formSwitherBtn.on('click', function() {
        var btnData = $(this).data('form-layout');
        var btnActive = $('#form-elements-pane .admin-form.active');

        // Remove any existing animations and then fade current form out
        btnActive.removeClass('slideInUp').addClass('animated fadeOutRight animated-shorter');
        // When above exit animation ends remove leftover classes and animate the new form in
        btnActive.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            btnActive.removeClass('active fadeOutRight animated-shorter');
            $('#' + btnData).addClass('active animated slideInUp animated-shorter')
        });
    });

    // Form Skin Switcher
    $formSwitherLink.on('click', function() {
        var btnData = $(this).data('form-skin');

        $('#skin-switcher a').removeClass('item-active');
        $(this).addClass('item-active')

        $adminForm.each(function(i, e) {
            var skins = 'theme-primary theme-info theme-success theme-warning theme-danger theme-alert theme-system theme-dark';
            var panelSkins = 'panel-primary panel-info panel-success panel-warning panel-danger panel-alert panel-system panel-dark';
            $(e).removeClass(skins).addClass('theme-' + btnData);
            $Panel.removeClass(panelSkins).addClass('panel-' + btnData);
            $pageHeader.removeClass().addClass('text-' + btnData);
        });

        $($options).each(function(i, e) {
            if ($(e).hasClass('block')) {
                $(e).removeClass().addClass('block mt15 option option-' + btnData);
            } else {
                $(e).removeClass().addClass('option option-' + btnData);
            }
        });
        $($switches).each(function(i, ele) {
            if ($(ele).hasClass('switch-round')) {
                if ($(ele).hasClass('block')) {
                    $(ele).removeClass().addClass('block mt15 switch switch-round switch-' + btnData);
                } else {
                    $(ele).removeClass().addClass('switch switch-round switch-' + btnData);
                }
            } else {
                if ($(ele).hasClass('block')) {
                    $(ele).removeClass().addClass('block mt15 switch switch-' + btnData);
                } else {
                    $(ele).removeClass().addClass('switch switch-' + btnData);
                }
            }
        });
        $buttons.removeClass().addClass('button btn-' + btnData);
    });

    // function was without comment, work with form widget on page admin_forms-elements.html
    setTimeout(function() {
        $adminForm.addClass('theme-primary');
        $Panel.addClass('panel-primary');
        $pageHeader.addClass('text-primary');

        $($options).each(function(i, e) {
            if ($(e).hasClass('block')) {
                $(e).removeClass().addClass('block mt15 option option-primary');
            } else {
                $(e).removeClass().addClass('option option-primary');
            }
        });
        $($switches).each(function(i, ele) {

            if ($(ele).hasClass('switch-round')) {
                if ($(ele).hasClass('block')) {
                    $(ele).removeClass().addClass('block mt15 switch switch-round switch-primary');
                } else {
                    $(ele).removeClass().addClass('switch switch-round switch-primary');
                }
            } else {
                if ($(ele).hasClass('block')) {
                    $(ele).removeClass().addClass('block mt15 switch switch-primary');
                } else {
                    $(ele).removeClass().addClass('switch switch-primary');
                }
            }
        });
        $buttons.removeClass().addClass('button btn-primary');
    }, 800);
});

        // Demo code - active navigation btns
        $animationNav.click(function() {
            $animationNav.removeClass('btn-primary').addClass('btn-default');
            $(this).addClass('btn-primary');
        });

        // Form switcher nav
        $adminFormListLink.on('click', function() {
            formSwitches.removeClass('item-active');
            $(this).addClass('item-active')

            if ($(this).attr('href') === "#contact3") {
                setTimeout(function() {
                    initialize();
                }, 100);
            }

        });


