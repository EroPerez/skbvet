<script type="text/javascript">
    /*FARM*/
    var lista_livestock = [];
    var lista_livestock_transf = [];
    var idactive;
    var newlivestock = true;
    var t_edit;


    $(document).ready(function () {
        "use strict";
        // Init Theme Core
        Core.init();
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });
        $('#recfarmer').val('');
        $('#recfarm').val('');
        $('#editfarmer').val('1');
        $('#edit').val('1');
        $('#page').val('0');

        /* Date picker*/
        $('#livestock_dateadd').datepicker({
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

//        $('#livestock_datebirth').datepicker({
//            dateFormat: 'yy-mm-dd',
//            numberOfMonths: 1,
//            showOn: 'both',
//            buttonText: '<i class="fa fa-calendar-o"></i>',
//            prevText: '<i class="fa fa-chevron-left"></i>',
//            nextText: '<i class="fa fa-chevron-right"></i>',
//            beforeShow: function (input, inst) {
//                var newclass = 'admin-form';
//                var themeClass = $(this).parents('.admin-form').attr('class');
//                var smartpikr = inst.dpDiv.parent();
//                if (!smartpikr.hasClass(themeClass)) {
//                    inst.dpDiv.wrap('<div class="' + themeClass + '"></div>');
//                }
//            }
//        });

        $('#livestock_datearrival').datepicker({
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

        $('#date_addfarmer').datepicker({
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

        $("input[type='radio'][name='rlivestock']").click(function (e) {
            if ($(this).val() == '2') {
                $("#livestock_contry").removeAttr('disabled');
                $("#livestock_datearrival").removeAttr('disabled');
                $("#livestock_quara_period").removeAttr('disabled');
                $("#livestock_Quarantine_unit").removeAttr('disabled');
            } else
            {
                $("#livestock_contry").attr('disabled', 'true');
                $("#livestock_datearrival").attr('disabled', 'true');
                $("#livestock_quara_period").attr('disabled', 'true');
                $("#livestock_Quarantine_unit").attr('disabled', 'true');
            }

        });
        //  forward_farmers();

<?php
if (isset($action) && $action === 'new') {
    echo 'new_farmers();';
} else if (isset($action) && $action === 'edit') {
    echo "farmer_get_by_id($recn, true);";
} else if (isset($action) && $action === 'read') {
    echo "farmer_get_by_id($recn, false);";
}
?>
    });

    /*****************TRANSACCION FARM *****************/

    function forward_farmers() {

        $('#addfarm').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/farmer_forward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                $('#recfarmer').val(Number(e.farmer[0].recn));
                $('#date_addfarmer').val(e.farmer[0].dateAdded);
                $('#recfarm').val(Number(e.farm[0].recn));
                $('#farmer_firstname').val(e.farmer[0].fName);
                $('#farmer_lastname').val(e.farmer[0].lName);
                $('#farmer_address').val(e.farmer[0].address1);
                $('#farmer_phone').val(e.farmer[0].Phone);
                $('#farmname').val(e.farm[0].farmName);
                $('#farm_location').val(e.farm[0].location);
                $("#farm_parish").val(e.district);
                $("#farm_size").val(e.size);
                $("#farm_sizeunit").val(e.sizeunits);
                $('#livestock_farm').val(e.farm[0].farmName);
                $('#livestock_farmers').val(e.farmer[0].fName);

                //Para la paginación
                $('#page').val(e.page);

                $('#editfarm').removeClass('disabled').addClass('item-active');
                $('#deletefarm').removeClass('disabled').addClass('item-active');
                listar_livestock();
                $('#livestockDetails').show();
            }
        });

    }

    function back_farmers() {
        $('#addfarm').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/farmer_backward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                $('#recfarmer').val(Number(e.farmer[0].recn));
                $('#recfarm').val(Number(e.farm[0].recn));
                $('#date_addfarmer').val(e.farmer[0].dateAdded);
                $('#farmer_firstname').val(e.farmer[0].fName);
                $('#farmer_lastname').val(e.farmer[0].lName);
                $('#farmer_address').val(e.farmer[0].address1);
                $('#farmer_phone').val(e.farmer[0].Phone);
                $('#farmname').val(e.farm[0].farmName);
                $('#farm_location').val(e.farm[0].location);
                $("#farm_parish").val(e.district);
                $("#farm_size").val(e.farm[0].size);
                $("#farm_sizeunit").val(e.sizeunits);
                $('#livestock_farm').val(e.farm[0].farmName);
                $('#livestock_farmers').val(e.farmer[0].fName);
                //Para la paginación
                $('#page').val(e.page);

                $('#editfarm').removeClass('disabled').addClass('item-active');
                $('#deletefarm').removeClass('disabled').addClass('item-active');
                listar_livestock();
                $('#livestockDetails').show();

            }
        });
    }
    function delete_farmers() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/farm_delete'; ?>",
            data: {"recn": $('#recfarmer').val()},
            success: function (e) {
                $('#delete_modal_farmers').modal('hide');
                if (e.state)
                    forward_farmers();
                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: e.delete,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "40%",
                    delay: 2400
                });


            }
        });
    }
    function new_farmers() {
        t_edit = 0;
        $('#addfarm').removeClass('disabled').addClass('item-active');
        $('#editfarm').removeClass('item-active').addClass('disabled');
        $('#deletefarm').removeClass('item-active').addClass('disabled');

        // var form_elements = $("#form_farm").find(":input");
        //$.each(form_elements,function(index,value) {
        $('#date_addfarmer').removeAttr('readonly').val('');
        $('#farmer_firstname').removeAttr('readonly').val('');
        $('#farmer_lastname').removeAttr('readonly').val('');
        $('#farmer_address').removeAttr('readonly').val('');
        $('#farmer_phone').removeAttr('readonly').val('');
        $('#farmname').removeAttr('readonly').val('');
        $('#farm_location').removeAttr('readonly').val('');
        $("#farm_parish").removeAttr('readonly').val('');
        $("#farm_size").removeAttr('readonly').val('');
        $("#farm_sizeunit").removeAttr('readonly').val('');
        $('#recfarmer').val('');
        $('#recfarm').val('');
        $('#livestock_farm').val('');
        $('#livestock_farmers').val('');
        lista_livestock = '';
        llenar_tabla();
        $('#livestockDetails').hide();
        // });
    }
    function edit_farmers() {
        t_edit = 1;
        $('#addfarm').removeClass('disabled').addClass('item-active');
        $('#editfarm').removeClass('item-active').addClass('disabled');
        $('#deletefarm').removeClass('item-active').addClass('disabled');

        $('#date_addfarmer').removeAttr('readonly');
        $('#farmer_firstname').removeAttr('readonly');
        $('#farmer_lastname').removeAttr('readonly');
        $('#farmer_address').removeAttr('readonly');
        $('#farmer_phone').removeAttr('readonly');
        $('#farmname').removeAttr('readonly');
        $('#farm_location').removeAttr('readonly');
        $("#farm_parish").removeAttr('readonly');
        $("#farm_size").removeAttr('readonly');
        $("#farm_sizeunit").removeAttr('readonly');
        $('#livestockDetails').show();
    }
    function save_farmers() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/farm_add_edit'; ?>",
            data: {
                "date_addfarmer": $('#date_addfarmer').val(),
                "farmer_firstname": $('#farmer_firstname').val(),
                "farmer_lastname": $('#farmer_lastname').val(),
                "farmer_address": $('#farmer_address').val(),
                "farmer_phone": $('#farmer_phone').val(),
                "farmname": $('#farmname').val(),
                "farm_location": $('#farm_location').val(),
                "farm_parish": $('#farm_parish').val(),
                "farm_size": $('#farm_size').val(),
                "farm_sizeunit": $('#farm_sizeunit').val(),
                "edit": t_edit,
                "recfarm": $('#recfarm').val(),
                "recfarmer": $('#recfarmer').val()
            },
            // data: {$("#form-farm").serialize(),'edit':$('#edit').val()},
            success: function (res) {

                // Create new Notification
                let message = res.state;
                if (res.success) {
                    $('#addfarm').removeClass('item-active').addClass('disabled');
                    $('#editfarm').removeClass('disabled').addClass('item-active');
                    $('#deletefarm').removeClass('disabled').addClass('item-active');
                    $('#livestockDetails').show();

                    $('#recfarmer').val(res.farmer.recn);
                    $('#recfarm').val(res.farm.recn);
                    $('#livestock_farm').val(res.farm.farmName);
                    $('#livestock_farmers').val(res.farmer.fullname);
                }
                new PNotify({
                    title: 'Notification',
                    text: message,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "40%",
                    delay: 2400
                });
            }
        });

    }
    function search_farmer() {
        $('#addfarm').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/farmer_search'; ?>",
            data: {"name": $('#search_farm').val()},
            success: function (e) {
                if (e.farmer.length > 0) {
                    $('#date_addfarmer').val(e.farmer[0].dateAdded);
                    $('#recfarmer').val(Number(e.farmer[0].recn));
                    $('#recfarm').val(Number(e.farm[0].recn));
                    $('#farmer_firstname').val(e.farmer[0].fName);
                    $('#farmer_lastname').val(e.farmer[0].lName);
                    $('#farmer_address').val(e.farmer[0].address1);
                    $('#farmer_phone').val(e.farmer[0].Phone);
                    $('#farmname').val(e.farm[0].farmName);
                    $('#farm_location').val(e.farm[0].location);
                    $("#farm_parish").val(e.district);
                    $("#farm_size").val(e.farm[0].size);
                    $("#farm_sizeunit").val(e.sizeunits);
                    $('#livestock_farm').val(e.farm[0].farmName);
                    $('#livestock_farmers').val(e.farmer[0].fName);

                    $('#editfarm').removeClass('disabled').addClass('item-active');
                    $('#deletefarm').removeClass('disabled').addClass('item-active');
                    listar_livestock();
                    $('#livestockDetails').show();
                } else {
                    new PNotify({
                        title: 'Notification',
                        text: "No farmer's information found",
                        shadow: "true",
                        opacity: "0.75",
                        // addclass: noteStack,
                        type: "success",
                        // stack: Stacks[noteStack],
                        width: "30%",
                        delay: 2400
                    });
                }
            }
        });
    }

    function farmer_get_by_id(id, is_edit = true) {
        $('#addfarm').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/farmer_get_by_id'; ?>",
            data: {"farmerRecn": id},
            success: function (e) {
                if (e.farmer.length > 0) {
                    $('#date_addfarmer').val(e.farmer[0].dateAdded);
                    $('#recfarmer').val(Number(e.farmer[0].recn));
                    $('#recfarm').val(Number(e.farm[0].recn));
                    $('#farmer_firstname').val(e.farmer[0].fName);
                    $('#farmer_lastname').val(e.farmer[0].lName);
                    $('#farmer_address').val(e.farmer[0].address1);
                    $('#farmer_phone').val(e.farmer[0].Phone);
                    $('#farmname').val(e.farm[0].farmName);
                    $('#farm_location').val(e.farm[0].location);
                    $("#farm_parish").val(e.district);
                    $("#farm_size").val(e.farm[0].size);
                    $("#farm_sizeunit").val(e.sizeunits);
                    $('#livestock_farm').val(e.farm[0].farmName);
                    $('#livestock_farmers').val(e.farmer[0].fName);
                    $('#editfarm').removeClass('disabled').addClass('item-active');
                    $('#deletefarm').removeClass('disabled').addClass('item-active');
                    listar_livestock();
                    if (is_edit) {
                        edit_farmers();
                    }
                } else {
                    new PNotify({
                        title: 'Notification',
                        text: "No farmer's information found",
                        shadow: "true",
                        opacity: "0.75",
                        // addclass: noteStack,
                        type: "success",
                        // stack: Stacks[noteStack],
                        width: "30%",
                        delay: 2400
                    });
                }
            }
        });
    }

    /* LIVESTOCK */
    $('#livestock_species').change(function (events) {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/farm/Farm/breeds_species'; ?>",
            // url:'http://localhost/ahr/index.php/farm/Farm/breeds_species',
            data: {"recn": $('#livestock_species').val()},
            success: function (e) {
                $('#livestock_breeds').html(e).fadeIn();
            }
        });
    });

    function listar_livestock() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/listar_livestock'; ?>",
            data: {"recn": $('#recfarm').val()},
            success: function (e) {
                lista_livestock = e;
                llenar_tabla();
            }
        });

    }

    function llenar_tabla() {
        $('#body_table').html(" ");
        var html = "";
        for (var i = 0; i < lista_livestock.length; i++) {
            html += "<tr>";
            html += "<td>" + lista_livestock[i].IDNO + "</td>";
            html += "<td>" + lista_livestock[i].species + "</td>";
            html += "<td>" + lista_livestock[i].breed + "</td>";
            html += "<td>" + lista_livestock[i].sex + "</td>";
            html += "<td>" + lista_livestock[i].age + "</td>";

            html += '<td><a  data-toggle="modal" href="#livestock_Modal" class="btn btn-primary" id="edit_live_'
                    + lista_livestock[i].recn + '" onclick="javascript:editar_livestock('
                    + lista_livestock[i].recn + ');"> <i class="glyphicon glyphicon-edit"></i></a></td>';
            html += '<td><a   class="btn btn-danger" data-toggle="modal" href="#eliminarlivestock" onclick="activeid('
                    + lista_livestock[i].recn + ')"  id="delete_live_' + lista_livestock[i].recn + '" > <i class="glyphicon glyphicon-trash"></i></a></td>';
            html += "</tr>";
        }

        $('#body_table').html(html);
    }
    /*listar transf */
    function listar_livestock_transf() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/listar_livestock_transf'; ?>",
            data: {"reclive": idactive},
            success: function (e) {
                lista_livestock_transf = e;
                llenar_tabla_transf();
            }
        });

    }

    /* Llenar tabla transf*/
    function llenar_tabla_transf() {
        $('#body_tranfer').html('');
        var html = '';
        for (var i = 0; i < lista_livestock_transf.length; i++) {
            html += "<tr>";
            html += "<td>" + (i + 1) + "</td>";
            html += "<td>" + lista_livestock_transf[i].fromtranf + "</td>";
            html += "<td>" + lista_livestock_transf[i].totranf + "</td>";
            html += "</tr>";
        }

        $('#body_tranfer').html(html);
    }

    function delete_livestock() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/delete_livestock'; ?>",
            data: {"reclive": idactive},
            success: function (e) {
                $('#eliminarlivestock').modal('hide');
                listar_livestock();
                res_text = "Live Stock Successfully Delete";

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

    function save_livestock() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/add_livestock'; ?>",
            data: {
                "recfarm": $('#recfarm').val(),
                "livestock_dateadd": $('#livestock_dateadd').val(),
                "livestock_id": $('#livestock_id').val(),
                "livestock_species": $('#livestock_species').val(),
                "livestock_breeds": $('#livestock_breeds').val(),
                "livestock_sex": $('#livestock_sex').val(),
                "livestock_datebirth": $('#livestock_datebirth').val(),
                "livestock_contry": $('#livestock_contry').val(),
                "rlivestock": $('#rlivestock').val(),
                "livestock_datearrival": $('#livestock_datearrival').val(),
                "livestock_quara_period": $('#livestock_quara_period').val(),
                "livestock_Quarantine_unit": $('#livestock_Quarantine_unit').val(),
                "addlivestock": newlivestock,
                "recnlivestock": idactive,
                "livestock_yearofbirth": $('#livestock_yearofbirth').val(),
            },
            success: function (e) {
                listar_livestock();
                new PNotify({
                    title: 'Notification',
                    text: "Your data has been successfully stored into the database.",
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });

            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    function editar_livestock(idlive) {
        activeid(idlive);

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/edit_livestock'; ?>",
            data: {"recnlive": idactive},
            success: function (e) {
                $('#id_illness').removeAttr('disabled');
                $('#livestock_dateadd').val(e[0].dateAdded);
                $('#livestock_id').val(e[0].IDNO);
                $('#livestock_species').val(e[0].species);
                $('#livestock_breeds').html('<option value="' + e[0].breedRecn + '">' + e[0].breed + '</option>');
                $('#livestock_sex').val(e[0].sex);
//                $('#livestock_datebirth').val(e[0].dateOfBirth);
                $('#livestock_contry').val(e[0].countryOfOrigin);
                $('#rlivestock').val(e[0].localOrOverseas);
                $('#livestock_datearrival').val(e[0].arrivalDate);
                $('#livestock_quara_period').val(e[0].quarantinePeriod);
                $('#livestock_Quarantine_unit').val(e[0].quarantinePeriodUnits);
                $('#livestock_yearofbirth').val(e[0].years);
                $('#livestock_datebirth').val(e[0].months);
            }
        });
        newlivestock = false;
        $('#body_illness').html('<tr><td>Click in Show Illness button</td></tr>');
        listar_livestock_transf();
        //$('#livestock_Modal').modal(show);

    }
    function limpiar_addmodal() {
        $('#livestock_dateadd').val('');
        $('#livestock_id').val('');
        $('#livestock_species').val('');

        $('#livestock_sex').val('');
        $('#livestock_datebirth').val('');
        $('#livestock_contry').val('');
        $('#rlivestock').val('');
        $('#livestock_datearrival').val('');
        $('#livestock_quara_period').val('');
        $('#livestock_Quarantine_unit').val('');
        $('#livestock_yearofbirth').val('');

        $('#id_illness').prop('disabled', true);
        $('#body_tranfer').html('<tr><td>No transfers...</td></tr>');
        $('#body_illness').html('<tr><td>No Illness...</td></tr>');
    }
    function activeid(id) {
        idactive = id;
    }
    function listar_illness_history(lista_illness_history) {
        $('#body_illness').html('<tr><td>No Illness...</td></tr>');
        var html = '';

        if (lista_illness_history.length > 0) {
            $('#body_illness').html('');

            for (var i = 0; i < lista_illness_history.length; i++) {
                html += "<tr>";
                html += "<td>" + lista_illness_history[i].Illness + "</td>";
                html += "<td>" + lista_illness_history[i].dateOfIllness + "</td>";
                html += "</tr>";
            }
            $('#body_illness').html(html);
        }

    }

    function show_illness() {

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/farm/Farm/illness_livestock'; ?>",
            data: {"livestockRecn": idactive},
            success: function (e) {

                listar_illness_history(e);
            }
        });


    }

</script>