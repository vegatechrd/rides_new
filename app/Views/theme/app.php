<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Rideapp</title>
    <meta name="description" content="Rideapp">
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png')?>" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/favicon_192x192.png')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome-6.6.0/all.min.css')?>"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
   
    <link rel="manifest" href="__manifest.json">
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="<?= base_url('assets/img/loading-icon.png')?>" alt="icon" class="loading-icon">
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <!-- <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a> -->
        </div>
        <div class="pageTitle">
            <img src="<?= base_url('assets/img/logo2.png')?>" alt="logo" class="logo">
        </div>
        <div class="right">
            <!-- <a href="app-notifications.html" class="headerButton">
                <ion-icon class="icon" name="notifications-outline"></ion-icon>
                <span class="badge badge-danger">4</span>
            </a>
            <a href="app-settings.html" class="headerButton">
                <img src="<?= base_url('assets/img/sample/avatar/avatar1.jpg')?>" alt="image" class="imaged w32">
                <span class="badge badge-danger">6</span>
            </a> -->
        </div>
    </div>
    <!-- * App Header -->

    <?= $this->renderSection("content") ?>    

    <!-- App Bottom Menu -->
    <!-- <div class="appBottomMenu">
        <a href="<?= base_url('home') ?>" class="item active">
            <div class="col">
                <ion-icon name="pie-chart-outline"></ion-icon>
                <strong>Dashboard</strong>
            </div>
        </a>
        <a href="<?= base_url('viajesheader') ?>" class="item">
            <div class="col">
                <ion-icon name="document-text-outline"></ion-icon>
                <strong>Viajes</strong>
            </div>
        </a>
      
        <a href="app-cards.html" class="item">
            <div class="col">
                <ion-icon name="card-outline"></ion-icon>
                <strong>Finanzas</strong>
            </div>
        </a>
        <a href="app-settings.html" class="item">
            <div class="col">
                <ion-icon name="settings-outline"></ion-icon>
                <strong>Configuración</strong>
            </div>
        </a>
    </div> -->
    <!-- * App Bottom Menu -->


    <!-- iOS Add to Home Action Sheet -->
    <div class="modal inset fade action-sheet ios-add-to-home" id="ios-add-to-home-screen" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add to Home Screen</h5>
                    <a href="#" class="close-button" data-bs-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content text-center">
                        <div class="mb-1"><img src="<?= base_url('assets/img/icon/192x192.png')?>" alt="image" class="imaged w64 mb-2">
                        </div>
                        <div>
                            Install <strong>Finapp</strong> on your iPhone's home screen.
                        </div>
                        <div>
                            Tap <ion-icon name="share-outline"></ion-icon> and Add to homescreen.
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- * iOS Add to Home Action Sheet -->


    <!-- Android Add to Home Action Sheet -->
    <div class="modal inset fade action-sheet android-add-to-home" id="android-add-to-home-screen" tabindex="-1"
        role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar a Pantalla Inicio</h5>
                    <a href="#" class="close-button" data-bs-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content text-center">
                        <div class="mb-1">
                            <img src="assets/img/icon/192x192.png" alt="image" class="imaged w64 mb-2">
                        </div>
                        <div>
                            Install <strong>Finapp</strong> on your Android's home screen.
                        </div>
                        <div>
                            Tap <ion-icon name="ellipsis-vertical"></ion-icon> and Add to homescreen.
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary btn-block" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- * Android Add to Home Action Sheet -->



    <!-- ========= JS Files =========  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url('assets/plugins/bootstrap.bundle.min.js')?>"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="<?= base_url('assets/plugins/splide/splide.min.js')?>"></script>
    <!-- Base Js File -->
    <script src="<?= base_url('assets/plugins/base.js')?>"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/localization/messages_es_PE.min.js" 
    integrity="sha512-gb8oTuD3rVtuSherfRjSS7beLwbKp2dJaJsiiNglM3x+lGEfWmF7N0NW97VpQ6UrxMrcNPJsw88SYzqKA5Qniw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"></script>

    <script>
        // Add to Home with 2 seconds delay.
        AddtoHome("2000", "once");
    </script>

     <!-- PageScript-->
     <?= $this->renderSection("pageScript") ?>
    <!-- /PageScript-->

</body>

</html>