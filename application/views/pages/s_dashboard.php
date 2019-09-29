<script type="text/javascript">
    $(document).ready(function () {
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

//        demoHighCharts.init();
//        runVectorMaps();
        $(window).trigger('resize');

    });
</script>
