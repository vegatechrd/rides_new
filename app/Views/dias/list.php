<?= $this->extend("theme/app") ?>

<?= $this->section("content") ?>  

 <!-- App Header -->
 <div class="appHeader">
        <div class="left">
            <a href="<?= base_url('dias') ?>" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"><?= $title ?></div>
        <?php if ($dia->cerrado == 0) : ?>
       <div class="right">
       <a href="#" class="button btn-text-primary">
        <ion-icon name="ellipsis-horizontal-circle-outline" data-bs-toggle="modal" data-bs-target="#PanelRight" size="large" role="img" 
        class="md icon-large hydrated" aria-label="cash outline"></ion-icon></a>
       
 
        </div> 
        <?php endif; ?>
    </div>
    <!-- * App Header -->
 <!-- App Capsule -->
 <div id="appCapsule">
<?php if ($dia->cerrado == 0) : ?>

 <div class="section mt-3">
<div class="row">
<a href="<?= base_url('viajes/new/').$dia_id?>" class="btn btn-block btn-primary me-2"><ion-icon name="add-outline"></ion-icon>Nuevo Viaje</a>

</div>
   </div>
   <?php endif; ?>
   <div class="section mt-2">
     <div class="row">
    
        <div class="col-6">
                    <div class="stat-box">
                        <div class="title">META</div>
                        <div class="value"><?= '$ '.number_format($dia->meta,2) ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">PENDIENTE META</div>
                        <div class="value"><?= '$ '.number_format($dia->pendiente,2)?></div>
                    </div>
                </div>
               
                </div>
                <div class="row mt-1">
                   
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">TOTAL RECAUDADO</div>
                        <div class="value"><?= '$ '.number_format($dia->recaudado,2) ?></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="stat-box">
                        <div class="title">GANANCIA</div>
                        <div class="value <?= $dia->balance < 0 ? 'text-danger' : 'text-success'?>"><?= '$ '.number_format($dia->balance,2) ?></div>
                    </div>
                </div>
            </div>
           
           
        </div>

          
   <div class="accordion mt-2" id="accordionExample2">
        
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion002">
                            <ion-icon name="car-outline" role="img" class="md hydrated" aria-label="card outline"></ion-icon>
                           Viajes
                        </button>
                    </h2>
                    <div id="accordion002" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                        <div class="accordion-body">
                                    

       <?php if ($lista_viajes) : ?>
       
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              
                                <th scope="col">No.</th>
                                <th scope="col">Plataforma</th>
                                <th scope="col">Kms. / Mins.</th>
                                <th scope="col" class="text-end">Monto</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach (array_reverse($lista_viajes) as $key => $value) { ?>
                            <tr>
                               
                                <th scope="row"><?= $value->conteo_viajes ?></th>
                                <th scope="row"><div><?= $value->plataforma ?><i class="fa-solid fa-circle-check ms-2 fa-xl <?= $value->tipo_viaje ?> "></i></div>
                                <div><?= date('h:i A', strtotime($value->fecha_hora))?></div></th>
                                <th scope="row"><?= $value->total_kms.' | '.$value->total_mins ?></th>
                                <th scope="row" class="text-end text-primary"><a href="<?= base_url('viajes/detail/'.$value->id) ?>">$ <?= number_format($value->total,2) ?></a></th>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                </div>
   <?php   endif ?>
                        </div>
                    </div>
               
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion003">
                            <ion-icon name="cash-outline" role="img" class="md hydrated text-danger" aria-label="cash outline"></ion-icon>
                           Gastos
                        </button>
                    </h2>
                    <div id="accordion003" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                        <div class="accordion-body">
                   
                        <?php if ($lista_gastos) : ?>

                        <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Categoría</th>
                                <th scope="col" class="text-end">Monto</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach (array_reverse($lista_gastos) as $key => $value) { ?>
                            <tr>
                                <th scope="row"><?= $value->conteo_gastos ?></th>
                                <td><?= $value->categoria ?></td>
                                <td class="text-end text-danger"><a href="<?= base_url('gastos/detail/'.$value->id) ?>">$ <?= number_format($value->total,2) ?></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php   endif ?>

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion001">
                            <ion-icon name="information-circle-outline" role="img" class="md hydrated" aria-label="wallet outline"></ion-icon>
                           Más Informaciones
                        </button>
                    </h2>
                    <div id="accordion001" class="accordion-collapse collapse" data-bs-parent="#accordionExample2">
                        <div class="accordion-body">

                <div class="table-responsive mt-2">
                    <table class="table">
                       
                        <tbody>
                            <tr>
                                <th scope="row">TOTAL PROPINAS</th>
                                <td><?= number_format($dia->total_propinas,2) ?></td>
                                </tr>
                                <tr>
                                <th scope="row">CANTIDAD VIAJES</th>
                                <td><?= $dia->cantidad_viajes ?></td>
                              
                            </tr>
                            <tr>
                                <th scope="row">TOTAL KILÓMETROS</th>
                                <td><?= $dia->total_kms_dia ?></td>
                              
                            </tr>
                            <tr>
                                <th scope="row">TOTAL EFECTIVO</th>
                                <td><?= number_format($dia->total_efectivo,2) ?></td>
                              
                            </tr>
                            <tr>
                                <th scope="row">TOTAL TARJETA</th>
                                <td><?= number_format($dia->total_tarjeta,2) ?></td>
                              
                            </tr>
                            <tr>
                                <th scope="row">PRECIO KM. VIAJE</th>
                                <td><?= $dia->precio_km_viaje ?></td>
                              
                            </tr>
                           
                        </tbody>
                    </table>
                </div>

          

                        </div>
                    </div>
                </div>
            </div>


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
                                <a href="<?= base_url('dias/edit/'.$dia_id) ?>" class="btn btn-list">
                                    <span>
                                        <ion-icon name="create-outline" role="img" class="md hydrated" aria-label="arrow forward outline"></ion-icon>
                                        Editar Día
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('gastos/new/').$dia_id?>" class="btn btn-list">
                                    <span>
                                        <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="card outline"></ion-icon>
                                       Crear Gasto
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a onclick="cerrardia(<?= $dia_id ?>);" class="btn btn-list">
                                    <span>
                                        <ion-icon name="lock-closed-outline" role="img" class="md hydrated" aria-label="card outline"></ion-icon>
                                       Cerrar Día
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
   <script>

function cerrardia(id) {

    Swal.fire({
         title: "Cerrar el día ?",
         text: "Esta operación no se podrá reversar.",
         icon: 'info',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
           confirmButtonText: 'Si, Cerrar',
         cancelButtonText: 'No, Cancelar'
       }).then((result) => {
   
         if (result.value) {
           $.ajax({
             url: '<?= base_url("dias/cerrar") ?>',
             type: 'post',
             data: {
               id : id
             },
             dataType: 'json',
             success: function(response) {
   
               if (response.success === true) {
                 Swal.fire({
                   icon: 'success',
                   title: 'Cerrado',
                   text: 'Su día fue cerrado',
                   showConfirmButton: true              
                 }).then(function() {
         window.location.href = "<?= base_url('dias')?>";
   });
               } else {
                 Swal.fire({
                   toast:false,
                   position: 'bottom-end',
                   icon: 'error',
                   title: response.messages,
                   showConfirmButton: true,
                   timer: 3000
                 })
               }
             }
           });
         }
       })


}



   </script>


    <?= $this->endSection() ?>