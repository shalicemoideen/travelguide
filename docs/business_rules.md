# Business Rules

## Lead Management

1. **Lead numbering**: Auto-generated as `LD-{leads_id}` (e.g., LD-1, LD-2)
2. **Lead types**: B2C (direct customer) or B2B (via agent/partner)
3. **Date types**: WITH (fixed start/end dates) or FLEXI (flexible dates)
4. **Lead status pipeline**: Intake → Qualified → Not Qualified → Lost → Converted (tracked via `lead_current_status` and `stage_id_fk`)
5. **Meta lead ads**: Leads from Facebook/Meta ads are auto-created via webhook with `raw_meta_json` stored for reference
6. **Force stop**: Staff can be force-stopped from receiving Meta leads (`meta_force_stop` = 'Y'); logged in `force_stop_log`
7. **Guest count**: Each lead has guest count details (adults, children) with child age breakdowns
8. **Accommodation plan**: Each lead has an accommodation plan linked to guest count details

## Quotation

1. **Quotation numbering**: Auto-generated as `Quot-{last_id + 1}`
2. **Multi-option quotations**: Each quotation can have multiple options (variants) with different hotels, rooms, vehicles, meal plans
3. **Package data copying**: On quotation creation, all package data (itinerary, inclusions, exclusions, add-ons, payment policies, terms, cancellation policies, notes) is copied into quotation tables — the quotation becomes independent of the package
4. **Cover page images**: Copied from package to quotation-specific upload directory
5. **Room tariff calculation**: Tariffs are calculated per room based on:
   - Number of adults, children (with/without bed)
   - Extra beds
   - Room count
   - Per-night rate (from room tariff management, adjusted for seasonal hikes)
   - Supplements (e.g., Christmas/New Year supplements)
   - Auto-calculated total vs. manual override
6. **Tariff context**: Tariff lookup uses lead_id, day, destination, property, and room category to find the applicable rate
7. **Seasonal hikes**: Room tariffs can have seasonal hike periods with per-property, per-room, per-weekday rate adjustments
8. **Margin calculation**: Each option has margin type (FIXED or PERCENTAGE) applied to total cost to get quote rate
9. **Amount types**: Options can be priced as `net` or `gross`
10. **Per-person pricing**: `quotation_options_per_amount` for per-person rate display
11. **Quotation statuses**: 2=created, 5=confirmed, 6=cancelled
12. **Lead quotation flag**: `leads_quotation_status` set to 1 when quotation created, reset to 0 on quotation delete
13. **Transaction safety**: Quotation creation uses DB transaction with rollback on any failure
14. **Soft delete cascade**: Deleting a quotation soft-deletes all 12+ child tables recursively
15. **Update strategy**: Itinerary days are updated in-place; other child tables are deleted and reinserted on update
16. **Batch tariff calculation**: A checkbox "Calculate room tariff for all properties" triggers sequential tariff calculation for all rooms in an option via AJAX

## Client Confirmation

1. **Tokenized link**: Unique token (`md5(uniqid(quotation_id + time))`) generated per quotation
2. **One confirmation per quotation**: Duplicate generation is blocked
3. **Client selects**: One option, one property per day, optional room categories
4. **Confirmation status**: `pending` → `confirmed` on client submission
5. **Client details captured**: Name, email, phone, comments on confirmation

## Property Reservation

1. **Three-level confirmation**: Blocking → Confirmation → Re-confirmation
2. **Blocking (Level 1)**: Hotel blocks rooms; records confirmer, cut-off date, blocked date
3. **Confirmation (Level 2)**: Hotel formally confirms with confirmation number
4. **Re-confirmation (Level 3)**: Close to travel date, staff re-confirms
5. **Booking number format**: e.g., `2-26-326` (derived from quotation/option/property IDs)
6. **One reservation per property per quotation**: Unique combination
7. **Auto-creation**: Reservations auto-created from quotation confirmation records
8. **Payment scheduler**: Each reservation has a payment scheduler (FULL or EMI) for property owner payments
9. **Payment status**: PENDING → PARTIAL → PAID / OVERDUE
10. **Comments**: Append-only comment trail per reservation

## Payment Scheduling

1. **Two schedulers per booking**: Client scheduler (`receipt_scheduler`) and property scheduler (`property_payment_scheduler`)
2. **Payment types**: FULL (single payment) or EMI (installments)
3. **EMI split**: By fixed AMOUNT or by PERCENTAGE of total
4. **Installment due dates**: Each installment has its own due date
5. **Overdue tracking**: Installments past due date with unpaid balance are OVERDUE
6. **Append-only payments**: Each payment is a new row; no updates or deletes
7. **Payment methods**: Cash, Card, UPI, Bank Transfer, Cheque
8. **Payment slips**: Optional file upload for documentation
9. **Financial defaults**: System can auto-calculate expected totals from quotation confirmed option

## Booking Cancellation

1. **Cancellation scope**: FULL (entire booking) or PARTIAL (specific properties/services)
2. **Reason categories**: GUEST, COMPANY, SUPPLIER, FORCE_MAJEURE, NO_SHOW, OTHER
3. **Policy slab calculation**: `days_before_travel` determines cancellation charge percentage
4. **Financial snapshots**: Frozen at approval time (snap_package_value, snap_customer_received, snap_supplier_booked, snap_supplier_paid)
5. **Customer refund**: `customer_refund_due = snap_customer_received - customer_cancellation_charge`
6. **Supplier refund**: `supplier_refund_expected = snap_supplier_booked - supplier_cancellation_charge`
7. **P&L formula**: `net_result = net_retained_from_customer + net_paid_to_suppliers - net_other_cost + net_adjustment_total`
8. **Approval workflow**: DRAFT → PENDING_APPROVAL → APPROVED → SETTLED (or REJECTED)
9. **Charge override**: Staff can manually override auto-calculated customer cancellation charge
10. **Refund reversal**: Individual refunds can be reversed via REVERSAL entries
11. **Cancellation reversal**: Entire cancellation can be reversed, restoring quotation status
12. **Property-level tracking**: Each property has its own cancellation line with charge and refund tracking
13. **Non-property services**: Transport, visa, guide, etc. tracked separately
14. **Adjustments**: Write-offs, goodwill, gateway fees, tax adjustments, incentive clawback
15. **Settlement status**: Both customer and supplier settlements tracked independently

## Room Tariff Management

1. **Base tariff**: Per room category per property, with per-night rates
2. **Seasonal hikes**: Hike periods (date ranges) with rate adjustments
3. **Hike scope**: Per property, per room category, per weekday
4. **Hike types**: Flat amount or percentage increase
5. **Holiday settings**: Configurable holiday surcharge settings
6. **Company holidays**: Holiday calendar affects tariff calculations

## Staff & Attendance

1. **Biometric integration**: eSSL API for attendance sync
2. **Device user ID**: Maps biometric employee code to `user_details.device_user_id`
3. **Attendance records**: Daily in/out times from biometric punches
4. **Leave requests**: Sick, casual, paid, unpaid, half-day, other
5. **Force stop**: Can stop Meta lead assignment to specific staff

## Package Management

1. **Package as template**: Reusable travel template with itinerary, properties, rooms, policies
2. **Package options**: Multiple options within a package (different hotel categories)
3. **Day-by-day structure**: Each package has days with destinations and properties
4. **Room categories**: Each property in a package has room categories with tariff details
5. **Inclusions/Exclusions**: Managed via shared `inclusion_exclusion_common` master
6. **Policies**: Payment policies, terms, cancellation policies, notes — all copied to quotation on creation
7. **Special requirements**: Per-day special requirements with costs

## General

1. **Soft deletes**: All tables use `*_status` column (1=active, 0=deleted); no physical deletes
2. **Audit trail**: `activity` table logs all CRUD operations with user, IP, timestamp
3. **Login logs**: All login/logout events logged in `login_logs`
4. **Currency**: Default INR; stored per payment scheduler
5. **Timezone**: Asia/Kolkata for all date/time operations
6. **Decimal precision**: Financial fields use decimal(14,2) for cancellation, double for quotation/lead
