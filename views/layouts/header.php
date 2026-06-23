<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= isset($title) ? $title . ' — PT Maju Jaya' : 'PT Maju Jaya Sales Order System' ?></title>

    <!-- Font Awesome (local) -->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <!-- SB Admin 2 CSS (local) -->
    <link href="<?= base_url('assets/css/sb-admin-2.css') ?>" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ===== DESIGN TOKENS ===== */
        :root {
            --primary:      #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light:#eff6ff;
            --accent:       #0ea5e9;
            --success:      #10b981;
            --warning:      #f59e0b;
            --danger:       #ef4444;
            --info:         #06b6d4;
            --sidebar-bg:   #0f172a;
            --sidebar-text: #94a3b8;
            --sidebar-active: #2563eb;
            --body-bg:      #f1f5f9;
            --card-bg:      #ffffff;
            --text-main:    #1e293b;
            --text-muted:   #64748b;
            --border:       #e2e8f0;
            --radius:       0.75rem;
            --radius-sm:    0.5rem;
            --shadow-sm:    0 1px 3px rgba(0,0,0,0.07), 0 1px 2px rgba(0,0,0,0.05);
            --shadow:       0 4px 6px -1px rgba(0,0,0,0.08), 0 2px 4px -1px rgba(0,0,0,0.05);
            --shadow-lg:    0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -2px rgba(0,0,0,0.04);
        }

        /* ===== GLOBAL RESET ===== */
        * { font-family: 'Inter', sans-serif !important; }

        body {
            background-color: var(--body-bg);
            color: var(--text-main);
        }

        /* ===== TABLE HEADER ===== */
        table.dataTable thead th,
        .table thead th {
            background-color: var(--sidebar-bg);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            border: none;
            padding: 0.85rem 1rem;
        }

        /* ===== STATUS BADGES ===== */
        .badge-pill { font-size: 0.7rem; font-weight: 600; padding: 0.35em 0.75em; letter-spacing: 0.03em; }
        .badge-draft      { background-color: #e2e8f0; color: #475569; }
        .badge-dikirim    { background-color: #dbeafe; color: #1d4ed8; }
        .badge-selesai    { background-color: #d1fae5; color: #065f46; }
        .badge-dibatalkan { background-color: #fee2e2; color: #991b1b; }

        /* ===== CARDS ===== */
        .card {
            border: none !important;
            border-radius: var(--radius) !important;
            box-shadow: var(--shadow) !important;
            background: var(--card-bg);
        }
        .card-header {
            background: var(--card-bg) !important;
            border-bottom: 1px solid var(--border) !important;
            border-radius: var(--radius) var(--radius) 0 0 !important;
            padding: 1rem 1.25rem !important;
        }

        /* ===== BUTTONS ===== */
        .btn {
            border-radius: var(--radius-sm) !important;
            font-weight: 500 !important;
            font-size: 0.85rem !important;
            letter-spacing: 0.01em !important;
        }
        .btn-primary { background-color: var(--primary) !important; border-color: var(--primary) !important; }
        .btn-primary:hover { background-color: var(--primary-dark) !important; border-color: var(--primary-dark) !important; }
        .btn-success { background-color: var(--success) !important; border-color: var(--success) !important; }
        .btn-danger  { background-color: var(--danger) !important; border-color: var(--danger) !important; }
        .btn-sm { padding: 0.35rem 0.75rem !important; }

        /* ===== FORM CONTROLS ===== */
        .form-control {
            border-radius: var(--radius-sm) !important;
            border-color: var(--border) !important;
            font-size: 0.875rem !important;
        }
        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15) !important;
        }

        /* ===== ALERTS ===== */
        .alert {
            border-radius: var(--radius-sm) !important;
            border: none !important;
            font-size: 0.875rem;
        }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-danger  { background: #fee2e2; color: #991b1b; }

        /* ===== STATS CARDS ===== */
        .stat-card {
            border-left: 4px solid transparent !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg) !important;
        }
        .stat-card.blue   { border-left-color: var(--primary) !important; }
        .stat-card.green  { border-left-color: var(--success) !important; }
        .stat-card.cyan   { border-left-color: var(--info) !important; }
        .stat-card.yellow { border-left-color: var(--warning) !important; }

        /* ===== PAGE HEADING ===== */
        .page-heading h1 { font-size: 1.4rem; font-weight: 700; color: var(--text-main); }

        /* ===== TABLE ROWS ===== */
        .table-hover tbody tr:hover { background-color: var(--primary-light); }
        .table td, .table th { vertical-align: middle; }

        /* ===== PROGRESS BAR ===== */
        .progress { border-radius: 9999px; height: 0.6rem; }
        .progress-bar { border-radius: 9999px; }
    </style>
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php /* sidebar di-include terpisah */ ?>

<!-- <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"> -->