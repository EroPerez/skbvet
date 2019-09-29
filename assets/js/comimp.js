$(document).ready(function () {
   	  "use strict";
        // Init Theme Core
        Core.init();
         $('#multiselect5').multiselect({
          buttonClass: 'multiselect dropdown-toggle btn btn-default btn-primary'
        });
           var   dialog,grid;
          //data=[{"Date":"dat1","Commodity":"dat2","Weight":"dat3","Country":"Dat3"}];
                        
                grid = $('#compimp_table').grid({
                 dataSource:"http://localhost/ahr/index.php/comimp/Comimp/listar",
              //  dataSource: data,
                 columns: [
                    { field: 'Date', width: 62 },
                    { field: 'Commodity' },
                    { field: 'Weight'},
                    { field: 'Country'}
                 ],
                detailTemplate: '<div><table/></div>'
            });
         dialog = $('#dialog').dialog({
                title: 'Add/Edit Record',
                autoOpen: false,
                resizable: false,
                modal: true
            });
            function Edit(e) {
                $('#ID').val(e.data.id);
                $('#com_date').val(e.data.record.com_date);
                $('#PlaceOfBirth').val(e.data.record.PlaceOfBirth);
                $('#dialog').dialog('open');
            }
            function Delete(e) {
                if (confirm('Are you sure?')) {
                    alert('TODO: Write code that delete the data on the server.');
                    grid.reload(); //load the new data from the server after the deletion
                }
            }
            function Save() {
                if ($('#ID').val()) {
                    var id = parseInt($('#ID').val());
                    alert('TODO: Write code that update the data on the server.');
                    grid.updateRow(id, { 'ID': id, 'Name': $('#Name').val(), 'PlaceOfBirth': $('#PlaceOfBirth').val() });
                } else {
                    alert('TODO: Write code that add the new record on the server.');
                    grid.addRow({ 'ID': grid.count(true) + 1, 'Name': $('#Name').val(), 'PlaceOfBirth': $('#PlaceOfBirth').val() });
                }
                dialog.close();
            }
            $('#btnAdd').on('click', function () {
                $('#ID').val('');
                $('#Name').val('');
                $('#PlaceOfBirth').val('');
                $('#dialog').dialog('open');
            });
            $('#btnSave').on('click', Save);
            $('#btnCancel').on('click', function () {
                dialog.close();
            });
            $('#btnSearch').on('click', function () {
                grid.reload({ searchString: $('#txtQuery').val() });
            });
            $('#btnClear').on('click', function () {
                $('#txtQuery').val('');
                grid.reload({ searchString: '' });
            });
         /* Date picker*/
         $('#comimp_date').datepicker({
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
        $('#com_date').datepicker({
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
