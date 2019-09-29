<script type="text/javascript">
    var lista_illness = [];
    var lista_trans = [];
    var caseid;
    var idactive;
    var newillness = true;
    var t_edit;
    var idactive_t;
    var type;
    var newtrans = true;
    $(document).ready(function () {
        "use strict";
        // Init Theme Core
        Core.init();
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });
        $('#page').val('0');
        // Init Select2 - Basic Single
        $(".select2-single").select2();
        $('#case_datepicker6').datepicker({
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
        $('#illness_dateadd').datepicker({
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
        $('#treatment_dateadd').datepicker({
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
        $('#trans_dateadd').datepicker({
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

        $('#case_livestockid').change(function (e) {
            if (t_edit != 1) {
                var me = $(this);
                var htmlv = '';
                jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "<?php echo base_url() . 'index.php/illness/Illness/case_search_by_livestock '; ?>",
                    data: {"name": me.val()},
                    success: function (e) {
                        if (e.caseillness.length > 0) {
                            t_edit = -1;
                            $('#reccase').val(e.caseillness[0].recn)
                            $('#case_datepicker6').val(e.caseillness[0].dateOfCase);
                            $('#case_CaseNo').val(e.caseillness[0].caseNumber);
                            //$('#case_farm').val(e.caseillness[0].farmRecn);
                            // $('#case_farm').trigger('change');
                            //$('#case_livestockid').val(e.caseillness[0].livestockRecn);
                            for (var i = 0; i < e.veterinarian.length; i++) {
                                htmlv += "<option value='" + e.veterinarian[i]['recn'] + "'>" + e.veterinarian[i]['name'] + "</option>";
                            }
                            $('#case_veterinarian').html(htmlv);
                            $('#case_veterinarian').val(e.caseillness[0].vetRecn);
                            listar_illness();
                            listar_trans();
                            $('#i_bill_total').html(e.caseillness[0]['billTotal']);

                            $('#addcase').removeClass('item-active').addClass('disabled');
                            $('#editcase').removeClass('disabled').addClass('item-active');
                            $('#deletecase').removeClass('disabled').addClass('item-active');

                            $('#illnessDetails').show();
                        } else {
                            t_edit = 0;
                            $('#addcase').removeClass('disabled').addClass('item-active');
                            $('#editcase').removeClass('item-active').addClass('disabled');
                            $('#deletecase').removeClass('item-active').addClass('disabled');

                            $('#case_CaseNo').removeAttr('readonly').val('');
                            $('#case_datepicker6').removeAttr('readonly').val('');

                            $('#reccase').val('')
                            $('#case_datepicker6').val('');
                            $('#case_CaseNo').val('');
                            $('#case_veterinarian').val('');
                            jQuery.ajax({
                                type: 'POST',
                                dataType: 'html',
                                url: "<?php echo base_url() . 'index.php/illness/Illness/veterinary'; ?>",
                                success: function (e) {
                                    $('#case_veterinarian').html(e);

                                }
                            });

                            lista_illness = [];
                            llenar_tabla();
                            lista_trans = [];
                            llenar_tabla_trans();
                            $('#i_bill_total').html('');
                            $('#illnessDetails').hide();

                        }
                    },
                    error: function (e) {
                        new_case();
                    }
                });
            }
        });
        // forward_case();

<?php
if (isset($action) && $action === 'new') {
    echo 'new_case();';
} else if (isset($action) && $action === 'edit') {
    echo "case_get_by_id($recn, true);";
} else if (isset($action) && $action === 'read') {
    echo "case_get_by_id($recn, false);";
}
?>
    });
    function activeid(id) {
        idactive = id;
    }
    function forward_case() {
        var html = "", htmlv = '', htmlf = '';
        $('#addcase').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/case_forward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                //Para la paginación
                $('#page').val(e.page);
                t_edit = -1;

                caseid = Number(e.caseillness[0].recn);
                $('#reccase').val(Number(e.caseillness[0].recn));
                $('#case_CaseNo').val(e.caseillness[0].caseNumber);
                $('#case_datepicker6').val(e.caseillness[0].dateOfCase);

                for (var i = 0; i < e.farm.length; i++) {
                    htmlf += "<option value='" + e.farm[i].recn + "'>" + e.farm[i].farmName + "</option>";
                }
                $('#case_farm').html(htmlf);


                for (var i = 0; i < e.livestock.length; i++) {
                    html += "<option value='" + e.livestock[i].recn + "'>" + e.livestock[i].IDNO + "</option>";
                }
                $('#case_livestockid').html(html);
                $('#case_livestockid').val(e.caseillness[0].livestockRecn);

                for (var i = 0; i < e.veterinarian.length; i++) {
                    htmlv += "<option value='" + e.veterinarian[i]['recn'] + "'>" + e.veterinarian[i]['name'] + "</option>";
                }
                $('#case_veterinarian').html(htmlv);
                $('#case_veterinarian').val(e.caseillness[0].vetRecn);
                listar_illness();
                listar_trans();
                $('#i_bill_total').html(e.caseillness[0]['billTotal']);

                $('#editcase').removeClass('disabled').addClass('item-active');
                $('#deletecase').removeClass('disabled').addClass('item-active');

                $('#illnessDetails').show();
            }
        });

    }

    function backward_case() {
        var html = "", htmlv = '', htmlf = '';
        $('#addcase').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/case_backward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                //Para la paginación
                $('#page').val(e.page);
                t_edit = -1;

                caseid = Number(e.caseillness[0].recn);
                $('#reccase').val(Number(e.caseillness[0].recn));
                $('#case_CaseNo').val(e.caseillness[0].caseNumber);
                $('#case_datepicker6').val(e.caseillness[0].dateOfCase);

                for (var i = 0; i < e.farm.length; i++) {
                    htmlf += "<option value='" + e.farm[i].recn + "'>" + e.farm[i].farmName + "</option>";
                }
                $('#case_farm').html(htmlf);

                for (var i = 0; i < e.livestock.length; i++) {
                    html += "<option value='" + e.livestock[i].recn + "'>" + e.livestock[i].IDNO + "</option>";
                }
                $('#case_livestockid').html(html);
                $('#case_livestockid').val(e.caseillness[0].livestockRecn);

                for (var i = 0; i < e.veterinarian.length; i++) {
                    htmlv += "<option value='" + e.veterinarian[i]['recn'] + "'>" + e.veterinarian[i]['name'] + "</option>";
                }
                $('#case_veterinarian').html(htmlv);
                $('#case_veterinarian').val(e.caseillness[0].vetRecn);

                listar_illness();
                listar_trans();
                $('#i_bill_total').html(e.caseillness[0]['billTotal']);


                $('#editcase').removeClass('disabled').addClass('item-active');
                $('#deletecase').removeClass('disabled').addClass('item-active');
                $('#illnessDetails').show();
            }
        });

    }
    function new_case() {
        t_edit = 0;
        $('#addcase').removeClass('disabled').addClass('item-active');
        $('#editcase').removeClass('item-active').addClass('disabled');
        $('#deletecase').removeClass('item-active').addClass('disabled');
        $('#case_CaseNo').removeAttr('readonly').val('');
        $('#case_datepicker6').removeAttr('readonly').val('');
        caseid = -1;
        $('#reccase').val('');
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/illness/Illness/farm'; ?>",
            success: function (e) {
                $('#case_farm').html(e);

            }
        });
        $('#case_livestockid').html("");
        $('#case_farm').change(function (e) {
            jQuery.ajax({
                type: 'POST',
                dataType: 'html',
                url: "<?php echo base_url() . 'index.php/illness/Illness/livestock_for_farm'; ?>",
                data: {"recfarm": $('#case_farm').val()},
                success: function (e) {
                    $('#case_livestockid').html(e);

                }
            });

        });
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/illness/Illness/veterinary'; ?>",
            success: function (e) {
                $('#case_veterinarian').html(e);

            }
        });


        lista_illness = [];
        llenar_tabla();
        lista_trans = [];
        llenar_tabla_trans();
        $('#i_bill_total').html('');
        $('#illnessDetails').hide();
    }

    function delete_case() {
        $('#addcase').removeClass('item-active').addClass('disabled');
        $('#delete_modal_case').modal('hide');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/delete_case'; ?>",
            data: {"recncase": $('#reccase').val()},
            success: function (e) {
                if (e.state) {
                    forward_case();
                }
                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: e.let,
                    shadow: "true",
                    opacity: "0.95",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "30%",
                    delay: 2400
                });

            }
        });
    }
    function edit_case() {
        t_edit = 1;
        var val_f;
        var val_l;
        var val_v;
        $('#addcase').removeClass('disabled').addClass('item-active');
        $('#editcase').removeClass('item-active').addClass('disabled');
        $('#deletecase').removeClass('item-active').addClass('disabled');

        $('#case_datepicker6').removeAttr('readonly');
        $('#case_CaseNo').removeAttr('readonly');
        $('#case_farm').removeAttr('readonly');
        $('#case_livestockid').removeAttr('readonly');
        $('#case_veterinarian').removeAttr('readonly');
        val_f = $('#case_farm').val();
        val_l = $('#case_livestockid').val();
        val_v = $('#case_veterinarian').val();
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/illness/Illness/farm'; ?>",
            success: function (e) {
                $('#case_farm').html(e);
                $('#case_farm').val(val_f);

            }
        });
        $('#case_farm').change(function (e) {
            jQuery.ajax({
                type: 'POST',
                dataType: 'html',
                url: "<?php echo base_url() . 'index.php/illness/Illness/livestock_for_farm'; ?>",
                data: {"recfarm": $('#case_farm').val()},
                success: function (e) {
                    $('#case_livestockid').html(e);
                    $('#case_livestockid').val(val_l);
                }
            });

        });
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/illness/Illness/veterinary'; ?>",
            success: function (e) {
                $('#case_veterinarian').html(e);
                $('#case_veterinarian').val(val_v);

            }
        });


    }
    function save_case() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/case_add_edit'; ?>",
            data: {
                "case_datepicker6": $('#case_datepicker6').val(),
                "case_CaseNo": $('#case_CaseNo').val(),
                "case_farm": $('#case_farm').val(),
                "case_livestockid": $('#case_livestockid').val(),
                "case_veterinarian": $('#case_veterinarian').val(),
                "reccase": $('#reccase').val(),
                "billTotal": parseFloat($('#i_bill_total').val()),
                "edit": t_edit
            },
            // data: {$("#form-farm").serialize(),'edit':$('#edit').val()},
            success: function (res) {

                // Create new Notification
                t_edit = -1;
                new PNotify({
                    title: 'Notification',
                    text: res.state,
                    shadow: "true",
                    opacity: "0.90",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });
                if (res.success) {
                    $('#addcase').removeClass('item-active').addClass('disabled');
                    $('#editcase').removeClass('disabled').addClass('item-active');
                    $('#deletecase').removeClass('disabled').addClass('item-active');

                    caseid = Number(res.recn);
                    $('#reccase').val(res.recn);
                    $('#illnessDetails').show();
                }
            }
        });

    }
    function listar_illness() {

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/listar_illness'; ?>",
            data: {"recn": $('#reccase').val()},
            success: function (e) {

                lista_illness = e;
                llenar_tabla();
            }
        });

    }
    function llenar_tabla() {
        $('#body_table').html(" ");
        var html = "";
        for (var i = 0; i < lista_illness.length; i++) {
            html += "<tr>";
            html += "<td>" + $('#case_livestockid option:selected').text() + "</td>";
            html += "<td>" + lista_illness[i].dateOfIllness + "</td>";
            html += "<td>" + lista_illness[i].nameillness + "</td>";
            html += "<td>" + lista_illness[i].treatname + "</td>";


//            html += '<td><a  data-toggle="modal" href="#illness_view_Modal" class="btn btn-primary" id=view_live_'
//                    + lista_illness[i].recn + ' onclick="view_illness('
//                    + lista_illness[i].recn + ')"> <i class="glyphicon glyphicon-eye-open">'
//            '</i></a></td>';

            html += '<td><a  data-toggle="modal" href="#illness_Modal" class="btn btn-primary" id="edit_live_'
                    + lista_illness[i].recn + '" onclick="javascript:editar_illness('
                    + lista_illness[i].recn + ');"> <i class="glyphicon glyphicon-edit"></i></a></td>';
            html += '<td><a   class="btn btn-danger" data-toggle="modal" href="#eliminarillness" onclick="activeid('
                    + lista_illness[i].recn + ')"  id="delete_illness_' + lista_illness[i].recn + '"> <i class="glyphicon glyphicon-trash">'
            '</i></a></td>';
            html += "</tr>";
        }

        $('#body_table').html(html);
    }
    function editar_illness(idlive) {
        activeid(idlive);

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/edit_illness'; ?>",
            data: {"recnlive": idactive},
            success: function (e) {
                $('#sele_illness').val(e[0].recnillness);
                $('#illness_dateadd').val(e[0].dateOfIllness);
                $('#clinical_summary').val(e[0].summary);
                $('#sele_treatment').val(e[0].recntreatname);
                $('#treatment_dateadd').val(e[0].dateOfTreatment);
                $('#withdrawl_period').val(e[0].Withdrawal);
                $('#response_treatment').val(e[0].response);
            }
        });
        newillness = false;

        // $('#illness_Modal').modal(show);

    }
    function limpiar_addmodal_illness() {

        $('#sele_illness').val('');
        $('#illness_dateadd').val('');
        $('#clinical_summary').val('');
        $('#sele_treatment').val('');
        $('#treatment_dateadd').val('');
        $('#withdrawl_period').val('');
        $('#response_treatment').val('');
        //$('#illness_Modal').modal(show);
    }
    function save_illness() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/add_illness'; ?>",
            data: {

                "caseid": $('#reccase').val(),
                "illness": $('#sele_illness').val(),
                "illness_dateadd": $('#illness_dateadd').val(),
                "clinical_summary": $('#clinical_summary').val(),
                "treatment": $('#sele_treatment').val(),
                "treatment_dateadd": $('#treatment_dateadd').val(),
                "withdrawl_period": $('#withdrawl_period').val(),
                "response_treatment": $('#response_treatment').val(),
                "addillness": newillness,
                "recnillness": idactive
            },
            success: function (e) {

                listar_illness();
                new PNotify({
                    title: 'Notification',
                    text: "Illness successfully added.",
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });

            }
        });
    }
    function delete_illness() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/delete_illness'; ?>",
            data: {"reclive": idactive},
            success: function (e) {

                $('#eliminarillness').modal('hide');
                listar_illness();
                res_text = "Illness successfully deleted.";

                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: res_text,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });

            }
        });
    }
    $("input[type='radio'][name='i_transact_radio']").click(function (e) {
        if ($(this).val() == '1') {
            $("#label_trans_form").html('Date of Charge');
            type = '1';
            $('#save_trans_button').removeAttr('disabled');
        } else
        {
            $("#label_trans_form").html('Date of Payment');
            type = '2';
            $('#save_trans_button').removeAttr('disabled');
        }

    });
    function activeid_t(id) {
        idactive_t = id;
    }
    function limpiar_addmodal_trans() {
        $('#amount_trans').val('');
        $('#trans_dateadd').val('');
        $('#amount_trans').removeAttr('readonly');
        $('#trans_dateadd').removeAttr('readonly');
        $('#transaction_Modal').modal(show);
    }
    function save_transaction_bill() {

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/add_trans'; ?>",
            data: {
                "caseid": $('#reccase').val(),
                "type_trans": type,
                "amount_trans": $('#amount_trans').val(),
                "trans_dateadd": $('#trans_dateadd').val(),
                "addtrans": newtrans,
                "recntrans": idactive_t
            },
            success: function (e) {

                listar_trans();
                new PNotify({
                    title: 'Notification',
                    text: e,
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
    function listar_trans() {

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/listar_trans'; ?>",
            data: {"recn": $('#reccase').val()},
            success: function (e) {

                lista_trans = e;
                llenar_tabla_trans();
            }
        });

    }
    function llenar_tabla_trans() {

        $('#body_table_t').html(" ");
        var html = "";
        for (var i = 0; i < lista_trans.length; i++) {
            html += "<tr>";
            html += "<td>" + lista_trans[i].transactionDate + "</td>";
            if (lista_trans[i].type === '1')
                html += "<td>" + lista_trans[i].amount + "</td>";
            else
                html += "<td></td>";
            if (lista_trans[i].type === '2')
                html += "<td>" + lista_trans[i].amount + "</td>";
            else
                html += "<td></td>";
            html += "<td>" + lista_trans[i].balance + "</td>";

            /* html +='<td><a  data-toggle="modal" href="#trans_view" class="btn btn-primary" id=view_live_'
             + lista_trans[i].recn  + ' onclick="view_trans('
             + lista_trans[i].recn  + ')"> <i class="glyphicon glyphicon-eye-open">'  
             '</i></a></td>';
             */
            /*html +='<td><a  data-toggle="modal" href="#trans_Modal" class="btn btn-primary" id=edit_live_'
             + lista_trans[i].recn  + ' onclick="editar_trans('
             + lista_trans[i].recn  + ')"> <i class="glyphicon glyphicon-edit">'  
             '</i></a></td>';
             */
            html += '<td><a   class="btn btn-danger" data-toggle="modal" href="#eliminartrans" onclick="activeid_t('
                    + lista_trans[i].recn + ')"  id="delete_trans_' + lista_trans[i].recn + '" > <i class="glyphicon glyphicon-trash">'
            '</i></a></td>';
            html += "</tr>";
        }

        $('#body_table_t').html(html);
    }
    function delete_trans() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/delete_trans'; ?>",
            data: {"reclive": idactive_t},
            success: function (e) {

                $('#eliminartrans').modal('hide');
                listar_trans();
                res_text = "Transaction deleted";

                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: res_text,
                    shadow: "true",
                    opacity: "1",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });

            }
        });
    }

    function recalculate_bill() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/recalculate_bill'; ?>",
            data: {"recn": $('#reccase').val()},
            success: function (e) {
                $('#i_bill_total').html(e);

            }
        });

    }
    /* SEARCH ILLNESS */
    function search_case() {
        var html = "", htmlv = '', htmlf = '';
        $('#addcase').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/case_search'; ?>",
            data: {"name": $('#search_case').val()},
            success: function (e) {
                if (e.caseillness.length > 0) {
                    t_edit = -1;

                    $('#reccase').val(Number(e.caseillness[0].recn));
                    $('#case_CaseNo').val(e.caseillness[0].caseNumber);
                    $('#case_datepicker6').val(e.caseillness[0].dateOfCase);

                    for (var i = 0; i < e.farm.length; i++) {
                        htmlf += "<option value='" + e.farm[i].recn + "'>" + e.farm[i].farmName + "</option>";
                    }
                    $('#case_farm').html(htmlf);
                    $('#case_farm').val(e.caseillness[0].farmRecn);
                    // $('#case_farm').trigger('change');

                    for (var i = 0; i < e.livestock.length; i++) {
                        html += "<option value='" + e.livestock[i].recn + "'>" + e.livestock[i].IDNO + "</option>";
                    }
                    $('#case_livestockid').html(html);
                    $('#case_livestockid').val(e.caseillness[0].livestockRecn);

                    for (var i = 0; i < e.veterinarian.length; i++) {
                        htmlv += "<option value='" + e.veterinarian[i]['recn'] + "'>" + e.veterinarian[i]['name'] + "</option>";
                    }
                    $('#case_veterinarian').html(htmlv);
                    $('#case_veterinarian').val(e.caseillness[0].vetRecn);

                    listar_illness();
                    listar_trans();
                    $('#i_bill_total').html(e.caseillness[0]['billTotal']);

                    $('#editcase').removeClass('disabled').addClass('item-active');
                    $('#deletecase').removeClass('disabled').addClass('item-active');

                    $('#illnessDetails').show();
                } else
                {
                    new PNotify({
                        title: 'Notification',
                        text: "No Case's information found",
                        shadow: "true",
                        opacity: "0.75",
                        // addclass: noteStack,
                        type: "success",
                        // stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                }
            }
        });
    }

    function case_get_by_id(id, is_edit = true) {
        var html = "", htmlv = '', htmlf = '';
        $('#addcase').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/illness/Illness/case_get_by_id'; ?>",
            data: {"reccase": id},
            success: function (e) {
                if (e.caseillness.length > 0) {
                    t_edit = -1;

                    $('#reccase').val(Number(e.caseillness[0].recn));
                    $('#case_CaseNo').val(e.caseillness[0].caseNumber);
                    $('#case_datepicker6').val(e.caseillness[0].dateOfCase);

                    for (var i = 0; i < e.farm.length; i++) {
                        htmlf += "<option value='" + e.farm[i].recn + "'>" + e.farm[i].farmName + "</option>";
                    }
                    $('#case_farm').html(htmlf);
                    $('#case_farm').val(e.caseillness[0].farmRecn);
                    // $('#case_farm').trigger('change');

                    for (var i = 0; i < e.livestock.length; i++) {
                        html += "<option value='" + e.livestock[i].recn + "'>" + e.livestock[i].IDNO + "</option>";
                    }
                    $('#case_livestockid').html(html);
                    $('#case_livestockid').val(e.caseillness[0].livestockRecn);

                    for (var i = 0; i < e.veterinarian.length; i++) {
                        htmlv += "<option value='" + e.veterinarian[i]['recn'] + "'>" + e.veterinarian[i]['name'] + "</option>";
                    }
                    $('#case_veterinarian').html(htmlv);
                    $('#case_veterinarian').val(e.caseillness[0].vetRecn);

                    listar_illness();
                    listar_trans();
                    $('#i_bill_total').html(e.caseillness[0]['billTotal']);

                    $('#editcase').removeClass('disabled').addClass('item-active');
                    $('#deletecase').removeClass('disabled').addClass('item-active');

                    $('#illnessDetails').show();
                    if (is_edit) {
                        edit_case();
                    }
                } else
                {
                    new PNotify({
                        title: 'Notification',
                        text: "No Case's information found",
                        shadow: "true",
                        opacity: "0.75",
                        // addclass: noteStack,
                        type: "success",
                        // stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                }
            }
        });
    }

</script>