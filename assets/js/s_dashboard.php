<!--<script type="text/javascript">
$(document).ready(function () {
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
        // Init Theme Core
        Core.init();
         // Init Demo JS
        Demo.init();
        // Init Widget Demo JS
        // demoWidgets.init();
        // Because we are using Admin Panels we use the OnFinish
        // callback to activate the demoWidgets. It's smoother if
        // when we let the panels be moved and organized before
        // filling them with content from various plugins
        // Init plugins used on this page
        // HighCharts, JvectorMap, Admin Panels
        // Init Admin Panels on widgets inside the ".admin-panels" container
      
        // demoHighCharts.init();
        runVectorMaps();
        $(window).trigger('resize');
        // Widget VectorMap
        function runVectorMaps() {
          // Jvector Map Plugin
          var runJvectorMap = function (mapLocation) {
            // Data set
            var mapData = [900, 700, 350, 500];
            // Init Jvector Map
            $('#WidgetMap').vectorMap({
              map: mapLocation || 'us_lcc_en',
              //regionsSelectable: true,
              backgroundColor: 'transparent',
              zoomOnScroll: false,
              series: {
                markers: [{
                  attribute: 'r',
                  scale: [3, 7],
                  values: mapData
                }]
              },
              regionStyle: {
                initial: {
                  fill: '#8ab5d1'
                },
                hover: {
                  fill: '#fff',
                  "fill-opacity": 1
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
              },
            });
      
            // Manual code to alter the Vector map plugin to
            // allow for individual coloring of countries
            var states = ['US-CA', 'US-TX', 'US-MO',
              'US-NY'
            ];
            var colors = ["#fff176", "#fff176", "#fff176", "#fff176"];
            var colors2 = ["#fff176", "#fff176", "#fff176", "#fff176"];
            $.each(states, function (i, e) {
              $("#qewWidgetMap path[data-code=" + e + "]").css({
                fill: colors[i]
              });
            });
            $('#WidgetMap').find('.jvectormap-marker')
                    .each(function (i, e) {
                      $(e).css({
                        fill: colors2[i],
                        stroke: colors2[i]
                      });
                    });
          }
          if ($('#WidgetMap').length) {
            runJvectorMap();
            var regionLinks = $("a[data-region]");
      
            regionLinks.on("click", function (event) {
              var $this = $(this);
              regionLinks.removeClass("active-region");
              $this.addClass("active-region");
              $('#WidgetMap').find(".jvectormap-container").remove();
              runJvectorMap($this.data("region"));
            });
          }
        }
     
});
</script>-->