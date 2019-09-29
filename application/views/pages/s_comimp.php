<script type="text/javascript">

    /**********************************************COMIMP**********************************************/
//Agrupa el trabajo sobre las tablas:///////////////////////////////////////////////////////////////
//tbltradeproducts -> Almacena las licencias////////////////////////////////////////////////////////
//tbltradeproductdetails -> Almacena los comodities relacionados////////////////////////////////////

    var lista_comodities = [];
    var lista_livestock_transf = [];
    var tradeproductsactive = -1;
    var tradeproductsdetailsactive = -1;
    var c_edit;
    var t_edit;

    $(document).ready(function () {
        "use strict";
        // Init Theme Core
        Core.init();
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });

        $('#comimp_recn').val('');
        $('#comimp_licenceNo').val('');
        $('#comimp_trader').val('');
        $('#comimp_fee').val('');
        $('#edit').val('0');
        $('#page').val('0');

        t_edit = -1;
        //$("#comimp_date").attr('readonly','true'); 
        $("#comimp_licenceNo").attr('readonly', 'true');
        $("#comimp_trader").attr('readonly', 'true');
        $("#comimp_fee").attr('readonly', 'true');

        /* Date picker*/
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
        $('#comimp_date_comm').datepicker({
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
//        back_licence();
<?php
if (isset($action) && $action === 'new') {
    echo 'new_licence();';
} else if (isset($action) && $action === 'edit') {
    echo "licence_get_by_id($recn, true);";
} else if (isset($action) && $action === 'read') {
    echo "licence_get_by_id($recn, false);";
}
?>
    });


/////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************LICENCE**********************************************/
/////////////////////////////////////////////////////////////////////////////////////////////////////

    function back_licence() {
        $('#addlicence').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/tradeproducts_backward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                $('#comimp_recn').val(Number(e.tradeproducts[0].recn));
                $('#comimp_licenceNo').val(e.tradeproducts[0].licenceNo);
                $('#comimp_date').val(e.tradeproducts[0].dateOfLicence);
                $('#comimp_trader').val(e.tradeproducts[0].FarmRecn);
                $('#comimp_fee').val(e.tradeproducts[0].fee);

                //Para la paginación
                $('#page').val(e.page);

                lista_comodities = e.tradeproductsdetails;
                llenar_tabla(lista_comodities);

                t_edit = -1;
                tradeproductsactive = $('#comimp_recn').val();

                $("#comimp_date").attr('readonly', 'true');
                $("#comimp_licenceNo").attr('readonly', 'true');
                $("#comimp_trader").attr('readonly', 'true');
                $("#comimp_fee").attr('readonly', 'true');
                $('#editlicence').removeClass('disabled').addClass('item-active');
                $('#deletelicence').removeClass('disabled').addClass('item-active');
                $('#commodityRow').show();
            }
        });
    }

    /****************************************************************************************************/

    function forward_licence() {
        $('#addlicence').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/tradeproducts_forward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                console.log(e);
                $('#comimp_recn').val(Number(e.tradeproducts[0].recn));
                $('#comimp_licenceNo').val(e.tradeproducts[0].licenceNo);
                $('#comimp_date').val(e.tradeproducts[0].dateOfLicence);
                $('#comimp_trader').val(e.tradeproducts[0].FarmRecn);
                $('#comimp_fee').val(e.tradeproducts[0].fee);

                //Para la paginación
                $('#page').val(e.page);

                $lista_comodities = e.tradeproductsdetails;
                llenar_tabla($lista_comodities);

                t_edit = -1;
                tradeproductsactive = $('#comimp_recn').val();

                $("#comimp_date").attr('readonly', 'true');
                $("#comimp_licenceNo").attr('readonly', 'true');
                $("#comimp_trader").attr('readonly', 'true');
                $("#comimp_fee").attr('readonly', 'true');
                $('#editlicence').removeClass('disabled').addClass('item-active');
                $('#deletelicence').removeClass('disabled').addClass('item-active');
                $('#commodityRow').show();
            }
        });
    }

    /****************************************************************************************************/

    function new_licence() {
        t_edit = 0;
        $('#addlicence').removeClass('disabled').addClass('item-active');
        $('#editlicence').removeClass('item-active').addClass('disabled');
        $('#deletelicence').removeClass('item-active').addClass('disabled');

        $('#comimp_licenceNo').removeAttr('readonly').val('');
        $('#comimp_date').removeAttr('readonly').val('');
        $('#comimp_trader').removeAttr('readonly').val('');
        $('#comimp_fee').removeAttr('readonly').val('');
        $('#comimp_recn').val('');
        tradeproductsactive = $('#comimp_recn').val();

        lista_comodities = '';
        llenar_tabla(lista_comodities);
        $('#commodityRow').hide();
    }

    /****************************************************************************************************/

    function save_licence() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/tradeproducts_add_edit'; ?>",
            data: {"comimp_date": $('#comimp_date').val(),
                "comimp_licenceNo": $('#comimp_licenceNo').val(),
                "comimp_trader": $('#comimp_trader').val(),
                "comimp_fee": $('#comimp_fee').val(),
                "edit": t_edit,
                "comimp_recn": $('#comimp_recn').val()},
            success: function (res) {
                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: res.state,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });
                if (res.success) {
                    $('#addlicence').removeClass('item-active').addClass('disabled');
                    $('#editlicence').removeClass('disabled').addClass('item-active');
                    $('#deletelicence').removeClass('disabled').addClass('item-active');
                    $('#comimp_recn').val(res.recn);
                    tradeproductsactive = $('#comimp_recn').val();
                    $('#commodityRow').show();
                }
            }
        });

    }

    /****************************************************************************************************/

    function edit_licence() {
        t_edit = 1;
        $('#addlicence').removeClass('disabled').addClass('item-active');
        $('#editlicence').removeClass('item-active').addClass('disabled');
        $('#deletelicence').removeClass('item-active').addClass('disabled');
        // var form_elements = $("#form_farm").find(":input");
        //$.each(form_elements,function(index,value) {
        $('#comimp_date').removeAttr('readonly');
        $('#comimp_licenceNo').removeAttr('readonly');
        $('#comimp_trader').removeAttr('readonly');
        $('#comimp_fee').removeAttr('readonly');
    } // Fin de la funci�n

    /****************************************************************************************************/

    function delete_licence() {
        //$('#eliminarlicence').modal('show');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/tradeproducts_delete'; ?>",
            data: {"comimp_recn": $('#comimp_recn').val()},
            success: function (e) {
                $('#eliminarlicence').modal('hide');
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
                if (e.success)
                    forward_licence();
            }
            //$('#eliminarlicence').modal('close');
        });

    } // Fin de la funci�n

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************tradeproductsdetails -> COMODITIES**********************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function save_tradeproductsdetails() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/add_tradeproductsdetails'; ?>",
            data: {
                "recntp": $('#recntp').val(),
                "recntpd": $('#recntpd').val(),
                "sele_comimp_contry": $('#sele_comimp_contry').val(),
                "comimp_date_comm": $('#comimp_date_comm').val(),
                "sele_comimp_comm": $('#sele_comimp_comm').val(),
                "weight_comimp": $('#weight_comimp').val(),
                "edit": c_edit
            },
            success: function (e) {
                listar_tradeproductsdetails();
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
            }
        });
    }

    /****************************************************************************************************/

    function editar_tradeproductsdetails(idlive) {
        tradeproductsdetailsactive = idlive;
        c_edit = 1;
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/edit_tradeproductsdetails'; ?>",
            data: {"recnlive": tradeproductsdetailsactive},
            success: function (e) {
                $('#recntp').val(e[0].tradeProductRecn);
                $('#sele_comimp_contry').val(e[0].country);
                $('#comimp_date_comm').val(e[0].dateOfTrade);
                $('#sele_comimp_comm').val(e[0].commodityRecn);
                $('#weight_comimp').val(e[0].weightInKG);
                $('#recntpd').val(e[0].recn);
            }
        });       
    }

    /****************************************************************************************************/

    function delete_tradeproductsdetails() {
        //tradeproductsdetailsactive = idlive;
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/delete_tradeproductsdetails'; ?>",
            data: {"recnlive": tradeproductsdetailsactive},
            success: function (e) {
                console.log(e);
                $('#eliminarcommodity').modal('hide');
                listar_tradeproductsdetails();
                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: e.message,
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

    /****************************************************************************************************/

    function listar_tradeproductsdetails() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/listar_tradeproductsdetails'; ?>",
            data: {"recn": tradeproductsactive},
            success: function (e) {
                lista_comodities = e;
                llenar_tabla(lista_comodities);
            }
        });

    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************Funciones de ayuda**********************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function llenar_tabla(lista_comodities) {
        $('#body_table').html(" ");
        var html = "";
        var i;
        for (i = 0; i < lista_comodities.length; i++) {
            html += "<tr>";
            html += "<td>" + lista_comodities[i].dateOfTrade + "</td>";
            html += "<td>" + lista_comodities[i].name + "</td>";
            html += "<td>" + lista_comodities[i].weightInKG + "</td>";
            html += "<td>" + lista_comodities[i].namep + "</td>";

            html += '<td><a  data-toggle="modal" href="#comimp_Modal" class="btn btn-primary" id="edit_live_'
                    + lista_comodities[i].recntpd + '" onclick="editar_tradeproductsdetails('
                    + lista_comodities[i].recntpd + ')"> <i class="glyphicon glyphicon-edit">'
            '</i></a></td>';
            html += '<td><a   class="btn btn-danger" data-toggle="modal" href="#eliminarcommodity" onclick = "activeid('
                    + lista_comodities[i].recntpd + ')"  id="delete_live_' + lista_comodities[i].recntpd + '" > <i class="glyphicon glyphicon-trash">'
            '</i></a></td>';
            html += "</tr>";
        }
        if (lista_comodities.length == 0)
            html = "";
        $('#body_table').html(html);
    }

    function limpiar_addmodal_commodity() {
        $('#recntp').val(tradeproductsactive);
        $('#sele_comimp_contry').val('');
        $('#comimp_date_comm').val('');
        $('#sele_comimp_comm').val('');
        $('#weight_comimp').val('');
        c_edit = 0;
    }

    function activeid(id) {
        tradeproductsdetailsactive = id;
    }
    function search_comimp() {
        $('#addlicence').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/search'; ?>",
            data: {"name": $('#search_comimp').val()},
            success: function (e) {
                if (e.tradeproducts.length > 0) {
                    console.log(e);
                    $('#comimp_recn').val(Number(e.tradeproducts[0].recn));
                    $('#comimp_licenceNo').val(e.tradeproducts[0].licenceNo);
                    $('#comimp_date').val(e.tradeproducts[0].dateOfLicence);
                    $('#comimp_trader').val(e.tradeproducts[0].FarmRecn);
                    $('#comimp_fee').val(e.tradeproducts[0].fee);

                    $lista_comodities = e.tradeproductsdetails;
                    llenar_tabla($lista_comodities);

                    t_edit = -1;
                    tradeproductsactive = $('#comimp_recn').val();

                    $("#comimp_date").attr('readonly', 'true');
                    $("#comimp_licenceNo").attr('readonly', 'true');
                    $("#comimp_trader").attr('readonly', 'true');
                    $("#comimp_fee").attr('readonly', 'true');
                    $('#editlicence').removeClass('disabled').addClass('item-active');
                    $('#deletelicence').removeClass('disabled').addClass('item-active');
                    $('#commodityRow').show();
                } else
                    $('#body_table').html(" ");
            }
        });
    }

    function licence_get_by_id(id, is_edit = true) {
        $('#addlicence').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/comimp/Comimp/licence_get_by_id'; ?>",
            data: {"LicRecn": id},
            success: function (e) {
                if (e.tradeproducts.length > 0) {
//                    console.log(e);
                    $('#comimp_recn').val(Number(e.tradeproducts[0].recn));
                    $('#comimp_licenceNo').val(e.tradeproducts[0].licenceNo);
                    $('#comimp_date').val(e.tradeproducts[0].dateOfLicence);
                    $('#comimp_trader').val(e.tradeproducts[0].FarmRecn);
                    $('#comimp_fee').val(e.tradeproducts[0].fee);

                    $lista_comodities = e.tradeproductsdetails;
                    llenar_tabla($lista_comodities);

                    t_edit = -1;
                    tradeproductsactive = $('#comimp_recn').val();

                    $("#comimp_date").attr('readonly', 'true');
                    $("#comimp_licenceNo").attr('readonly', 'true');
                    $("#comimp_trader").attr('readonly', 'true');
                    $("#comimp_fee").attr('readonly', 'true');
                    $('#editlicence').removeClass('disabled').addClass('item-active');
                    $('#deletelicence').removeClass('disabled').addClass('item-active');
                    $('#commodityRow').show();
                    if (is_edit) {
                        edit_licence();
                    }
                } else
                    $('#body_table').html(" ");
            }
        });
    }


</script>