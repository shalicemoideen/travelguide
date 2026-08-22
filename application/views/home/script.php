<script>

/******************* Leads Analytics Charts ********************/

$(document).ready(function(){



  var leadsLineChart = null;

  var staffBarChart  = null;

  var statusDonut    = null;



  function loadLeadsCharts(){

    $.ajax({

      url: "<?php echo base_url(); ?>index.php/Dashboard/leads_chart_data",

      method: "GET",

      dataType: "JSON",

      success: function(data){



        // ---- 1. Line Chart: Daily leads last 30 days ----

        if(document.getElementById('leads_daily_chart')){

          if(leadsLineChart){ leadsLineChart.destroy(); }

          var lineOptions = {

            chart: { type: 'area', height: 220, toolbar: { show: false }, zoom: { enabled: false } },

            series: [{ name: 'Leads Incoming', data: data.daily.counts }],

            xaxis: { categories: data.daily.labels, tickAmount: 6, labels: { rotate: -30, style: { fontSize: '11px' } } },

            yaxis: { min: 0, tickAmount: 4, labels: { formatter: function(v){ return parseInt(v); } } },

            colors: ['var(--primary)'],

            fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05 } },

            stroke: { curve: 'smooth', width: 2 },

            markers: { size: 3 },

            tooltip: { x: { show: true } },

            grid: { borderColor: '#f1f1f1' },

            dataLabels: { enabled: false }

          };

          leadsLineChart = new ApexCharts(document.getElementById('leads_daily_chart'), lineOptions);

          leadsLineChart.render();

        }



        // ---- 2. Grouped Bar Chart: Staff assigned vs converted ----

        if(document.getElementById('leads_staff_chart')){

          if(staffBarChart){ staffBarChart.destroy(); }

          var barOptions = {

            chart: { type: 'bar', height: 300, toolbar: { show: false } },

            series: [

              { name: 'Assigned', data: data.staff.assigned },

              { name: 'Converted to Trip', data: data.staff.converted }

            ],

            xaxis: { categories: data.staff.names, labels: { rotate: -20, style: { fontSize: '11px' } } },

            yaxis: { min: 0, tickAmount: 4, labels: { formatter: function(v){ return parseInt(v); } } },

            colors: ['#FFB900', '#0DC143'],

            plotOptions: { bar: { borderRadius: 4, columnWidth: '55%', grouped: true } },

            dataLabels: { enabled: false },

            legend: { position: 'top' },

            grid: { borderColor: '#f1f1f1' },

            tooltip: { shared: true, intersect: false }

          };

          staffBarChart = new ApexCharts(document.getElementById('leads_staff_chart'), barOptions);

          staffBarChart.render();

        }



        // ---- 3. Donut Chart: Lead status breakdown ----

        if(document.getElementById('leads_status_donut')){

          if(statusDonut){ statusDonut.destroy(); }

          var donutOptions = {

            chart: { type: 'donut', height: 280 },

            series: data.status.counts,

            labels: data.status.labels,

            colors: ['#4A90D9','#FFB900','#0DC143','#E23428','#6c757d'],

            legend: { position: 'bottom', fontSize: '12px' },

            dataLabels: { enabled: true, formatter: function(val){ return Math.round(val) + '%'; } },

            plotOptions: { pie: { donut: { size: '65%' } } },

            tooltip: { y: { formatter: function(v){ return v + ' leads'; } } }

          };

          statusDonut = new ApexCharts(document.getElementById('leads_status_donut'), donutOptions);

          statusDonut.render();

        }



      },

      error: function(){

        console.log('Error loading leads chart data');

      }

    });

  }



  loadLeadsCharts();



  // ---- Custom date range datepickers (dd/mm/yyyy) ----

  $('#custom-start-date').datepicker({

    format: 'dd/mm/yyyy',

    autoclose: true,

    todayHighlight: true

  });

  $('#custom-end-date').datepicker({

    format: 'dd/mm/yyyy',

    autoclose: true,

    todayHighlight: true

  });



  function dmyToYmd(dmy){

    if(!dmy) return '';

    var p = dmy.split('/');

    if(p.length !== 3) return '';

    return p[2] + '-' + p[1] + '-' + p[0];

  }



  // ---- Period filter dropdown ----

  $('#dashboard-period-select').on('change', function(){

    var period = $(this).val();



    if (period === 'custom') {

      $('#custom-date-range').show();

      return;

    } else {

      $('#custom-date-range').hide();

    }



    $.ajax({

      url: "<?php echo base_url(); ?>index.php/Dashboard/get_period_counts",

      method: "POST",

      dataType: "JSON",

      data: { period: period },

      success: function(data){

        $('#total_leads_count').text(data.allleads);

        $('#converted_trips_count').text(data.converted);

        $('#checkin_count').text(data.checkin);

        $('#checkout_count').text(data.checkout);

        $('#quotations_sent_count').text(data.quotations);

      },

      error: function(){

        console.log('Error loading period counts');

      }

    });

  });



  // ---- Custom date range apply ----

  $('#custom-date-apply').on('click', function(){

    var startDisplay = $('#custom-start-date').val();

    var endDisplay = $('#custom-end-date').val();

    if (!startDisplay || !endDisplay) {

      alert('Please select both start and end dates.');

      return;

    }

    var startDate = dmyToYmd(startDisplay);

    var endDate = dmyToYmd(endDisplay);

    if (!startDate || !endDate) {

      alert('Invalid date format. Please use dd/mm/yyyy.');

      return;

    }

    if (startDate > endDate) {

      alert('Start date cannot be after end date.');

      return;

    }

    $.ajax({

      url: "<?php echo base_url(); ?>index.php/Dashboard/get_period_counts",

      method: "POST",

      dataType: "JSON",

      data: { period: 'custom', custom_start: startDate, custom_end: endDate },

      success: function(data){

        $('#total_leads_count').text(data.allleads);

        $('#converted_trips_count').text(data.converted);

        $('#checkin_count').text(data.checkin);

        $('#checkout_count').text(data.checkout);

        $('#quotations_sent_count').text(data.quotations);

      },

      error: function(){

        console.log('Error loading custom period counts');

      }

    });

  });



});

/******************* End Leads Analytics Charts ********************/

</script>

