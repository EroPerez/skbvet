<script type="text/javascript">

    /**********************************************IMPORTAR ANIMALES: LICENCIAS y ANIMALES**********************************************/
//Agrupa el trabajo sobre las tablas:
//tbltradeliveanimal -> Licencias.
//tbltradeliveanimaldetails -> Animales.
    /**********************************************IMPORTAR ANIMALES: LICENCIAS y ANIMALES**********************************************/

    var lista_animal = []; // Conjunto de animales asociados a una licencia.
    var surveillanceactive = -1; // -1 --> Ninguna licencia activa;
    var tradeliveanimaldetailsactive = -1; // -1 --> Ning�n animal activo;
    var c_edit; // -1 --> Sin acci�n; 0 --> Insertar; 1 --> Editar. Acciones sobre los animales.
    var t_edit; // -1 --> Sin acci�n; 0 --> Insertar; 1 --> Editar. Acciones sobre las licencias.

// Constructor de la vista.
    $(document).ready(function () {
        "use strict";
        // Init Theme Core.
        Core.init();
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });
        //Inicializar la vista surv.

        $('#surv_date').val('');
        $('#srv_test').val('');
        $('#surv_farm').val('');
        $('#surv_recn').val('');
        $('#edit').val('0');
        $('#page').val('0');
        //$('#showAnimal').hide();
        // Solo lectura.
        $("#surv_date").attr('readonly', 'true');
        $("#surv_farm").attr('readonly', 'true');
        $("#srv_test").attr('readonly', 'true');
        t_edit = -1; // -1 --> Sin acci�n;


        $('#surv_date').datepicker({
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
//        forward_surv();// Mostrar la ultima licencia.	
<?php
if (isset($action) && $action === 'new') {
    echo 'new_surv();';
} else if (isset($action) && $action === 'edit') {
    echo "surv_get_by_id($recn, true);";
} else if (isset($action) && $action === 'read') {
    echo "surv_get_by_id($recn, false);";
}
?>
    });
// Fin del constructor de la vista.

    /**********************************************LICENCE**********************************************/
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************LICENCE**********************************************/

// Funci�n para cargar la licencia anterior.
    function back_surv() {
        $('#add_surv').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/back'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                //console.log(e);
                // Limpiar la vista.
                $('#surv_date').removeAttr('readonly').val('');
                $('#surv_farm').removeAttr('readonly').val('');
                $('#srv_test').removeAttr('readonly').val('');

                // Cargar datos de la nueva licencia.
                $('#surv_recn').val(e.surveillance[0].recn);
                surveillanceactive = e.surveillance[0].recn;
                $('#surv_date').val(e.surveillance[0].dateOfSurveillance);
                $('#surv_farm').val(e.surveillance[0].farmRecn);
                $('#srv_test').val(e.surveillance[0].testRecn);

                //Para la paginación
                $('#page').val(e.page);
                // Mostrar lista de animales asociados a la nueva licencia.
                lista_animal = e.animals;
                llenar_tabla(lista_animal);
                t_edit = -1; // -1 --> Sin acci�n.


                // Solo lectura.
                $("#surv_date").attr('readonly', 'true');
                $("#surv_farm").attr('readonly', 'true');
                $("#srv_test").attr('readonly', 'true');
                $('#showAnimal').show();

                $('#add_surv').removeClass('item-active').addClass('disabled');
                $('#edit_surv').removeClass('disabled').addClass('item-active');
                $('#delete_surv').removeClass('disabled').addClass('item-active');

                $('#surv_farm').trigger('change');
            },
            error: function (e) {
                console.log(e);
            }
        });

    }
// Fin de la funci�n para cargar la licencia anterior.

    /****************************************************************************************************/

// Funci�n para cargar la licencia siguiente.
    function forward_surv() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/forward'; ?>",
            data: {"page": $('#page').val()},
            success: function (e) {
                console.log(e);
                // Limpiar la vista.
                $('#surv_date').removeAttr('readonly').val('');
                $('#surv_farm').removeAttr('readonly').val('');
                $('#srv_test').removeAttr('readonly').val('');

                // Cargar datos de la nueva licencia.
                $('#surv_recn').val(e.surveillance[0].recn); // Actualizar la surveillance activa.
                surveillanceactive = e.surveillance[0].recn;
                $('#surv_date').val(e.surveillance[0].dateOfSurveillance);
                $('#surv_farm').val(e.surveillance[0].farmRecn);
                $('#srv_test').val(e.surveillance[0].testRecn);

                //Para la paginación
                $('#page').val(e.page);
                // Mostrar lista de animales asociados a la nueva licencia.
                lista_animal = e.animals;
                llenar_tabla(lista_animal);
                t_edit = -1; // -1 --> Sin acci�n.


                // Solo lectura.
                $("#surv_date").attr('readonly', 'true');
                $("#surv_farm").attr('readonly', 'true');
                $("#srv_test").attr('readonly', 'true');
                $('#showAnimal').show();

                $('#add_surv').removeClass('item-active').addClass('disabled');
                $('#edit_surv').removeClass('disabled').addClass('item-active');
                $('#delete_surv').removeClass('disabled').addClass('item-active');

                $('#surv_farm').trigger('change');
            }
        });

    }
// Fin de la funci�n para cargar la licencia siguiente.

    /****************************************************************************************************/

// Funci�n para preparar la vista para insertar una nueva licencia.
    function new_surv() {
        // Solo lectura.	 
        $("#surv_date").prop('readonly', false);
        $("#surv_farm").prop('readonly', false);
        $("#srv_test").prop('readonly', false);
        //Preparar para insertar otra licencia
        t_edit = 0;
        lista_animal = []; // Conjunto de animales asociados a una licencia.  
        surveillanceactive = -1;
        tradeliveanimaldetailsactive = -1; // -1 --> Ning�n animal activo;
        c_edit = -1; //--> Sin acci�n; 0 --> Insertar; 1 --> Editar. Acciones sobre los animales.
        $('#surv_recn').val('');
        $('#surv_date').val('');
        $('#srv_test').val('');
        $('#surv_farm').val('');
        $('#edit').val(t_edit);
        $('#page').val('0');
        $('#body_table').html(" ");
        $('#showAnimal').hide();

        $('#edit_surv').removeClass('item-active').addClass('disabled');
        $('#delete_surv').removeClass('item-active').addClass('disabled');
        //$('#add_surv').removeClass('disabled').addClass('item-active');
    }
// Fin de la funci�n para preparar la vista para insertar una nueva licencia.

    /****************************************************************************************************/

// Funci�n para salvar los datos de la licencia. Ya sea Insertar nueva o para Actualizar.
    function save_surv() {
        create_new_id();
    }
// Fin de la funci�n para salvar los datos de la licencia. Ya sea Insertar nueva o para Actualizar.

    /****************************************************************************************************/

// Funci�n para preparar la vista para editar una licencia.
    function edit_surv() {
        t_edit = 1; // 1 --> Editar.
        $('#edit').val(t_edit);
        $('#surv_date').removeClass('disabled').addClass('active');
        // Permitir edici�n.
        $('#srv_test').removeAttr('readonly');
        $('#surv_farm').removeAttr('readonly');
        $('#srv_test').removeAttr('readonly');

        $('#edit_surv').removeClass('item-active').addClass('disabled');
        $('#delete_surv').removeClass('item-active').addClass('disabled');
        $('#add_surv').removeClass('disabled').addClass('item-active');

    }
// Fin de la funci�n para preparar la vista para editar una licencia.

    /****************************************************************************************************/

// Funci�n para eliminar una licencia.
    function delete_surv() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/delete'; ?>",
            data: {
                "recn": $('#surv_recn').val()
            },
            success: function (e) {
                $('#eliminarlicence').modal('hide'); // Cerrar vista modal.
                if (e.status)
                    forward_surv(); // Mostrar la lista actualizada de animales asociados a la licencia.
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
// Fin de la funci�n para eliminar una licencia.

    /****************************************************************************************************/

    /**********************************************ANIMALES**********************************************/
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************ANIMALES**********************************************/

    function save_tradeliveanimaldetails() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/surv_animal'; ?>",
            data: {
                "recnsrv": surveillanceactive,
                "animal_farm": $('#animal_farm').val(),
                "test_result": $('#test_result').val(),
                "edit": c_edit,
                "idedit": tradeliveanimaldetailsactive,
            },
            success: function (e) {
                listar_tradeliveanimaldetails();
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

    function editar_tradeliveanimaldetails(idlive) {
        tradeliveanimaldetailsactive = idlive;
        c_edit = 1;
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/edit_tradeliveanimaldetails'; ?>",
            data: {"recnlive": tradeliveanimaldetailsactive},
            success: function (e) {
                $('#animal_farm').val(e[0].livestockRecn);
                $('#test_result').val(e[0].testResult);

            }
        });
    }

    /****************************************************************************************************/

    function delete_tradeliveanimaldetails() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/delete_tradeliveanimaldetails'; ?>",
            data: {"recnlive": tradeliveanimaldetailsactive},
            success: function (e) {
                $('#eliminaranimal').modal('hide');
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
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/liveanimalBySurveillance'; ?>",
            data: {"recn": surveillanceactive},
            success: function (e) {
                lista_animal = e;
                llenar_tabla(lista_animal);
            }
        });
    }


    //Create new id 
    function create_new_id() {

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/create_new'; ?>",
            data: {
                "surv_farm": $('#surv_farm').val(),
                "srv_test": $('#srv_test').val(),
                "surv_date": $('#surv_date').val(),
                "recn": surveillanceactive,
                "edit": t_edit

            },
            success: function (e) {

                if (e.success) {
                    surveillanceactive = e.id;
                    $('#surv_recn').val(e.id)
                    $('#showAnimal').show();

                    $('#add_surv').removeClass('item-active').addClass('disabled');
                    $('#edit_surv').removeClass('disabled').addClass('item-active');
                    $('#delete_surv').removeClass('disabled').addClass('item-active');
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**********************************************Funciones de ayuda**********************************************/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function item_active_new() {
        if (t_edit == 0) {
            $('#add_surv').removeClass('disabled').addClass('item-active');

        } else {
            // $('#add_surv').removeClass('disabled').addClass('item-active');
            if (t_edit == -1) {
                $('#add_surv').removeClass('item-active').addClass('disabled');
                $('#showAnimal').hide();
                //surveillanceactive = -1;
                t_edit = 0;
            }

        }


    }


    $('#srv_test').change(function (events) {
        item_active_new();
    });


    $('#surv_farm').change(function (events) {
        // item_active_new();

        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/animalByFarm' ?>",
            data: {"recn": $('#surv_farm').val()},
            success: function (e) {
                $('#animal_farm').html(e).fadeIn();

            },
            error: function (e) {
                console.log(e);
            }
        });

    });


    $('#animalimp_species').change(function (events) {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/animalimp/Animalimp/breeds_species'; ?>",
            // url:'http://localhost/ahr/index.php/farm/Farm/breeds_species',
            data: {"recn": $('#animalimp_species').val()},
            success: function (e) {
                $('#animalimp_breeds').html(e).fadeIn();
            }
        });
    });
    function llenar_tabla(lista_animal) {
        $('#body_table').html(" ");
        var html = "";
        var i;
        for (i = 0; i < lista_animal.length; i++) {
            html += "<tr>";
            html += "<td>" + lista_animal[i].IDNO + "</td>";
            html += "<td>" + lista_animal[i].testResult + "</td>";
            html += '<td><a data-toggle="modal" href="#animalimp_Modal" class="btn btn-primary" id="edit_live_'
                    + lista_animal[i].recnd + '" onclick="editar_tradeliveanimaldetails('
                    + lista_animal[i].recnd + ')"> <i class="glyphicon glyphicon-edit"></i></a></td>';
            html += '<td><a class="btn btn-danger" data-toggle="modal" href="#eliminaranimal" onclick="activeid('
                    + lista_animal[i].recnd + ')"  id="delete_live_' + lista_animal[i].recnd + '"> <i class="glyphicon glyphicon-trash">'
            '</i></a></td>';
            html += "</tr>";
        }
        $('#body_table').html(html);
    }

    /****************************************************************************************************/

    function limpiar_addmodal_animal() {
        $('#recntp').val(surveillanceactive);
        $('#animal_farm').val('');
        $('#test_result').val('');

        c_edit = 0;
    }

    /****************************************************************************************************/

    function activeid(id) {
        tradeliveanimaldetailsactive = id;
    }

    /****************************************************************************************************/
    function OnFilterTime() {

        if ($('#time_filter').val() == 0) {
            $('#date_cmp').show();
            $('#year_cmp').hide();
        } else {
            $('#year_cmp').show();
            $('#date_cmp').hide();
        }

    }

    function search_surveillance() {
        $('#add_surv').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/search'; ?>",
            data: {"name": $('#surveillance_case').val()},
            success: function (e) {
                if (e.surveillance.length > 0) {
                    // Limpiar la vista.
                    $('#surv_date').removeAttr('readonly').val('');
                    $('#surv_farm').removeAttr('readonly').val('');
                    $('#srv_test').removeAttr('readonly').val('');

                    // Cargar datos de la nueva licencia.
                    $('#comimp_recn').val(Number(e.surveillance[0].recn));
                    $('#surv_date').val(e.surveillance[0].dateOfSurveillance);
                    $('#surv_farm').val(e.surveillance[0].farmRecn);
                    $('#srv_test').val(e.surveillance[0].testRecn);

                    // Mostrar lista de animales asociados a la nueva licencia.
                    lista_animal = e.animals;
                    llenar_tabla(lista_animal);
                    t_edit = -1; // -1 --> Sin acci�n.
                    surveillanceactive = e.surveillance[0].recn;

                    // Solo lectura.
                    $("#surv_date").attr('readonly', 'true');
                    $("#surv_farm").attr('readonly', 'true');
                    $("#srv_test").attr('readonly', 'true');
                    $('#showAnimal').show();
                    $('#add_surv').removeClass('item-active');
                    $('#edit_surv').addClass('item-active');
                    $('#delete_surv').addClass('item-active');

                    $('#surv_farm').trigger('change');
                    $('#edit_surv').removeClass('disabled').addClass('item-active');
                    $('#delete_surv').removeClass('disabled').addClass('item-active');
                }
            }
        });

    }

    function surv_get_by_id(id, is_edit = true) {
        $('#add_surv').removeClass('item-active').addClass('disabled');
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/surveillance/Surveillance/surv_get_by_id'; ?>",
            data: {"recn": id},
            success: function (e) {
                if (e.surveillance.length > 0) {
                    // Limpiar la vista.
                    $('#surv_date').removeAttr('readonly').val('');
                    $('#surv_farm').removeAttr('readonly').val('');
                    $('#srv_test').removeAttr('readonly').val('');

                    // Cargar datos de la nueva licencia.
                    $('#comimp_recn').val(Number(e.surveillance[0].recn));
                    $('#surv_date').val(e.surveillance[0].dateOfSurveillance);
                    $('#surv_farm').val(e.surveillance[0].farmRecn);
                    $('#srv_test').val(e.surveillance[0].testRecn);

                    // Mostrar lista de animales asociados a la nueva licencia.
                    lista_animal = e.animals;
                    llenar_tabla(lista_animal);
                    t_edit = -1; // -1 --> Sin acci�n.
                    surveillanceactive = e.surveillance[0].recn;

                    // Solo lectura.
                    $("#surv_date").attr('readonly', 'true');
                    $("#surv_farm").attr('readonly', 'true');
                    $("#srv_test").attr('readonly', 'true');
                    $('#showAnimal').show();
                    $('#add_surv').removeClass('item-active');
                    $('#edit_surv').addClass('item-active');
                    $('#delete_surv').addClass('item-active');

                    $('#surv_farm').trigger('change');
                    $('#edit_surv').removeClass('disabled').addClass('item-active');
                    $('#delete_surv').removeClass('disabled').addClass('item-active');
                    if (is_edit) {
                        edit_surv();
                    }
                }
            }
        });

    }
</script>