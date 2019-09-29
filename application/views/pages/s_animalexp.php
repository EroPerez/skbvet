<script type="text/javascript">

    /**********************************************IMPORTAR ANIMALES: LICENCIAS y ANIMALES**********************************************/
//Agrupa el trabajo sobre las tablas:
//tbltradeliveanimal -> Licencias.
//tbltradeliveanimaldetails -> Animales.
    /**********************************************IMPORTAR ANIMALES: LICENCIAS y ANIMALES**********************************************/

    var lista_animal = [];                  // Conjunto de animales asociados a una licencia.
    var tradeliveanimalactive = -1;         // -1 --> Ninguna licencia activa;
    var tradeliveanimaldetailsactive = -1;  // -1 --> Ning�n animal activo;
    var c_edit;                             // -1 --> Sin acci�n; 0 --> Insertar; 1 --> Editar. Acciones sobre los animales.
    var t_edit;                             // -1 --> Sin acci�n; 0 --> Insertar; 1 --> Editar. Acciones sobre las licencias.

// Constructor de la vista.
    $(document).ready(function () {
        "use strict";
        // Init Theme Core.
        Core.init();
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });

        //Inicializar la vista licence.
        $('#animalimp_recn').val('');
        $('#animalimp_date').val('');
        $('#animalimp_licenceNo').val('');
        $('#animalimp_importer').val('');
        $('#animalimp_fee').val('');
        $('#animalimp_sender').val('');
        $('#animalimp_receiver').val('');
        $('#edit').val('0');
        $('#page').val('0');

        // Solo lectura.
        $("#animalimp_date").attr('readonly', 'true');
        $("#animalimp_licenceNo").attr('readonly', 'true');
        $("#animalimp_importer").attr('readonly', 'true');
        $("#animalimp_fee").attr('readonly', 'true');

        t_edit = -1; // -1 --> Sin acci�n;


        $('#animalimp_date').datepicker({
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

        $('#animalimp_dateadd').datepicker({
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
//        back_licence();// Mostrar la ultima licencia.	
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
// Fin del constructor de la vista.

    /**********************************************LICENCE**********************************************/
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************LICENCE**********************************************/

// Funci�n para cargar la licencia anterior.
    function back_licence() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/tradeliveanimal_backward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {

                // Limpiar la vista.
                $('#animalimp_licenceNo').removeAttr('readonly').val('');
                $('#animalimp_date').removeAttr('readonly').val('');
                $('#animalimp_importer').removeAttr('readonly').val('');
                $('#animalimp_fee').removeAttr('readonly').val('');

                // Cargar datos de la nueva licencia.
                $('#animalimp_recn').val(Number(e.tradeliveanimal[0].recn));
                $('#animalimp_licenceNo').val(e.tradeliveanimal[0].licenceNo);
                $('#animalimp_date').val(e.tradeliveanimal[0].dateOfLicence);
                $('#animalimp_importer').val(e.tradeliveanimal[0].farmRecn);
                $('#animalimp_fee').val(e.tradeliveanimal[0].fee);

                //Para la paginación
                $('#page').val(e.page);

                // Mostrar lista de animales asociados a la nueva licencia.
                lista_animal = e.tradeliveanimaldetails;
                llenar_tabla(lista_animal);

                t_edit = -1; // -1 --> Sin acci�n.
                tradeliveanimalactive = $('#animalimp_recn').val(); // Actualizar la licencia activa.

                // Solo lectura.
                $("#animalimp_date").attr('readonly', 'true');
                $("#animalimp_licenceNo").attr('readonly', 'true');
                $("#animalimp_importer").attr('readonly', 'true');
                $("#animalimp_fee").attr('readonly', 'true');

                $('#commodityDetails').show();

                $('#add_licence').removeClass('item-active').addClass('disabled');
                $('#deletelicence').removeClass('disabled').addClass('item-active');
                $('#edit_licence').removeClass('disabled').addClass('item-active');

            }
        });
    }
// Fin de la funci�n para cargar la licencia anterior.

    /****************************************************************************************************/

// Funci�n para cargar la licencia siguiente.
    function forward_licence() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/tradeliveanimal_forward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {

                // Limpiar la vista.
                $('#animalimp_licenceNo').removeAttr('readonly').val('');
                $('#animalimp_date').removeAttr('readonly').val('');
                $('#animalimp_importer').removeAttr('readonly').val('');
                $('#animalimp_fee').removeAttr('readonly').val('');

                // Cargar datos de la nueva licencia.
                $('#animalimp_recn').val(Number(e.tradeliveanimal[0].recn));
                $('#animalimp_licenceNo').val(e.tradeliveanimal[0].licenceNo);
                $('#animalimp_date').val(e.tradeliveanimal[0].dateOfLicence);
                $('#animalimp_importer').val(e.tradeliveanimal[0].farmRecn);
                $('#animalimp_fee').val(e.tradeliveanimal[0].fee);

                //Para la paginación
                $('#page').val(e.page);

//                console.log( $('#page').val())

                // Mostrar lista de animales asociados a la nueva licencia.
                $lista_animal = e.tradeliveanimaldetails;
                llenar_tabla($lista_animal);

                t_edit = -1; // -1 --> Sin acci�n.
                tradeliveanimalactive = $('#animalimp_recn').val(); // Actualizar la licencia activa.

                // Solo lectura.
                $("#animalimp_date").attr('readonly', 'true');
                $("#animalimp_licenceNo").attr('readonly', 'true');
                $("#animalcomimp_importer").attr('readonly', 'true');
                $("#animalimp_fee").attr('readonly', 'true');

                $('#commodityDetails').show();

                $('#add_licence').removeClass('item-active').addClass('disabled');
                $('#deletelicence').removeClass('disabled').addClass('item-active');
                $('#edit_licence').removeClass('disabled').addClass('item-active');

            }
        });
    }
// Fin de la funci�n para cargar la licencia siguiente.

    /****************************************************************************************************/

// Funci�n para preparar la vista para insertar una nueva licencia.
    function new_licence() {
        t_edit = 0; // 0 --> Insertar.
        $('#add_licence').removeClass('disabled').addClass('item-active');
        $('#deletelicence').removeClass('item-active').addClass('disabled');
        $('#edit_licence').removeClass('item-active').addClass('disabled');

        $('#commodityDetails').hide();

        // Limpiar vista y hacer componentes editables.
        $('#animalimp_licenceNo').removeAttr('readonly').val('');
        $('#animalimp_date').removeAttr('readonly').val('');
        $('#animalimp_importer').removeAttr('readonly').val('');
        $('#animalimp_fee').removeAttr('readonly').val('');
        $('#animalimp_recn').val('');

        // Limpiar lista de animales asociados.
        lista_animal = '';
        llenar_tabla(lista_animal);
    }
// Fin de la funci�n para preparar la vista para insertar una nueva licencia.

    /****************************************************************************************************/

// Funci�n para salvar los datos de la licencia. Ya sea Insertar nueva o para Actualizar.
    function save_licence() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/tradeliveanimal_add_edit'; ?>",
            data: {
                "animalimp_date": $('#animalimp_date').val(),
                "animalimp_licenceNo": $('#animalimp_licenceNo').val(),
                "animalimp_importer": $('#animalimp_importer').val(),
                "animalimp_fee": $('#animalimp_fee').val(),
                "edit": t_edit,
                "animalimp_recn": $('#animalimp_recn').val()
            },
            success: function (e) {

                // Solo lectura.
                if (e.success) {
                    $("#animalimp_date").attr('readonly', 'true');
                    $("#animalimp_licenceNo").attr('readonly', 'true');
                    $("#animalcomimp_importer").attr('readonly', 'true');
                    $("#animalimp_fee").attr('readonly', 'true');

                    tradeliveanimalactive = e.id;
                    $('#animalimp_recn').val(tradeliveanimalactive);
                    //Preparar para insertar otra licencia               
                    $('#commodityDetails').show();


                    $('#add_licence').removeClass('item-active').addClass('disabled');
                    $('#deletelicence').removeClass('disabled').addClass('item-active');
                    $('#edit_licence').removeClass('disabled').addClass('item-active');
                }

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
            }
        });
    }
// Fin de la funci�n para salvar los datos de la licencia. Ya sea Insertar nueva o para Actualizar.

    /****************************************************************************************************/

// Funci�n para preparar la vista para editar una licencia.
    function edit_licence() {
        t_edit = 1; // 1 --> Editar.
        $('#add_licence').removeClass('disabled').addClass('item-active');
        $('#deletelicence').removeClass('item-active').addClass('disabled');
        $('#edit_licence').removeClass('item-active').addClass('disabled');
        // Permitir edici�n.
        $('#animalimp_date').removeAttr('readonly');
        $('#animalimp_licenceNo').removeAttr('readonly');
        $('#animalimp_importer').removeAttr('readonly');
        $('#animalimp_fee').removeAttr('readonly');
    }
// Fin de la funci�n para preparar la vista para editar una licencia.

    /****************************************************************************************************/

// Funci�n para eliminar una licencia.
    function delete_licence() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/tradeliveanimal_delete'; ?>",
            data: {"animalimp_recn": $('#animalimp_recn').val()},
            success: function (e) {
                $('#eliminarlicence').modal('hide'); // Cerrar vista modal.
                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: e.state,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });
                if (e.success)
                    forward_licence(); // Mostrar la lista actualizada de animales asociados a la licencia. 
            }
        });

    }
// Fin de la funci�n para eliminar una licencia.

    /****************************************************************************************************/

    /**********************************************ANIMALES**********************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************ANIMALES**********************************************/

    function save_tradeliveanimaldetails() {
        var check_import = document.getElementById('animalimp_status1');
        var type_import = 0;
        if (check_import.checked == true) {
            var type_import = 1;
        } else {
            type_import = 2;
        }
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/add_tradeliveanimaldetails'; ?>",
            data: {
                "recntp": $('#recntp').val(),
                "recntpd": $('#recntpd').val(),
                "animalimp_origin": $('#animalimp_origin').val(),
                "animalimp_dateadd": $('#animalimp_dateadd').val(),
                "animalimp_status": type_import, //$('#animalimp_status').val(),
                "animalimp_species": $('#animalimp_species').val(),
                "animalimp_breeds": $('#animalimp_breeds').val(),
                "animalimp_quantity": $('#animalimp_quantity').val(),
                "animalimp_quara_period": $('#animalimp_quara_period').val(),
                "animalimp_quarantine_unit": $('#animalimp_quarantine_unit').val(),
                "animalimp_comment": $('#animalimp_comment').val(),
                "animalimp_sender": $('#animalimp_sender').val(),
                "animalimp_receiver": $('#animalimp_receiver ').val(),
                "edit": c_edit
            },
            success: function (e) {
                if (e.success)
                    listar_tradeliveanimaldetails();
                new PNotify({
                    title: 'Notification',
                    text: e.state,
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

    function editar_tradeliveanimaldetails(idlive) {
        tradeliveanimaldetailsactive = idlive;
        c_edit = 1;
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/edit_tradeliveanimaldetails'; ?>",
            data: {"recnlive": tradeliveanimaldetailsactive},
            success: function (e) {
                $('#recntp').val(e[0].tradeLiveAnimalRecn);
                $('#animalimp_origin').val(e[0].country);
                $('#animalimp_dateadd').val(e[0].dateOfTrade);
                $('#animalimp_breeds').val(e[0].nameb); //breedRecn
                $('#animalimp_species').val(e[0].names);
                //$('#animalimp_status').val(e[0].tradeStatus);
                $("input[name=animalimp_status][value=" + e[0].tradeStatus + "]").prop('checked', true);
                $('#animalimp_quantity').val(e[0].quantity);
                $('#animalimp_quara_period').val(e[0].quarantinePeriod);
                $('#animalimp_quarantine_unit').val(e[0].quarantinePeriodUnit);
                $('#animalimp_comment').val(e[0].comments);
                $('#animalimp_sender').val(e[0].consignee_of_sender);
                $('#animalimp_receiver ').val(e[0].consignee_of_receiver);
                $('#recntpd').val(e[0].recn);
                llenar_select_breeds(e[0].names);
                var select_breeds = document.getElementById('animalimp_breeds');
                select_breeds.value = 4;
                //$('#animalimp_breeds').val(3);
            }
        });
    }

    /****************************************************************************************************/

    function delete_tradeliveanimaldetails() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/delete_tradeliveanimaldetails'; ?>",
            data: {"recnlive": tradeliveanimaldetailsactive},
            success: function (e) {
                $('#eliminaranimal').modal('hide');
                if (e.success)
                    listar_tradeliveanimaldetails();
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
            }
        });
    }

    /****************************************************************************************************/

    function listar_tradeliveanimaldetails() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/listar_tradeliveanimaldetails'; ?>",
            data: {"recn": tradeliveanimalactive},
            success: function (e) {
                lista_animal = e;
                llenar_tabla(lista_animal);
            }
        });

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************Funciones de ayuda**********************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $('#animalimp_species').change(function (events) {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/breeds_species'; ?>",
            // url:'http://localhost/ahr/index.php/farm/Farm/breeds_species',
            data: {"recn": $('#animalimp_species').val()},
            success: function (e) {
                $('#animalimp_breeds').html(e).fadeIn();
            }
        });
    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////
    function llenar_select_breeds(species_recn) {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/breeds_species'; ?>",
            // url:'http://localhost/ahr/index.php/farm/Farm/breeds_species',
            data: {"recn": species_recn},
            success: function (e) {
                $('#animalimp_breeds').html(e).fadeIn();
            }
        });
    }
    ;

    function llenar_tabla(lista_animal) {
        $('#body_table').html(" ");
        var html = "";
        var i;
        for (i = 0; i < lista_animal.length; i++) {
            var tradeStatus = "New Export";
            if (lista_animal[i].tradeStatus == 2)
                tradeStatus = "Re Export";
            html += "<tr>";
            html += "<td>" + lista_animal[i].dateOfTrade + "</td>";
            html += "<td>" + tradeStatus + "</td>";
            html += "<td>" + lista_animal[i].names + " : " + lista_animal[i].nameb + "</td>";
            html += "<td>" + lista_animal[i].quantity + "</td>";
            html += "<td>" + lista_animal[i].namep + "</td>";

            html += '<td><a  data-toggle="modal" href="#animalimp_Modal" class="btn btn-primary" id="edit_live_'
                    + lista_animal[i].recntpd + '" onclick="editar_tradeliveanimaldetails('
                    + lista_animal[i].recntpd + ')"> <i class="glyphicon glyphicon-edit">'
            '</i></a></td>';
            html += '<td><a   class="btn btn-danger" data-toggle="modal" href="#eliminaranimal" onclick="activeid('
                    + lista_animal[i].recntpd + ')"  id="delete_live_' + lista_animal[i].recntpd + '"> <i class="glyphicon glyphicon-trash">'
            '</i></a></td>';
            html += "</tr>";
        }
        $('#body_table').html(html);
    }

    /****************************************************************************************************/

    function limpiar_addmodal_animal() {
        $('#recntp').val(tradeliveanimalactive);
        $('#animalimp_origin').val('');
        $('#animalimp_dateadd').val('');
        $('[name="animalimp_status"]').removeAttr('checked');
        $('#animalimp_species').val('');
        $('#animalimp_breeds').val('');
        $('#animalimp_quantity').val('');
        $('#animalimp_quara_period').val('');
        $('#animalimp_comment').val('');
        $('#animalimp_sender').val('');
        $('#animalimp_receiver ').val('');
        c_edit = 0;
    }

    /****************************************************************************************************/

    function activeid(id) {
        tradeliveanimaldetailsactive = id;
    }

    /****************************************************************************************************/

    function  search_animexp() {
        $('#addlicence').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/search'; ?>",
            data: {"name": $('#search_animexp').val()},
            success: function (e) {
                if (e.tradeliveanimal.length > 0) {
                    console.log(e);
                    // Limpiar la vista.
                    $('#animalimp_licenceNo').removeAttr('readonly').val('');
                    $('#animalimp_date').removeAttr('readonly').val('');
                    $('#animalimp_importer').removeAttr('readonly').val('');
                    $('#animalimp_fee').removeAttr('readonly').val('');

                    // Cargar datos de la nueva licencia.
                    $('#animalimp_recn').val(Number(e.tradeliveanimal[0].recn));
                    $('#animalimp_licenceNo').val(e.tradeliveanimal[0].licenceNo);
                    $('#animalimp_date').val(e.tradeliveanimal[0].dateOfLicence);
                    $('#animalimp_importer').val(e.tradeliveanimal[0].farmRecn);
                    $('#animalimp_fee').val(e.tradeliveanimal[0].fee);

                    // Mostrar lista de animales asociados a la nueva licencia.
                    lista_animal = e.tradeliveanimaldetails;
                    llenar_tabla(lista_animal);

                    t_edit = -1; // -1 --> Sin acci�n.
                    tradeliveanimalactive = $('#animalimp_recn').val(); // Actualizar la licencia activa.

                    // Solo lectura.
                    $("#animalimp_date").attr('readonly', 'true');
                    $("#animalimp_licenceNo").attr('readonly', 'true');
                    $("#animalimp_importer").attr('readonly', 'true');
                    $("#animalimp_fee").attr('readonly', 'true');

                    $('#commodityDetails').show();
                    $('#add_licence').removeClass('item-active').addClass('disabled');
                    $('#deletelicence').removeClass('disabled').addClass('item-active');
                    $('#edit_licence').removeClass('disabled').addClass('item-active');

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
            url: "<?php echo base_url() . 'index.php/animalexp/Animalexp/licence_get_by_id'; ?>",
            data: {"LicRecn": id},
            success: function (e) {

                if (e.tradeliveanimal.length > 0) {
                    console.log(e);
                    // Limpiar la vista.
                    $('#animalimp_licenceNo').removeAttr('readonly').val('');
                    $('#animalimp_date').removeAttr('readonly').val('');
                    $('#animalimp_importer').removeAttr('readonly').val('');
                    $('#animalimp_fee').removeAttr('readonly').val('');

                    // Cargar datos de la nueva licencia.
                    $('#animalimp_recn').val(Number(e.tradeliveanimal[0].recn));
                    $('#animalimp_licenceNo').val(e.tradeliveanimal[0].licenceNo);
                    $('#animalimp_date').val(e.tradeliveanimal[0].dateOfLicence);
                    $('#animalimp_importer').val(e.tradeliveanimal[0].farmRecn);
                    $('#animalimp_fee').val(e.tradeliveanimal[0].fee);

                    // Mostrar lista de animales asociados a la nueva licencia.
                    lista_animal = e.tradeliveanimaldetails;
                    llenar_tabla(lista_animal);

                    t_edit = -1; // -1 --> Sin acci�n.
                    tradeliveanimalactive = $('#animalimp_recn').val(); // Actualizar la licencia activa.

                    // Solo lectura.
                    $("#animalimp_date").attr('readonly', 'true');
                    $("#animalimp_licenceNo").attr('readonly', 'true');
                    $("#animalimp_importer").attr('readonly', 'true');
                    $("#animalimp_fee").attr('readonly', 'true');

                    $('#commodityDetails').show();
                    $('#add_licence').removeClass('item-active').addClass('disabled');
                    $('#deletelicence').removeClass('disabled').addClass('item-active');
                    $('#edit_licence').removeClass('disabled').addClass('item-active');

                    if (is_edit) {
                        edit_licence();
                    }
                }
            }
        });
    }


</script>