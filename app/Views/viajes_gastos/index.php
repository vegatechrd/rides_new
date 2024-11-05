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
        <a href="<?= base_url('viajes/new')?>" class="button"><ion-icon name="add-outline"></ion-icon></a>

        </div>
    </div>
    <!-- * App Header -->
 <!-- App Capsule -->
 <div id="appCapsule">

    <!-- Transactions -->
    <div class="section mt-2">

    
            <div class="section-title"><?= date('M-Y') ?></div>

            <?php foreach ($datos as $key => $value) { ?>
                
                <div class="transactions mb-1">
                <!-- item -->
                <a href="#" class="item">
                    <div class="detail">
                        <img src="assets/img/sample/brand/1.jpg" alt="img" class="image-block imaged w48">
                        <div>
                            <strong><?= date('d-m-Y',strtotime($value->fecha)) ?></strong>
                            <p></p>
                        </div>
                    </div>
                    <div class="right">
                        <div class="price text-success"> <?= $value->total_dia ?></div>
                    </div>
                </a>
                </div>

           <?php } ?>
        
        </div>
        <!-- * Transactions -->

      
        <!-- <div class="section mt-2 mb-2">
            <a href="#" class="btn btn-primary btn-block btn-lg">Ver Más</a>
        </div> -->

           


    </div>
    <!-- * App Capsule -->

    <?= $this->endSection() ?>

    <?= $this->section("pageScript") ?>



    <?= $this->endSection() ?>