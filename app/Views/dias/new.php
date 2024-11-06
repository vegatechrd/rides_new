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
        <!-- <div class="right">
                       <a href="#" class="button" data-bs-toggle="modal" data-bs-target="#modal_nuevo_dia">
                            <ion-icon name="add-outline"></ion-icon>
                        </a>

        </div> -->
    </div>
    <!-- * App Header -->
 <!-- App Capsule -->


   <!-- App Capsule -->
   <div id="appCapsule">
<div class="section p-1">
    <form action="index.html">
        <div class="card">
            <div class="card-body">
            <div class="form-group boxed">
                                    <label class="label">Fecha / Hora</label>
                                    <div class="input-group mb-2">
                                        <input type="datetime-local" id="fecha" name="fecha" class="form-control">
                                    </div>
                                </div>
                              
                                <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="label" for="textarea4b">Descripción</label>
                                <textarea id="descripcion" name="descripcion" rows="2" class="form-control"></textarea>
                                <i class="clear-input">
                                    <ion-icon name="close-circle" role="img" class="md hydrated" aria-label="close circle"></ion-icon>
                                </i>
                            </div>
                        </div>
                        <div class="form-group boxed">
                                    <label class="label">Meta RD$</label>
                                    <div class="input-group mb-2">
                                        <input type="number" id="meta" name="meta" class="form-control">
                                    </div>
                                </div>
             
                                <div class="form-group basic">
                                    <button type="button" id="btn_guardar" class="btn btn-primary btn-block btn-lg"><i class="fas fa-save me-2"></i>Guardar</button>
                                </div>
            </div>
        </div>

    </form>
</div>

</div>


    <?= $this->endSection() ?>

    <?= $this->section("pageScript") ?>

<script>
   
$(document).ready(function(){

var now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
document.getElementById('fecha').value = now.toISOString().slice(0,16);

$("#btn_guardar").on("click", function() {

array_dia = [];

var fecha_format = $("#fecha").val();
var fecha = moment(fecha_format).format('YYYY-MM-DD H:mm:ss');
var descripcion = $("#descripcion").val();
var meta = $("#meta").val();

var dia_detalles = {fecha, descripcion, meta};
array_dia.push(dia_detalles);

$.ajax({
type: "POST",
url: "<?= base_url('dias/store')?>",
data: {array_dia: JSON.stringify(array_dia)},
success: function(data) {
    
    if (data.success == true) {

    Swal.fire({
    icon: 'success',
    title: 'Guardado',
    showCloseButton: true,
    html: 'Su día fue guardado satisfactoriamente!'
  }).then(function() {
    window.location.href = "<?= base_url('dias');?>";
});

}
else {
    Swal.fire({
    icon: 'error',
    title: 'Error',
    showCloseButton: true,
    html: data.messages
  })

}

}
 }); 

 
    });

});
</script>

    <?= $this->endSection() ?>