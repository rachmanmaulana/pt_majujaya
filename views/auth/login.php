<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login — PT Maju Jaya</title>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif !important; }

        body {
            background: #0f172a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Subtle grid background */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(37,99,235,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37,99,235,0.06) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Glow blobs */
        body::after {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%);
            top: -150px; left: -150px;
            pointer-events: none;
        }

        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }

        /* Logo / brand area */
        .login-brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            border-radius: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 8px 20px rgba(37,99,235,0.35);
        }
        .login-brand-icon i { color: #fff; font-size: 1.4rem; }
        .login-brand h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #f8fafc;
            margin: 0 0 0.25rem;
            letter-spacing: -0.02em;
        }
        .login-brand p {
            font-size: 0.8rem;
            color: #64748b;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* Card */
        .login-card {
            background: #1e293b;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }
        .login-card h2 {
            font-size: 1rem;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 1.5rem;
        }

        /* Form */
        .form-group label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.4rem;
        }
        .form-control {
            background: #0f172a !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            border-radius: 0.5rem !important;
            color: #e2e8f0 !important;
            font-size: 0.875rem !important;
            padding: 0.65rem 0.875rem !important;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .form-control::placeholder { color: #475569 !important; }
        .form-control:focus {
            border-color: #2563eb !important;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.2) !important;
            outline: none !important;
        }

        /* Submit button */
        .btn-login {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            border-radius: 0.5rem;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 0.75rem;
            width: 100%;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: opacity 0.15s ease, transform 0.15s ease;
            box-shadow: 0 4px 12px rgba(37,99,235,0.35);
        }
        .btn-login:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }

        /* Alert */
        .alert-danger {
            background: rgba(239,68,68,0.1) !important;
            border: 1px solid rgba(239,68,68,0.25) !important;
            color: #fca5a5 !important;
            border-radius: 0.5rem !important;
            font-size: 0.85rem;
        }

        /* Divider */
        .login-divider {
            border-color: rgba(255,255,255,0.07) !important;
            margin: 1.5rem 0 1rem !important;
        }

        .login-footer {
            text-align: center;
            font-size: 0.75rem;
            color: #475569;
        }
        .login-footer strong { color: #64748b; }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- Brand -->
    <div class="login-brand">
        <div class="login-brand-icon">
            <i class="fas fa-shipping-fast"></i>
        </div>
        <h1>PT Maju Jaya</h1>
        <p>Sales Order System</p>
    </div>

    <!-- Card -->
    <div class="login-card">
        <h2>Masuk ke sistem</h2>

        <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show mb-3">
            <i class="fas fa-exclamation-circle mr-1"></i>
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/login') ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username"
                       name="username" placeholder="Masukkan username" required autofocus
                       value="<?= set_value('username') ?>">
            </div>
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password"
                       name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
            </button>
        </form>

        <hr class="login-divider">
        <div class="login-footer">
            <strong>Pembuat:</strong> Rachman Maulana — 1224160049
        </div>
    </div>

</div>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>