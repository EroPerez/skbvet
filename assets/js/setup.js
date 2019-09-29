var typebtn = '';
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
    });
    //botton new


// contry tab
    $('#select_contry').val('');
    $('#select_contry').click(function () {
        $('#contry').val($('#select_contry').data('contry'));
    });



});

function delete_commodity() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'http://localhost/ahr/index.php/setup/Setup/delete_commodity',
        data: {"recnactivo": $('#select_commod').val()},
        success: function (e) {
            listar_commodity();
        }

    });

}

function listar_commodity() {

    $.ajax({
        type: 'post',
        dataType: 'html',
        url: 'http://localhost/ahr/index.php/setup/Setup/listar_commodity',

        success: function (e) {
            /*  var html;
             for(var i=0;i<e.length;i++){
             html += "<option id=optcom_"+e[i].recn+"data-commod="+e[i].name +"value="+e[i].recn.">"+e[i].name+"</option>";
             }*/
            $('#select_commod').html(e).fadeIn();
            $('#commodity').val('');
        }
    });

}
function add_commodity() {
    $('#commodity').removeAttr('readonly').val('');
    typebtn = 'a';


}
function edit_commodity() {
    $('#commodity').removeAttr('readonly');
    typebtn = 'e';
}

function save_commodity() {

    if (typebtn == 'e') {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'http://localhost/ahr/index.php/setup/Setup/edit_commodity',
            data: {'name': $('#commodity').val(), 'recn': $('#select_commod').val()},
            success: function (e) {

                listar_commodity();
            }
        });
    }
    if (typebtn == 'a') {
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'http://localhost/ahr/index.php/setup/Setup/add_commodity',
            data: {'name': $('#commodity').val()},
            success: function (e) {
                alert(e.resultado);
                listar_commodity();
            }
        });

    }
}     