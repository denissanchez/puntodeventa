$(function() {
   'use strict';

   $(function () {
       const table = $('#table');
       table.DataTable({
           "aLengthMenu": [
               [10, 30, 50, -1],
               [10, 30, 50, "All"]
           ],
           "iDisplayLength": 10,
           "language": {
               search: ""
           }
       });

       // table.each(function() {
       //     const datatable = $(this);
       //     // SEARCH - Add the placeholder for Search and Turn this into in-line form control
       //     const search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
       //     search_input.attr('placeholder', 'Search');
       //     search_input.removeClass('form-control-sm');
       //     // LENGTH - Inline-Form control
       //     const length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
       //     length_sel.removeClass('form-control-sm');
       // });
   });
});
