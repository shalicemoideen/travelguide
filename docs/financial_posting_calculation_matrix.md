# Financial Posting — Calculation Matrix

> **SINGLE SOURCE OF TRUTH** for every field, value, formula, and data flow on the Financial Posting screen.

---

## 1. OVERVIEW

### Purpose

The Financial Posting screen records **actual operational costs** incurred during a tour and compares them against **quoted costs** to determine real-time profit or loss. It is the post-confirmation financial reconciliation tool used after property reservations are completed.

### Why Every Value Exists

| Value Category | Why It Exists |
|---------------|---------------|
| Quoted Amounts | Immutable reference from the quotation — the cost promised to the client |
| Actual Amounts | Real cost incurred — editable by operations staff |
| Descriptions | Audit trail explaining why actual differs from quoted |
| Other Expenses | Catch-all for costs not covered by standard categories (visa, tips, tolls) |
| Margin | Predefined profit margin from the quotation option |
| Pre Quoted Amount | Total amount quoted to the client — the revenue benchmark |
| Actual Cost (sum of Quoted) | Total quoted cost across all line items |
| Cost After Financial Post | Total actual cost across all line items |
| Total | Actual cost plus margin — total expenditure including profit |
| Difference | Revenue benchmark minus total expenditure — shows surplus or deficit |
| Total Margin | Final profit/loss figure — margin plus difference |

### Which Values Are Editable

| Value | Editable? |
|-------|-----------|
| Driver Quoted Amount | No (readonly) |
| Driver Actual Amount | Yes |
| Driver Description | Yes |
| Hotel Quoted (per day) | No (readonly) |
| Hotel Actual (per day) | Yes |
| Hotel Description (per day) | Yes |
| Inclusions Quoted (per day) | No (readonly) |
| Inclusions Actual (per day) | Yes |
| Inclusions Description (per day) | Yes |
| Special Quoted (per day) | No (readonly) |
| Special Actual (per day) | Yes |
| Special Description (per day) | Yes |
| Other Expense Label | Yes |
| Other Expense Amount | Yes |
| Other Expense Description | Yes |
| Margin | No (display only) |
| Pre Quoted Amount | No (display only) |
| Actual Cost | No (auto-calculated) |
| Cost After Financial Post | No (auto-calculated) |
| Total | No (auto-calculated) |
| Difference | No (auto-calculated) |
| Total Margin | No (auto-calculated) |
| Overall Description / Notes | Yes |
| Day rows (add/remove) | No (auto-generated from itinerary) |
| Expense rows (add/remove) | Yes (user can add/delete) |

### Which Values Are Calculated

| Value | Calculated By | Formula |
|-------|--------------|---------|
| Day Total (Quoted) | JS (`fpAddDay`) | hotel_quoted + inclusions_quoted + special_quoted |
| Actual Cost | JS (`fpCalculate`) | SUM(all .fp-quoted inputs) |
| Cost After Financial Post | JS (`fpCalculate`) | SUM(all .fp-actual inputs) |
| Total | JS (`fpCalculate`) | Cost After Financial Post + Margin |
| Difference | JS (`fpCalculate`) | Pre Quoted Amount − Total |
| Total Margin | JS (`fpCalculate`) | Margin + Difference |
| Pre Quoted Amount | PHP model | hotelTotal + inclusionsTotal + specialTotal + driverAmount + marginValue |

---

## 2. COMPLETE FIELD MATRIX

### A. Driver Section

| Screen Label | Internal Name | DB Table | DB Column | Source Module | Controller | Model | View | JavaScript | Editable | Calculation | Validation | Updated When | Used By |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Driver Quote Amount | `fp_driver_quoted` | `financial_posting` | `fp_driver_quoted` | Quotation | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `hub.php:471` | `[name="fp_driver_quoted"]` | No (readonly) | From `quotation_options_cab_amount` | `readonly`, `min="0"`, `step="0.01"` | Load/Reset | Actual Cost |
| Driver Actual Amount | `fp_driver_actual` | `financial_posting` | `fp_driver_actual` | User input | `ajax_save_financial_posting` | N/A | `hub.php:472` | `[name="fp_driver_actual"]` | Yes | Defaults to `driver_quoted` | `min="0"`, `step="0.01"` | User/Save/Load | Cost After FP |
| Driver Description | `fp_driver_desc` | `financial_posting` | `fp_driver_desc` | User input | `ajax_save_financial_posting` | N/A | `hub.php:473` | `[name="fp_driver_desc"]` | Yes | None | None | User/Save/Load | Audit |

### B. Day-Based Rows (per itinerary day)

#### Day Header

| Screen Label | Internal Name | DB Table | DB Column | Source Module | Controller | Model | View | JavaScript | Editable | Calculation | Validation | Updated When | Used By |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Day Label | `day_label` | `financial_posting_hotel_days` | `fphd_day_label` | Quotation itinerary | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `hub_script.php fpAddDay()` | `dayData.day_label` | No | From `quotation_properties_days_day` | None | Load/Reset | Day ID, merge key |
| Day Total (Quoted) | N/A | N/A | N/A | N/A | N/A | N/A | `fpAddDay()` | Calculated in `fpAddDay()` | No | `hotel_quoted + inc_quoted + special_quoted` | None | Load/Reset | Visual reference |

#### Hotel Rent (per day)

| Screen Label | Internal Name | DB Table | DB Column | Source Module | Controller | Model | View | JavaScript | Editable | Calculation | Validation | Updated When | Used By |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Hotel Rent (Quoted) | `hotel_quoted` | `financial_posting_hotel_days` | `fphd_quoted_amount` | Quotation tariff | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `fpAddDay()` | `.fp-quoted` in day row | No (readonly) | `SUM(manual_total_rate)` confirmed rooms | `readonly`, `min="0"`, `step="0.01"` | Load/Reset | Actual Cost, Day Total |
| Hotel Rent (Actual) | `hotel_actual` | `financial_posting_hotel_days` | `fphd_actual_amount` | Reservation or user | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `fpAddDay()` | `.fp-actual` in day row | Yes | Defaults to `discounted_total` or `total_amount`; user override | `min="0"`, `step="0.01"` | User/Save/Load | Cost After FP |
| Hotel Description | `hotel_desc` | `financial_posting_hotel_days` | `fphd_description` | Auto or user | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `fpAddDay()` | text input in day row | Yes | Auto: "Reservation discount: X" | None | User/Save/Load | Audit |

#### Property Based Inclusions (per day)

| Screen Label | Internal Name | DB Table | DB Column | Source Module | Controller | Model | View | JavaScript | Editable | Calculation | Validation | Updated When | Used By |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Inclusions (Quoted) | `inc_quoted` | `financial_posting_inclusions` | `fpi_quoted_amount` | Quotation inclusions | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `fpAddDay()` | `.fp-quoted` in inc row | No (readonly) | `SUM(inclusion_amount)` confirmed property | `readonly`, `min="0"`, `step="0.01"` | Load/Reset | Actual Cost, Day Total |
| Inclusions (Actual) | `inc_actual` | `financial_posting_inclusions` | `fpi_actual_amount` | User input | `ajax_save_financial_posting` | N/A | `fpAddDay()` | `.fp-actual` in inc row | Yes | Defaults to `inc_quoted`; user override | `min="0"`, `step="0.01"` | User/Save/Load | Cost After FP |
| Inclusions Description | `inc_desc` | `financial_posting_inclusions` | `fpi_description` | Auto or user | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `fpAddDay()` | text input in inc row | Yes | Auto: comma-separated inclusion names | None | User/Save/Load | Audit |

#### Special Requirements (per day)

| Screen Label | Internal Name | DB Table | DB Column | Source Module | Controller | Model | View | JavaScript | Editable | Calculation | Validation | Updated When | Used By |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Special (Quoted) | `special_quoted` | `financial_posting_special` | `fps_quoted_amount` | Quotation special | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `fpAddDay()` | `.fp-quoted` in special row | No (readonly) | `SUM(special_requirements_cost)` per day | `readonly`, `min="0"`, `step="0.01"` | Load/Reset | Actual Cost, Day Total |
| Special (Actual) | `special_actual` | `financial_posting_special` | `fps_actual_amount` | User input | `ajax_save_financial_posting` | N/A | `fpAddDay()` | `.fp-actual` in special row | Yes | Defaults to `special_quoted`; user override | `min="0"`, `step="0.01"` | User/Save/Load | Cost After FP |
| Special Description | `special_desc` | `financial_posting_special` | `fps_description` | Auto or user | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `fpAddDay()` | text input in special row | Yes | Auto: comma-separated requirement names | None | User/Save/Load | Audit |

### C. Other Expenses Section

| Screen Label | Internal Name | DB Table | DB Column | Source Module | Controller | Model | View | JavaScript | Editable | Calculation | Validation | Updated When | Used By |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Expense Label | `exp_labels[]` | `financial_posting_expenses` | `fpe_label` | User input | `ajax_save_financial_posting` | N/A | `fpAddExpense()` | `[name="exp_labels[]"]` | Yes | None | None | User/Save/Load | Expense ID |
| Expense Quoted | N/A | N/A | N/A | N/A | N/A | N/A | `fpAddExpense()` | "—" (em dash) | No | N/A | N/A | N/A | N/A |
| Expense Amount | `exp_amounts[]` | `financial_posting_expenses` | `fpe_amount` | User input | `ajax_save_financial_posting` | N/A | `fpAddExpense()` | `[name="exp_amounts[]"]` class `fp-actual` | Yes | User entered | `min="0"`, `step="0.01"` | User/Save/Load | Cost After FP |
| Expense Description | `exp_descs[]` | `financial_posting_expenses` | `fpe_description` | User input | `ajax_save_financial_posting` | N/A | `fpAddExpense()` | `[name="exp_descs[]"]` | Yes | None | None | User/Save/Load | Audit |
| Add Expense button | N/A | N/A | N/A | N/A | N/A | N/A | `hub.php:480` | `onclick="fpAddExpense()"` | N/A | Adds row | N/A | Click | N/A |
| Delete Expense button | N/A | N/A | N/A | N/A | N/A | N/A | `fpAddExpense()` | `onclick="fpRemoveRow(this)"` | N/A | Removes row | N/A | Click | N/A |

### D. Summary / Totals Section

| Screen Label | Internal Name | DB Table | DB Column | Source Module | Controller | Model | View | JavaScript | Editable | Calculation | Validation | Updated When | Used By |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Actual Cost | `fp_actual_cost` | `financial_posting` | `fp_actual_cost` | Calculated | `ajax_save_financial_posting` | N/A | `hub.php:486` | `#fpActualCost` | No | `SUM(all .fp-quoted)` | N/A | Load (quoted is readonly) | Display |
| Cost After Financial Post | `fp_cost_after` | `financial_posting` | `fp_cost_after` | Calculated | `ajax_save_financial_posting` | N/A | `hub.php:491` | `#fpCostAfterPost` | No | `SUM(all .fp-actual)` | N/A | Any actual input change | Total |
| Margin | `fp_margin` | `financial_posting` | `fp_margin` | Quotation | `ajax_save_financial_posting` | `get_financial_posting_defaults` | `hub.php:497` | `#fpMargin` | No | `quotation_options_margin_value` | N/A | Load/Reset | Total, Total Margin |
| Total | N/A | N/A | N/A | Calculated | N/A | N/A | `hub.php:503` | `#fpTotalAfterMargin` | No | `Cost After FP + Margin` | N/A | Any actual input change | Difference |
| Pre Quoted Amount | N/A | N/A | N/A | Calculated | N/A | `get_financial_posting_defaults` | `hub.php:509` | `#fpPreQuotedAmount` | No | `hotelTotal + incTotal + specialTotal + driver + margin` | N/A | Load/Reset | Difference |
| Difference | N/A | N/A | N/A | Calculated | N/A | N/A | `hub.php:515` | `#fpDifference` | No | `Pre Quoted − Total` | N/A | Any actual input change | Total Margin |
| Total Margin | N/A | N/A | N/A | Calculated | N/A | N/A | `hub.php:521` | `#fpTotalMargin` | No | `Margin + Difference` | N/A | Any actual input change | Display (final P&L) |
| Description / Notes | `fp_notes` | `financial_posting` | `fp_notes` | User input | `ajax_save_financial_posting` | N/A | `hub.php:527` | `#fpNotes` | Yes | None | None | User/Save/Load | Audit |

### E. Hidden Fields

| Screen Label | Internal Name | DB Table | DB Column | Source Module | Controller | Model | View | JavaScript | Editable | Calculation | Validation | Updated When | Used By |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Lead ID | `fp_leads_id_fk` | `financial_posting` | `fp_leads_id_fk` | Hub | `ajax_save_financial_posting` | N/A | `hub.php:454` | `#fp_leads_id` | No | From `#hub_lead_id` | Must be > 0 for save | Tab show/Load | Save payload |
| Record ID | `fp_id` | `financial_posting` | `fp_id` | Load response | `ajax_save_financial_posting` | N/A | `hub.php:455` | `#fp_record_id` | No | From AJAX response | 0 = new, >0 = update | Load/Save response | Save payload |

### F. Buttons

| Screen Label | Internal Name | Controller | View | JavaScript | Purpose |
|---|---|---|---|---|---|
| Submit | N/A | `ajax_save_financial_posting` | `hub.php:449` | `onclick="fpSubmit()"` | Saves all FP data |
| Reset | N/A | N/A | `hub.php:450` | `onclick="fpReset()"` | Reloads from server |
| Add Expense | N/A | N/A | `hub.php:480` | `onclick="fpAddExpense()"` | Adds expense row |

---

## 3. CALCULATION DEPENDENCY TREE

### Total Margin (final profit/loss)

```
Total Margin
  ← depends on
    ├─ Margin (from quotation_options.quotation_options_margin_value)
    └─ Difference
         ← depends on
            ├─ Pre Quoted Amount (from get_financial_posting_defaults)
            │    ← depends on
            │       ├─ hotelTotal (SUM of hotel_quoted across all days)
            │       │    ← depends on
            │       │       └─ quotation_room_tariff_details.manual_total_rate (confirmed rooms)
            │       ├─ inclusionsTotal (SUM of inc_quoted across all days)
            │       │    ← depends on
            │       │       └─ quotation_property_inclusions.inclusion_amount (confirmed property)
            │       ├─ specialTotal (SUM of special_quoted across all days)
            │       │    ← depends on
            │       │       └─ quotation_special_requirements.quotation_special_requirements_cost
            │       ├─ driverAmount
            │       │    ← depends on
            │       │       └─ quotation_options.quotation_options_cab_amount
            │       └─ marginValue
            │            ← depends on
            │               └─ quotation_options.quotation_options_margin_value
            │
            └─ Total
                 ← depends on
                    ├─ Cost After Financial Post (SUM of all .fp-actual)
                    │    ← depends on
                    │       ├─ fp_driver_actual (user input / default from driver_quoted)
                    │       ├─ SUM(fphd_actual_amount) across all days
                    │       │    ← depends on
                    │       │       └─ property_payment_scheduler.discounted_total (if reservation)
                    │       │          or user override
                    │       ├─ SUM(fpi_actual_amount) across all days
                    │       │    ← depends on
                    │       │       └─ defaults to fpi_quoted_amount, user can override
                    │       ├─ SUM(fps_actual_amount) across all days
                    │       │    ← depends on
                    │       │       └─ defaults to fps_quoted_amount, user can override
                    │       └─ SUM(fpe_amount) across all expenses
                    │            ← depends on
                    │               └─ user input only
                    │
                    └─ Margin (from quotation_options.quotation_options_margin_value)
```

### Actual Cost (sum of Quoted)

```
Actual Cost
  ← depends on
    ├─ fp_driver_quoted
    │    ← depends on
    │       └─ quotation_options.quotation_options_cab_amount
    ├─ SUM(fphd_quoted_amount) across all days
    │    ← depends on
    │       └─ SUM(quotation_room_tariff_details.manual_total_rate) per day
    ├─ SUM(fpi_quoted_amount) across all days
    │    ← depends on
    │       └─ SUM(quotation_property_inclusions.inclusion_amount) per day
    └─ SUM(fps_quoted_amount) across all days
         ← depends on
            └─ SUM(quotation_special_requirements.quotation_special_requirements_cost) per day
```

### Day Total (Quoted) — per day

```
Day Total (Quoted)
  ← depends on
    ├─ hotel_quoted (for that day)
    │    ← depends on
    │       └─ quotation_room_tariff_details.manual_total_rate (confirmed rooms, that day)
    ├─ inclusions_quoted (for that day)
    │    ← depends on
    │       └─ quotation_property_inclusions.inclusion_amount (confirmed property, that day)
    └─ special_quoted (for that day)
         ← depends on
            └─ quotation_special_requirements.quotation_special_requirements_cost (that day)
```

---

## 4. CALCULATION FORMULAS

### Formula 1: Day Total (Quoted)

| Attribute | Value |
|-----------|-------|
| **Purpose** | Show total quoted cost for a single itinerary day |
| **Formula** | `Day Total = Hotel Quoted + Inclusions Quoted + Special Quoted` |
| **Variables** | `Hotel Quoted` = sum of `manual_total_rate` for confirmed rooms on that day; `Inclusions Quoted` = sum of `inclusion_amount` for confirmed property on that day; `Special Quoted` = sum of `quotation_special_requirements_cost` for that day |
| **Example** | Hotel=3000 + Inclusions=500 + Special=200 → Day Total = 3,700.00 |
| **Database values** | `quotation_room_tariff_details.manual_total_rate`, `quotation_property_inclusions.inclusion_amount`, `quotation_special_requirements.quotation_special_requirements_cost` |
| **Refresh trigger** | Calculated once in `fpAddDay()` on load. Not refreshed after. |
| **Implemented in** | `hub_script.php` `fpAddDay()` |

### Formula 2: Actual Cost (Sum of Quoted)

| Attribute | Value |
|-----------|-------|
| **Purpose** | Total of all quoted amounts across every row in the table |
| **Formula** | `Actual Cost = SUM(all .fp-quoted inputs in #fpHubTable)` |
| **Variables** | Includes driver quoted, all hotel quoted, all inclusions quoted, all special quoted. Does NOT include other expenses (no quoted amount). |
| **Example** | Driver=5000 + Day1 Hotel=3000 + Day1 Inc=500 + Day1 Special=200 + Day2 Hotel=4000 → 12,700.00 |
| **Database values** | `fp_driver_quoted`, `fphd_quoted_amount`, `fpi_quoted_amount`, `fps_quoted_amount` |
| **Refresh trigger** | `fpCalculate()` on any `.fp-quoted` input change (readonly, so only on load) |
| **Implemented in** | `hub_script.php` `fpCalculate()` |

### Formula 3: Cost After Financial Post (Sum of Actual)

| Attribute | Value |
|-----------|-------|
| **Purpose** | Total of all actual amounts across every row including other expenses |
| **Formula** | `Cost After Financial Post = SUM(all .fp-actual inputs in #fpHubTable)` |
| **Variables** | Includes driver actual, all hotel actual, all inclusions actual, all special actual, all expense amounts |
| **Example** | Driver=4500 + Day1 Hotel=2800 + Day1 Inc=500 + Day1 Special=150 + Day2 Hotel=3800 + Expense=300 → 12,050.00 |
| **Database values** | `fp_driver_actual`, `fphd_actual_amount`, `fpi_actual_amount`, `fps_actual_amount`, `fpe_amount` |
| **Refresh trigger** | `fpCalculate()` on any `.fp-actual` input change |
| **Implemented in** | `hub_script.php` `fpCalculate()` |

### Formula 4: Margin

| Attribute | Value |
|-----------|-------|
| **Purpose** | Predefined profit margin from the quotation |
| **Formula** | `Margin = quotation_options.quotation_options_margin_value` |
| **Variables** | `quotation_options_margin_value` — set during quotation creation for confirmed/first active option |
| **Example** | 5,000.00 |
| **Database values** | `quotation_options.quotation_options_margin_value` |
| **Refresh trigger** | Load / Reset only |
| **Implemented in** | `Quotation_model::get_financial_posting_defaults()` |

### Formula 5: Total

| Attribute | Value |
|-----------|-------|
| **Purpose** | Total expenditure including margin |
| **Formula** | `Total = Cost After Financial Post + Margin` |
| **Variables** | `Cost After Financial Post` (Formula 3), `Margin` (Formula 4) |
| **Example** | 12,050 + 5,000 → 17,050.00 |
| **Database values** | None directly — computed from computed values |
| **Refresh trigger** | `fpCalculate()` on any `.fp-actual` input change |
| **Implemented in** | `hub_script.php` `fpCalculate()` |

### Formula 6: Pre Quoted Amount

| Attribute | Value |
|-----------|-------|
| **Purpose** | Total amount quoted to the client — revenue benchmark |
| **Formula** | `Pre Quoted Amount = hotelTotal + inclusionsTotal + specialTotal + driverAmount + marginValue` |
| **Variables** | `hotelTotal` = SUM of all daily hotel quoted; `inclusionsTotal` = SUM of all daily inclusion quoted; `specialTotal` = SUM of all daily special quoted; `driverAmount` = `quotation_options_cab_amount`; `marginValue` = `quotation_options_margin_value` |
| **Example** | 7,000 + 500 + 200 + 5,000 + 5,000 → 17,700.00 |
| **Database values** | `quotation_room_tariff_details.manual_total_rate`, `quotation_property_inclusions.inclusion_amount`, `quotation_special_requirements.quotation_special_requirements_cost`, `quotation_options.quotation_options_cab_amount`, `quotation_options.quotation_options_margin_value` |
| **Refresh trigger** | Load / Reset only (calculated server-side) |
| **Implemented in** | `Quotation_model::get_financial_posting_defaults()` |

### Formula 7: Difference

| Attribute | Value |
|-----------|-------|
| **Purpose** | Surplus or deficit — revenue benchmark minus total expenditure |
| **Formula** | `Difference = Pre Quoted Amount − Total` |
| **Variables** | `Pre Quoted Amount` (Formula 6), `Total` (Formula 5) |
| **Example** | 17,700 − 17,050 → +650.00 (profit) |
| **Database values** | None directly |
| **Refresh trigger** | `fpCalculate()` on any `.fp-actual` input change |
| **Implemented in** | `hub_script.php` `fpCalculate()` |
| **Visual** | Green badge > 0, red badge < 0, grey badge = 0 |

### Formula 8: Total Margin

| Attribute | Value |
|-----------|-------|
| **Purpose** | Final profit/loss figure |
| **Formula** | `Total Margin = Margin + Difference` |
| **Variables** | `Margin` (Formula 4), `Difference` (Formula 7) |
| **Example** | 5,000 + 650 → 5,650.00 (profit) |
| **Database values** | None directly |
| **Refresh trigger** | `fpCalculate()` on any `.fp-actual` input change |
| **Implemented in** | `hub_script.php` `fpCalculate()` |
| **Visual** | Green badge > 0, red badge < 0, grey badge = 0 |

### Formula 9: Hotel Cost (Quoted, per day)

| Attribute | Value |
|-----------|-------|
| **Purpose** | Quoted hotel cost for a single day |
| **Formula** | `Hotel Quoted (day) = SUM(quotation_room_tariff_details.manual_total_rate) WHERE day = this day AND room is confirmed` |
| **Example** | Day 1: Deluxe (2,000) + Suite (1,000) → 3,000.00 |
| **Database values** | `quotation_room_tariff_details.manual_total_rate`, `quotation_confirmation`, `quotation_properties_days`, `quotation_properties_rooms` |
| **Refresh trigger** | Load / Reset only |
| **Implemented in** | `Quotation_model::get_financial_posting_defaults()` |

### Formula 10: Hotel Cost (Actual, per day)

| Attribute | Value |
|-----------|-------|
| **Purpose** | Actual hotel cost for a single day |
| **Formula** | `Hotel Actual (day) = property_payment_scheduler.discounted_total` (if reservation exists) OR `Hotel Quoted` (fallback) |
| **Example** | Reservation total=3,200, discount=400 → discounted_total=2,800 → 2,800.00 |
| **Database values** | `property_payment_scheduler.total_amount`, `property_payment_scheduler.discount_amount`, `property_payment_scheduler.discounted_total`, `property_reservation` |
| **Refresh trigger** | Load / Reset (defaults); user can override |
| **Implemented in** | `Quotation_model::get_financial_posting_defaults()` |

### Formula 11: Driver Cost (Quoted)

| Attribute | Value |
|-----------|-------|
| **Purpose** | Quoted driver/transport cost |
| **Formula** | `Driver Quoted = quotation_options.quotation_options_cab_amount` |
| **Example** | 5,000.00 |
| **Database values** | `quotation_options.quotation_options_cab_amount` |
| **Refresh trigger** | Load / Reset only |
| **Implemented in** | `Quotation_model::get_financial_posting_defaults()` |

### Formula 12: Inclusions Cost (Quoted, per day)

| Attribute | Value |
|-----------|-------|
| **Purpose** | Quoted inclusion cost for a single day |
| **Formula** | `Inclusions Quoted (day) = SUM(quotation_property_inclusions.inclusion_amount) WHERE property = confirmed property AND day = this day` |
| **Example** | Breakfast=200 + Airport Pickup=300 → 500.00 |
| **Database values** | `quotation_property_inclusions.inclusion_amount`, `quotation_property_inclusions.inclusion_name`, `quotation_confirmation` |
| **Refresh trigger** | Load / Reset only |
| **Implemented in** | `Quotation_model::get_financial_posting_defaults()` |

### Formula 13: Special Requirements Cost (Quoted, per day)

| Attribute | Value |
|-----------|-------|
| **Purpose** | Quoted special requirement cost for a single day |
| **Formula** | `Special Quoted (day) = SUM(quotation_special_requirements.quotation_special_requirements_cost) WHERE day = this day` |
| **Example** | Birthday Cake=200 → 200.00 |
| **Database values** | `quotation_special_requirements.quotation_special_requirements_cost`, `quotation_special_requirements.quotation_special_requirements_name` |
| **Refresh trigger** | Load / Reset only |
| **Implemented in** | `Quotation_model::get_financial_posting_defaults()` |

### Formula 14: Other Expense Amount

| Attribute | Value |
|-----------|-------|
| **Purpose** | User-defined additional expense |
| **Formula** | N/A — user entered value |
| **Example** | Guide Tips = 300.00 |
| **Database values** | `financial_posting_expenses.fpe_amount` |
| **Refresh trigger** | User input only |
| **Implemented in** | `hub_script.php` `fpAddExpense()` |

---

## 5. DATA FLOW

### Load Flow — Driver Quoted Amount

```
Database: quotation_options.quotation_options_cab_amount
  ↓
Model: Quotation_model::get_financial_posting_defaults() — selects confirmed/first option
  ↓
Controller: Quotation::ajax_get_financial_posting_defaults($quotation_id) — returns JSON
  ↓
API: GET Quotation/ajax_get_financial_posting_defaults/{quotationId}
  ↓
JavaScript: fpLoad() → defaults.driver_quote_amount → [name="fp_driver_quoted"].val()
  ↓
HTML: <input name="fp_driver_quoted" readonly>
  ↓
User: Sees pre-filled, read-only value
```

### Load Flow — Driver Actual (no saved FP)

```
Database: quotation_options.quotation_options_cab_amount
  ↓
Model: get_financial_posting_defaults() → defaults.driver_quote_amount
  ↓
Controller: ajax_get_financial_posting_defaults() → JSON
  ↓
API: GET .../defaults/{quotationId}
  ↓
JavaScript: fpLoad() → no saved FP → [name="fp_driver_actual"].val(defaults.driver_quote_amount)
  ↓
HTML: <input name="fp_driver_actual">
  ↓
User: Sees pre-filled value, can edit
```

### Load Flow — Driver Actual (saved FP exists)

```
Database: financial_posting.fp_driver_actual
  ↓
Controller: Quotation::ajax_get_financial_posting($leadId) — direct DB query
  ↓
API: GET Quotation/ajax_get_financial_posting/{leadId}
  ↓
JavaScript: fpLoad() → fpData.data.fp_driver_actual → [name="fp_driver_actual"].val()
  ↓
HTML: <input name="fp_driver_actual">
  ↓
User: Sees saved value, can edit
```

### Load Flow — Hotel Quoted (per day)

```
Database: quotation_room_tariff_details.manual_total_rate
  (joined with quotation_properties_rooms, quotation_properties, quotation_properties_days, quotation_confirmation)
  ↓
Model: get_financial_posting_defaults() — sums manual_total_rate per day for confirmed rooms
  ↓
Controller: ajax_get_financial_posting_defaults() → JSON with days[].hotel_quoted
  ↓
API: GET .../defaults/{quotationId}
  ↓
JavaScript: fpLoad() → defaults.days.forEach(day => fpAddDay(day)) → sets .fp-quoted input
  ↓
HTML: <input class="fp-quoted" readonly> inside hotel row
  ↓
User: Sees pre-filled, read-only value per day
```

### Load Flow — Hotel Actual (per day, with reservation)

```
Database: property_payment_scheduler.discounted_total (or total_amount)
  (joined with property_reservation)
  ↓
Model: get_financial_posting_defaults() — checks if reservation exists for confirmed property
  ↓
Controller: ajax_get_financial_posting_defaults() → JSON with days[].hotel_actual
  ↓
API: GET .../defaults/{quotationId}
  ↓
JavaScript: fpAddDay(dayData) → sets .fp-actual input to dayData.hotel_actual
  ↓
HTML: <input class="fp-actual"> inside hotel row
  ↓
User: Sees reservation-based default, can override
```

### Load Flow — Margin

```
Database: quotation_options.quotation_options_margin_value
  ↓
Model: get_financial_posting_defaults() → defaults.margin_value
  ↓
Controller: ajax_get_financial_posting_defaults() → JSON
  ↓
API: GET .../defaults/{quotationId}
  ↓
JavaScript: fpLoad() → $('#fpMargin').text(defaults.margin_value)
  ↓
HTML: <span id="fpMargin">5,000.00</span>
  ↓
User: Sees static margin value
```

### Load Flow — Pre Quoted Amount

```
Database: Multiple tables (quotation_room_tariff_details, quotation_property_inclusions,
  quotation_special_requirements, quotation_options)
  ↓
Model: get_financial_posting_defaults() — calculates:
  pre_quoted_amount = hotelTotal + inclusionsTotal + specialTotal + driverAmount + marginValue
  ↓
Controller: ajax_get_financial_posting_defaults() → JSON with pre_quoted_amount
  ↓
API: GET .../defaults/{quotationId}
  ↓
JavaScript: fpLoad() → $('#fpPreQuotedAmount').text(defaults.pre_quoted_amount)
  ↓
HTML: <span id="fpPreQuotedAmount">17,700.00</span>
  ↓
User: Sees calculated benchmark
```

### Load Flow — Calculated Totals

```
JavaScript: fpCalculate()
  ↓ reads
  All .fp-quoted and .fp-actual inputs in #fpHubTable
  ↓ computes
  quotedTotal, actualTotal, totalAfterMargin, difference, totalMargin
  ↓ writes
  $('#fpActualCost').text(quotedTotal.toFixed(2))
  $('#fpCostAfterPost').text(actualTotal.toFixed(2))
  $('#fpTotalAfterMargin').text(totalAfterMargin.toFixed(2))
  $('#fpDifference').text(difference.toFixed(2))
  $('#fpTotalMargin').text(totalMargin.toFixed(2))
  ↓
HTML: <span id="fpActualCost">, <span id="fpCostAfterPost">, etc.
  ↓
User: Sees real-time updated totals
```

### Save Flow (Reverse)

```
User: Clicks Submit
  ↓
JavaScript: fpSubmit()
  ↓ collects
  All inputs from #fpHubTable into JSON payload:
    - fp_leads_id_fk from #fp_leads_id
    - fp_record_id from #fp_record_id
    - fp_driver_quoted, fp_driver_actual, fp_driver_desc
    - fp_actual_cost, fp_cost_after, fp_margin from calculated spans
    - fp_notes from #fpNotes
    - days[] array (day_label, hotel_quoted, hotel_actual, hotel_desc,
      inc_quoted, inc_actual, inc_desc, special_quoted, special_actual, special_desc)
    - exp_labels[], exp_amounts[], exp_descs[]
  ↓
API: POST Quotation/ajax_save_financial_posting (Content-Type: application/json)
  ↓
Controller: Quotation::ajax_save_financial_posting()
  ↓ validates
  has_permission('FINANCIAL_POSTING') → json_decode → leadId > 0
  ↓
Database Operations:
  IF recordId > 0:
    UPDATE financial_posting SET ... WHERE fp_id = recordId
    DELETE FROM financial_posting_hotel_days WHERE fphd_fp_id_fk = fpId
    DELETE FROM financial_posting_inclusions WHERE fpi_fp_id_fk = fpId (if table exists)
    DELETE FROM financial_posting_special WHERE fps_fp_id_fk = fpId (if table exists)
    DELETE FROM financial_posting_expenses WHERE fpe_fp_id_fk = fpId
  ELSE:
    INSERT INTO financial_posting → fpId = insert_id()

  FOR each day:
    INSERT INTO financial_posting_hotel_days (...)
    INSERT INTO financial_posting_inclusions (...) (if table exists)
    INSERT INTO financial_posting_special (...) (if table exists)

  FOR each expense:
    INSERT INTO financial_posting_expenses (...)
  ↓
Response: {"status": true, "fp_id": fpId}
  ↓
JavaScript: Updates #fp_record_id, shows success notification
  ↓
User: Sees confirmation
```

---

## 6. DATABASE MAPPING

### Write Tables (updated during Save)

| Table | Columns Used | Purpose | Updated | Read Only | Foreign Keys | Relationships |
|-------|-------------|---------|---------|-----------|-------------|---------------|
| `financial_posting` | `fp_id`, `fp_leads_id_fk`, `fp_driver_quoted`, `fp_driver_actual`, `fp_driver_desc`, `fp_actual_cost`, `fp_cost_after`, `fp_margin`, `fp_notes`, `fp_created_at`, `fp_updated_at` | Main FP record | Yes (INSERT/UPDATE) | No | `fp_leads_id_fk` → `leads.leads_id` (CASCADE) | 1:N with hotel_days, inclusions, special, expenses |
| `financial_posting_hotel_days` | `fphd_id`, `fphd_fp_id_fk`, `fphd_day_label`, `fphd_quoted_amount`, `fphd_actual_amount`, `fphd_description`, `fphd_sort_order` | Per-day hotel costs | Yes (DELETE+INSERT) | No | `fphd_fp_id_fk` → `financial_posting.fp_id` (CASCADE) | N:1 with financial_posting |
| `financial_posting_inclusions` | `fpi_id`, `fpi_fp_id_fk`, `fpi_day_label`, `fpi_quoted_amount`, `fpi_actual_amount`, `fpi_description`, `fpi_sort_order` | Per-day inclusion costs | Yes (DELETE+INSERT, if table exists) | No | `fpi_fp_id_fk` → `financial_posting.fp_id` (CASCADE) | N:1 with financial_posting |
| `financial_posting_special` | `fps_id`, `fps_fp_id_fk`, `fps_day_label`, `fps_quoted_amount`, `fps_actual_amount`, `fps_description`, `fps_sort_order` | Per-day special costs | Yes (DELETE+INSERT, if table exists) | No | `fps_fp_id_fk` → `financial_posting.fp_id` (CASCADE) | N:1 with financial_posting |
| `financial_posting_expenses` | `fpe_id`, `fpe_fp_id_fk`, `fpe_label`, `fpe_amount`, `fpe_description` | Other expenses | Yes (DELETE+INSERT) | No | `fpe_fp_id_fk` → `financial_posting.fp_id` (CASCADE) | N:1 with financial_posting |

### Read-Only Source Tables (for defaults auto-population)

| Table | Columns Used | Purpose | Foreign Keys | Relationships |
|-------|-------------|---------|-------------|---------------|
| `quotation_options` | `quotation_options_id`, `quotation_options_cab_amount`, `quotation_options_margin_value`, `quotation_options_status` | Driver quoted, margin, option selection | `quotation_id_fk` → `quotation` | 1:N with quotation |
| `quotation_room_tariff_details` | `manual_total_rate` | Hotel quoted per day | `quotation_properties_rooms_id_fk` → `quotation_properties_rooms` | N:1 with quotation_properties_rooms |
| `quotation_property_inclusions` | `inclusion_amount`, `inclusion_name`, `quotation_properties_id_fk` | Inclusion quoted + description per day | `quotation_properties_id_fk` → `quotation_properties` | N:1 with quotation_properties |
| `quotation_special_requirements` | `quotation_special_requirements_cost`, `quotation_special_requirements_name`, `quotation_properties_days_id_fk` | Special quoted + description per day | `quotation_properties_days_id_fk` → `quotation_properties_days` | N:1 with quotation_properties_days |
| `quotation_confirmation` | `option_id_fk`, `properties_id_fk`, `properties_room_id_fk` | Identifies confirmed option, property, rooms | Multiple FKs to quotation_options, quotation_properties, quotation_properties_rooms | 1:1 with confirmed option |
| `quotation_properties_days` | `quotation_properties_days_id`, `quotation_properties_days_day` | Day structure and labels | `quotation_properties_id_fk` → `quotation_properties` | N:1 with quotation_properties |
| `quotation_properties` | `quotation_properties_id`, `properties_id_fk` | Property mapping per day | `properties_id_fk` → `properties` | N:1 with properties |
| `quotation_properties_rooms` | `quotation_properties_rooms_id` | Room mapping per property | `quotation_properties_id_fk` → `quotation_properties` | N:1 with quotation_properties |
| `property_reservation` | `properties_id_fk`, `quotation_id_fk` | Reservation data for actual hotel costs | `properties_id_fk` → `properties`, `quotation_id_fk` → `quotation` | 1:N with property_payment_scheduler |
| `property_payment_scheduler` | `total_amount`, `discount_amount`, `discounted_total` | Reservation payment totals and discounts | `property_reservation_id_fk` → `property_reservation` | N:1 with property_reservation |
| `leads` | `leads_id` | Parent lead record | None | 1:N with financial_posting |
| `tr_permissions` | `name` = `FINANCIAL_POSTING` | Permission check | None | N:N with roles via tr_role_permissions |

---

## 7. UI COMPONENT MAPPING

### Driver Section

| HTML ID | HTML Name | CSS Class | JavaScript Events | Validation | Calculation Trigger | AJAX Calls | Save Behaviour |
|---------|-----------|-----------|-------------------|------------|---------------------|------------|----------------|
| N/A | `fp_driver_quoted` | `form-control form-control-sm fp-quoted` | `input` → `fpCalculate()` | `readonly`, `min="0"`, `step="0.01"` | Contributes to Actual Cost | None | Sent in payload as `fp_driver_quoted` |
| N/A | `fp_driver_actual` | `form-control form-control-sm fp-actual` | `input` → `fpCalculate()` | `min="0"`, `step="0.01"` | Contributes to Cost After FP | None | Sent in payload as `fp_driver_actual` |
| N/A | `fp_driver_desc` | `form-control form-control-sm` | None | None | None | None | Sent in payload as `fp_driver_desc` |

### Day-Based Rows (dynamically generated by `fpAddDay()`)

| HTML ID | HTML Name | CSS Class | JavaScript Events | Validation | Calculation Trigger | AJAX Calls | Save Behaviour |
|---------|-----------|-----------|-------------------|------------|---------------------|------------|----------------|
| N/A | N/A | `fp-day-header` | None | None | Day Total shown in header | None | `day_label` sent in payload |
| N/A | `hotel_quoted[]` (dynamic) | `form-control form-control-sm fp-quoted` | `input` → `fpCalculate()` | `readonly`, `min="0"`, `step="0.01"` | Contributes to Actual Cost, Day Total | None | Sent in `days[].hotel_quoted` |
| N/A | `hotel_actual[]` (dynamic) | `form-control form-control-sm fp-actual` | `input` → `fpCalculate()` | `min="0"`, `step="0.01"` | Contributes to Cost After FP | None | Sent in `days[].hotel_actual` |
| N/A | `hotel_desc[]` (dynamic) | `form-control form-control-sm` | None | None | None | None | Sent in `days[].hotel_desc` |
| N/A | `inc_quoted[]` (dynamic) | `form-control form-control-sm fp-quoted` | `input` → `fpCalculate()` | `readonly`, `min="0"`, `step="0.01"` | Contributes to Actual Cost, Day Total | None | Sent in `days[].inc_quoted` |
| N/A | `inc_actual[]` (dynamic) | `form-control form-control-sm fp-actual` | `input` → `fpCalculate()` | `min="0"`, `step="0.01"` | Contributes to Cost After FP | None | Sent in `days[].inc_actual` |
| N/A | `inc_desc[]` (dynamic) | `form-control form-control-sm` | None | None | None | None | Sent in `days[].inc_desc` |
| N/A | `special_quoted[]` (dynamic) | `form-control form-control-sm fp-quoted` | `input` → `fpCalculate()` | `readonly`, `min="0"`, `step="0.01"` | Contributes to Actual Cost, Day Total | None | Sent in `days[].special_quoted` |
| N/A | `special_actual[]` (dynamic) | `form-control form-control-sm fp-actual` | `input` → `fpCalculate()` | `min="0"`, `step="0.01"` | Contributes to Cost After FP | None | Sent in `days[].special_actual` |
| N/A | `special_desc[]` (dynamic) | `form-control form-control-sm` | None | None | None | None | Sent in `days[].special_desc` |

### Other Expenses Section

| HTML ID | HTML Name | CSS Class | JavaScript Events | Validation | Calculation Trigger | AJAX Calls | Save Behaviour |
|---------|-----------|-----------|-------------------|------------|---------------------|------------|----------------|
| N/A | `exp_labels[]` | `form-control form-control-sm` | None | None | None | None | Sent in `exp_labels[]` |
| N/A | `exp_amounts[]` | `form-control form-control-sm fp-actual` | `input` → `fpCalculate()` | `min="0"`, `step="0.01"` | Contributes to Cost After FP | None | Sent in `exp_amounts[]` |
| N/A | `exp_descs[]` | `form-control form-control-sm` | None | None | None | None | Sent in `exp_descs[]` |
| `fpOtherExpHeader` | N/A | `fp-section-header` | `onclick="fpAddExpense()"` on button | N/A | N/A | None | N/A |
| N/A (delete btn) | N/A | `btn btn-sm btn-link text-danger` | `onclick="fpRemoveRow(this)"` | N/A | Triggers `fpCalculate()` after removal | None | Row excluded from payload |

### Summary Section

| HTML ID | HTML Name | CSS Class | JavaScript Events | Validation | Calculation Trigger | AJAX Calls | Save Behaviour |
|---------|-----------|-----------|-------------------|------------|---------------------|------------|----------------|
| `fpActualCost` | N/A | N/A (span) | None | N/A | Set by `fpCalculate()` | None | Sent in payload as `fp_actual_cost` |
| `fpCostAfterPost` | N/A | N/A (span) | None | N/A | Set by `fpCalculate()` | None | Sent in payload as `fp_cost_after` |
| `fpMargin` | N/A | `fw-bold text-secondary` (span) | None | N/A | Set on load from defaults | None | Sent in payload as `fp_margin` |
| `fpTotalAfterMargin` | N/A | N/A (span) | None | N/A | Set by `fpCalculate()` | None | Not stored in DB |
| `fpPreQuotedAmount` | N/A | `fw-bold text-primary` (span) | None | N/A | Set on load from defaults | None | Not stored in DB |
| `fpDifference` | N/A | `fw-bold` (span) | None | N/A | Set by `fpCalculate()` | None | Not stored in DB |
| `fpTotalMargin` | N/A | `fw-bold` (span) | None | N/A | Set by `fpCalculate()` | None | Not stored in DB |
| `fpNotes` | `fp_notes` | `form-control` (textarea) | None | None | None | None | Sent in payload as `fp_notes` |

### Hidden Fields

| HTML ID | HTML Name | CSS Class | JavaScript Events | Validation | Calculation Trigger | AJAX Calls | Save Behaviour |
|---------|-----------|-----------|-------------------|------------|---------------------|------------|----------------|
| `fp_leads_id` | N/A | N/A (hidden input) | Set on tab show | Must be > 0 for save | None | None | Sent in payload as `fp_leads_id_fk` |
| `fp_record_id` | N/A | N/A (hidden input) | Set on load/save response | 0 = new, >0 = update | None | None | Sent in payload as `fp_record_id` |

### Buttons

| HTML ID | CSS Class | JavaScript Events | AJAX Calls | Save Behaviour |
|---------|-----------|-------------------|------------|----------------|
| N/A (Submit) | `btn btn-info btn-sm` | `onclick="fpSubmit()"` | POST `ajax_save_financial_posting` | Triggers save |
| N/A (Reset) | `btn btn-secondary btn-sm` | `onclick="fpReset()"` | GET `ajax_get_financial_posting` + GET `ajax_get_financial_posting_defaults` | Discards unsaved changes |
| N/A (Add Expense) | `btn btn-sm btn-info` | `onclick="fpAddExpense()"` | None | Adds row to DOM |

### Table Container

| HTML ID | CSS Class | JavaScript Events | Purpose |
|---------|-----------|-------------------|---------|
| `fpHubTable` | `table table-bordered align-middle fp-table` | `input` on `.fp-quoted` and `.fp-actual` → `fpCalculate()` | Main table containing all FP rows |
| `financialPostingTab` | `tab-pane fade` | `shown.bs.tab` → `fpLoad(leadId)` | Tab pane container |

---

## 8. SAVE MAPPING

### Fields Collected by `fpSubmit()`

| Field | Source | JS Variable | Payload Key |
|-------|--------|-------------|-------------|
| Lead ID | `$('#fp_leads_id').val()` | `leadId` | `fp_leads_id_fk` |
| Record ID | `$('#fp_record_id').val()` | `recordId` | `fp_record_id` |
| Driver Quoted | `$('[name="fp_driver_quoted"]').val()` | — | `fp_driver_quoted` |
| Driver Actual | `$('[name="fp_driver_actual"]').val()` | — | `fp_driver_actual` |
| Driver Description | `$('[name="fp_driver_desc"]').val()` | — | `fp_driver_desc` |
| Actual Cost | `$('#fpActualCost').text()` | — | `fp_actual_cost` |
| Cost After FP | `$('#fpCostAfterPost').text()` | — | `fp_cost_after` |
| Margin | `$('#fpMargin').text()` | — | `fp_margin` |
| Notes | `$('#fpNotes').val()` | — | `fp_notes` |
| Days (array) | Iterated from `.fp-hotel-day` rows | `days[]` | `days` |
| Expense Labels | `[name="exp_labels[]"]` | — | `exp_labels` |
| Expense Amounts | `[name="exp_amounts[]"]` | — | `exp_amounts` |
| Expense Descriptions | `[name="exp_descs[]"]` | — | `exp_descs` |

### Validation Order

| Step | Check | Failure Response |
|------|-------|-----------------|
| 1 | `has_permission('FINANCIAL_POSTING')` | `{"status": false, "message": "Permission denied: Financial Posting"}` |
| 2 | `json_decode($raw, true)` — valid JSON | `{"status": false, "message": "Invalid payload"}` |
| 3 | `(int)$payload['fp_leads_id_fk'] > 0` | `{"status": false, "message": "Lead ID required"}` |

### AJAX Payload Structure

```json
{
    "fp_leads_id_fk": 123,
    "fp_record_id": 45,
    "fp_driver_quoted": 5000,
    "fp_driver_actual": 4500,
    "fp_driver_desc": "Driver allowance",
    "fp_actual_cost": 12700,
    "fp_cost_after": 12050,
    "fp_margin": 5000,
    "fp_notes": "Overall notes",
    "days": [
        {
            "day_label": "Day 1",
            "hotel_quoted": 3000,
            "hotel_actual": 2800,
            "hotel_desc": "Hotel XYZ",
            "inc_quoted": 500,
            "inc_actual": 500,
            "inc_desc": "Breakfast, Airport Pickup",
            "special_quoted": 200,
            "special_actual": 150,
            "special_desc": "Birthday Cake"
        }
    ],
    "exp_labels": ["Guide Tips", "Toll Charges"],
    "exp_amounts": [300, 150],
    "exp_descs": ["Tips for guide", "Highway tolls"]
}
```

### Controller Method

`Quotation::ajax_save_financial_posting()` at `application/controllers/Quotation.php:8042`

### Model Method

None — controller performs direct DB operations via `$this->db`.

### Database Updates (in order)

| Step | Operation | Table | Condition |
|------|-----------|-------|-----------|
| 1a | UPDATE | `financial_posting` | WHERE `fp_id = recordId` (if recordId > 0) |
| 1b | DELETE | `financial_posting_hotel_days` | WHERE `fphd_fp_id_fk = fpId` (if recordId > 0) |
| 1c | DELETE | `financial_posting_inclusions` | WHERE `fpi_fp_id_fk = fpId` (if recordId > 0 AND table exists) |
| 1d | DELETE | `financial_posting_special` | WHERE `fps_fp_id_fk = fpId` (if recordId > 0 AND table exists) |
| 1e | DELETE | `financial_posting_expenses` | WHERE `fpe_fp_id_fk = fpId` (if recordId > 0) |
| — | OR | | |
| 2a | INSERT | `financial_posting` | If recordId = 0; `fpId = insert_id()` |
| 3 | INSERT (loop) | `financial_posting_hotel_days` | For each day in `days[]` |
| 4 | INSERT (loop) | `financial_posting_inclusions` | For each day (if table exists) |
| 5 | INSERT (loop) | `financial_posting_special` | For each day (if table exists) |
| 6 | INSERT (loop) | `financial_posting_expenses` | For each expense in `exp_labels[]` |

### Transaction Handling

**None.** Each DB operation is a separate call. No `$this->db->trans_start()` / `trans_complete()`. Partial saves can occur on error.

### Success Response

```json
{"status": true, "fp_id": 123}
```

### Reload Behaviour After Save

- `#fp_record_id` updated with returned `fp_id`
- Success notification shown
- No automatic full reload — user remains on the screen with saved data
- If user navigates away and returns, `fpLoad()` will load the saved record

---

## 9. RECALCULATION MATRIX

| User Changes | System Recalculates |
|-------------|---------------------|
| Driver Actual Amount | Cost After Financial Post → Total → Difference → Total Margin |
| Hotel Actual Amount (any day) | Cost After Financial Post → Total → Difference → Total Margin |
| Inclusions Actual Amount (any day) | Cost After Financial Post → Total → Difference → Total Margin |
| Special Actual Amount (any day) | Cost After Financial Post → Total → Difference → Total Margin |
| Other Expense Amount (any) | Cost After Financial Post → Total → Difference → Total Margin |
| Add Other Expense Row | Cost After Financial Post → Total → Difference → Total Margin (new row contributes 0 until amount entered) |
| Delete Other Expense Row | Cost After Financial Post → Total → Difference → Total Margin (removed amount no longer counted) |
| Reset button clicked | All values reload from server: Driver, Hotel, Inclusions, Special, Margin, Pre Quoted Amount, all totals |
| Tab reopened | All values reload from server via `fpLoad()` |
| Submit button clicked | No recalculation — data saved as-is from current input values |

### Note on Quoted Amounts

Quoted Amount inputs are `readonly` — users cannot change them. Therefore, Actual Cost (sum of Quoted) only changes on load/reset when new defaults are fetched. Day Total (Quoted) is also static after initial render.

### Recalculation Chain Detail

```
Any .fp-actual input change
  ↓
fpCalculate() fires
  ↓
1. Recalculates Actual Cost = SUM(all .fp-quoted)     [effectively unchanged — readonly]
2. Recalculates Cost After FP = SUM(all .fp-actual)    [CHANGED]
3. Recalculates Total = Cost After FP + Margin         [CHANGED]
4. Recalculates Difference = Pre Quoted - Total        [CHANGED]
5. Recalculates Total Margin = Margin + Difference     [CHANGED]
6. Updates badge colors for Difference and Total Margin
7. Updates all display spans with .toFixed(2)
```

---

## 10. VALIDATION MATRIX

| Field | Validation | Error Message | Required | Decimal Precision | Min Value | Max Value | Editable | Locked After |
|-------|------------|---------------|----------|-------------------|-----------|-----------|----------|--------------|
| Driver Quoted | `readonly` | N/A | No (defaults to 0) | 2 (DECIMAL(10,2)) | 0 (HTML) | None | No | Load |
| Driver Actual | `min="0"`, `step="0.01"` | None (HTML5 only) | No (defaults to 0) | 2 (DECIMAL(10,2)) | 0 (HTML) | None | Yes | Save |
| Driver Description | None | None | No | N/A (VARCHAR 255) | N/A | 255 chars (DB) | Yes | Save |
| Hotel Quoted (per day) | `readonly` | N/A | No (defaults to 0) | 2 (DECIMAL(10,2)) | 0 (HTML) | None | No | Load |
| Hotel Actual (per day) | `min="0"`, `step="0.01"` | None (HTML5 only) | No (defaults to 0) | 2 (DECIMAL(10,2)) | 0 (HTML) | None | Yes | Save |
| Hotel Description (per day) | None | None | No | N/A (VARCHAR 255) | N/A | 255 chars (DB) | Yes | Save |
| Inclusions Quoted (per day) | `readonly` | N/A | No (defaults to 0) | 2 (DECIMAL(12,2)) | 0 (HTML) | None | No | Load |
| Inclusions Actual (per day) | `min="0"`, `step="0.01"` | None (HTML5 only) | No (defaults to 0) | 2 (DECIMAL(12,2)) | 0 (HTML) | None | Yes | Save |
| Inclusions Description (per day) | None | None | No | N/A (VARCHAR 500) | N/A | 500 chars (DB) | Yes | Save |
| Special Quoted (per day) | `readonly` | N/A | No (defaults to 0) | 2 (DECIMAL(12,2)) | 0 (HTML) | None | No | Load |
| Special Actual (per day) | `min="0"`, `step="0.01"` | None (HTML5 only) | No (defaults to 0) | 2 (DECIMAL(12,2)) | 0 (HTML) | None | Yes | Save |
| Special Description (per day) | None | None | No | N/A (VARCHAR 500) | N/A | 500 chars (DB) | Yes | Save |
| Expense Label | None | None | No | N/A (VARCHAR 255) | N/A | 255 chars (DB) | Yes | Save |
| Expense Amount | `min="0"`, `step="0.01"` | None (HTML5 only) | No (defaults to 0) | 2 (DECIMAL(10,2)) | 0 (HTML) | None | Yes | Save |
| Expense Description | None | None | No | N/A (VARCHAR 255) | N/A | 255 chars (DB) | Yes | Save |
| Margin | N/A (display only) | N/A | No | 2 (DECIMAL(10,2)) | N/A | N/A | No | Load |
| Pre Quoted Amount | N/A (display only) | N/A | No | 2 (calculated) | N/A | N/A | No | Load |
| Actual Cost | N/A (display only) | N/A | No | 2 (DECIMAL(10,2)) | N/A | N/A | No | Load (auto-calc) |
| Cost After FP | N/A (display only) | N/A | No | 2 (DECIMAL(10,2)) | N/A | N/A | No | Auto-calc on input |
| Total | N/A (display only) | N/A | No | 2 (calculated) | N/A | N/A | No | Auto-calc on input |
| Difference | N/A (display only) | N/A | No | 2 (calculated) | N/A | N/A | No | Auto-calc on input |
| Total Margin | N/A (display only) | N/A | No | 2 (calculated) | N/A | N/A | No | Auto-calc on input |
| Notes | None | None | No | N/A (TEXT) | N/A | Unlimited (TEXT) | Yes | Save |
| Lead ID | Must be > 0 for save | "Lead ID required" | Yes (for save) | N/A (INT) | 1 | None | No | Tab show |
| Record ID | 0 = new, >0 = update | N/A | No | N/A (INT) | 0 | None | No | Load/Save response |

### Server-Side Validation Summary

| Check | Implementation | Error Response |
|-------|----------------|----------------|
| Permission | `has_permission('FINANCIAL_POSTING')` | `{"status": false, "message": "Permission denied: Financial Posting"}` |
| Valid JSON | `json_decode($raw, true)` | `{"status": false, "message": "Invalid payload"}` |
| Lead ID > 0 | `(int)$payload['fp_leads_id_fk']` | `{"status": false, "message": "Lead ID required"}` |
| All amounts | `(float)` cast | No error — accepts any numeric value including negative |
| All strings | `isset() ? value : ''` | No error — accepts any string including empty |

### What Is NOT Validated

- No quotation status check on server (UI-only gate)
- No negative amount validation server-side
- No max length validation on description fields server-side
- No required field validation (all default to 0 or empty string)
- No duplicate expense label check
- No transaction wrapping

---

## 11. BUSINESS RULE MATRIX

| Rule | Reason | Impact |
|------|--------|--------|
| Quoted Amount is read-only after confirmation | Preserves original quotation as immutable reference | Users cannot inflate quoted costs to manipulate variance |
| Actual Amount can exceed quoted amount | Real costs may be higher than estimated | Difference becomes negative, reducing Total Margin |
| Actual Amount can be lower than quoted amount | Real costs may be lower than estimated (e.g., off-season discount) | Difference becomes positive, increasing Total Margin |
| Margin is read-only on FP screen | Margin is a commercial term agreed with client, not an operational cost | Margin only changes if quotation option changes |
| Margin cannot become NULL | `quotation_options_margin_value` defaults to 0 if not set | Total calculation always has a numeric margin |
| Hotel Rent quoted comes from room tariff details | Tariff is calculated during quotation creation via room tariff modal | Changing tariff after FP is saved requires Reset to reflect |
| Hotel Rent actual comes from reservation payment scheduler | Reservation captures the negotiated supplier cost | If no reservation exists, actual defaults to quoted |
| Property Inclusion is system-generated from quotation | Inclusions are part of the package/quotation, not manually entered | Only confirmed property inclusions are included |
| Special Requirements are system-generated from quotation | Special requirements are captured during quotation creation | Per-day, not per-property |
| Other Expense is manual entry only | These are ad-hoc costs not in the quotation | No quoted amount — only actual amount |
| Difference updates immediately on any actual input change | Real-time P&L visibility for operations staff | No server round-trip needed for recalculation |
| Total Margin updates immediately | Final profit/loss must be visible as costs are entered | Green/red badge provides instant visual feedback |
| Days are auto-generated from itinerary | Day structure must match the tour itinerary | Users cannot add/remove days on FP screen |
| FP records are linked to leads, not quotations | A lead may have multiple quotations over time; FP tracks the operational cost per lead | Multiple FP records possible per lead; latest is loaded |
| Delete-and-reinsert on update | Simplifies save logic — no need to track which child rows changed | Child row IDs change on every save |
| Optional tables checked with `table_exists()` | `financial_posting_inclusions` and `financial_posting_special` may not exist in all deployments | Backward-compatible schema extension |
| Tab enabled only for statuses 8, 9, 7 | FP is operational — requires reservations to be completed first | Statuses 1-6 cannot access FP |
| Permission required for save but not for load | View access controlled by tab visibility; write access controlled by permission | Users without permission can view but not save |
| Pre Quoted Amount is independently calculated | Ensures all cost components are explicitly summed | NOT same as `quotation_options_total_quote_rate` |
| No server-side quotation status validation on save | UI gate is considered sufficient | Save could technically succeed even if status changes after tab is opened |
| Expense amounts only contribute to Actual Total | Other expenses have no quoted counterpart | Does not affect Actual Cost (sum of Quoted) |
| Reservation discount auto-populates description | Audit trail for why hotel actual differs from quoted | "Reservation discount: X" auto-filled in hotel description |

---

## 12. DEPENDENCY MAP

### Total Margin

```
Total Margin
  ↓
  Difference
    ↓
    Total
      ↓
      Cost After Financial Post
        ↓
        Actual Amounts (all rows)
          ↓
          Driver Actual (user input)
          Hotel Actual (reservation or user override)
            ↓
            property_payment_scheduler.discounted_total
              ↓
              property_reservation
                ↓
                quotation_confirmation (confirmed property)
                  ↓
                  quotation_options (confirmed option)
                    ↓
                    quotation
                      ↓
                      leads
          Inclusions Actual (defaults to quoted, user override)
          Special Actual (defaults to quoted, user override)
          Expense Amounts (user input only)
      Margin
        ↓
        quotation_options.quotation_options_margin_value
    Pre Quoted Amount
      ↓
      hotelTotal (SUM of hotel_quoted)
        ↓
        quotation_room_tariff_details.manual_total_rate
          ↓
          quotation_properties_rooms
            ↓
            quotation_properties
              ↓
              quotation_properties_days
                ↓
                quotation_options (confirmed)
      inclusionsTotal (SUM of inc_quoted)
        ↓
        quotation_property_inclusions.inclusion_amount
      specialTotal (SUM of special_quoted)
        ↓
        quotation_special_requirements.quotation_special_requirements_cost
      driverAmount
        ↓
        quotation_options.quotation_options_cab_amount
      marginValue
        ↓
        quotation_options.quotation_options_margin_value
```

### Actual Cost

```
Actual Cost
  ↓
  SUM(all Quoted Amounts)
    ↓
    Driver Quoted
      ↓
      quotation_options.quotation_options_cab_amount
    Hotel Quoted (per day)
      ↓
      quotation_room_tariff_details.manual_total_rate
        ↓
        quotation_properties_rooms (confirmed rooms)
          ↓
          quotation_confirmation
            ↓
            quotation_options
    Inclusions Quoted (per day)
      ↓
      quotation_property_inclusions.inclusion_amount
        ↓
        quotation_properties (confirmed property)
          ↓
          quotation_confirmation
    Special Quoted (per day)
      ↓
      quotation_special_requirements.quotation_special_requirements_cost
```

### Day Total (per day)

```
Day Total (Quoted)
  ↓
  Hotel Quoted (that day)
    ↓
    quotation_room_tariff_details.manual_total_rate
  Inclusions Quoted (that day)
    ↓
    quotation_property_inclusions.inclusion_amount
  Special Quoted (that day)
    ↓
    quotation_special_requirements.quotation_special_requirements_cost
```

---

## 13. FILE DEPENDENCIES

### Controllers

| File | Methods | Lines |
|------|---------|-------|
| `application/controllers/Quotation.php` | `ajax_save_financial_posting()` | 8042-8145 |
| `application/controllers/Quotation.php` | `ajax_get_financial_posting($leadId)` | 8147-8254 |
| `application/controllers/Quotation.php` | `ajax_get_financial_posting_defaults($quotation_id)` | 8256-8270 |

### Models

| File | Methods | Lines |
|------|---------|-------|
| `application/models/Quotation_model.php` | `get_financial_posting_defaults($quotation_id)` | ~963-1300 |

### Views

| File | Section | Lines |
|------|---------|-------|
| `application/views/Quotation/hub.php` | CSS styles for FP | 100-209 |
| `application/views/Quotation/hub.php` | Tab nav item | 340-346 |
| `application/views/Quotation/hub.php` | FP tab pane (table HTML) | 443-536 |
| `application/views/Quotation/hub_script.php` | FP JavaScript | 4141-4684 |
| `application/views/Quotation/list.php` | Legacy modal version (alternate UI) | 4059-4270 |

### Helpers

| File | Function |
|------|----------|
| `application/helpers/permission_helper.php` | `has_permission('FINANCIAL_POSTING')` |

### AJAX Endpoints

| Endpoint | HTTP Method | URL Pattern |
|----------|-------------|-------------|
| Save FP | POST | `Quotation/ajax_save_financial_posting` |
| Get saved FP | GET | `Quotation/ajax_get_financial_posting/{leadId}` |
| Get defaults | GET | `Quotation/ajax_get_financial_posting_defaults/{quotationId}` |

### Routes

No explicit routes defined — uses CodeIgniter default routing: `controller/method/param`

### Database Tables (Write)

| Table | Migration File |
|-------|---------------|
| `financial_posting` | `db/migration_financial_posting.sql` |
| `financial_posting_hotel_days` | `db/migration_financial_posting.sql` |
| `financial_posting_inclusions` | `db/migration_financial_posting.sql` |
| `financial_posting_special` | `db/migration_financial_posting.sql` |
| `financial_posting_expenses` | `db/migration_financial_posting.sql` |

### Database Tables (Read-Only Source)

| Table | Purpose |
|-------|---------|
| `quotation_options` | Driver amount, margin, option selection |
| `quotation_room_tariff_details` | Hotel quoted per day |
| `quotation_property_inclusions` | Inclusion quoted + description |
| `quotation_special_requirements` | Special quoted + description |
| `quotation_confirmation` | Confirmed option/property/rooms |
| `quotation_properties_days` | Day structure |
| `quotation_properties` | Property mapping |
| `quotation_properties_rooms` | Room mapping |
| `property_reservation` | Reservation link |
| `property_payment_scheduler` | Reservation totals and discounts |
| `leads` | Parent lead |
| `tr_permissions` | FINANCIAL_POSTING permission |

### Migration/Seed Files

| File | Purpose |
|------|---------|
| `db/migration_financial_posting.sql` | Creates all 5 FP tables |
| `db/add_quotation_hub_permissions.sql` | Inserts FINANCIAL_POSTING permission |

### JavaScript Functions

| Function | File | Purpose |
|----------|------|---------|
| `fpLoad(leadId)` | `hub_script.php:4155` | Loads saved FP + defaults via parallel AJAX |
| `fpAddDay(dayData)` | `hub_script.php:4278` | Renders day block (header + hotel + inclusions + special) |
| `fpAddExpense(label, amount, desc)` | `hub_script.php:4335` | Adds expense row |
| `fpRemoveRow(btn)` | `hub_script.php:4357` | Removes expense row |
| `fpCalculate()` | `hub_script.php:4362` | Recalculates all totals and updates badges |
| `fpSubmit()` | `hub_script.php:4410` | Gathers data and sends JSON to save endpoint |
| `fpReset()` | `hub_script.php:4666` | Reloads from server |
| `escapeHtml(str)` | `hub_script.php:1639` | XSS prevention |
| `toggleTab(tabId, enabled, tooltip)` | `hub_script.php:~500` | Tab enable/disable |
| `updateQuotationHubActions(status)` | `hub_script.php:~280` | Tab gating by status |

---

## 14. FREQUENTLY MODIFIED AREAS

### Fields Most Likely to Change

| Field | Why It Changes | How Often |
|-------|---------------|-----------|
| Driver Actual Amount | Fuel price fluctuations, driver negotiation | Every tour |
| Hotel Actual Amount (per day) | Reservation discounts, seasonal rates, room changes | Every tour |
| Other Expenses | Ad-hoc costs vary per tour (visa, tips, tolls, GST) | Every tour |
| Inclusions Actual Amount | Sometimes inclusions are added/removed at property | Occasionally |
| Special Actual Amount | Special requirements may be cancelled or added | Occasionally |
| Descriptions (all) | Audit notes for cost deviations | Every tour |
| Notes (overall) | General comments about the posting | Every tour |

### Fields Least Likely to Change

| Field | Why |
|-------|-----|
| Driver Quoted | Fixed by quotation |
| Hotel Quoted | Fixed by quotation tariff |
| Inclusions Quoted | Fixed by quotation |
| Special Quoted | Fixed by quotation |
| Margin | Fixed by quotation option |
| Pre Quoted Amount | Calculated from fixed quotation values |
| Day structure | Fixed by itinerary |

### Calculations Most Likely to Change

| Calculation | Why It Might Change |
|-------------|-------------------|
| Pre Quoted Amount formula | May need to include other expenses or taxes in future |
| Total Margin formula | May need to factor in taxes or commission |
| Day Total | May need to show actual day total (currently only quoted) |
| Difference | May need to exclude margin from calculation in some business scenarios |

### Business Rules AI Should Protect

| Rule | Why It Must Not Break |
|------|----------------------|
| Quoted Amounts are readonly | Preserves quotation integrity |
| Margin comes from quotation option | Commercial agreement with client |
| Delete-and-reinsert pattern | Simplifies save logic; changing to update-in-place requires tracking child IDs |
| `table_exists()` checks for optional tables | Backward compatibility with deployments lacking inclusions/special tables |
| Tab gating by quotation status (8, 9, 7) | Operational workflow — FP only after reservations complete |
| `fpCalculate()` triggered on `input` event | Real-time calculation is core UX |
| Pre Quoted Amount is independently calculated | Not same as `quotation_options_total_quote_rate` |
| Lead-based linking (not quotation-based) | FP tracks operational cost per lead, not per quotation |

### Files That Should Be Modified Together

| Files | Why |
|-------|-----|
| `hub.php` + `hub_script.php` | HTML structure and JS must stay in sync |
| `Quotation.php` (controller) + `Quotation_model.php` | Controller calls model for defaults |
| `migration_financial_posting.sql` + controller save/get methods | Schema changes require controller updates |
| `add_quotation_hub_permissions.sql` + `hub.php` tab visibility | Permission name must match |

---

## 15. AI QUICK REFERENCE

### Editable Fields

- Driver Actual Amount
- Driver Description
- Hotel Actual Amount (per day)
- Hotel Description (per day)
- Inclusions Actual Amount (per day)
- Inclusions Description (per day)
- Special Actual Amount (per day)
- Special Description (per day)
- Other Expense Label
- Other Expense Amount
- Other Expense Description
- Overall Description / Notes

### Calculated Fields

- Day Total (Quoted) — `fpAddDay()`
- Actual Cost — `fpCalculate()`
- Cost After Financial Post — `fpCalculate()`
- Total — `fpCalculate()`
- Difference — `fpCalculate()`
- Total Margin — `fpCalculate()`
- Pre Quoted Amount — `get_financial_posting_defaults()`

### Read-Only Fields

- Driver Quoted Amount
- Hotel Quoted Amount (per day)
- Inclusions Quoted Amount (per day)
- Special Quoted Amount (per day)
- Margin
- Pre Quoted Amount
- Actual Cost
- Cost After Financial Post
- Total
- Difference
- Total Margin
- Day Label
- Day Total (Quoted)
- Lead ID (hidden)
- Record ID (hidden)

### Main Calculations

```
Actual Cost           = SUM(all .fp-quoted)
Cost After FP         = SUM(all .fp-actual)
Total                 = Cost After FP + Margin
Difference            = Pre Quoted − Total
Total Margin          = Margin + Difference
Pre Quoted            = hotelTotal + incTotal + specialTotal + driver + margin
Day Total (Quoted)    = hotel_quoted + inc_quoted + special_quoted
```

### Important APIs

| API | Method | Purpose |
|-----|--------|---------|
| `Quotation/ajax_save_financial_posting` | POST JSON | Save |
| `Quotation/ajax_get_financial_posting/{leadId}` | GET | Load saved |
| `Quotation/ajax_get_financial_posting_defaults/{quotationId}` | GET | Load defaults |

### Important Tables

| Table | Role |
|-------|------|
| `financial_posting` | Main record |
| `financial_posting_hotel_days` | Per-day hotel |
| `financial_posting_inclusions` | Per-day inclusions (optional) |
| `financial_posting_special` | Per-day special (optional) |
| `financial_posting_expenses` | Other expenses |
| `quotation_options` | Driver amount, margin source |
| `quotation_room_tariff_details` | Hotel quoted source |
| `property_payment_scheduler` | Hotel actual source |

### Important Controllers

- `Quotation::ajax_save_financial_posting()` — line 8042
- `Quotation::ajax_get_financial_posting()` — line 8147
- `Quotation::ajax_get_financial_posting_defaults()` — line 8256

### Important Models

- `Quotation_model::get_financial_posting_defaults()` — line ~963

### Important JavaScript

- `fpLoad()` — line 4155
- `fpAddDay()` — line 4278
- `fpCalculate()` — line 4362
- `fpSubmit()` — line 4410
- `fpReset()` — line 4666

### Things Future AI Must Never Break

1. **Quoted Amount readonly** — never make quoted inputs editable
2. **`fpCalculate()` formula chain** — Total Margin = Margin + Difference; Difference = Pre Quoted − Total; Total = Cost After + Margin
3. **`table_exists()` checks** — never remove these for optional tables
4. **Delete-and-reinsert save pattern** — child rows are always deleted then reinserted on update
5. **`.fp-quoted` and `.fp-actual` CSS classes** — `fpCalculate()` depends on these selectors
6. **Tab gating (statuses 8, 9, 7)** — FP must not be accessible before reservation completion
7. **`FINANCIAL_POSTING` permission check** — must remain on save endpoint
8. **Pre Quoted Amount formula** — must remain independent of `quotation_options_total_quote_rate`
9. **Lead-based linking** — FP records link to `leads_id`, not `quotation_id`
10. **`escapeHtml()` on user text** — XSS prevention before rendering

### Most Sensitive Calculations

| Calculation | Why Sensitive |
|-------------|--------------|
| Total Margin | Final P&L — directly affects business decisions |
| Difference | Determines if tour is over/under budget |
| Cost After Financial Post | Base for Total and Difference — any error propagates |
| Pre Quoted Amount | Server-side calculation — JS reads it as text, parsing errors possible if format changes |
| Hotel Actual from reservation | Complex join logic in model — depends on reservation data integrity |

### Common Mistakes

1. **Confusing Actual Cost with Cost After Financial Post** — Actual Cost is sum of QUOTED, not actual
2. **Thinking Pre Quoted = `quotation_options_total_quote_rate`** — it's independently calculated
3. **Assuming Day Total updates dynamically** — it's static after render
4. **Expecting transaction safety** — there is none; partial saves possible
5. **Assuming single FP record per lead** — multiple records possible; latest loaded
6. **Forgetting `table_exists()` checks** — inclusions/special tables may not exist
7. **Assuming server validates quotation status** — only UI gates by status
8. **Expecting negative amount validation server-side** — only HTML `min="0"` prevents it
9. **Assuming expense labels are required** — empty labels are accepted
10. **Expecting itinerary sync** — changing itinerary after FP save requires manual Reset

### Future Extension Points

1. **Add DB transaction wrapping** in `ajax_save_financial_posting()`
2. **Add server-side quotation status validation** to prevent saving outside statuses 8/9/7
3. **Add optimistic locking** (version column) for concurrent edit detection
4. **Add audit log** tracking who changed what and when
5. **Add dynamic day subtotal** — recalculate day header when actual amounts change
6. **Add FP status field** — draft, submitted, approved
7. **Add approval workflow** — require manager sign-off
8. **Add new row types** — create new tables following `financial_posting_inclusions` pattern with `table_exists()` checks
9. **Add historical FP comparison** — show all FP records for a lead
10. **Add export to PDF/Excel** for financial posting reports
