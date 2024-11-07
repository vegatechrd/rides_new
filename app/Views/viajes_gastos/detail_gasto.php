<?= $this->extend("theme/app") ?>

<?= $this->section("content") ?>  

 <!-- App Header -->
 <div class="appHeader">
        <div class="left">
            <a href="<?= base_url('dias/view/'.$viaje->dia_id) ?>" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>

        <div class="right">
       
        <a class="button btn-text-primary" href="<?= base_url('viajesgastos/edit/').$viaje->id ?>">
        <ion-icon name="create-outline" role="img" class="md icon-large hydrated" aria-label="edit outline"></ion-icon></a>

        </div>
        <div class="pageTitle"><?= $title ?></div>
       
    </div>
    <!-- * App Header -->
 <!-- App Capsule -->

 <div id="appCapsule" class="full-height">

<div class="section mt-2 mb-2 bg-white">

<ul class="listview flush transparent simple-listview no-space mt-3">
    
    <li>
            <strong>Categoría Gasto</strong>
            <h3 class="m-0"><?= $viaje->categoria ?></h3>
        </li>
        <li>
            <strong>Total</strong>
            <h3 class="m-0"><?= 'RD$ '.number_format($viaje->total,2) ?></h3>
        </li>
        <li>
            <strong>Cantidad KM.</strong>
            <h3 class="m-0"><?= $viaje->kms_recorridos ?></h3>
        </li>
        <li>
            <strong>Precio Galón</strong>
            <h3 class="m-0"><?= number_format($viaje->precio_galon,2) ?></h3>
        </li>
        <li>
            <strong>Comentario</strong>
            <h3 class="m-0"><?= $viaje->comentario ?></h3>
        </li>

    </ul>


</div>

  <div class="section mt-2 mb-2">

  <button type="button" id="btn_eliminar" class="btn btn-danger btn-block btn-lg"><i class="fas fa-trash me-2"></i>Eliminar</button>

  </div>


</div>


    <?= $this->endSection() ?>

    <?= $this->section("pageScript") ?>

    <script>
   
   $(document).ready(function(){
   
   
     $("#btn_eliminar").on("click", function() {
   
       var id = <?= $viaje->id ?>; 
   
         Swal.fire({
         title: "Eliminar Viaje ?",
         text: "Esta operación no se podrá reversar.",
         icon: 'error',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
           confirmButtonText: 'Si, Eliminar',
         cancelButtonText: 'No, Cancelar'
       }).then((result) => {
   
         if (result.value) {
           $.ajax({
             url: '<?= base_url("viajes/remove") ?>',
             type: 'post',
             data: {
               id : id
             },
             dataType: 'json',
             success: function(response) {
   
               if (response.success === true) {
                 Swal.fire({
                   icon: 'success',
                   title: 'Eliminado',
                   text: 'Su viaje fue eliminado',
                   showConfirmButton: true              
                 }).then(function() {
         window.location.href = "<?= base_url('dias/list/').$viaje->dia_id?>";
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
     });
   
   
   });
   </script>

    <?= $this->endSection() ?>