<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login — PT Maju Jaya</title>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <style>
        :root {
    --gunmetal: #393e41;
    --ocean-mist: #44bba4;
    --alabaster-grey: #e7e5df;
    --tuscan-sun: #e7bb41;
    --dust-grey: #d3d0cb;
}
body {
    background: linear-gradient(135deg, var(--gunmetal) 0%, #2c3033 100%);
    min-height: 100vh;
}
.login-card {
    border-radius: 1rem;
    border: none;
    box-shadow: 0 1rem 3rem rgba(0,0,0,0.3) !important;
}
.login-header {
    background: linear-gradient(135deg, var(--ocean-mist) 0%, #38a090 100%);
    border-radius: 1rem 1rem 0 0;
    padding: 2rem;
}
.login-header i { color: #fff; }
.login-header h4, .login-header p { color: #fff !important; }
.card-body { background-color: var(--alabaster-grey); border-radius: 0 0 1rem 1rem; }
.form-control:focus {
    border-color: var(--ocean-mist);
    box-shadow: 0 0 0 0.2rem rgba(68,187,164,0.25);
}
.btn-primary.btn-user {
    background-color: var(--ocean-mist) !important;
    border-color: var(--ocean-mist) !important;
    font-weight: 600;
    letter-spacing: 0.05em;
}
.btn-primary.btn-user:hover {
    background-color: #38a090 !important;
    border-color: #38a090 !important;
}
.text-gray-900 { color: var(--gunmetal) !important; }
hr { border-color: var(--dust-grey); }
.text-muted { color: #7a7670 !important; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:100vh;">
        <div class="col-xl-5 col-lg-6 col-md-8">

            <div class="card o-hidden border-0 shadow-lg login-card">
                <div class="login-header p-4 text-center text-white">
                    <i class="fas fa-shipping-fast fa-3x mb-3"></i>
                    <h4 class="font-weight-bold mb-0">PT Maju Jaya</h4>
                    <p class="mb-0 text-white-50">Sales Order System</p>
                </div>
                <div class="card-body p-4">
                    <h5 class="text-center text-gray-900 mb-4">Silakan Login</h5>

                    <?php if ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/login') ?>" method="post">
                        <div class="form-group">
                            <label for="username"><i class="fas fa-user fa-sm text-gray-400 mr-1"></i> Username</label>
                            <input type="text" class="form-control form-control-user" id="username"
                                   name="username" placeholder="Masukkan username" required autofocus
                                   value="<?= set_value('username') ?>">
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fas fa-lock fa-sm text-gray-400 mr-1"></i> Password</label>
                            <input type="password" class="form-control form-control-user" id="password"
                                   name="password" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block btn-lg mt-3">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </button>
                    </form>

                    <hr>
                    <div class="text-center small text-muted">
                        <strong>Pembuat : </strong><br>
                        <!-- admin / password &nbsp;|&nbsp; budi / password &nbsp;|&nbsp; manager / password -->
                         Rachman Maulana - 1224160049
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>