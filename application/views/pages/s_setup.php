<script type="text/javascript">
    var typebtn = 'i';
    var idactivo;
    $(document).ready(function () {
        "use strict";
        // Init Theme Core
        Core.init();
        listar_commodity();

        // commodity tap       
        $('#select_commod').val('');
        $('#select_commod').click(function () {
            var idactivo = $('#select_commod').val();
            var namecomm = $('#optcom_' + idactivo).data('commod');

            $('#commodity').val(namecomm);
            $('#commodity').attr('readonly', 'true');
            typebtn = 's';
        });


// contry tab
        $('#select_contry').click(function () {
            var idactivo = $('#select_contry').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_countries'; ?>",
                data: {"recnactivo": $('#select_contry').val()},
                success: function (e) {
                    $('#contry').val(e[0].name);
                    if (e[0].type == '1') {
                        var check_country = document.getElementById('checkbox_local');
                        check_country.checked = true;
                    } else {
                        $("#checkbox_local").removeAttr('checked');
                    }
                }
            });
            $('#contry').attr('readonly', 'true');
            $("#checkbox_local").attr('disabled', 'true');
            typebtn = 's';
        });

// Illness tab
        $('#select_illness').click(function () {
            var idactivo = $('#select_illness').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_illnessname'; ?>",
                data: {"recnactivo": $('#select_illness').val()},
                success: function (e) {
                    $('#illness').val(e[0].name);
                    $('#illness_code').val(e[0].code);
                }
            });
            $('#illness').attr('readonly', 'true');
            $('#illness_code').attr('readonly', 'true');
            typebtn = 's';
        });

        // Species-Breeds tab 

        $('#select_species').click(function () {
            var idactivo = $('#select_species').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_species'; ?>",
                data: {"recnactivo": $('#select_species').val()},
                success: function (e) {
                    $('#species').val(e[0].name);
                }
            });
            $('#species').attr('readonly', 'true');
            typebtn = 's';
        });

        $('#select_breeds').click(function () {
            var idactivo = $('#select_breeds').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_breeds'; ?>",
                data: {"recnactivo": $('#select_breeds').val()},
                success: function (e) {
                    $('#breeds').val(e[0].name);
                    $('#species_breeds').val(e[0].speciesrecn);
                }
            });
            $('#breeds').attr('readonly', 'true');
            $('#species_breeds').attr('disabled', 'true');
            typebtn = 's';
        });


        // Traders tab importer
        $('#select_traders').click(function () {
            var idactivo = $('#select_traders').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_traders'; ?>",
                data: {"recnactivo": $('#select_traders').val()},
                success: function (e) {
                    $('#traders').val(e[0].name);
                }
            });
            $('#traders').attr('readonly', 'true');
            typebtn = 's';
        });

        // Traders tab exporter
        $('#select_etraders').click(function () {
            var idactivo = $('#select_etraders').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_traders'; ?>",
                data: {"recnactivo": $('#select_etraders').val()},
                success: function (e) {
                    $('#etraders').val(e[0].name);
                }
            });
            $('#etraders').attr('readonly', 'true');
            typebtn = 's';
        });

        // Treatments tab

        $('#select_treatmentnames').click(function () {
            var idactivo = $('#select_treatmentnames').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_treatmentnames'; ?>",
                data: {"recnactivo": $('#select_treatmentnames').val()},
                success: function (e) {
                    $('#treatmentnames').val(e[0].name);
                    $('#default').val(e[0].default);
                }
            });
            $('#treatmentnames').attr('readonly', 'true');
            $('#default').attr('readonly', 'true');
            typebtn = 's';
        });

        // TESTS tab

        $('#select_testnames').click(function () {
            var idactivo = $('#select_testnames').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_testnames'; ?>",
                data: {"recnactivo": $('#select_testnames').val()},
                success: function (e) {
                    $('#testnames').val(e[0].name);
                }
            });
            $('#testnames').attr('readonly', 'true');

            typebtn = 's';
        });

        // Units tab

        $('#select_units').click(function () {
            var idactivo = $('#select_units').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_units'; ?>",
                data: {"recnactivo": $('#select_units').val()},
                success: function (e) {
                    $('#units').val(e[0].name);
                }
            });
            $('#units').attr('readonly', 'true');
            typebtn = 's';
        });

        // Veterinarians tab
        $('#select_vets').click(function () {
            var idactivo = $('#select_vets').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_Veterinarians'; ?>",
                data: {"recnactivo": $('#select_vets').val()},
                success: function (e) {
                    $('#vets').val(e[0].name);
                }
            });
            $('#vets').attr('readonly', 'true');
            typebtn = 's';
        });

        // Districts tab 
        $('#select_districts').click(function () {
            var idactivo = $('#select_districts').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_districts'; ?>",
                data: {"recnactivo": $('#select_districts').val()},
                success: function (e) {
                    $('#districts').val(e[0].name);
                    $('#districts_region').val(e[0].region);
                }
            });
            $('#districts').attr('readonly', 'true');
            typebtn = 's';
        });

        // Owners tab 
        $('#select_owners').click(function () {
            var idactivo = $('#select_owners').val();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/get_one_owners'; ?>",
                data: {"recnactivo": $('#select_owners').val()},
                success: function (e) {
                    $('#owners').val(e[0].name);
                }
            });
            $('#owners').attr('readonly', 'true');
            typebtn = 's';
        });


        /*$('#tab_owners').click(function(){
         typebtn = 'i';
         $('#owners').attr('readonly','true');
         $('#owners').val('');
         }*/

    });

    /********************************************COMMODITY**********************************************************/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    function add_commodity() {
        $('#commodity').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_commodity() {
        if (typebtn == 's') {
            $('#commodity').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_commodity() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_commodity'; ?>",
                data: {'name': $('#commodity').val(), 'recn': $('#select_commod').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_commodity();
                }
            });
            $('#commodity').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_commodity'; ?>",
                data: {'name': $('#commodity').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_commodity();
                }
            });
            $('#commodity').attr('readonly', 'true');
            $('#commodity').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_commodity() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_commodity'; ?>",
                data: {"recnactivo": $('#select_commod').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_commodity();
                }
            });
            typebtn = 'i';
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_commodity() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_commodity'; ?>",
            success: function (e) {
                $('#select_commod').html(e).fadeIn();
                $('#commodity').val('');
            }
        });
    }

    /********************************************COUNTRY**********************************************************/

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_contry() {
        $('#contry').removeAttr('readonly').val('');
        $("#checkbox_local").removeAttr('disabled');
        typebtn = 'a';
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_contry() {
        if (typebtn == 's') {
            $('#contry').removeAttr('readonly');
            $("#checkbox_local").removeAttr('disabled');
            typebtn = 'e';
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_contry() {
        var check_country = document.getElementById('checkbox_local');
        if (check_country.checked)
            check_country = 1;
        else
            check_country = 2;
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_countries'; ?>",
                data: {'name': $('#contry').val(), 'recn': $('#select_contry').val(), 'type': check_country},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_contry();
                }
            });
            $('#contry').attr('readonly', 'true');
            $("#checkbox_local").attr('disabled', 'true');
            check_country = document.getElementById('checkbox_local');
            check_country.checked = false;
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_countries'; ?>",
                data: {'name': $('#contry').val(), 'type': check_country},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_contry();
                }
            });
            $('#contry').attr('readonly', 'true');
            $('#contry').val('');
            $("#checkbox_local").attr('disabled', 'true');
            check_country = document.getElementById('checkbox_local');
            check_country.checked = false;
        }
        typebtn = 'i';
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_contry() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_countries'; ?>",
                data: {"recnactivo": $('#select_contry').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_contry();
                }
            });
            $('#contry').attr('readonly', 'true');
            $("#checkbox_local").attr('disabled', 'true');
            check_country = document.getElementById('checkbox_local');
            check_country.checked = false;
            typebtn = 'i';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    function listar_contry() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_countries'; ?>",
            success: function (e) {
                $('#select_contry').html(e).fadeIn();
                $('#contry').val('');
            }
        });
    }

    /**********************************ILLNESSNAME****************************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_illness() {
        $('#illness').removeAttr('readonly').val('');
        $('#illness_code').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_illness() {
        if (typebtn == 's') {
            $('#illness').removeAttr('readonly');
            $('#illness_code').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_illness() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_illnessname'; ?>",
                data: {'recn': $('#select_illness').val(), 'name': $('#illness').val(), 'code': $('#illness_code').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_illness();
                }
            });
            $('#illness').attr('readonly', 'true');
            $('#illness_code').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_illnessname'; ?>",
                data: {'name': $('#illness').val(), 'code': $('#illness_code').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_illness();
                }
            });
            $('#illness').attr('readonly', 'true');
            $('#illness_code').attr('readonly', 'true');
            $('#illness').val('');
            $('#illness_code').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_illness() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_illnessname'; ?>",
                data: {"recnactivo": $('#select_illness').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_illness();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_illness() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_illnessname'; ?>",
            success: function (e) {
                $('#select_illness').html(e).fadeIn();
                $('#illness').val('');
                $('#illness_code').val('');
            }
        });
    }

    /**********************************SPECIES AND BREEDS***********************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_species() {
        $('#species').removeAttr('readonly').val('');
        typebtn = 'a';
    }

    function add_breeds() {
        $('#breeds').removeAttr('readonly').val('');
        $('#species_breeds').removeAttr('disabled').val('');
        listar_species1();
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_species() {
        if (typebtn == 's') {
            $('#species').removeAttr('readonly');
            typebtn = 'e';
        }
    }

    function edit_breeds() {
        var temp = $('#species_breeds').val();
        if (typebtn == 's') {
            $('#breeds').removeAttr('readonly');
            //listar_species1();
            $('#species_breeds').removeAttr('disabled').val(temp);

            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_species() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_species'; ?>",
                data: {'recn': $('#select_species').val(), 'name': $('#species').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_species();
                }
            });
            $('#species').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_species'; ?>",
                data: {'name': $('#species').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_species();
                }
            });
            $('#species').attr('readonly', 'true');
            $('#species').val('');
        }
        typebtn = 'i';
    }

    function save_breeds() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_breeds'; ?>",
                data: {'recn': $('#select_breeds').val(), 'name': $('#breeds').val(), 'speciesrecn': $('#species_breeds').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_breeds();
                }
            });
            $('#breeds').attr('readonly', 'true');
            $('#species_breeds').removeAttr('disabled');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_breeds'; ?>",
                data: {'name': $('#breeds').val(), 'speciesrecn': $('#species_breeds').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_breeds();
                }
            });
            $('#breeds').attr('readonly', 'true');
            $('#breeds').val('');
            $('#species_breeds').removeAttr('disabled').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_species() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_species'; ?>",
                data: {"recnactivo": $('#select_species').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_species();
                }
            });
            typebtn = 'i';
        }
    }

    function delete_breeds() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_breeds'; ?>",
                data: {"recnactivo": $('#select_breeds').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_breeds();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_species() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_species'; ?>",
            success: function (e) {
                $('#select_species').html(e).fadeIn();
                $('#species').val('');
            }
        });
    }

    function listar_species1() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_species'; ?>",
            success: function (e) {
                $('#species_breeds').html(e).fadeIn();
            }
        });
    }

    function listar_breeds() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_breeds'; ?>",
            success: function (e) {
                $('#select_breeds').html(e).fadeIn();
                $('#breeds').val('');
            }
        });
    }


    /**********************************TRADERS**********************************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_traders() {
        $('#traders').removeAttr('readonly').val('');
        typebtn = 'a';
    }

    function add_etraders() {
        $('#etraders').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_traders() {
        if (typebtn == 's') {
            $('#traders').removeAttr('readonly');
            typebtn = 'e';
        }
    }

    function edit_etraders() {
        if (typebtn == 's') {
            $('#etraders').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_traders() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_traders'; ?>",
                data: {'recn': $('#select_traders').val(), 'name': $('#traders').val(), 'type': 1},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_traders();
                }
            });
            $('#traders').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_traders'; ?>",
                data: {'name': $('#traders').val(), 'type': 1},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_traders();
                }
            });
            $('#traders').attr('readonly', 'true');
            $('#traders').val('');
        }
        typebtn = 'i';
    }

    function save_etraders() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_traders'; ?>",
                data: {'recn': $('#select_etraders').val(), 'name': $('#etraders').val(), 'type': 2},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_etraders();
                }
            });
            $('#etraders').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_traders'; ?>",
                data: {'name': $('#etraders').val(), 'type': 2},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_etraders();
                }
            });
            $('#etraders').attr('readonly', 'true');
            $('#etraders').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_traders() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_traders'; ?>",
                data: {"recnactivo": $('#select_traders').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_traders();
                }
            });
            typebtn = 'i';
        }
    }

    function delete_etraders() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_traders'; ?>",
                data: {"recnactivo": $('#select_etraders').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_etraders();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_traders() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_traders'; ?>",
            data: {"type": 1},
            success: function (e) {
                $('#select_traders').html(e).fadeIn();
                $('#traders').val('');
            }
        });
    }

    function listar_etraders() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_traders'; ?>",
            data: {"type": 2},
            success: function (e) {
                $('#select_etraders').html(e).fadeIn();
                $('#etraders').val('');
            }
        });
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**********************************TREATMENTS************************************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_treatmentnames() {
        $('#treatmentnames').removeAttr('readonly').val('');
        $('#default').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_treatmentnames() {
        if (typebtn == 's') {
            $('#treatmentnames').removeAttr('readonly');
            $('#default').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_treatmentnames() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_treatmentnames'; ?>",
                data: {'recn': $('#select_treatmentnames').val(), 'name': $('#treatmentnames').val(), 'default': $('#default').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_treatmentnames();
                }
            });
            $('#treatmentnames').attr('readonly', 'true');
            $('#default').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_treatmentnames'; ?>",
                data: {'name': $('#treatmentnames').val(), 'default': $('#default').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_treatmentnames();
                }
            });
            $('#treatmentnames').attr('readonly', 'true');
            $('#default').attr('readonly', 'true');
            $('#treatmentnames').val('');
            $('#default').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_treatmentnames() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_treatmentnames'; ?>",
                data: {"recnactivo": $('#select_treatmentnames').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_treatmentnames();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_treatmentnames() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_treatmentnames'; ?>",
            success: function (e) {
                $('#select_treatmentnames').html(e).fadeIn();
                $('#treatmentnames').val('');
                $('#default').val('');
            }
        });
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**********************************TESTS************************************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_testnames() {
        $('#testnames').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_testnames() {
        if (typebtn == 's') {
            $('#testnames').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_testnames() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_testnames'; ?>",
                data: {'recn': $('#select_testnames').val(), 'name': $('#testnames').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_treatmentnames();
                }
            });
            $('#testnames').attr('readonly', 'true');

        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_testnames'; ?>",
                data: {'name': $('#testnames').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_testnames();
                }
            });
            $('#testnames').attr('readonly', 'true');
            $('#testnames').val('');

        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_testnames() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_testnames'; ?>",
                data: {"recnactivo": $('#select_testnames').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_testnames();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_testnames() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_testnames'; ?>",
            success: function (e) {
                $('#select_testnames').html(e).fadeIn();
                $('#testnames').val('');

            }
        });
    }


    /**********************************UNITS*****************************************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_units() {
        $('#units').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_units() {
        if (typebtn == 's') {
            $('#units').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_units() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_units'; ?>",
                data: {'recn': $('#select_units').val(), 'name': $('#units').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_units();
                }
            });
            $('#units').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_units'; ?>",
                data: {'name': $('#units').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_units();
                }
            });
            $('units').attr('readonly', 'true');
            $('units').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_units() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_units'; ?>",
                data: {"recnactivo": $('#select_units').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_units();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_units() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_units'; ?>",
            success: function (e) {
                $('#select_units').html(e).fadeIn();
                $('#units').val('');
            }
        });
    }

    /**********************************VETERINATIANS*********************************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_vets() {
        $('#vets').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_vets() {
        if (typebtn == 's') {
            $('#vets').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_vets() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_veterinarians'; ?>",
                data: {'recn': $('#select_vets').val(), 'name': $('#vets').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_vets();
                }
            });
            $('#vets').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_veterinarians'; ?>",
                data: {'name': $('#vets').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_vets();
                }
            });
            $('#vets').attr('readonly', 'true');
            $('#vets').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_vets() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_veterinarians'; ?>",
                data: {"recnactivo": $('#select_vets').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_vets();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_vets() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_veterinarians'; ?>",
            success: function (e) {
                $('#select_vets').html(e).fadeIn();
                $('#vets').val('');
            }
        });
    }

    /**********************************DISTRICTS************************************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_districts() {
        $('#districts').removeAttr('readonly').val('');
        $('#districts_region').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_districts() {
        if (typebtn == 's') {
            $('#districts').removeAttr('readonly');
            $('#districts_region').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_districts() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_districts'; ?>",
                data: {'recn': $('#select_districts').val(), 'name': $('#districts').val(), 'region': $('#districts_region').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_districts();
                }
            });
            $('#districts').attr('readonly', 'true');
            $('#districts_region').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_districts'; ?>",
                data: {'name': $('#districts').val(), 'region': $('#districts_region').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_districts();
                }
            });
            $('#districts').attr('readonly', 'true');
            $('#districts_region').attr('readonly', 'true');
            $('#districts').val('');
            $('#districts_region').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_districts() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_districts'; ?>",
                data: {"recnactivo": $('#select_districts').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_districts();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_districts() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_districts'; ?>",
            success: function (e) {
                $('#select_districts').html(e).fadeIn();
                $('#districts').val('');
                $('#districts_region').val('');
            }
        });
    }

    /**********************************OWNERS***************************************************************************************/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function add_owners() {
        $('#owners').removeAttr('readonly').val('');
        typebtn = 'a';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function edit_owners() {
        if (typebtn == 's') {
            $('#owners').removeAttr('readonly');
            typebtn = 'e';
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function save_owners() {
        if (typebtn == 'e') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/edit_owners'; ?>",
                data: {'recn': $('#select_owners').val(), 'name': $('#owners').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_owners();
                }
            });
            $('#owners').attr('readonly', 'true');
        }
        if (typebtn == 'a') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/add_owners'; ?>",
                data: {'name': $('#owners').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_owners();
                }
            });
            $('#owners').attr('readonly', 'true');
            $('#owners').val('');
        }
        typebtn = 'i';
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function delete_owners() {
        if (typebtn == 's') {
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/setup/Setup/delete_owners'; ?>",
                data: {"recnactivo": $('#select_owners').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e.state,
                        shadow: "true",
                        opacity: "0.75",
                        //addclass: noteStack,
                        type: "success",
                        //stack: Stacks[noteStack],
                        width: "25%",
                        delay: 2400
                    });
                    listar_owners();
                }
            });
            typebtn = 'i';
        }
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function listar_owners() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'html',
            url: "<?php echo base_url() . 'index.php/setup/Setup/listar_owners'; ?>",
            success: function (e) {
                $('#select_owners').html(e).fadeIn();
                $('#owners').val('');
            }
        });
    }

</script>