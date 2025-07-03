<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Forgot Password | Divine, Meesho Delivery Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('public/assets/images/favicon.ico'); ?>">

    <!-- Layout config Js -->
    <script src="<?= base_url('public/assets/js/layout.js'); ?>"></script>

    <!-- Bootstrap Css -->
    <link href="<?= base_url('public/assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('public/assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('public/assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url('public/assets/css/custom.min.css'); ?>" rel="stylesheet" type="text/css" />
    <style>
        .auth-page-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f7fc;
        }

        .auth-page-content {
            width: 100%;
            max-width: 450px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .text-center h5 {
            color: #333;
            margin-bottom: 30px;
            font-size: 1.8em;
        }

        .error-message,
        .success-message {
            background-color: #ffdddd;
            border-left: 5px solid #f44336;
            padding: 10px;
            margin-bottom: 20px;
            color: #f44336;
            font-size: 14px;
            border-radius: 5px;
        }

        .success-message {
            background-color: #e6ffe6;
            border-left: 5px solid #4caf50;
            color: #4caf50;
        }

        .form-label {
            font-weight: 600;
        }

        input[type="email"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }

        input[type="email"]:focus {
            border-color: #5fbae9;
            outline: none;
        }

        button {
            padding: 12px;
            font-size: 1.1em;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:active {
            background-color: #004085;
        }

        .auth-footer {
            margin-top: 30px;
            text-align: center;
        }

        .auth-footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="text-center">
                <h5 class="text-primary">Forgot Your Password?</h5>
            </div>

            <!-- Display error or success message -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="error-message">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="success-message">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/forgot_password/sendResetLink'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Enter Your Registered Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
            </form>

            <div class="auth-footer mt-3">
                <a href="<?= base_url('admin/login'); ?>" class="text-muted">Back to Login</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> Meesho Delivery Services <i class="mdi mdi-heart text-danger"></i> by Ephphatha Softech Pvt.Ltd.</p>
        </div>
    </footer>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('public/assets/libs/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/libs/simplebar/simplebar.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/libs/node-waves/waves.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/libs/feather-icons/feather.min.js'); ?>"></script>
    <script src="<?= base_url('public/assets/js/plugins.js'); ?>"></script>
</body>

</html>
