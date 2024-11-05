<?= $this->extend("theme/app") ?>

<?= $this->section("content") ?>  

 <!-- App Header -->
 <div class="appHeader">
        <div class="left">
        <a href="<?= base_url('dias/list/'.$dia_id) ?>" class="headerButton goBack">
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
    <form>

        <input type="hidden" value="<?= $dia_id ?>" id="dia_id" name="dia_id">
        <div class="card">
            <div class="card-body">
                                           <div class="form-group boxed">
                                    <label class="label">Plataforma</label>
                                    <div class="input-group mb-2">
                             <select name="id_plataforma" id="id_plataforma" class="form-control">
                            <?php foreach ($plataformas as $key => $value) : ?>
                            <option value="<?= $value->id ?>" <?php if ($value->descripcion == "INDRIVE"){ echo 'selected="selected"';}?>><?= $value->descripcion ?></option>
                          <?php endforeach ?>
                          </select>
                                 </div>
                                </div>
                           

                                <div class="row">
                                <div class="col">
                                <div class="form-group boxed">
                                    <label class="label">Kms. Recogida</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="kms_recogida" name="kms_recogida" class="form-control">
                                    </div>
                                </div>
                                </div>
                                <div class="col">
                                <div class="form-group boxed">
                                    <label class="label">Minutos Recogida</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" class="form-control" id="mins_recogida" name="mins_recogida">

                                    </div>
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col">
                                <div class="form-group boxed">
                                    <label class="label">Kms. Destino</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="kms_destino" name="kms_destino" class="form-control">
                                    </div>
                                </div>
                                </div>
                                <div class="col">
                                <div class="form-group boxed">
                                    <label class="label">Minutos Destino</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="mins_destino" name="mins_destino" class="form-control">
                                    </div>
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                    <div class="form-group boxed">
                                    <label class="label">Efectivo</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="efectivo" name="efectivo" class="form-control sumar">
                                    </div>
                                </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group boxed">
                                    <label class="label">Tarjeta</label>
                                    <div class="input-group mb-2">
                                    <input type="number" inputmode="number" step="any" pattern="^-?\d*\.{0,1}\d+$" id="tarjeta" name="tarjeta" class="form-control sumar">
                                    </div>
                                </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group boxed">
                                    <label class="label">Propina</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="propina" name="propina" class="form-control sumar">
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <input type="text" id="total" name="total" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <button type="button" id="btn_guardar" class="btn btn-primary btn-block btn-lg"><i class="fas fa-save me-2"></i>Guardar</button>
                                </div>
            </div>
        </div>

    </formaction=>
</div>

</div>


    <?= $this->endSection() ?>

    <?= $this->section("pageScript") ?>

<script>
   
$(document).ready(function(){


$('.sumar').keyup(function() {
    var total = 0;

    $(".sumar").each(
      function() {
        if (Number($(this).val())) {
          total = total + Number($(this).val());
        }
      });
    $("#total").val(total);
  });


//$("#mins_recogida").inputmask("99:99"); 
//$("#mins_destino").inputmask("99:99"); 

// var now = new Date();
//now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
//document.getElementById('fecha').value = now.toISOString().slice(0,16);

$("#btn_guardar").on("click", function() {

$("#btn_guardar").prop('disabled', true);

array_viaje = [];

var kms_recogida = $("#kms_recogida").val();
var mins_recogida = $("#mins_recogida").val();
var kms_destino = $("#kms_destino").val();
var mins_destino = $("#mins_destino").val();
var efectivo = $("#efectivo").val() === "" ? 0 : $("#efectivo").val();
var tarjeta = $("#tarjeta").val() === "" ? 0 : $("#tarjeta").val();
var propina = $("#propina").val() === "" ? 0 : $("#propina").val();
var id_plataforma = $("#id_plataforma").val();
var dia_id = $("#dia_id").val();  


var viaje_detalles = {kms_recogida, mins_recogida, kms_destino, mins_destino, efectivo, tarjeta, propina, id_plataforma, dia_id};
array_viaje.push(viaje_detalles);

$.ajax({
type: "POST",
url: "<?= base_url('viajes/add')?>",
data: {array_viaje: JSON.stringify(array_viaje)},
success: function(data) { 

    Swal.fire({
    icon: 'success',
    title: "Guardado!",
    showCloseButton: true,
    html: 'Su viaje fue guardado satisfactoriamente!'+
    '<hr>'+
    '<a href="<?= base_url('viajes/new/')?>'+dia_id+'" class="btn btn-success"><i class="fas fa-car me-2"></i> Nuevo Viaje</a>'+
    '<hr>',
  }).then(function() {
    $("#btn_guardar").prop('disabled', false);
    window.location.href = "<?= base_url('dias/list/')?>"+dia_id+"";
});

}
 }); 

 
    });

});
</script>

    <?= $this->endSection() ?>