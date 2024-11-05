<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Rideapp</title>
    <meta name="description" content="Rides App">
    <meta name="keywords" content="Ride App" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/favicon_192x192.png')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome-6.6.0/all.min.css')?>"/>
    <link rel="manifest" href="<?= base_url('__manifest.json') ?>">
</head>
<body>
    <!-- loader -->
    <div id="loader">
        <img src="<?= base_url('assets/img/loading-icon.png') ?>" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <!-- <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="#" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
        </div>
    </div> -->
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 mb-3 text-center">
      
            <img src="<?= base_url('assets/img/logo_color.png')?>" alt="logo" class="logo" width="175">
                       
        </div>
        <div class="text-center mt-2"> <h3>INICIAR SESI&Oacute;N</h3></div>
        <div class="section mb-5 p-2">

            <form action="<?= base_url('Login/autorizar_login')?>" method="POST">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="email1" id="label_usuario">Usuario</label>
        
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Digita tu usuario" value="<?php if(isset($_POST['usuario']))
                                { echo $_POST['usuario'];}?>" required>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" name="password1" autocomplete="off"
                                    placeholder="Your password">
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>
<div class="form-group-basic">
<button type="submit" class="btn btn-primary btn-block btn-lg mt-5"><i class="fas fa-sign-in me-3"></i>INGRESAR</button>

</div>

                    </div>
                </div>
             <br>
                <div class="text-center">
                                <?php if (isset($validation)) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $validation->listErrors(); ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php } ?>
                            </div>
               

            </form>
        </div>

    </div>
    <!-- * App Capsule -->



    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/plugins/bootstrap.bundle.min.js') ?>"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="<?= base_url('assets/plugins/splide/splide.min.js') ?>"></script>
    <!-- Base Js File -->
    <script src="<?= base_url('assets/plugins/base.js') ?>"></script>


</body>

</html>