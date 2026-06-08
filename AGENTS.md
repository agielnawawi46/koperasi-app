# DanaKarya Cooperative Management System

## Project Overview

DanaKarya is a web-based cooperative management platform developed using Laravel 12, Laravel Breeze (Blade + Alpine.js), and Spatie Laravel Permission.

This project is already partially implemented.

The current UI, layouts, navigation, dashboards, and existing views must be preserved.

The objective of future development is to improve business processes, add missing features, and complete cooperative operations without rebuilding the application.

---

# Development Rules

## DO NOT

* Rebuild the project from scratch.
* Replace existing UI designs.
* Modify sidebar structures unless requested.
* Remove existing routes.
* Remove existing database tables.
* Change page layouts.
* Rename existing modules without approval.
* Delete working features.

## ALLOWED

* Refactor backend logic.
* Create new controllers.
* Create services and repositories.
* Add migrations.
* Add validations.
* Improve database structure.
* Add missing business processes.
* Add reports and exports.

---

# Business Scope

DanaKarya is designed for:

* One Company
* One Cooperative
* Many Members

The cooperative operates under a single company.

Employees become cooperative members.

---

# User Roles

## Super Admin

Purpose:
Manage company administrator accounts.

Menus:

* Dashboard

Permissions:

* Create Admin Account
* Activate Admin Account
* Deactivate Admin Account

Super Admin cannot manage cooperative transactions.

---

## Admin

Purpose:
Manage cooperative configuration.

Menus:

* Dashboard
* Organization
* Users
* Monitoring
* Reports
* Profile

Responsibilities:

### Dashboard

Display:

* Total Active Members
* Total Savings
* Total Loans
* Total Outstanding Installments

### Organization

Manage:

#### Cooperative Profile

* Cooperative Name
* Company Name
* Email
* Phone
* Address
* Website

#### Savings Configuration

* Mandatory Savings Amount
* Principal Savings Amount
* Billing Date

#### Payroll Configuration

* Payroll Date
* Maximum Salary Deduction Percentage

#### Loan Configuration

* Interest Rate
* Interest Method
* Maximum Tenor
* Loan Policy

#### SHU Configuration

* Savings Allocation
* Loan Allocation
* Reserve Fund Allocation

### Users

Manage:

* Pengurus
* Pengawas
* Anggota

### Monitoring

View system activities and audit logs.

### Reports

* Backup System
* Export Reports
* System Configuration

---

## Pengurus

Purpose:
Manage cooperative operations.

Menus:

* Dashboard
* Savings Transactions
* Loan Management
* Installment Monitoring
* Financial Reports
* Activity Monitoring
* Profile

### Dashboard

Display:

* Monthly Savings
* Active Loans
* Pending Applications
* Monthly Installments

### Savings Transactions

Display:

* Principal Savings
* Mandatory Savings
* Voluntary Savings
* Savings History

### Loan Management

Display:

* Total Loans
* Active Loans
* Loan Profit
* Pending Applications

Functions:

* Approve Loans
* Reject Loans
* Manage Disbursement Status

### Installment Monitoring

Display only:

* Installment Status
* Remaining Installments
* Delayed Installments
* Installment History

No manual installment input.

### Financial Reports

Manage:

* Savings Reports
* Loan Reports
* Installment Reports
* Operational Reports

Export:

* PDF
* Excel

### Activity Monitoring

Display system activity logs.

---

## Pengawas

Purpose:
Perform cooperative supervision and auditing.

Menus:

* Dashboard Audit
* Member Data
* Transaction Audit
* Reports & SHU
* Profile

### Dashboard Audit

Display:

* Savings Summary
* Loan Summary
* Cooperative Health Indicators

### Member Data

Monitor member information.

### Transaction Audit

Audit:

* Savings
* Loans
* Installments

Read-only access.

### Reports & SHU

View:

* Financial Reports
* SHU Reports
* RAT Reports

Export:

* PDF
* Excel

---

## Anggota

Purpose:
Use cooperative services.

Menus:

* Dashboard
* My Savings
* My Loans
* My Installments
* SHU
* Profile

### Dashboard

Display:

* Principal Savings
* Mandatory Savings
* Voluntary Savings
* Total Loans
* Active Installments
* Active Bills

### My Savings

Functions:

* View Savings Balance
* Deposit Voluntary Savings
* Withdraw Voluntary Savings

Payment Gateway allowed.

### My Loans

Functions:

* Submit Loan Request
* View Loan History
* View Remaining Loan

Loan disbursement is performed offline by Pengurus.

### My Installments

Display:

* Installment Progress
* Remaining Tenor
* Payment History
* Payment Schedule

Payment Gateway allowed.

### SHU

Display annual SHU distribution.

### Profile

Display:

* Name
* Email
* Phone Number
* National ID
* Address
* Join Date
* Salary
* Total Savings
* Total Loans
* Total Transactions

Allow password updates.

---

# Payroll Rules

Payroll is not a standalone menu.

Payroll settings are configured in Organization.

Payroll deductions are used for:

* Mandatory Savings
* Loan Installments

The system only records deductions.

Actual payroll transfer is performed by the company.

---

# Loan Rules

Before approving a loan:

1. Member status must be Active.
2. Cooperative cash must be sufficient.
3. Minimum reserve balance must remain available.
4. Monthly installment must not exceed the configured salary deduction percentage.
5. Loan tenor must follow company configuration.
6. Maximum loan amount follows company policy.

---

# Loan Disbursement

Loan disbursement is OFFLINE.

Workflow:

Submitted
→ Verified
→ Approved
→ Ready for Disbursement
→ Disbursed

The system only records the status.

---

# SHU Rules

Formula:

SHU = Total Income - Operational Expenses

Distribution follows organization configuration.

Components:

* Savings Contribution
* Loan Contribution
* Reserve Fund

SHU is calculated annually.

---

# Reporting

Available reports:

* Savings Report
* Loan Report
* Installment Report
* SHU Report
* RAT Report

Export formats:

* PDF
* Excel

---

# Technical Notes

Current Stack:

* Laravel 12
* Breeze
* Alpine.js
* Tailwind CSS
* Spatie Permission

Current Status:

* UI already developed.
* Many pages use Blade + Alpine.
* Existing layouts must be preserved.

Before changing any file:

1. Analyze current implementation.
2. Explain required modifications.
3. List affected files.
4. Wait for confirmation if major changes are required.
