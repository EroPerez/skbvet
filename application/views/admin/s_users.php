<script type="text/javascript">
    var lista_usuario;
    var idactive;
    var level_active;
    $(document).ready(function () {

        "use strict";
        // Init Theme Core
        Core.init();
        Demo.init();
        listar_user();
        /*  $('#table_user').dataTable({
         "searching": false,
         "pagingType": "full_numbers",
         });           
         */
        $('#multiselect1').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect2').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect3').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect4').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect5').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect6').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect7').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect8').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect9').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect10').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect11').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect12').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });
        $('#multiselect13').multiselect({
            buttonClass: 'multiselect dropdown-toggle btn btn-default btn-info'
        });

        $("#btnupload").click(function () {
            event.preventDefault();
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?php echo base_url() . 'index.php/auth/Mainten/do_uploads'; ?>",
                data: {"filename": $('#file').val()},
                success: function (e) {
                    // Create new Notification
                    new PNotify({
                        title: 'Notification',
                        text: e,
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
        });

    });
//function uploadphoto(){

//}
    function listar_user() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/auth/Mainten/userslist'; ?>",

            success: function (e) {
                lista_usuario = e;
                llenar_tabla();
            }
        });
    }
    $('#checkboxactive').click(function () {
        if ($('#checkboxactive').attr('checked'))
            $('#checkboxactive').removeAttr('checked').val('0');
        else
            $('#checkboxactive').attr('checked', '').val('1');
    });
    function activeid(id) {
        idactive = id;
    }
    function llenar_tabla() {
        //$('#table_user').html(" ");

        var html = "";
        for (var i = 0; i < lista_usuario.length; i++) {
            var status = "Active";
            if (lista_usuario[i].status != 1)
                status = "Disabled";
            html += "<tr>";
            html += "<td>" + lista_usuario[i].username + "</td>";
            html += "<td>" + lista_usuario[i].rolelevel + "</td>";
            html += "<td>" + status + "</td>";

            html += '<td><a  data-toggle="modal" href="#edituser" class="btn btn-primary" id="edit_user_'
                    + lista_usuario[i].username + '" onclick="edit_activeid(\''
                    + lista_usuario[i].username + '\',\'' + lista_usuario[i].rolelevel + '\')"> <i class="glyphicon glyphicon-edit">'
            '</i></a></td>';
            html += '<td><a   class="btn btn-danger" data-toggle="modal" href="#eliminaruser" onclick="activeid(\''
                    + lista_usuario[i].username + '\')"  id="delete_user_' + lista_usuario[i].username + '" > <i class="glyphicon glyphicon-trash">'
            '</i></a></td>';
            html += "</tr>";
        }

        $('#body_table').html(html);
    }

    function save_user() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/auth/Mainten/add_user'; ?>",
            data: {"username": $('#user_name').val(), "passwd": $('#password').val(), "r_passwd": $('#retry_password').val(), "role": $('#level_role').val()},
            success: function (e) {
                // Create new Notification
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
                listar_user();
            }
        });
    }
    function edit_activeid(id, level) {
        activeid(id);
        level_active = level;
        $('#edit_level_role').val(level_active);
    }
    function editar_user() {

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/auth/Mainten/edit_user'; ?>",
            data: {
                "recuser": idactive,
                "password": $('#ch_password').val(),
                "ret_password": $('#ch_retry_password').val(),
                "state": $('#checkboxactive').val(),
                "role": $('#edit_level_role').val()
            },
            success: function (e) {
                $('#edituser').modal('hide');
                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: e,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });
                $('#ch_password').val('');
                $('#ch_retry_password').val('');
                listar_user();
            }
        });
    }
    function delete_user() {
        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: "<?php echo base_url() . 'index.php/auth/Mainten/delete_user'; ?>",
            data: {"recuser": idactive},
            success: function (e) {
                $('#eliminaruser').modal('hide');

                // Create new Notification
                new PNotify({
                    title: 'Notification',
                    text: e,
                    shadow: "true",
                    opacity: "0.75",
                    // addclass: noteStack,
                    type: "success",
                    // stack: Stacks[noteStack],
                    width: "25%",
                    delay: 2400
                });
                listar_user();
            }
        });
    }
    function limpiar_addmodal() {
        $('#user_name').val('');
        $('#password').val('');
        $('#retry_password').val('');
    }
</script>    