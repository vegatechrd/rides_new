<?= $this->extend("theme/app") ?>

<?= $this->section("content") ?>    
    
    <!-- App Capsule -->
    <div id="appCapsule">

        <!-- Wallet Card -->
        <div class="section wallet-card-section pt-1">
            <div class="wallet-card">
                <!-- Balance -->
                <div class="balance">
                    <div class="left">
                        <span class="title" style="text-transform: uppercase;">Ganancias Semana</span>
                        <h1 class="total"><?= '$ '. number_format($ganancias_semana,2) ?></h1>
                    </div>
                </div>
                <!-- * Balance -->
                <!-- Wallet Footer -->
                <div class="wallet-footer">
                    <div class="item">
                        <a href="<?= base_url('dias')?>">
                            <div class="icon-wrapper bg-primary">
                                <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                            <strong>DIAS</strong>
                        </a>
                    </div>
                   
                    <div class="item">
                    <a href="<?= base_url('dias/tabla_precios')?>">
                            <div class="icon-wrapper bg-success">
                                <ion-icon name="list-outline"></ion-icon>
                            </div>
                            <strong>PRECIOS</strong>
                        </a>
                    </div>
                   
                    <div class="item">
                    <a href="<?= base_url('viajes/simular')?>">
                            <div class="icon-wrapper bg-info">
                                <ion-icon name="arrow-up-outline"></ion-icon>
                            </div>
                            <strong>SIMULAR</strong>
                        </a>
                    </div>
                    <!-- <div class="item">
                        <a href="">
                            <div class="icon-wrapper bg-danger">
                                <ion-icon name="arrow-forward-outline"></ion-icon>
                            </div>
                            <strong>GASTOS</strong>
                        </a>
                    </div>
                    -->
                    <!-- <div class="item">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exchangeActionSheet">
                            <div class="icon-wrapper bg-warning">
                                <ion-icon name="swap-vertical"></ion-icon>
                            </div>
                            <strong>Exchange</strong>
                        </a>
                    </div> -->

                </div>
                <!-- * Wallet Footer -->
            </div>
        </div>
       
        <!-- Wallet Card -->
        <div class="section mt-4">
        <div class="section-heading">
                <h2 class="title">Informaciones Semana Actual</h2>
               
            </div>
        <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">TARJETA SEMANA</div>
                        <div class="value"><?= '$ '.number_format($tarjeta_semana,2) ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">EFECTIVO SEMANA</div>
                        <div class="value"><?= '$ '.number_format($efectivo_semana,2) ?></div>
                    </div>
                </div>
            </div>
           
           
        </div>
        <div class="section mt-4">
        <div class="section-heading">
                <h2 class="title">Informaciones Mensuales</h2>
                
            </div>
      
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">RECAUDADO MES</div>
                        <div class="value text-success"><?= '$ '.number_format($recaudado_mes,2) ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">GASTOS MES</div>
                        <div class="value text-danger"><?= '$ '.number_format($gastos_mes,2) ?></div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">GANANCIAS MES</div>
                        <div class="value text-success"><?= '$ '.number_format($ganancias_mes,2) ?></div>
                    </div>
                </div>
            </div>
           
           
        </div>
        <div class="section mt-4">
        <div class="section-heading">
                <h2 class="title">Informaciones Globales</h2>
               
            </div>
      
            <div class="row mt-2">
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">RECAUDADO GLOBAL</div>
                        <div class="value text-success"><?= '$ '.number_format($ingresos_globales,2) ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">GASTOS GLOBALES</div>
                        <div class="value text-danger"><?= '$ '.number_format($gastos_globales,2) ?></div>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="stat-box">
                        <div class="title">GANANCIAS GLOBALES</div>
                        <div class="value text-success"><?= '$ '.number_format($ganancias_globales,2) ?></div>
                    </div>
                </div>
            </div>
           
           
        </div>
      
    </div>
    <!-- * App Capsule -->

    <?= $this->endSection() ?>