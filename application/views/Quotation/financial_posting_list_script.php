<script type="text/javascript">

var $fpTable;

function fpListEsc(v) {
    if (v === null || v === undefined || v === '') return '';
    return $('<div>').text(v).html();
}

function fpListMoney(n) {
    var v = parseFloat(n || 0);
    if (isNaN(v)) v = 0;
    return v.toFixed(2);
}

$(document).ready(function () {

    $fpTable = $('#FinancialPostingList').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        buttons: [
            { extend: 'excel', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7], orthogonal: 'export' } },
            { extend: 'pdf',   exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7], orthogonal: 'export' } },
            { extend: 'print', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7], orthogonal: 'export' } }
        ],
        "language": {
            "emptyTable": "No financial posting recorded yet. Use \"Add Financial Posting\" to create one."
        },
        "ajax": {
            "url": "<?php echo base_url(); ?>index.php/Quotation/ajax_financial_posting_list",
            "type": "POST",
            "data": function (d) {
                d.search_value = $('#fpListSearch').val();
            }
        },
        "createdRow": function (row, data, index) {
            $('td', row).eq(2).html(data['trip_code']
                ? '<span class="badge badge-warning">' + fpListEsc(data['trip_code']) + '</span>'
                : '-');

            $('td', row).eq(5).html(fpListMoney(data['pre_quoted_amount']));
            $('td', row).eq(6).html(fpListMoney(data['actual_cost']));

            var margin = parseFloat(data['total_margin'] || 0);
            $('td', row).eq(7).html(
                '<span class="fw-bold ' + (margin >= 0 ? 'text-success' : 'text-danger') + '">' +
                margin.toFixed(2) + '</span>'
            );

            $('td', row).eq(8).html(
                '<button type="button" class="btn btn-sm btn-info" onclick="fpOpenForm(' +
                data['quotation_id'] + ',' + data['leads_id'] + ',\'' + fpListEsc(data['quotation_number']) +
                '\')"><i class="la la-edit"></i> Edit</button>'
            );
        },
        "drawCallback": function () {
            var api = this.api();
            api.column(0).nodes().each(function (node, i) {
                var pageInfo = api.page.info();
                $(node).html(pageInfo.start + i + 1);
            });
        },
        "columns": [
            { "data": "leads_id",          "orderable": false },
            { "data": "quotation_number",  "orderable": false },
            { "data": "trip_code",         "orderable": false },
            { "data": "guest_name",        "orderable": false },
            { "data": "travel_start_date", "orderable": false, "render": function(data, type, row) {
                var dur = parseInt(row.duration, 10);
                var durStr = '-';
                if (!isNaN(dur) && dur > 0) {
                    var nights = dur - 1;
                    durStr = nights + 'N ' + dur + 'D';
                }
                if (type === 'export') {
                    return (data || '-') + ' | ' + (row.travel_end_date || '-') + ' | ' + durStr;
                }
                return '<div style="line-height:1.6">' +
                    '<div><span style="color:#36b9cc;font-weight:600;font-size:13px">' + (data || '-') + '</span></div>' +
                    '<div><span style="color:#e74a3b;font-weight:600;font-size:13px">' + (row.travel_end_date || '-') + '</span></div>' +
                    '<div><span class="badge badge-success" style="font-size:11px">' + durStr + '</span></div>' +
                    '</div>';
            }},
            { "data": "pre_quoted_amount", "orderable": false },
            { "data": "actual_cost",       "orderable": false },
            { "data": "total_margin",      "orderable": false },
            { "data": "quotation_id",      "orderable": false }
        ]
    });

    var searchTimer = null;
    $('#fpListSearch').on('keyup', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(function () { $fpTable.ajax.reload(); }, 350);
    });

    $('#fpAddBtn').on('click', function () {
        $('#fpPickSearch').val('');
        fpLoadPickList('');
        $('#fpPickQuotationModal').modal('show');
    });

    var pickTimer = null;
    $('#fpPickSearch').on('keyup', function () {
        var term = $(this).val();
        clearTimeout(pickTimer);
        pickTimer = setTimeout(function () { fpLoadPickList(term); }, 350);
    });
});

function fpLoadPickList(term) {
    $('#fpPickList').html(
        '<div class="text-center py-4"><div class="spinner-border text-primary"></div></div>'
    );

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_trip_completed_quotations",
        type: "GET",
        data: { q: term },
        dataType: "JSON",
        success: function (res) {
            var rows = (res && res.data) ? res.data : [];
            if (!rows.length) {
                $('#fpPickList').html(
                    '<div class="alert alert-light mb-0">No trip completed quotation is pending a financial posting.</div>'
                );
                return;
            }
            var html = '';
            for (var i = 0; i < rows.length; i++) {
                var r = rows[i];
                html += '<div class="fp-pick-item" onclick="fpOpenForm(' + r.quotation_id + ',' + r.leads_id +
                        ',\'' + fpListEsc(r.quotation_number) + '\')">';
                html += '<div>';
                html += '<div class="fp-pick-name">' + fpListEsc(r.quotation_number) +
                        (r.trip_code ? ' <span class="badge badge-warning">' + fpListEsc(r.trip_code) + '</span>' : '') +
                        '</div>';
                html += '<div class="fp-pick-meta">' + fpListEsc(r.guest_name) + ' &middot; ' +
                        fpListEsc(r.leads_number) + ' &middot; ' + fpListEsc(r.travel_start_date) + '</div>';
                html += '</div>';
                html += '<span class="btn btn-sm btn-outline-primary">Select</span>';
                html += '</div>';
            }
            $('#fpPickList').html(html);
        },
        error: function () {
            $('#fpPickList').html('<div class="alert alert-danger mb-0">Failed to load quotations.</div>');
        }
    });
}

function fpOpenForm(quotationId, leadId, quotationNumber) {
    $('#fpPickQuotationModal').modal('hide');

    $('#quotation_id').val(quotationId);
    $('#fpFormQuotationLabel').text(quotationNumber ? '- ' + quotationNumber : '');
    $('#fpFormModal').modal('show');

    // Shared with the quotation hub: builds the day rows and loads any saved posting.
    fpLoad(leadId);
}

// Called by the shared fpSubmit() once a posting is saved.
function fpOnSaved() {
    $('#fpFormModal').modal('hide');
    $fpTable.ajax.reload(null, false);
}

<?php include(APPPATH . 'views/Quotation/financial_posting_form_script.php'); ?>
</script>
