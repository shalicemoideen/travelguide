<script>
// https://www.snagoff.com/blog/blog-post/add-remove-multiple-input-fields-dynamically-with-jquery-and-php/

////***Select2 option *****///
// $("#itineraries_category_id_fk").select2({
//   dropdownParent: $("#ItineraryModal"),
//   minimumResultsForSearch: 0
// });
// $("#itineraries_category_id_fk").select2({
//     dropdownParent: $("#ItineraryModal"),
//     minimumResultsForSearch: 0,
//     width: '100%',
//     selectOnClose: false
// });

// $('#itineraries_category_id_fk').on('select2:open', function () {

//     setTimeout(function () {

//         document.querySelector(
//             '.select2-container--open .select2-search__field'
//         ).focus();

//     }, 0);

// });

function initCommonSelect2(scope) {

    scope = scope || document;

    $(scope).find('.lst-flt-select2').each(function () {

        let $select = $(this);

        // avoid re-initializing
        if ($select.hasClass('select2-hidden-accessible')) {
            return;
        }

        // find nearest opened modal if this select is inside modal
        let $modal = $select.closest('.modal');

        let options = {
            width: '100%',
            minimumResultsForSearch: 0
        };

        // only set dropdownParent when inside modal
        if ($modal.length) {
            options.dropdownParent = $modal;
        }

        $select.select2(options);
    });
}

// auto focus search input for all select2
$(document).on('select2:open', function () {
    setTimeout(function () {
        let searchField = document.querySelector('.select2-container--open .select2-search__field');
        if (searchField) {
            searchField.focus();
        }
    }, 50);
});

// initialize page select2
$(document).ready(function () {
    initCommonSelect2(document);

    // Initialize Select2 for itinerary filter dropdowns with AJAX
    $('#itineraries_id_filter').select2({
        width: '100%',
        minimumResultsForSearch: 0,
        allowClear: true,
        placeholder: 'Please Select itinerary',
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Itinerary/get_itinerary_dropdown',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });

    $('#itineraries_category_id_filter').select2({
        width: '100%',
        minimumResultsForSearch: 0,
        allowClear: true,
        placeholder: 'Please Select itinerary category',
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Itinerary/get_itinerary_category_dropdown',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });

    $('#itineraries_days_destination_id_fk_filter').select2({
        width: '100%',
        minimumResultsForSearch: 0,
        allowClear: true,
        placeholder: 'Please Select destination',
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Itinerary/get_destination_dropdown',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });

    $('#itineraries_createdby_user_id').select2({
        width: '100%',
        minimumResultsForSearch: 0,
        allowClear: true,
        placeholder: 'Please Select Created by',
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Itinerary/get_staff_dropdown',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });
});

// Initialize category AJAX Select2 for the modal form
function initCategorySelect2InModal() {
    if ($('#itineraries_category_id_fk').hasClass('select2-hidden-accessible')) {
        return;
    }
    $('#itineraries_category_id_fk').select2({
        dropdownParent: $('#ItineraryModal'),
        width: '100%',
        placeholder: 'Please Select Category',
        allowClear: true,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Itinerary/get_itinerary_category_dropdown',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { q: params.term };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });
}

// call this after opening any modal
$('#ItineraryModal').on('shown.bs.modal', function () {
    initCommonSelect2(this);
    initCategorySelect2InModal();
});

// $("#itineraries_id_filter").select2({
//   // dropdownParent: $("#LeadsModal"),
//   minimumResultsForSearch: 0
// });
// $("#itineraries_category_id_filter").select2({
//   // dropdownParent: $("#LeadsModal"),
//   minimumResultsForSearch: 0
// });

// $("#itineraries_days_destination_id_fk_filter").select2({
//   // dropdownParent: $("#LeadsModal"),
//   minimumResultsForSearch: 0
// });
// $("#itineraries_createdby_user_id").select2({
//   // dropdownParent: $("#LeadsModal"),
//   minimumResultsForSearch: 0
// });
////***Select2 option *****///

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});


////***Filter button hide and show*****///


////***searching button*****///

$('#search').click(function () {

        $table.ajax.reload();
    });

// Refresh button to clear filters and reload datatable
$('#refresh').click(function () {
    $('#itineraries_id_filter').val(null).trigger('change');
    $('#itineraries_category_id_filter').val(null).trigger('change');
    $('#itineraries_duration_nights_filter').val('');
    $('#itineraries_days_destination_id_fk_filter').val(null).trigger('change');
    $('#itineraries_createdby_user_id').val(null).trigger('change');
    $table.ajax.reload();
});

$( "#itineraries_duration_nights_filter" ).keypress(function() {
            $table.ajax.reload();
});

////***searching button*****///

////***Latest Jquery form validation for adding form*****///
   /* ===== VIEW BUTTON CLICK ===== */
function view_itinerary(id){
  document.getElementById('previewSection').style.display = 'block';

  // If you have loader, show it here

  $.ajax({
    url: "<?= base_url('index.php/Itinerary/ajax_view_preview/'); ?>" + id,
    type: "GET",
    dataType: "JSON",
    success: function(res){
      if (!res || !res.status) {
        alert('No data found');
        return;
      }

      setCover(res.master || {});
      itinerary = res.days || [];
      renderItinerary();

      document.getElementById('previewSection').scrollIntoView({behavior:'smooth'});
    },
    error: function(){
      alert('Error loading itinerary preview');
    }
  });
}
    ////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
    
    
    $table = $('#Itinerary_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    title: 'Itinerary details'
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    title: 'Itinerary details'
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0 ,1, 2, 3, 4, 5]
                    },
                    title: 'Itinerary details'
                },
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Itinerary/get/",
            "type": "POST",
            "data" : function (d) {
                        d.itineraries_id_filter = $("#itineraries_id_filter").val();
                        d.itineraries_category_id_filter = $("#itineraries_category_id_filter").val();
                        d.itineraries_duration_nights_filter = $("#itineraries_duration_nights_filter").val();
                        d.itineraries_days_destination_id_fk_filter = $("#itineraries_days_destination_id_fk_filter").val();
                        d.itineraries_createdby_user_id = $("#itineraries_createdby_user_id").val();

           }            
        },
        // "ajax": {
            // "url": "<?php echo site_url('States/get')?>",
            // "type": "POST"
        // },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            
            

            // $('td', row).eq(5).html('<div class="form-button-action"><a  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task" href="javascript:void(0)" onclick="edit_role('+data['roles_id']+')"><i class="fa fa-edit"></i></a><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" href="javascript:void(0)" onclick="return delete_role('+data['roles_id']+')"><i class="fa fa-times"></i></button></div>');

            // $('td', row).eq(6).html('<div class="d-flex"><a class="btn btn-primary shadow btn-xs sharp me-1" target="_blank" title="Preview" href="<?php echo base_url();?>index.php/itinerary/preview/'+data['itineraries_id']+'" ><i class="fa fa-eye"></i></a><a href="javascript:void(0)" title="Duplicate" onclick="duplicate_itinerary('+data['itineraries_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-file-alt"></i></a><a href="javascript:void(0)" title="Edit" onclick="edit_itinerary('+data['itineraries_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" title="Delete" onclick="return delete_itinerary('+data['itineraries_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');
            
           let actionHtml = '<div class="d-flex">';

            // Edit button
            if (hasPermission('ITINERARY_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" title="Edit" onclick="edit_itinerary('+data['itineraries_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }

             // Duplicate button
            if (hasPermission('ITINERARY_DUPLICATE')) {
                actionHtml += '<a href="javascript:void(0)" title="Duplicate" onclick="duplicate_itinerary('+data['itineraries_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-file-alt"></i></a>';
            }

             // Preview button
            if (hasPermission('ITINERARY_PREVIEW')) {
                actionHtml += '<a class="btn btn-primary shadow btn-xs sharp me-1" target="_blank" title="Preview" href="<?php echo base_url();?>index.php/itinerary/preview/'+data['itineraries_id']+'" ><i class="fa fa-eye"></i></a>';
            }

            // Delete button
            if (hasPermission('ITINERARY_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" title="Delete" onclick="return delete_itinerary('+data['itineraries_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }

            actionHtml += '</div>';

            $('td', row).eq(6).html(actionHtml);
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "itineraries_status", "orderable": false },
            { "data": "itineraries_name", "orderable": false },
            { "data": "itinerary_category_name", "orderable": false },
            { "data": "itineraries_duration_nights", "orderable": false },
            { "data": "itineraries_description", "orderable": false },
            { "data": "admin_name", "orderable": false },
            { "data": "itineraries_id", "orderable": false },
            
            
            
        ]
        
    });
    
    
    ////***Latest Jquery form validation for adding form*****///
            
    $("#form").validate({

        validClass: "success",
        rules: {
            'input, select, textarea': {
                required: function(element) {
                    return $(element).is(':visible');
                }
            }
                // booking_work_order_end_date: { greaterThan: "#booking_work_order_date" }
            
        },
        messages: {
            
        },
        
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('input-success-o').addClass('input-warning-o');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('input-warning-o').addClass('input-success-o');
        },

        errorClass: 'input-error', // Optional, customize error class
        errorElement: 'div'

    });

  });
    
 
////***Listing table*****///

$('#itineraries_first_cover_page').on('change', function(){
    const file = this.files[0];
    if(file){
        const url = URL.createObjectURL(file);
        $('#first_cover_preview').html('<img src="'+url+'" style="width:120px;">');
    }
});

$('#itineraries_last_cover_page').on('change', function(){
    const file = this.files[0];
    if(file){
        const url = URL.createObjectURL(file);
        $('#last_cover_preview').html('<img src="'+url+'" style="width:120px;">');
    }
});
////***For close the modal *****///
//   $('#ItineraryModal').on('hidden.bs.modal', function() {
//   var waitForClose = window.setInterval(function() {
//     if ($('body').hasClass('modal-open') == false) {
//       $('.user').find('#name').trigger('focus');
//       window.clearInterval(waitForClose)
//     }
//   }, 100);
//   $(".product-item").remove();
// });
function Itinerarymodalclose()
{

    $('#ItineraryModal').modal('hide');
   
    //$( "div" ).remove( ".modal-backdrop" );
    $('#itinerary_category_name').val('');
    $(".product-item").remove();
    $(".product-item1").remove();
    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.itinerary_category_name').removeClass('input-success-o');
    $('.itinerary_category_name').removeClass('input-warning-o');
    $(".product-item").remove();
    $(".product-item1").remove();

    // $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///


// $('#ItineraryModal').on('hidden.bs.modal', function () {

//     destroyAllDayEditors();
// initSelect2Destination(this);
//     $('#productRowWrapper').empty();
//     $('#removed_itineraries_days_ids').val('');

//     $('#form')[0].reset();
//     $('.help-block').empty();
//     $('.input-warning-o').removeClass('input-warning-o');

// });

let dayEditors = []; // store all day editor instances

function destroyAllDayEditors5() {
  // destroy all stored editors
  if (dayEditors.length) {
    dayEditors.forEach(ed => { try { ed.destroy(); } catch(e){} });
    dayEditors = [];
  }

  // also clear markers
  $('#productRowWrapper .day-editor').removeClass('editor-initialized');
  $('#productRowWrapper .day-editor').each(function(){ this.editorInstance = null; });
}


$('#ItineraryModal').on('hidden.bs.modal', function () {

  destroyAllDayEditors5();

  $('#productRowWrapper').empty();
  $('#removed_itineraries_days_ids').val('');

  // reset form + validation UI
  $('#form')[0].reset();
  $('.help-block').empty();
  $('.input-warning-o').removeClass('input-warning-o');

});


////***For open the modal *****///
    
////***For open modal of Itinerary adding form  *****///
    
function add_Itinerary()
{
    save_method = 'add';

    destroyAllDayEditors5();   // ✅ CKEditor5 destroy

    $('#form')[0].reset();
    $("#id").val('');
    $('#removed_itineraries_days_ids').val('');

    $('.input-warning-o').removeClass('input-warning-o');
    $('.help-block').empty();

    $('#productRowWrapper').empty();

    if ($('#itineraries_category_id_fk').hasClass('select2-hidden-accessible')) {
        $('#itineraries_category_id_fk').val(null).trigger('change');
    }

    // Clear cover page image previews and hidden fields
    $('#first_cover_preview').empty();
    $('#last_cover_preview').empty();
    $('#itineraries_first_cover_page_txt').val('');
    $('#itineraries_last_cover_page_txt').val('');

    $('#ItineraryModal').modal('show');
    $('.modal-title').text('Add Itinerary Details');
    $('#btnSave').text('save');

    renderDayRows($('#itineraries_duration_nights1').val() || 0);
}


////***For open modal of Itinerary adding form  *****///

////***For editing Itinerary details from adding modal form  *****///

// function renderDayRowsFromDB(days)
// {
//   var $wrap = $('#productRowWrapper');
//   var tpl = document.getElementById('dayRowTemplate');
//   var imgBase = "<?= base_url('uploads/itinerary_days/'); ?>";

//   $wrap.empty();
//   if (!Array.isArray(days)) days = [];

//   for (var i = 0; i < days.length; i++) {
//     var d = days[i];

//     var node = tpl.content.cloneNode(true);
//     $wrap.append(node);

//     var $row = $wrap.find('.day-row').last();

//     var dayText = d.itineraries_days_day ? d.itineraries_days_day : ('Day ' + (i + 1));
//     $row.find('.day-label').text(dayText);

//     var dayNo = String(dayText).replace('Day', '').trim();
//     $row.find('.itineraries_days_day').val(dayNo);

//     var tb = d.itineraries_days_travel_back ? d.itineraries_days_travel_back : '';
//     $row.find('.itineraries_days_travel_back').val(tb);
//     if (tb === 'TB') $row.find('.travel-badge').show();

//     // destination
//     var $sel = $row.find('select[name="itineraries_days_destination_id_fk[]"]');
//     $sel.html(DEST_OPTIONS_HTML);

//     if (!$sel.hasClass("select2-hidden-accessible")) {
//       $sel.select2({
//         width: '100%',
//         placeholder: "Search Destination",
//         allowClear: true,
//         dropdownParent: $('#ItineraryModal')
//       });
//     }
//     $sel.val(d.itineraries_days_destination_id_fk).trigger('change');

//     // title
//     $row.find('input[name="itineraries_days_title[]"]').val(d.itineraries_days_title);

//     // ✅ image existing + preview (fixed URL)
//     $row.find('.itineraries_days_image_existing').val(d.itineraries_days_image ? d.itineraries_days_image : '');
//     if (d.itineraries_days_image) {
//       $row.find('.day-image-preview')
//         .attr('src', imgBase + d.itineraries_days_image)
//         .show();
//     } else {
//       $row.find('.day-image-preview').hide().attr('src','');
//     }

//     // description
//     // $row.find('textarea[name="itineraries_days_description[]"]').val(d.itineraries_days_description);
//     let textarea = $row.find('.day-editor')[0];

// if (textarea.editorInstance) {
//     textarea.editorInstance.setData(d.itineraries_days_description || '');
// }


//     // day id
//     $row.find('.itineraries_days_id').val(d.itineraries_days_id);
//   }

//   // ✅ assign unique textarea ids then init editors
//   assignEditorIds();
//   initDayEditors('#productRowWrapper');

//   // ✅ set CKEditor data from textarea (important in edit)
//   $('#productRowWrapper textarea.itineraries_days_description').each(function(){
//     if (this.id && window.CKEDITOR && CKEDITOR.instances[this.id]) {
//       CKEDITOR.instances[this.id].setData($(this).val());
//     }
//   });
// }

function renderDayRowsFromDB(days)
{
  var $wrap = $('#productRowWrapper');
  var tpl = document.getElementById('dayRowTemplate');
  var imgBase = "<?= base_url('uploads/itinerary_days/'); ?>";

  $wrap.empty();
  destroyAllDayEditors5(); // ✅ important before rebuild

  if (!Array.isArray(days)) days = [];

  for (var i = 0; i < days.length; i++) {
    var d = days[i];

    $wrap.append(tpl.content.cloneNode(true));
    var $row = $wrap.find('.day-row').last();

    var dayText = d.itineraries_days_day ? d.itineraries_days_day : ('Day ' + (i + 1));
    $row.find('.day-label').text(dayText);

    var dayNo = String(dayText).replace('Day', '').trim();
    $row.find('.itineraries_days_day').val(dayNo);

    var tb = d.itineraries_days_travel_back ? d.itineraries_days_travel_back : '';
    $row.find('.itineraries_days_travel_back').val(tb);
    if (tb === 'TB') $row.find('.travel-badge').show();

    var $sel = $row.find('select[name="itineraries_days_destination_id_fk[]"]');
    $sel.html(DEST_OPTIONS_HTML).val(d.itineraries_days_destination_id_fk).trigger('change');

    if (!$sel.hasClass("select2-hidden-accessible")) {
      $sel.select2({
        width: '100%',
        placeholder: "Search Destination",
        allowClear: true,
        dropdownParent: $('#ItineraryModal')
      });
    }

    $row.find('input[name="itineraries_days_title[]"]').val(d.itineraries_days_title);
    $row.find('.itineraries_days_id').val(d.itineraries_days_id);

    // image preview
    $row.find('.itineraries_days_image_existing').val(d.itineraries_days_image || '');
    if (d.itineraries_days_image) {
      $row.find('.day-image-preview').attr('src', imgBase + d.itineraries_days_image).show();
    } else {
      $row.find('.day-image-preview').hide().attr('src','');
    }

    // store description HTML temporarily in textarea (for later editor setData)
    $row.find('.day-editor').val(d.itineraries_days_description || '');
  }

  // ✅ init editors then setData from textarea value
  initDayEditors('#productRowWrapper').then(function(){
    $('#productRowWrapper .day-editor').each(function(){
      if (this.editorInstance) {
        this.editorInstance.setData($(this).val() || '');
      }
    });
  });
}


function addRemovedDayIdsFromRemovedRows($rows) {

    var removed = $('#removed_itineraries_days_ids').val();
    var arr = removed ? removed.split(',') : [];

    $rows.each(function(){
        var id = $(this).find('.itineraries_days_id').val();

        if (id && arr.indexOf(String(id)) === -1) {
            arr.push(String(id));
        }
    });

    $('#removed_itineraries_days_ids').val(arr.join(','));

}


function destroyAllDayEditors() {
  if (!window.CKEDITOR) return;

  for (var inst in CKEDITOR.instances) {
    if (CKEDITOR.instances.hasOwnProperty(inst)) {
      CKEDITOR.instances[inst].destroy(true);
    }
  }
}

function edit_itinerary(id)
{
  save_method = 'update';
  $('#form')[0].reset();
  $('.input-warning-o').removeClass('input-warning-o');
  $('.help-block').text('');

  // ✅ clear removed ids
  $('#removed_itineraries_days_ids').val('');

  // ✅ destroy existing editors before rebuilding rows
  destroyAllDayEditors5();

  // clear old dynamic rows
  $('#productRowWrapper').empty();

  $.ajax({
    url : "<?= base_url('index.php/Itinerary/ajax_edit/'); ?>" + id,
    type: "GET",
    dataType: "JSON",
    success: function(master)
    {
      $('#id').val(master.itineraries_id);

      $('[name="itineraries_name"]').val(master.itineraries_name);
      // Pre-inject the category option so Select2 AJAX can select it
      if (master.itineraries_category_id_fk && master.itinerary_category_name) {
          var $catSelect = $('[name="itineraries_category_id_fk"]');
          if ($catSelect.find('option[value="' + master.itineraries_category_id_fk + '"]').length === 0) {
              $catSelect.append(new Option(master.itinerary_category_name, master.itineraries_category_id_fk, true, true));
          }
          $catSelect.val(master.itineraries_category_id_fk).trigger('change');
      }
      $('[name="itineraries_duration_nights"]').val(master.itineraries_duration_nights);
      $('#itineraries_description').val(master.itineraries_description || '');


      if (master.itineraries_first_cover_page) {

          $('#itineraries_first_cover_page_txt').val(master.itineraries_first_cover_page);

          $('#first_cover_preview').html(
              '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>' +
              master.itineraries_first_cover_page +
              '" style="width:120px;border:1px solid #ddd;padding:3px;">'
          );

          $('#itineraries_first_cover_page').prop('required', false);

      } else {

          $('#first_cover_preview').html('');
          $('#itineraries_first_cover_page').prop('required', true);
      }


      if (master.itineraries_last_cover_page) {

          $('#itineraries_last_cover_page_txt').val(master.itineraries_last_cover_page);

          $('#last_cover_preview').html(
              '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>' +
              master.itineraries_last_cover_page +
              '" style="width:120px;border:1px solid #ddd;padding:3px;">'
          );

          $('#itineraries_last_cover_page').prop('required', false);

      } else {

          $('#last_cover_preview').html('');
          $('#itineraries_last_cover_page').prop('required', true);
      }

      $('#ItineraryModal').modal('show');
      $('.modal-title').text('Edit Itinerary Details');
      $('#btnSave').text('update');

      $.ajax({
        url: "<?= base_url('index.php/Itinerary/fetch_itineraries_days'); ?>",
        type: "POST",
        dataType: "JSON",
        data: { itineraries_id: master.itineraries_id },
        success: function(days)
        {
          renderDayRowsFromDB(days);
        }
      });
    },
    error: function () {
      alert('Error get data from ajax');
    }
  });
}

////***For editing Itinerary details from adding modal form  *****///

////***For duplicating Itinerary details from adding modal form  *****///

// function duplicate_itinerary(id)
// {
//   save_method = 'add';

//   $('#form')[0].reset();
//   $('.input-warning-o').removeClass('input-warning-o');
//   $('.help-block').text('');

//   $('#id').val('');
//   $('#removed_itineraries_days_ids').val('');

//   destroyAllDayEditors5();
//   $('#productRowWrapper').empty();

//   $.ajax({
//     url : "<?= base_url('index.php/Itinerary/ajax_edit/'); ?>" + id,
//     type: "GET",
//     dataType: "JSON",
//     success: function(master)
//     {
//       $('#id').val('');

//       $('[name="itineraries_name"]').val(master.itineraries_name || '');
//       $('[name="itineraries_category_id_fk"]').val(master.itineraries_category_id_fk).trigger('change');
//       $('[name="itineraries_duration_nights"]').val(master.itineraries_duration_nights);
//       $('#itineraries_description').val(master.itineraries_description || '');

//       if (master.itineraries_first_cover_page) {
//         $('#itineraries_first_cover_page_txt').val(master.itineraries_first_cover_page);
//         $('#first_cover_preview').html(
//           '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>' +
//           master.itineraries_first_cover_page +
//           '" style="width:120px;border:1px solid #ddd;padding:3px;">'
//         );
//         $('#itineraries_first_cover_page').prop('required', false);
//       } else {
//         $('#itineraries_first_cover_page_txt').val('');
//         $('#first_cover_preview').html('');
//         $('#itineraries_first_cover_page').prop('required', true);
//       }

//       if (master.itineraries_last_cover_page) {
//         $('#itineraries_last_cover_page_txt').val(master.itineraries_last_cover_page);
//         $('#last_cover_preview').html(
//           '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>' +
//           master.itineraries_last_cover_page +
//           '" style="width:120px;border:1px solid #ddd;padding:3px;">'
//         );
//         $('#itineraries_last_cover_page').prop('required', false);
//       } else {
//         $('#itineraries_last_cover_page_txt').val('');
//         $('#last_cover_preview').html('');
//         $('#itineraries_last_cover_page').prop('required', true);
//       }

//       $('#ItineraryModal').modal('show');
//       $('.modal-title').text('Duplicate Itinerary Details');
//       $('#btnSave').text('save');

//       $.ajax({
//         url: "<?= base_url('index.php/Itinerary/fetch_itineraries_days'); ?>",
//         type: "POST",
//         dataType: "JSON",
//         data: { itineraries_id: master.itineraries_id },
//         success: function(days)
//         {
//           renderDayRowsFromDBForDuplicate(days);
//         }
//       });
//     },
//     error: function () {
//       alert('Error get data from ajax');
//     }
//   });
// }

function duplicate_itinerary(id)
{
  save_method = 'add';

  $('#form')[0].reset();
  $('.input-warning-o').removeClass('input-warning-o');
  $('.help-block').text('');

  $('#id').val('');
  $('#removed_itineraries_days_ids').val('');

  destroyAllDayEditors5();
  $('#productRowWrapper').empty();

  $.ajax({
    url : "<?= base_url('index.php/Itinerary/ajax_edit/'); ?>" + id,
    type: "GET",
    dataType: "JSON",
    success: function(master)
    {
      $('#id').val('');

      $('[name="itineraries_name"]').val(master.itineraries_name || '');
      // Pre-inject the category option so Select2 AJAX can select it
      if (master.itineraries_category_id_fk && master.itinerary_category_name) {
          var $catSelectDup = $('[name="itineraries_category_id_fk"]');
          if ($catSelectDup.find('option[value="' + master.itineraries_category_id_fk + '"]').length === 0) {
              $catSelectDup.append(new Option(master.itinerary_category_name, master.itineraries_category_id_fk, true, true));
          }
          $catSelectDup.val(master.itineraries_category_id_fk).trigger('change');
      }
      $('[name="itineraries_duration_nights"]').val(master.itineraries_duration_nights);
      $('#itineraries_description').val(master.itineraries_description || '');

      if (master.itineraries_first_cover_page) {
        $('#itineraries_first_cover_page_txt').val(master.itineraries_first_cover_page);
        $('#first_cover_preview').html(
          '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>' +
          master.itineraries_first_cover_page +
          '" style="width:120px;border:1px solid #ddd;padding:3px;">'
        );
        $('#itineraries_first_cover_page').prop('required', false);
      } else {
        $('#itineraries_first_cover_page_txt').val('');
        $('#first_cover_preview').html('');
        $('#itineraries_first_cover_page').prop('required', true);
      }

      if (master.itineraries_last_cover_page) {
        $('#itineraries_last_cover_page_txt').val(master.itineraries_last_cover_page);
        $('#last_cover_preview').html(
          '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>' +
          master.itineraries_last_cover_page +
          '" style="width:120px;border:1px solid #ddd;padding:3px;">'
        );
        $('#itineraries_last_cover_page').prop('required', false);
      } else {
        $('#itineraries_last_cover_page_txt').val('');
        $('#last_cover_preview').html('');
        $('#itineraries_last_cover_page').prop('required', true);
      }

      $('#ItineraryModal').modal('show');
      $('.modal-title').text('Duplicate Itinerary Details');
      $('#btnSave').text('save');

      $.ajax({
        url: "<?= base_url('index.php/Itinerary/fetch_itineraries_days'); ?>",
        type: "POST",
        dataType: "JSON",
        data: { itineraries_id: master.itineraries_id },
        success: function(days)
        {
          renderDayRowsFromDBForDuplicate(days);
        }
      });
    },
    error: function () {
      alert('Error get data from ajax');
    }
  });
}
// function duplicate_itinerary(id)
// {
//   save_method = 'add'; // ✅ important: save as new record

//   $('#form')[0].reset();
//   $('.input-warning-o').removeClass('input-warning-o');
//   $('.help-block').text('');

//   // clear hidden ids
//   $('#id').val('');
//   $('#removed_itineraries_days_ids').val('');

//   // destroy editors
//   destroyAllDayEditors5();

//   // clear rows
//   $('#productRowWrapper').empty();

//   $.ajax({
//     url : "<?= base_url('index.php/Itinerary/ajax_edit/'); ?>" + id,
//     type: "GET",
//     dataType: "JSON",
//     success: function(master)
//     {
//       // ✅ DO NOT set old itinerary id
//       $('#id').val('');

//       // fill same data
//       $('[name="itineraries_name"]').val((master.itineraries_name || '') + ' - Copy');
//       $('[name="itineraries_category_id_fk"]').val(master.itineraries_category_id_fk).trigger('change');
//       $('[name="itineraries_duration_nights"]').val(master.itineraries_duration_nights);
//       $('#itineraries_description').val(master.itineraries_description || '');

//       // first cover
//       if (master.itineraries_first_cover_page) {
//         $('#itineraries_first_cover_page_txt').val(master.itineraries_first_cover_page);

//         $('#first_cover_preview').html(
//           '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>' +
//           master.itineraries_first_cover_page +
//           '" style="width:120px;border:1px solid #ddd;padding:3px;">'
//         );

//         $('#itineraries_first_cover_page').prop('required', false);
//       } else {
//         $('#itineraries_first_cover_page_txt').val('');
//         $('#first_cover_preview').html('');
//         $('#itineraries_first_cover_page').prop('required', true);
//       }

//       // last cover
//       if (master.itineraries_last_cover_page) {
//         $('#itineraries_last_cover_page_txt').val(master.itineraries_last_cover_page);

//         $('#last_cover_preview').html(
//           '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>' +
//           master.itineraries_last_cover_page +
//           '" style="width:120px;border:1px solid #ddd;padding:3px;">'
//         );

//         $('#itineraries_last_cover_page').prop('required', false);
//       } else {
//         $('#itineraries_last_cover_page_txt').val('');
//         $('#last_cover_preview').html('');
//         $('#itineraries_last_cover_page').prop('required', true);
//       }

//       $('#ItineraryModal').modal('show');
//       $('.modal-title').text('Duplicate Itinerary Details');
//       $('#btnSave').text('save');

//       // fetch day rows
//       $.ajax({
//         url: "<?= base_url('index.php/Itinerary/fetch_itineraries_days'); ?>",
//         type: "POST",
//         dataType: "JSON",
//         data: { itineraries_id: master.itineraries_id },
//         success: function(days)
//         {
//           renderDayRowsFromDBForDuplicate(days);
//         }
//       });
//     },
//     error: function () {
//       alert('Error get data from ajax');
//     }
//   });
// }

// function renderDayRowsFromDBForDuplicate(days)
// {
//   var $wrap = $('#productRowWrapper');
//   var tpl = document.getElementById('dayRowTemplate');
//   var imgBase = "<?= base_url('uploads/itinerary_days/'); ?>";

//   $wrap.empty();
//   destroyAllDayEditors5();

//   if (!Array.isArray(days)) days = [];

//   for (var i = 0; i < days.length; i++) {
//     var d = days[i];

//     $wrap.append(tpl.content.cloneNode(true));
//     var $row = $wrap.find('.day-row').last();

//     var dayText = d.itineraries_days_day ? d.itineraries_days_day : ('Day ' + (i + 1));
//     $row.find('.day-label').text(dayText);

//     var dayNo = String(dayText).replace('Day', '').trim();
//     $row.find('.itineraries_days_day').val(dayNo);

//     var tb = d.itineraries_days_travel_back ? d.itineraries_days_travel_back : '';
//     $row.find('.itineraries_days_travel_back').val(tb);
//     if (tb === 'TB') {
//       $row.find('.travel-badge').show();
//     } else {
//       $row.find('.travel-badge').hide();
//     }

//     var $sel = $row.find('select[name="itineraries_days_destination_id_fk[]"]');
//     $sel.html(DEST_OPTIONS_HTML);

//     if (!$sel.hasClass("select2-hidden-accessible")) {
//       $sel.select2({
//         width: '100%',
//         placeholder: "Search Destination",
//         allowClear: true,
//         dropdownParent: $('#ItineraryModal')
//       });
//     }
//     $sel.val(d.itineraries_days_destination_id_fk).trigger('change');

//     $row.find('input[name="itineraries_days_title[]"]').val(d.itineraries_days_title || '');

//     // ✅ do not keep old child id
//     $row.find('.itineraries_days_id').val('');

//     // keep existing image filename so ajax_add can reuse if no new image selected
//     $row.find('.itineraries_days_image_existing').val(d.itineraries_days_image || '');

//     if (d.itineraries_days_image) {
//       $row.find('.day-image-preview')
//         .attr('src', imgBase + d.itineraries_days_image)
//         .show();
//     } else {
//       $row.find('.day-image-preview').hide().attr('src', '');
//     }

//     $row.find('.day-editor').val(d.itineraries_days_description || '');
//   }

//   assignEditorIds();

//   initDayEditors('#productRowWrapper').then(function(){
//     $('#productRowWrapper .day-editor').each(function(){
//       if (this.editorInstance) {
//         this.editorInstance.setData($(this).val() || '');
//       }
//     });
//   });
// }

function renderDayRowsFromDBForDuplicate(days)
{
  var $wrap = $('#productRowWrapper');
  var tpl = document.getElementById('dayRowTemplate');
  var imgBase = "<?= base_url('uploads/itinerary_days/'); ?>";

  $wrap.empty();
  destroyAllDayEditors5();

  if (!Array.isArray(days)) days = [];

  for (var i = 0; i < days.length; i++) {
    var d = days[i];

    $wrap.append(tpl.content.cloneNode(true));
    var $row = $wrap.find('.day-row').last();

    var dayText = d.itineraries_days_day ? d.itineraries_days_day : ('Day ' + (i + 1));
    $row.find('.day-label').text(dayText);

    var dayNo = String(dayText).replace('Day', '').trim();
    $row.find('.itineraries_days_day').val(dayNo);

    var tb = d.itineraries_days_travel_back ? d.itineraries_days_travel_back : '';
    $row.find('.itineraries_days_travel_back').val(tb);
    if (tb === 'TB') {
      $row.find('.travel-badge').show();
    } else {
      $row.find('.travel-badge').hide();
    }

    var $sel = $row.find('select[name="itineraries_days_destination_id_fk[]"]');
    $sel.html(DEST_OPTIONS_HTML);

    if (!$sel.hasClass("select2-hidden-accessible")) {
      $sel.select2({
        width: '100%',
        placeholder: "Search Destination",
        allowClear: true,
        dropdownParent: $('#ItineraryModal')
      });
    }

    $sel.val(d.itineraries_days_destination_id_fk).trigger('change');

    $row.find('input[name="itineraries_days_title[]"]').val(d.itineraries_days_title || '');

    // important: blank old child id so save becomes INSERT
    $row.find('.itineraries_days_id').val('');

    // keep existing image filename in hidden field
    $row.find('.itineraries_days_image_existing').val(d.itineraries_days_image || '');

    if (d.itineraries_days_image) {
      $row.find('.day-image-preview')
        .attr('src', imgBase + d.itineraries_days_image)
        .show();
    } else {
      $row.find('.day-image-preview').hide().attr('src', '');
    }

    $row.find('.day-editor').val(d.itineraries_days_description || '');
  }

  assignEditorIds();

  initDayEditors('#productRowWrapper').then(function(){
    $('#productRowWrapper .day-editor').each(function(){
      if (this.editorInstance) {
        this.editorInstance.setData($(this).val() || '');
      }
    });
  });
}
////***For duplicating Itinerary details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id)
    {  

        // swal("Itinerary details updated successfully", "", "success")
        var ff = 0;
        
        ff = "Itinerary details updated successfully";

         $("#vehicle_update").val(ff);
        
         
         var options = {

        'title': '',

        'style': 'success',

        'message': ff,

        // 'success': 'warning',
        'icon': 'fas fa-check',

        };
        
        var n1 = new notify(options); 

        n1.show(); 

        setTimeout(function(){ n1.hide(); }, 10000);
    }
    else{
        
        // swal("Itinerary details added successfully", "", "success")

        var ff = 0;
        
        ff = "Itinerary details added successfully";

         $("#vehicle_add").val(ff);
        
         
         var options = {

        'title': '',

        'style': 'success',

        'message': ff,

        // 'success': 'warning',
        'icon': 'fas fa-check',

        };
        
        var n1 = new notify(options); 

        n1.show(); 

        setTimeout(function(){ n1.hide(); }, 10000);
    }
    
    
}

////***For reload the datatable  *****///

///***For save the Itinerary details from adding modal form *****///

function clearValidationUI() {
  $('.input-warning-o').removeClass('input-warning-o');
  $('.help-block').text('');
}

function showFieldError($field, message) {
  // your UI style
  $field.closest('.form-group, .col-md-3, .col-md-4, .col-12').addClass('input-warning-o');

  // if you have help-block span under field
  let $hb = $field.parent().find('.help-block');
  if ($hb.length) $hb.text(message);
  else {
    // create if not exists
    if (!$field.next('.help-block').length) $field.after('<span class="help-block" style="color:red"></span>');
    $field.next('.help-block').text(message);
  }
}

// function validateBeforeSave() {
//   clearValidationUI();

//   let ok = true;

//   // main fields
//   const requiredMain = [
//     { sel: '#itineraries_name', msg: 'Itinerary name is required' },
//     { sel: '#itineraries_duration_nights1', msg: 'Duration in nights is required' },
//     { sel: '#itineraries_category_id_fk', msg: 'Category is required' },
//     { sel: '#itineraries_description', msg: 'Description is required' }
//   ];

//   requiredMain.forEach(r => {
//     let $f = $(r.sel);
//     if ($.trim($f.val()) === '') {
//       showFieldError($f, r.msg);
//       ok = false;
//     }
//   });

//   // dynamic day rows
//   $('#productRowWrapper .day-row').each(function () {
//     let $row = $(this);

//     // Select2: use .val() directly, works
//     let $dest = $row.find('select[name="itineraries_days_destination_id_fk[]"]');
//     let $title = $row.find('input[name="itineraries_days_title[]"]');
//     let $desc  = $row.find('textarea[name="itineraries_days_description[]"]');

//     if (!$dest.val()) { showFieldError($dest, 'Destination is required'); ok = false; }
//     if ($.trim($title.val()) === '') { showFieldError($title, 'Title is required'); ok = false; }
//     if ($.trim($desc.val()) === '') { showFieldError($desc, 'Description is required'); ok = false; }
//   });

//   // If using Select2, errors should highlight the select2 container too
//   if (!ok) {
//     // focus first invalid field
//     let $first = $('.input-warning-o').find('input,select,textarea').first();
//     if ($first.length) $first.focus();
//   }

//   return ok;
// }

function validateBeforeSave() {
  clearValidationUI();

  // ✅ Sync CKEditor -> textarea BEFORE checking required fields
  if (window.CKEDITOR) {
    for (var inst in CKEDITOR.instances) {
      if (CKEDITOR.instances.hasOwnProperty(inst)) {
        CKEDITOR.instances[inst].updateElement();
      }
    }
  }

  let ok = true;

  // main fields
  const requiredMain = [
    { sel: '#itineraries_name', msg: 'Itinerary name is required' },
    { sel: '#itineraries_duration_nights1', msg: 'Duration in nights is required' },
    { sel: '#itineraries_category_id_fk', msg: 'Category is required' },
    // { sel: '#itineraries_description', msg: 'Description is required' }
  ];

  requiredMain.forEach(r => {
    let $f = $(r.sel);
    if ($.trim($f.val()) === '') {
      showFieldError($f, r.msg);
      ok = false;
    }
  });

  // dynamic day rows
//   $('#productRowWrapper .day-row').each(function () {
//     let $row = $(this);

//     let $dest = $row.find('select[name="itineraries_days_destination_id_fk[]"]');
//     let $title = $row.find('input[name="itineraries_days_title[]"]');
//     // let $desc  = $row.find('textarea[name="itineraries_days_description[]"]');
//     let editorElement = $row.find('.day-editor')[0];

// let descValue = '';

// if (editorElement.editorInstance) {
//     descValue = editorElement.editorInstance.getData().trim();
// }

// if (!descValue) {
//     showFieldError($(editorElement), 'Description is required');
//     ok = false;
// }


//     // ✅ For CKEditor content, remove HTML tags and check real text
//     let descVal = $.trim($desc.val());
//     descVal = descVal.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();

//     if (!$dest.val()) { showFieldError($dest, 'Destination is required'); ok = false; }
//     if ($.trim($title.val()) === '') { showFieldError($title, 'Title is required'); ok = false; }
//     if (descVal === '') { showFieldError($desc, 'Description is required'); ok = false; }
//   });

// dynamic day rows
$('#productRowWrapper .day-row').each(function () {
  let $row = $(this);

  let $dest = $row.find('select[name="itineraries_days_destination_id_fk[]"]');
  let $title = $row.find('input[name="itineraries_days_title[]"]');
  let editorEl = $row.find('.day-editor')[0];

  let html = (editorEl && editorEl.editorInstance) ? editorEl.editorInstance.getData() : '';
  let text = html.replace(/<[^>]*>/g, '').replace(/&nbsp;/g, ' ').trim();

  if (!$dest.val()) { showFieldError($dest, 'Destination is required'); ok = false; }
  if ($.trim($title.val()) === '') { showFieldError($title, 'Title is required'); ok = false; }
  if (text === '') { showFieldError($(editorEl), 'Description is required'); ok = false; }
});

  if (!ok) {
    let $first = $('.input-warning-o').find('input,select,textarea').first();
    if ($first.length) $first.focus();
  }

  return ok;
}

function save()
{
     
    if (!validateBeforeSave()) {
        return; // stop AJAX
    }
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Itinerary/ajax_add/";
    } 
    else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Itinerary/ajax_update/";
    }
    
    // ✅ push CKEditor5 data back to textarea fields
    $('#productRowWrapper .day-editor').each(function(){
      if (this.editorInstance) {
        $(this).val(this.editorInstance.getData());
      }
    });




    var fd = new FormData();
    
    var form = document.getElementById('form');
    var data = new FormData(form);
data.set('removed_itineraries_days_ids', $('#removed_itineraries_days_ids').val());

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: data, //$('#form').serialize(),
        dataType: "JSON",
        //cache : false,
        processData: false,
        enctype: 'multipart/form-data',
        contentType: false,
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {

                $('#ItineraryModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();
                $(".product-item").remove();
    $(".product-item1").remove();

                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
                    if($('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').length) {
                        $('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                    } else {
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            $('.help-block').val('hide');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

///***For save the Itinerary details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    // swal("Itinerary details deleted successfully", "", "success")
        var ff = 0;
        
        ff = "Itinerary details deleted successfully";

         $("#roles_delete").val(ff);
        
         
         var options = {

        'title': '',

        'style': 'success',

        'message': ff,

        // 'success': 'warning',
        'icon': 'fas fa-check',

        };
        var n1 = new notify(options); 

        n1.show(); 

        setTimeout(function(){ n1.hide(); }, 10000);
        
}

////***For reload the datatable for delete *****///
    
////***For reload the Itinerary datatable for delete *****///

function delete_itinerary(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Itinerary/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.itineraries_id);
            $('[name="itineraries_name"]').val(data.itineraries_name);
            $('#deleterowModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title1').text('Do you want to delete this record?'); // Set title to Bootstrap modal title
            $('#btnSave1').text('delete');
            $('#btnSave1').attr('disabled',false); //set button enable 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    
    // $('#deleterowModal').modal('show'); // show bootstrap modal
        // ajax delete data to database 
}

function delete_itineraries_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Itinerary/delete/";
        
    

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form1').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $("#id").val('');
                $('#deleterowModal').modal('hide');
                reload_table_delete();
                // ('body').removeClass('modal-open');
                //$('.modal-backdrop').remove();
                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    if($('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').length) {
                        $('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                    } else {
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
            }

            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 

        }
    });
}

////***For delete the Itinerary details from  database *****///


function initSelect2Destination(scope = document) {

    $(scope).find('.select2-destination').select2({
        width: '100%',
        placeholder: "Search Destination",
        allowClear: true,
        dropdownParent: $('#ItineraryModal') // REQUIRED for modal
    });

}

let DEST_OPTIONS_HTML = '<option value="">Please Select Destination</option>';

function loadDestinationsOnce() {
  return $.ajax({
    url: "<?= base_url('index.php/Itinerary/Destination_details'); ?>",
    type: "GET",
    dataType: "json"
  }).then(function(list){
    let html = '<option value="">Please Select Destination</option>';
    if (Array.isArray(list)) {
      list.forEach(function(item){
        html += `<option value="${item.id}">${item.name}</option>`;
      });
    }
    DEST_OPTIONS_HTML = html;
  });
}

function totalDaysFromNights(nights){
  nights = parseInt(nights, 10);
  if (isNaN(nights) || nights < 0) nights = 0;

  // Rule: total days = nights + 1 (travel back day is the last one)
  return nights + 1;
}

function renderDayRows(nights) {

  let totalDays = totalDaysFromNights(nights);
  let $wrap = $('#productRowWrapper');
  let tpl = document.getElementById('dayRowTemplate');

  let current = $wrap.find('.day-row').length;

  // remove extra rows if decreasing
  if (current > totalDays) {

    let $toRemove = $wrap.find('.day-row:gt(' + (totalDays - 1) + ')');

    destroyEditorsInRows($toRemove);
    addRemovedDayIdsFromRemovedRows($toRemove); // collect ids for soft-disable
    $toRemove.remove();

    current = $wrap.find('.day-row').length;
  }

  // add missing rows if increasing
  for (let i = current + 1; i <= totalDays; i++) {
    let node = tpl.content.cloneNode(true);
    $wrap.append(node);
  }

  // update labels + hidden fields + travel back marker
  $wrap.find('.day-row').each(function(index){

    let dayNo = index + 1;
    let isTravelBack = (dayNo === totalDays);

    $(this).attr('data-day', dayNo);
    $(this).find('.day-label').text('Day ' + dayNo);

    // ✅ hidden values for save
    $(this).find('.itineraries_days_day').val(dayNo);
    $(this).find('.itineraries_days_travel_back').val(isTravelBack ? 'TB' : '');

    // badge
    if (isTravelBack) $(this).find('.travel-badge').show();
    else $(this).find('.travel-badge').hide();

    // destination select
    let $sel = $(this).find('.destination_select');

    // preserve current selection (important for edit)
    let currentVal = $sel.val();

    if ($sel.children().length <= 1) {
      $sel.html(DEST_OPTIONS_HTML);
      if (currentVal) $sel.val(currentVal);
    }

    // init select2 only once
    if (!$sel.hasClass("select2-hidden-accessible")) {
      $sel.select2({
        width: '100%',
        placeholder: "Search Destination",
        allowClear: true,
        dropdownParent: $('#ItineraryModal')
      });
    }

  });

  assignEditorIds();
initDayEditors('#productRowWrapper');

  $('#noa_header').show();
}

$(document).ready(function(){
  loadDestinationsOnce().then(function(){
    // initial render if value already exists
    renderDayRows($('#itineraries_duration_nights1').val());
  });

  // on input change
  $('#itineraries_duration_nights1').on('input change', function(){
    let v = parseInt($(this).val(), 10);
    if (isNaN(v) || v < 0) {
      v = 0;
      $(this).val(0);
    }
    renderDayRows(v);
  });
});


// function initDayEditors(scope) {
//   $(scope).find('textarea.itineraries_days_description').each(function(){
//     if (!this.id) return; // must have id
//     if (CKEDITOR.instances[this.id]) return;
//     CKEDITOR.replace(this.id);
//   });
// }

// function initDayEditors(scope) {

//     $(scope).find('.day-editor').each(function () {

//         if (!this.classList.contains('editor-initialized')) {

//             ClassicEditor
//                 .create(this, {
//                     toolbar: [
//                         'bold', 'italic', 'link',
//                         'bulletedList', 'numberedList',
//                         'undo', 'redo'
//                     ]
//                 })
//                 .then(editor => {
//                     this.editorInstance = editor;
//                     this.classList.add('editor-initialized');
//                 })
//                 .catch(error => console.error(error));
//         }
//     });
// }

// function initDayEditors(scope) {

//   let promises = [];

//   $(scope).find('.day-editor').each(function () {

//     let el = this;
//     if (el.classList.contains('editor-initialized')) return;

//     let p = ClassicEditor
//       .create(el, {
//         toolbar: ['bold','italic','link','bulletedList','numberedList','undo','redo']
//       })
//       .then(editor => {
//         el.editorInstance = editor;
//         el.classList.add('editor-initialized');
//         dayEditors.push(editor);
//       });

//     promises.push(p);
//   });

//   return Promise.all(promises);
// }

function initDayEditors(scope) {

  let promises = [];

  $(scope).find('.day-editor').each(function () {

    let el = this;
    if (el.classList.contains('editor-initialized')) return;

    let p = ClassicEditor.create(el, {
          toolbar: [
            'heading',
            'fontSize',
            '|',
            'bold','italic','link',
            '|',
            'bulletedList','numberedList',
            '|',
            'blockQuote',
            'insertTable',
            'imageUpload',
            'mediaEmbed',
            '|',
            'undo','redo'
          ],

          fontSize: {
            options: [
              10,
              12,
              14,
              'default',
              18,
              20,
              24,
              28,
              32
            ],
            supportAllValues: true
          },

          table: {
            contentToolbar: ['tableColumn','tableRow','mergeTableCells']
          }

        })
      .then(editor => {
        el.editorInstance = editor;
        el.classList.add('editor-initialized');
        dayEditors.push(editor);
      });

    promises.push(p);
  });

  return Promise.all(promises);
}

// function assignEditorIds() {
//   $('#productRowWrapper .day-row').each(function(index){
//     var id = 'day_desc_' + (index + 1); // unique per row
//     var $ta = $(this).find('textarea.itineraries_days_description');
//     $ta.attr('id', id);
//   });
// }

function assignEditorIds() {
  $('#productRowWrapper .day-row').each(function(index){
    var id = 'day_desc_' + (index + 1);
    $(this).find('textarea.day-editor').attr('id', id);
  });
}


$(document).on('change', '.itineraries_days_image', function(){
  var file = this.files && this.files[0] ? this.files[0] : null;
  var $row = $(this).closest('.day-row');
  var $img = $row.find('.day-image-preview');

  if (!file) { $img.hide().attr('src',''); return; }

  var reader = new FileReader();
  reader.onload = function(e){
    $img.attr('src', e.target.result).show();
  };
  reader.readAsDataURL(file);
});

// function destroyEditorsInRows($rows){
//   $rows.find('textarea.itineraries_days_description').each(function(){
//     if (this.id && CKEDITOR.instances[this.id]) {
//       CKEDITOR.instances[this.id].destroy(true);
//     }
//   });
// }
function destroyEditorsInRows($rows){
  $rows.find('.day-editor').each(function(){
    if (this.editorInstance) {
      try { this.editorInstance.destroy(); } catch(e){}
      this.editorInstance = null;
    }
    this.classList.remove('editor-initialized');
  });

  // also remove from global dayEditors list
  dayEditors = dayEditors.filter(ed => {
    try { return ed && ed.sourceElement && $.contains(document, ed.sourceElement); }
    catch(e){ return false; }
  });
}



</script>