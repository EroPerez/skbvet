<script type="text/javascript">
var html_l='';
$(document).ready(function () {
      "use strict";
        // Init Theme Core
        Core.init();

         $('#multiselect5').multiselect({
          buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
          });
         $('#transfer_dateadd').datepicker({
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
     var live_list = $('[name="duallistbox_demo1[]"]').bootstrapDualListbox();
     
       $('#farm_from').change(function(){
        live_list.trigger('bootstrapduallistbox.refresh',true);
        // $('#live_from').html('');
        //$('.demo1').bootstrapDualListbox('refresh',true);
         jQuery.ajax({
          type:'POST',
           dataType:'json',
           url:"<?php echo base_url().'index.php/transfer/Transfer/livestock_by_farm'; ?>",
           data:{"recn":$("#farm_from").val()}, 
           success: function(e){

              for(var i=0; i < e.length; i++){
                html_l += "<option value='"+e[i].recn+"'>"+e[i].IDNO+"</option>";
              }
          //   $('select[name="duallistbox_demo1[]"]').html(html_l); 
          //    $('.demo1').bootstrapDualListbox('refresh',true);
           live_list.append(html_l);
           live_list.trigger('bootstrapduallistbox.refresh',true);
           }   
       });
     });  
   

               
     
     //para seleccion   
    
  	       
});  
 // Dual List Plugin Init
   //  var demo1 = $('select[name="duallistbox_demo1[]"]').bootstrapDualListbox();
$("#demoform").submit(function() {
  alert($('[name="duallistbox_demo1[]"]').val());
  return false;
});
</script>