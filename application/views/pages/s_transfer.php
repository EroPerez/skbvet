<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        var val_l = '';
        // Init Theme Core
        Core.init();

        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });
        $('#transfer_dateadd').datepicker({
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
        //////////////////
        // Dual List Plugin Init
        var demo1 = $('.demo1').bootstrapDualListbox({
            nonSelectedListLabel: 'Options',
            selectedListLabel: 'Selected',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: true,
            nonSelectedFilter: ''
        });
        document.querySelector('form#demoform').addEventListener('submit', function (e) {
            e.preventDefault();
            // alert("Options Selected: " + $('.demo1').val());
            var formData = new FormData();
            var livestocks = $('.demo1').val();
            if (livestocks !== null) {
                for (var i = 0; i < livestocks.length; i++) {
                    formData.append("livestock[]", livestocks[i]);
                }
            }
            formData.append("recn_f_from", $("#farm_from").val());
            formData.append("recn_f_to", $("#farm_to").val());
            formData.append("date_transf", $("#transfer_dateadd").val());
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                url: "<?php echo base_url() . 'index.php/transfer/Transfer/save_transf'; ?>",
                data: formData,
                success: function (e) {
                    if (e.success) {
                        $('.demo1').bootstrapDualListbox('refresh', true);
                        $('#farm_from').trigger('change');
                        new PNotify({
                            title: 'Notification',
                            text: e.state,
                            shadow: "true",
                            opacity: "0.95",
                            // addclass: noteStack,
                            type: "success",
                            // stack: Stacks[noteStack],
                            width: "30%",
                            delay: 2400
                        });
                    } else {
                        new PNotify({
                            title: 'Oh No!',
                            text: e.state,
                            type: 'error',
                            shadow: "true",
                            opacity: "0.95",
                            width: "35%"
                        });
                    }
                }

            });
        });
        /////////////////
        $('#farm_from').trigger('change');
    });
    function list_livestock(idx) {

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/transfer/Transfer/livestock_by_farm'; ?>",
            data: {"recn": idx},
            success: function (e) {

                for (var i = 0; i < e.length; i++) {
                    html_l += "<option value='" + e[i].recn + "' name=" + e[i].recn + " data-name=" + e[i].IDNO + ">" + e[i].IDNO + "</option>";
                }
            }
        });
        return html_l;
    }
    // Dual List Plugin Init
    $('#farm_from').change(function () {
        $('.demo1').bootstrapDualListbox('refresh', true);

        var html_l;
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/transfer/Transfer/livestock_by_farm'; ?>",
            data: {"recn": $("#farm_from").val()},
            success: function (e) {
                html_l = "<select multiple='multiple' size='10' name='demo1' class='demo1' id='demo1'>";
                for (var i = 0; i < e.length; i++) {
                    html_l += "<option value='" + e[i].recn + "' name='" + e[i].recn + "' data-name='" + e[i].IDNO + "'>" + e[i].IDNO + "</option>";
                }
                html_l += "</select>";

                $("#mostrar").html(html_l);
                var demo1 = $('.demo1').bootstrapDualListbox({
                    nonSelectedListLabel: 'Options',
                    selectedListLabel: 'Selected',
                    preserveSelectionOnMove: 'moved',
                    moveOnSelect: true,
                    nonSelectedFilter: ''
                });
            }
        });

    });



</script>