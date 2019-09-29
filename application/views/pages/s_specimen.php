<script type="text/javascript">
    /*SPECIMEN*/
    var idactive;

    var t_edit;

    $(document).ready(function () {
        "use strict";
        // Init Theme Core
        Core.init();
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });
        $('#specimen_recn').val('');
        $('#specimen_edit').val('1');
        $('#edit').val('1');
        $('#page').val('0');

        /* Date picker*/
        $('#date_issued_specimen').datepicker({
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
            showOn: 'both',
            buttonText: '<i class="fa fa-calendar-o"></i>',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            beforeShow: function (input, inst) {
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
            columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]


        });

        $('.dt-buttons').hide();
//        forward_specimen();
        <?php
        if (isset($action) && $action === 'new') {
            echo 'new_specimen();';
        } else if (isset($action) && $action === 'edit') {
            echo "specimen_get_by_id($recn, true);";
        } else if (isset($action) && $action === 'read') {
            echo "specimen_get_by_id($recn, false);";
        }
        ?>

    });

    /*****************TRANSACCION FARM *****************/


    function forward_specimen() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/specimen/Specimen_Permit/Specimen_Permit_forward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
//                console.log(e);
                $('#specimen_recn').val(Number(e.specimen[0].recn));
                $('#specimen_name').val(e.specimen[0].name);
                $('#specimen_sender').val(e.specimen[0].sender);
                $('#specimen_reciever').val(e.specimen[0].reciever);
                $('#sele_specimen_destination').val(e.specimen[0].destination);
                $('#specimen_weight').val(e.specimen[0].weight);
                $('#date_issued_specimen').val(e.specimen[0].dateIssued);
                $('#specimen_fee').val(e.specimen[0].fee);

                //Para la paginación
                $('#page').val(Number(e.page));

                $('#deletespecimen').removeClass('disabled').addClass('item-active');
                $('#editspecimen').removeClass('disabled').addClass('item-active');
                $('#addspecimen').removeClass('item-active').addClass('disabled');

            }
        });

    }


    function back_specimen() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/specimen/Specimen_Permit/Specimen_Permit_backward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                $('#specimen_recn').val(Number(e.specimen[0].recn));
                $('#specimen_name').val(e.specimen[0].name);
                $('#specimen_sender').val(e.specimen[0].sender);
                $('#specimen_reciever').val(e.specimen[0].reciever);
                $('#sele_specimen_destination').val(e.specimen[0].destination);
                $('#specimen_weight').val(e.specimen[0].weight);
                $('#date_issued_specimen').val(e.specimen[0].dateIssued);
                $('#specimen_fee').val(e.specimen[0].fee);

                //Para la paginación
                $('#page').val(Number(e.page));

                $('#deletespecimen').removeClass('disabled').addClass('item-active');
                $('#editspecimen').removeClass('disabled').addClass('item-active');
                $('#addspecimen').removeClass('item-active').addClass('disabled');


            }
        });
    }


    function delete_specimen() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/specimen/Specimen_Permit/Specimen_Permit_delete'; ?>",
            data: {"specimen_recn": $('#specimen_recn').val()},
            success: function (e) {
                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: e.state,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "30%",
                    delay: 2400
                });

                if (e.status)
                    forward_licence();

            }
        });

    }

    function new_specimen() {
        t_edit = 0;

        $('#addspecimen').removeClass('disabled').addClass('item-active');
        $('#deletespecimen').removeClass('item-active').addClass('disabled');
        $('#editspecimen').removeClass('item-active').addClass('disabled');

        $('#specimen_recn').val('');
        $('#specimen_name').removeAttr('readonly').val('');
        $('#specimen_sender').removeAttr('readonly').val('');
        $('#specimen_reciever').removeAttr('readonly').val('');
        $('#sele_specimen_destination').removeAttr('readonly').val('');
        $('#specimen_weight').removeAttr('readonly').val('');
        $('#date_issued_specimen').removeAttr('readonly').val('');
        $('#specimen_fee').removeAttr('readonly').val('');


    }

    function edit_specimen() {
        t_edit = 1;
        $('#addspecimen').removeClass('disabled').addClass('item-active');
        $('#deletespecimen').removeClass('item-active').addClass('disabled');
        $('#editspecimen').removeClass('item-active').addClass('disabled');

        $('#specimen_name').removeAttr('readonly');
        $('#specimen_sender').removeAttr('readonly');
        $('#specimen_reciever').removeAttr('readonly');
        $('#sele_specimen_destination').removeAttr('readonly');
        $('#specimen_weight').removeAttr('readonly');
        $('#date_issued_specimen').removeAttr('readonly');
        $('#specimen_fee').removeAttr('readonly');
    }


    function save_specimen() {

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/specimen/Specimen_Permit/Specimen_Permit_add_edit'; ?>",
            data: {
                "specimen_name": $('#specimen_name').val(),
                "specimen_sender": $('#specimen_sender').val(),
                "specimen_reciever": $('#specimen_reciever').val(),
                "sele_specimen_destination": $('#sele_specimen_destination').val(),
                "specimen_weight": $('#specimen_weight').val(),
                "date_issued_specimen": $('#date_issued_specimen').val(),
                "specimen_fee": $('#specimen_fee').val(),
                "edit": t_edit,
                "specimen_recn": $('#specimen_recn').val(),
            },
            success: function (res) {

                if (res.success) {
                    $('#specimen_recn').val(Number(res.id));
                    $('#addspecimen').removeClass('item-active').addClass('disabled');
                    $('#deletespecimen').removeClass('disabled').addClass('item-active');
                    $('#editspecimen').removeClass('disabled').addClass('item-active');
                }
                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: res.state,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "30%",
                    delay: 2400
                });
            }
        });

    }

    function search_specimen() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/specimen/Specimen_Permit/Specimen_Permit_search'; ?>",
            data: {"name": $('#search_specimen').val()},
            success: function (e) {
                if (e.specimen.length > 0) {
                    $('#specimen_recn').val(Number(e.specimen[0].recn));
                    $('#specimen_name').val(e.specimen[0].name);
                    $('#specimen_sender').val(e.specimen[0].sender);
                    $('#specimen_reciever').val(e.specimen[0].reciever);
                    $('#sele_specimen_destination').val(e.specimen[0].destination);
                    $('#specimen_weight').val(e.specimen[0].weight);
                    $('#date_issued_specimen').val(e.specimen[0].dateIssued);
                    $('#specimen_fee').val(e.specimen[0].fee);

                    $('#deletespecimen').removeClass('disabled').addClass('item-active');
                    $('#editspecimen').removeClass('disabled').addClass('item-active');
                    $('#addspecimen').removeClass('item-active').addClass('disabled');
                }
            }
        });
    }

    function specimen_get_by_id(id, is_edit = true) {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/specimen/Specimen_Permit/specimen_get_by_id'; ?>",
            data: {"recn": id},
            success: function (e) {
                if (e.specimen.length > 0) {
                    $('#specimen_recn').val(Number(e.specimen[0].recn));
                    $('#specimen_name').val(e.specimen[0].name);
                    $('#specimen_sender').val(e.specimen[0].sender);
                    $('#specimen_reciever').val(e.specimen[0].reciever);
                    $('#sele_specimen_destination').val(e.specimen[0].destination);
                    $('#specimen_weight').val(e.specimen[0].weight);
                    $('#date_issued_specimen').val(e.specimen[0].dateIssued);
                    $('#specimen_fee').val(e.specimen[0].fee);

                    $('#deletespecimen').removeClass('disabled').addClass('item-active');
                    $('#editspecimen').removeClass('disabled').addClass('item-active');
                    $('#addspecimen').removeClass('item-active').addClass('disabled');
                    if (is_edit) {
                        edit_specimen();
                    }
                }
            }
        });
    }
    function OnFilterTime() {

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