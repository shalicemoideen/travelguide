# Reports

## Overview

The application provides several reporting views, primarily through DataTables server-side processing and dashboard analytics. There is no dedicated reporting module; reports are embedded within list views with filtering capabilities.

## Dashboard Analytics

**Controller:** `Dashboard.php`
**Model:** `Dashboard_model.php`

### Statistics Provided

| Metric | Description |
|--------|-------------|
| Total leads | Count of all active leads |
| Converted leads | Leads with converted status |
| Qualified leads | Leads in qualified stage |
| Lost leads | Leads marked as lost |
| Total quotations | Count of all active quotations |
| Confirmed quotations | Quotations with status=5 |
| Pending quotations | Quotations with status=2 |
| Check-ins today | Property reservations with check-in = today |
| Check-outs today | Property reservations with check-out = today |
| Revenue (month) | Sum of client payments this month |
| Supplier payments (month) | Sum of property payments this month |
| Overdue installments | Count of overdue payment installments |

### Chart Data

- **Lead conversion trend**: Monthly lead count vs. conversion rate
- **Revenue trend**: Monthly revenue from client payments
- **Lead source distribution**: Pie chart of leads by source
- **Staff performance**: Bar chart of leads per staff member

## Built-in Report Views

### Lead Pipeline Reports

| View | Controller | Description |
|------|-----------|-------------|
| All Leads | `Leads` | Full lead list with all statuses |
| Recent Leads | `RecentLeads` | Recently created leads |
| Intake Leads | `LeadsIntake` | Leads in intake stage |
| Qualified Leads | `LeadsQualified` | Leads in qualified stage |
| Not Qualified | `LeadsNotQualified` | Leads not qualified |
| Lost Leads | `Leadslost` | Lost leads |
| Converted Leads | `LeadsConverted` | Converted leads |
| Active Trips | `Trips` | Converted leads currently travelling |

All lead lists use DataTables with:
- Server-side processing (`get` endpoint)
- Search by guest name, lead number, phone
- Filter by staff, source, stage, priority, date range
- Export to CSV/Excel via DataTables buttons

### Quotation Reports

| View | Controller | Description |
|------|-----------|-------------|
| Quotation List | `Quotation` | All quotations with status badges |
| Quotation Preview | `Quotation` | Read-only quotation with full details |
| Quotation Hub | `Quotation` | Aggregated quotation view |

### Property Reservation Reports

| View | Controller | Description |
|------|-----------|-------------|
| Reservation List | `Property_reservation` | All reservations with 3-level status |
| Reservation Detail | `Property_reservation` | Per-reservation detail with payments |

### Payment Reports

| View | Controller | Description |
|------|-----------|-------------|
| Receipt Scheduler | `Receipt_scheduler` | Client payment schedules |
| Property Payments | `Property_reservation` | Property owner payment schedules |
| Payment Report | `Payment_report` | Consolidated payment report |

### Cancellation Reports

| View | Controller | Description |
|------|-----------|-------------|
| Cancellation List | `Booking_cancellation` | All cancellations with P&L |
| Cancellation Detail | `Booking_cancellation` | Full P&L breakdown |

### Transporter Report

| View | Controller | Description |
|------|-----------|-------------|
| Transporter List | `Transporter` | Transporter performance and trip counts |

### Staff Attendance Report

| View | Controller | Description |
|------|-----------|-------------|
| Attendance Dashboard | `Staff_attendance` | Monthly attendance grid with in/out times |

## DataTables Configuration

All list views use DataTables with consistent configuration:

```javascript
$('#dataTable').DataTable({
    serverSide: true,
    ajax: '{controller}/get',
    columns: [
        { data: 'field1', name: 'field1' },
        { data: 'field2', name: 'field2' },
        // ...
    ],
    order: [[0, 'desc']],
    pageLength: 25,
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'print']
});
```

## Export Capabilities

- **CSV/Excel export**: Via DataTables Buttons extension
- **Print**: Via DataTables print button
- **Copy**: Copy to clipboard via DataTables

## Filtering

List views support filtering via:
- **Date range pickers**: For date-based filtering
- **Select2 dropdowns**: For staff, source, stage, status filtering
- **Free text search**: DataTables global search
- **Custom AJAX filters**: Filter buttons trigger `ajax.reload()` with custom parameters
