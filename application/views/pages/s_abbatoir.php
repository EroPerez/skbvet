 <script type="text/javascript">
      jQuery(document).ready(function () {
        "use strict";
        // Init Theme Core
        Core.init();
        // Init Demo JS
        Demo.init();
        // Form Switcher
         $(".select2-single").select2();
         $('#date_addabbatoir').datepicker({
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
          $('#date_birth').datepicker({
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
       
      });
     $('#select_livestock').change(function(){
       jQuery.ajax({
               type:'POST',
               dataType:'json',
               url:"<?php echo base_url().'index.php/abbatoir/Abbatoir/data_livestock'; ?>",
               data:{"reclivestock":$('#select_livestock').val()},
               success: function (e){
                 $('#abbatoir_Species').val(e.species); 
                 $('#abbatoir_Breed').val(e.breed);
                 $('#abbatoir_sex').val(e.sex);
                 $('#date_birth').val(e.date_of_birth);
                 $('#abbatoir_farmer').val(e.farmer);
                 $('#abbatoir_farm').val(e.farm);
                 $('#abbatoir_address2').val(e.address);
                 $('#abbatoir_telephone').val(e.telephone);
               }
             }); 
     });
   $('#new_presenter').click(function(){
       $('#abbatoir_presenter').removeAttr('readonly').val(''); 
       $('#abbatoir_address').removeAttr('readonly').val('');
       $('#abbatoir_phone').removeAttr('readonly').val('');
   });  
    $('#save_presenter').click(function(){
      var html='';
       jQuery.ajax({
               type:'POST',
               dataType:'json',
               url:"<?php echo base_url().'index.php/abbatoir/Abbatoir/add_presenter'; ?>",
               data:{
                "presenter":$('#abbatoir_presenter').val(),
                "date_presenter":$('#date_addabbatoir').val(),
                "address":$('#abbatoir_address').val(),
                "phone":$('#abbatoir_phone').val() },
               success: function (e){
                 $('#abbatoir_presenter').val(''); 
                 $('#date_presenter').val('');
                 $('#abbatoir_address').val('');
                 $('#abbatoir_phone').val('');
                 html ="<input id='recn_abbatoir' type='hidden' value='"+e.Recn+"' />"
                  html += '<td>'+e.present+'</td>';
                  html += '<td>'+e.presentadr+'</td>';
                  $('#body_table_Presenter').html(html);
               }
        });       
   }); 
   
   $('#save_animal').click(function(){
      jQuery.ajax({
               type:'POST',
               dataType:'json',
               url:"<?php echo base_url().'index.php/abbatoir/Abbatoir/save_animal'; ?>",
               data:{
                 'livestock_name':$('#select_livestock').val(), 
                 'livestock_recn': $('#livestock_recn').val(),
                 'abbatoir_recn':$('#recn_abbatoir').val(),
                 'type':$('#type').val()},
                
               success: function (e){
                 
               }
        });         

   });  
    </script>