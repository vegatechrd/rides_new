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
       
    </div>
    <!-- * App Header -->
 <!-- App Capsule -->
 <div id="appCapsule">

<div class="section-mt-2 bg-white">

<div class="table-responsive">
                    <table class="table" width="100%" style=" font-size: 20px;">
                        <thead>
                            <tr>
                              
                                <th scope="col">KMS.</th>
                                <th scope="col">Tiempo</th>
                                <th scope="col">Precio</th>
                               
                            </tr>
                        </thead>
                        <tbody>

                            
                                <th scope="row">2-6</th>
                                <th scope="row">20</th>
                                <th scope="row">$ 200</th>
                            </tr>
                            <tr>
                                <th scope="row">7-9</th>
                                <th scope="row">25</th>
                                <th scope="row">$ 250</th>
                            </tr>
                            <tr>
                                <th scope="row">9-12</th>
                                <th scope="row">30</th>
                                <th scope="row">$ 350</th>
                            </tr>
                            <tr>
                                <th scope="row">5-10</th>
                                <th scope="row">35</th>
                                <th scope="row">$ 400</th>
                            </tr>
                            <tr>
                                <th scope="row">10</th>
                                <th scope="row">45</th>
                                <th scope="row">$ 500</th>
                            </tr>
                            <tr>
                                <th scope="row">10</th>
                                <th scope="row">60</th>
                                <th scope="row">$ 600</th>
                            </tr>
                            <tr>
                                <th scope="row">23+</th>
                                <th scope="row">60+</th>
                                <th scope="row">$ 750-900</th>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>

</div>
          



    </div>
  
   
    <?= $this->endSection() ?>

    <?= $this->section("pageScript") ?>
  
    <?= $this->endSection() ?>