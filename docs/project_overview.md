# Project Overview — Travels Software

## 1. What the Application Does

Travels Software is a **B2B/B2C travel agency management system** built for tour operators who need to manage the full lifecycle of a travel booking — from lead capture through quotation, client confirmation, property reservation, payment scheduling, and cancellation/refund tracking.

The application is powered by the **CodeIgniter 3** PHP framework and uses a **MySQL** database. It is designed for internal staff (sales, operations, accounts) with role-based access control, and also exposes a public client-facing confirmation page.

## 2. Business Domain

The software serves a travel company (branded "Royale") that:

- Receives leads from multiple sources (walk-in, phone, Meta/Facebook ads, B2B partners)
- Creates **packages** (reusable travel templates with itineraries, properties, room categories, inclusions, exclusions, payment policies, terms, cancellation policies)
- Generates **quotations** from packages, customized per lead with multiple options (different hotels, room categories, vehicle types, meal plans)
- Sends quotations to clients for **confirmation** via a tokenized public link
- Reserves properties (hotels) through a **three-level confirmation** process (blocking → confirmation → re-confirmation) with property owners
- Schedules **client payments** (FULL or EMI) and **property payments** (FULL or EMI)
- Manages **booking cancellations** with full P&L tracking, customer refunds, supplier refunds, adjustments, and approval workflow
- Tracks **staff attendance** via biometric device integration (eSSL)
- Provides **dashboard analytics** for leads, conversions, check-ins, check-outs, and quotations

## 3. Key Business Entities

| Entity | Description |
|--------|-------------|
| **Lead** | A potential customer inquiry with travel dates, guest details, package interest |
| **Package** | A reusable travel template with itinerary, properties, rooms, inclusions/exclusions, policies |
| **Quotation** | A customized offer generated from a package for a specific lead, with multiple options |
| **Quotation Option** | A variant within a quotation (different hotel/room/vehicle combinations) |
| **Client Confirmation** | A tokenized public link where the client selects their preferred option and properties |
| **Property Reservation** | A hotel booking record with three-level confirmation (blocking, confirmation, re-confirmation) |
| **Receipt Scheduler** | Client payment schedule (FULL or EMI installments) |
| **Property Payment Scheduler** | Payment schedule for what the company owes property owners |
| **Booking Cancellation** | A cancellation event with P&L tracking, refund management, and approval workflow |
| **B2B Partner** | Travel agent partners who refer leads |
| **Staff** | Internal users with role-based permissions |

## 4. Technology Stack

| Component | Technology |
|-----------|-----------|
| Framework | CodeIgniter 3 (PHP) |
| Database | MySQL (InnoDB) |
| Frontend | jQuery, Bootstrap, DataTables, Select2 |
| Charts | Chart.js / Morris.js |
| Email | PHPMailer |
| Messaging | WhatsApp Cloud API (Meta) |
| Attendance | eSSL Biometric Device API |
| Lead Generation | Meta/Facebook Lead Ads API |
| Session | File-based sessions |
| Server | Apache (mod_rewrite via .htaccess) |

## 5. Application Configuration

- **Base URL:** `http://localhost/Travels-software-new`
- **Database:** MySQL on `mysql` host, database `travels`, user `test_user`
- **Timezone:** Asia/Kolkata
- **Session:** File driver, expires on browser close
- **CSRF:** Enabled with regeneration
- **Autoloaded libraries:** database, form_validation, session
- **Autoloaded helpers:** url, form, html, file, permission, date
- **Default controller:** `login`
- **404 override:** `Welcome`

## 6. High-Level Architecture

```
┌─────────────────────────────────────────────────────────┐
│                    Apache / .htaccess                    │
│                      index.php (FC)                      │
├─────────────────────────────────────────────────────────┤
│                   CodeIgniter Router                     │
│                  (routes.php → Controller)               │
├──────────────┬──────────────┬───────────────────────────┤
│  Controller  │    Model     │         View              │
│  (business   │  (DB access, │  (template.php →          │
│   logic,     │   queries,   │   header + nav + body     │
│   AJAX)      │   CRUD)      │   + script)               │
├──────────────┴──────────────┴───────────────────────────┤
│              MySQL Database (InnoDB)                     │
│   leads · quotation · property_reservation              │
│   booking_cancellation · receipt_scheduler              │
│   user_details · tr_roles · tr_permissions              │
│   packages · properties · rooms · itinerary             │
├─────────────────────────────────────────────────────────┤
│              External Integrations                       │
│   WhatsApp Cloud API · Meta Lead Ads · eSSL Biometric   │
│   PHPMailer (SMTP)                                      │
└─────────────────────────────────────────────────────────┘
```

## 7. Core Lifecycle

```
Lead → Package Selection → Quotation Generation → Client Confirmation
  → Property Reservation (3 levels) → Payment Scheduling
  → [if cancelled] → Booking Cancellation with P&L
```

1. A **lead** is registered (manually or via Meta lead ads)
2. A **package** is selected or a custom one is built
3. A **quotation** is generated from the package with multiple options
4. The client confirms via a **tokenized public link** (selects option + properties + rooms)
5. **Property reservations** are created for each confirmed property with three-level confirmation
6. **Payment schedules** are created for both client (receipt_scheduler) and property owner (property_payment_scheduler)
7. If the booking is cancelled, a **booking cancellation** record captures P&L, manages refunds, and requires approval
