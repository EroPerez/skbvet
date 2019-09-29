<script type="text/javascript">
 /*FARM*/
/* farm script*/
var lista_livestock= [];
var lista_livestock_transf= [];
var idactive;
var newlivestock = true;


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
          $('#editfarm').val('1'); 
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
         $('#livestock_datebirth').datepicker({
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
         $('#illness_datepicker6').datepicker({
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
  $("input[type='radio'][name='rlivestock']").click(function(e){
                                                if ($(this).val() == '2'){
                                        $("#livestock_contry").removeAttr('disabled');
                                                $("#livestock_datearrival").removeAttr('disabled');
                                                $("#livestock_quara_period").removeAttr('disabled');
                                                $("#livestock_Quarantine_unit").removeAttr('disabled');
           }
           else
           {
                                                $("#livestock_contry").attr('disabled', 'true');
                                                $("#livestock_datearrival").attr('disabled', 'true');
                                                $("#livestock_quara_period").attr('disabled', 'true');
                                                $("#livestock_Quarantine_unit").attr('disabled', 'true');
           } 
            
        });

});

/*****************TRANSACCION FARM *****************/ 
 function add_farmers(type){
                                                $("#edit").val(type);
                                                $.ajax({
                                                type: 'POST',
                                                        dataType: 'json',
                                                        url:"http://localhost/ahr/index.php/farm/Farm/farm_add",
                                                        //data:{"datepicker2":datep, "farmer_firstname":firstname, "farmer_lastname":lastname},
                                                        data: $("#form-farm").serialize(),
                                                        success: function(res){

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
      } 
  });
  $('#recfarmer').val(res.idfarmer);
  $('#recfarm').val(res.idfarm);
  $('#edit').val('0');
}   


$('#livestock_species').change(function(events){
                                                                $.ajax({
                                                                type:'post',
                                                                        dataType:'html',
                                                                        url:'http://localhost/ahr/index.php/farm/Farm/breeds_species',
                                                                        data:{"recn":$('#livestock_species').val()}, 
     success: function(e){
                                                                                $('#livestock_breeds').html(e).fadeIn();
     }
  }); 
});
/*
function forward_farmers(){
                                                                                $.ajax({
                                                                                type:'post',
                                                                                        dataType:'json',
                                                                                        url:'http://localhost/ahr/index.php/farm/Farm/farmer_forward',
                                                                                        data:{"recn":$('#recfarmer').val()}, 
     success: function(e){
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
                                                                                                $("#farm_size").val(e.farm[0].size);
                                                                                                $("#farm_sizeunit").val(e.sizeunits);
                                                                                                $('#livestock_farm').val(e.farm[0].farmName);
                                                                                                $('#livestock_farmers').val(e.farmer[0].fName);
                                                                                                $('#deletefarm').removeClass('disabled');
                                                                                                listar_livestock();
     }
 });

} 
*/
function back_farmers() {
                                                                                                $.ajax({
                                                                                                type:'post',
                                                                                                        dataType:'json',
                                                                                                        url:'http://localhost/ahr/index.php/farm/Farm/farmer_backward',
                                                                                                        data:{"recn":$('#recfarmer').val()}, 
     success: function(e){
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
                                                                                                                $('#deletefarm').removeClass('disabled');
                                                                                                                listar_livestock();
     }
 });
}
function delete_farmers(){
                                                                                                                $('#delete_modal_farmers').modal('show');
                                                                                                                $.ajax({
                                                                                                                type:'post',
                                                                                                                        dataType:'json',
                                                                                                                        url:'http://localhost/ahr/index.php/farm/Farm/farm_delete',
                                                                                                                        data:{"recn":$('#recfarmer').val()}, 
     success: function(e){

     } 
   });  
}
function new_farmers(){
                                                                                                                                $('#addfarm').removeClass('disabled').addClass('active');
                                                                                                                                // var form_elements = $("#form_farm").find(":input");
                                                                                                                                //$.each(form_elements,function(index,value) {
                                                                                                                                $('#farmer_firstname').removeAttr('readonly').val('');
                                                                                                                                $('#farmer_lastname').removeAttr('readonly').val('');
                                                                                                                                $('#farmer_address').removeAttr('readonly').val('');
                                                                                                                                $('#farmer_phone').removeAttr('readonly').val('');
                                                                                                                                $('#farmname').removeAttr('readonly').val('');
                                                                                                                                $('#farm_location').removeAttr('readonly').val('');
                                                                                                                                // });
}
function edit_farmers(){
                                                                                                                                edit = '1';
                                                                                                                                $('#addfarm').removeClass('disabled').addClass('active');
                                                                                                                                // var form_elements = $("#form_farm").find(":input");
                                                                                                                                //$.each(form_elements,function(index,value) {
                                                                                                                                $('#farmer_firstname').removeAttr('readonly');
                                                                                                                                $('#farmer_lastname').removeAttr('readonly');
                                                                                                                                $('#farmer_address').removeAttr('readonly');
                                                                                                                                $('#farmer_phone').removeAttr('readonly');
                                                                                                                                $('#farmname').removeAttr('readonly');
                                                                                                                                $('#farm_location').removeAttr('readonly');
                                                                                                                                $.ajax({
                                                                                                                                type: 'POST',
                                                                                                                                        dataType: 'json',
                                                                                                                                        url:"http://localhost/ahr/index.php/farm/Farm/farm_edit",
                                                                                                                                        //data:{"datepicker2":datep, "farmer_firstname":firstname, "farmer_lastname":lastname},
                                                                                                                                        data: $("#form-farm").serialize(),
                                                                                                                                        success: function(res){

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
      } 
  });    

}
function search_farmer(){
                                                                                                                                                $.ajax({
                                                                                                                                                type:'post',
                                                                                                                                                        dataType:'json',
                                                                                                                                                        url:'http://localhost/ahr/index.php/farm/Farm/farmer_search',
                                                                                                                                                        data:{"name":$('#search').val()}, 
     success: function(e){
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
                                                                                                                                                                $('#deletefarm').removeClass('disabled');
                                                                                                                                                                listar_livestock();
     }  
  });
}
/*trabajar los radio bottom  en el modal live   
                           
    $("#rlivestock").change(function (e){
                                                                                                                                                                $("#livestock_contry").attr('disabled', 'true')

    }); */     

function listar_livestock(){
                                                                                                                                                                $.ajax({
                                                                                                                                                                type:'post',
                                                                                                                                                                        dataType:'json',
                                                                                                                                                                        url:'http://localhost/ahr/index.php/farm/Farm/listar_livestock',
                                                                                                                                                                        data:{"recn":$('#recfarm').val()}, 
   success: function (e){
                                                                                                                                                                                lista_livestock = e;
                                                                                                                                                                                llenar_tabla();
   }
 });

}

function llenar_tabla(){
                                                                                                                                                                                $('#body_table').html(" ");
                                                                                                                                                                                var html = "";
                                                                                                                                                                                for (var i = 0; i < lista_livestock.length; i++){
                                                                                                                                                                        html += "<tr>";
                                                                                                                                                                                html += "<td>" + lista_livestock[i].IDNO + "</td>";
                                                                                                                                                                                html += "<td>" + lista_livestock[i].species + "</td>";
                                                                                                                                                                                html += "<td>" + lista_livestock[i].breed + "</td>";
                                                                                                                                                                                html += "<td>" + lista_livestock[i].sex + "</td>";
                                                                                                                                                                                html += "<td>" + lista_livestock[i].age + "</td>";
                                                                                                                                                                                html += '<td><a  data-toggle="modal" href="#livestock_Modal" class="btn btn-primary" id=edit_live_'
                                                                                                                                                                                + lista_livestock[i].recn + ' onclick="editar_livestock('
                                                                                                                                                                                + lista_livestock[i].recn + ')"> <i class="glyphicon glyphicon-edit">'
                                                                                                                                                                                '</i></a></td>';
                                                                                                                                                                                html += '<td><a   class="btn btn-danger" data-toggle="modal" href="#eliminarlivestock" onclick="activeid('
                                                                                                                                                                                + lista_livestock[i].recn + ')"  id=delete_live_' + lista_livestock[i].recn + ' > <i class="glyphicon glyphicon-trash">'
                                                                                                                                                                                '</i></a></td>';
                                                                                                                                                                                html += "</tr>";
       }
       
  $('#body_table').html(html);
}
/*listar transf */
function listar_livestock_transf(){
                                                                                                                                                                                $.ajax({
                                                                                                                                                                                type:'post',
                                                                                                                                                                                        dataType:'json',
                                                                                                                                                                                        url:'http://localhost/ahr/index.php/farm/Farm/listar_livestock_transf',
                                                                                                                                                                                        data:{"reclive":idactive}, 
   success: function (e){
                                                                                                                                                                                                lista_livestock_transf = e;
                                                                                                                                                                                                llenar_tabla_transf();
   }
 });

}

/* Llenar tabla transf*/
function llenar_tabla_transf(){
                                                                                                                                                                                                $('#body_tranfer').html('');
                                                                                                                                                                                                var html = '';
                                                                                                                                                                                                for (var i = 0; i < lista_livestock_transf.length; i++){
                                                                                                                                                                                        html += "<tr>";
                                                                                                                                                                                                html += "<td>" + (i + 1) + "</td>";
                                                                                                                                                                                                html += "<td>" + lista_livestock_transf[i].fromtranf + "</td>";
                                                                                                                                                                                                html += "<td>" + lista_livestock_transf[i].totranf + "</td>";
                                                                                                                                                                                                html += "</tr>";
       }
       
  $('#body_tranfer').html(html);
}
/*----*/
function delete_livestock(){
                                                                                                                                                                                                $.ajax({
                                                                                                                                                                                                type:'post',
                                                                                                                                                                                                        dataType:'json',
                                                                                                                                                                                                        url:'http://localhost/ahr/index.php/farm/Farm/delete_livestock',
                                                                                                                                                                                                        data:{"reclive":idactive}, 
   success: function (e){
                                                                                                                                                                                                                $('#eliminarlivestock').modal('hide');
                                                                                                                                                                                                                listar_livestock();
                                                                                                                                                                                                                res_text = "ok";
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
 
function save_livestock(){
                                                                                                                                                                                                                        $.ajax({
                                                                                                                                                                                                                        type:'post',
                                                                                                                                                                                                                                dataType:'json',
                                                                                                                                                                                                                                url:'http://localhost/ahr/index.php/farm/Farm/add_livestock',
                                                                                                                                                                                                                                data:{ "recfarm":$('#recfarm').val(),
                                                                                                                                                                                                                                        "livestock_dateadd":$('#livestock_dateadd').val(),
                                                                                                                                                                                                                                        "livestock_id":$('#livestock_id').val(),
                                                                                                                                                                                                                                        "livestock_species":$('#livestock_species').val(),
                                                                                                                                                                                                                                        "livestock_breeds":$('#livestock_breeds').val(),
                                                                                                                                                                                                                                        "livestock_sex":$('#livestock_sex').val(),
                                                                                                                                                                                                                                        "livestock_datebirth":$('#livestock_datebirth').val(),
                                                                                                                                                                                                                                        "livestock_contry":$('#livestock_contry').val(),
                                                                                                                                                                                                                                        "rlivestock":$('#rlivestock').val(),
                                                                                                                                                                                                                                        "livestock_datearrival": $('#livestock_datearrival').val(),
                                                                                                                                                                                                                                        "livestock_quara_period":$('#livestock_quara_period').val(),
                                                                                                                                                                                                                                        "livestock_Quarantine_unit": $('#livestock_Quarantine_unit').val(),
                                                                                                                                                                                                                                        "addlivestock":newlivestock,
                                                                                                                                                                                                                                        "recnlivestock":idactive }, 
     success: function (e){
                                                                                                                                                                                                                                        listar_livestock();
                                                                                                                                                                                                                                        new PNotify({
                                                                                                                                                                                                                                        title: 'Notification',
                                                                                                                                                                                                                                                text: "ok",
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

function editar_livestock(idlive){
                                                                                                                                                                                                                                                activeid(idlive);
                                                                                                                                                                                                                                                $.ajax({
                                                                                                                                                                                                                                                type:'post',
                                                                                                                                                                                                                                                        dataType:'json',
                                                                                                                                                                                                                                                        url:'http://localhost/ahr/index.php/farm/Farm/edit_livestock',
                                                                                                                                                                                                                                                        data:{"recnlive":idactive}, 
     success: function(e){

                                                                                                                                                                                                                                                                $('#livestock_dateadd').val(e[0].dateAdded);
                                                                                                                                                                                                                                                                $('#livestock_id').val(e[0].IDNO);
                                                                                                                                                                                                                                                                $('#livestock_species').val(e[0].species);
                                                                                                                                                                                                                                                                $('#livestock_breeds').html('<option value="' + e[0].breedRecn + '">' + e[0].breed + '</option>');
                                                                                                                                                                                                                                                                $('#livestock_sex').val(e[0].sex);
                                                                                                                                                                                                                                                                $('#livestock_datebirth').val(e[0].dateOfBirth);
                                                                                                                                                                                                                                                                $('#livestock_contry').val(e[0].countryOfOrigin);
                                                                                                                                                                                                                                                                $('#rlivestock').val(e[0].localOrOverseas);
                                                                                                                                                                                                                                                                $('#livestock_datearrival').val(e[0].arrivalDate);
                                                                                                                                                                                                                                                                $('#livestock_quara_period').val(e[0].quarantinePeriod);
                                                                                                                                                                                                                                                                $('#livestock_Quarantine_unit').val(e[0].quarantinePeriodUnits); } 
    });
  newlivestock = false;
  listar_livestock_transf();
  $('#livestock_Modal' ).modal(show);
}
function limpiar_addmodal(){
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
}
function activeid(id){
                                                                                                                                                                                                                                                                idactive = id;
}
</script>