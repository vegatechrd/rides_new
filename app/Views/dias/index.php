<?= $this->extend("theme/app") ?>

<?= $this->section("content") ?>  

 <!-- App Header -->
 <div class="appHeader">
        <div class="left">
            <a href="<?= base_url('home') ?>" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"><?= $title ?></div>
        <div class="right">

        <a href="#" class="button btn-text-primary">
        <ion-icon name="ellipsis-horizontal-circle-outline" data-bs-toggle="modal" data-bs-target="#PanelRight" size="large" role="img" 
        class="md icon-large hydrated" aria-label="cash outline"></ion-icon></a>
    

        </div>
    </div>
    <!-- * App Header -->
 <!-- App Capsule -->
 <div id="appCapsule">

    <!-- Transactions -->
    <div class="section mt-2">

              <?php foreach ($datos as $key => $value) { ?>
                
                <div class="transactions mb-2">
                <!-- item -->
                <a href="<?= base_url('dias/list/'.$value->id) ?>" class="item <?= $value->cerrado == 1 ? 'bg-dias-cerrado' : ''?>">
                    <div class="detail">
                        
                        <div>
                            <strong><?= $value->fecha_formateada ?></strong>
                            <strong><p>META: $ <?= number_format($value->meta,2)?></p>
                            <p>TOTAL KMS: <?= $value->total_kms_dia ?></p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price">Recaudado: <?= '$ '.$value->total_recaudado_dia ?></div>
                    </div>
                    <div class="right">
                        <div class="price text-danger"> Gastos: <?= '$ '.$value->total_gastos ?></div>
                    </div>
                    <div class="right">
                        <div class="price text-primary"> Ganancias: <?= '$ '.$value->ganancias ?></div>
                    </div>
                   
                </a>
                
                </div>

           <?php } ?>
        
        </div>
        <!-- * Transactions -->

       
    </div>
    <!-- * App Capsule -->


    <div class="modal fade panelbox panelbox-right" id="PanelRight" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Opciones</h5>
                        <a href="#" data-bs-dismiss="modal">Cerrar</a>
                    </div>
                    <div class="modal-body">
                        <ul class="action-button-list">
                            <li>
                                <a href="<?= base_url('dias/new/') ?>" class="btn btn-list">
                                    <span>
                                        <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                                        Crear Nuevo Día
                                    </span>
                                </a>
                            </li>
                            <li class="action-divider"></li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?= $this->endSection() ?>

    <?= $this->section("pageScript") ?>



    <?= $this->endSection() ?>