<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; PLN UP2D Jawa timur</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo e(asset('library/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('library/bootstrap-social/bootstrap-social.css')); ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/components.css')); ?>">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-stretch flex-wrap">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="m-3 p-4">
                        <img src="<?php echo e(asset('img/Logo_PLN.png')); ?>" alt="logo" width="80"
                            class="shadow-light mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">Welcome to <span
                                class="font-weight-bold">SI MASTER DATA PLN</span>
                        </h4>
                        <p class="text-muted">Silahkan Login</p>
                        <form method="POST" action="<?php echo e(route('loginpost')); ?>" class="needs-validation" novalidate="">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                    tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <a href="auth-forgot-password.html" class="float-left mt-3">
                                    Forgot Password?
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                                    tabindex="4">
                                    Login
                                </button>
                            </div>

                            <div class="mt-2 text-center">
                                Belum punya akun ? <a href="">Daftar Disini</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
                    data-background="<?php echo e(asset('img/unsplash/login-bg.jpg')); ?>">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">


                                <h1 class="display-4 font-weight-bold mb-2">Have a Good Day</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?php echo e(asset('library/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/popper.js/dist/umd/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('library/tooltip.js/dist/umd/tooltip.js')); ?>"></script>
    <script src="<?php echo e(asset('library/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/moment/min/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/stisla.js')); ?>"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\MasterDataPLN2\resources\views/Auth/auth-login2.blade.php ENDPATH**/ ?>