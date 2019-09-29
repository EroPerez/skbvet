<script type="text/javascript">


// Constructor de la vista.
    $(document).ready(function () {
        "use strict";
        // Init Theme Core.
        Core.init();
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });
        OnFilterTime();
        $('#comimp_date').datepicker({
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
            showOn: 'both',
            buttonText: '<i class="fa fa-calendar-o"></i>',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            beforeShow: function (input, inst) {
                var newclass = 'admin-form';
                var themeClass = $(this).parents('.admin-form').attr('class');
                var smartpikr = inst.dpDiv.parent();
                if (!smartpikr.hasClass(themeClass)) {
                    inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
                }
            }
        });

        $('#table_animalimp').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excelHtml5',
                'pdfHtml5',
                'print'
            ],
	    order: [],
            columnDefs: [ {
              targets  : 'no-sort',
              orderable: false
            }]


        });

        $('.dt-buttons').hide();


    });

    /****************************************************************************************************/
    function OnFilterTime()
    {

        if ($('#time_filter').val() == 0 || $('#time_filter').val() == -1) {
            $('#date_cmp').show();
            $('#year_cmp').hide();
        } else {
            $('#year_cmp').show();
            $('#date_cmp').hide();
        }

    }
    function exportExcel() {


        $(".buttons-excel").click();

    }

    function exportPDF() {

        $(".buttons-pdf").click();
    }

    function  printTable() {

        $(".buttons-print").click();
    }
</script>