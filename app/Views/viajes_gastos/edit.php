<?= $this->extend("theme/app") ?>

<?= $this->section("content") ?>  

 <!-- App Header -->
 <div class="appHeader">
        <div class="left">
        <a href="<?= base_url('dias/view/'.$datos->dia_id) ?>" class="headerButton goBack">
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
    <input type="hidden" value="<?= $datos->dia_id ?>" id="dia_id" name="dia_id">
        <input type="hidden" value="<?= $datos->id ?>" id="id" name="id">
        <div class="card">
            <div class="card-body">
           
                                <div class="form-group boxed">
                                    <label class="label">Plataforma</label>
                                    <div class="input-group mb-2">
                             <select name="id_plataforma" id="id_plataforma" class="form-control">
                            <?php foreach ($plataformas as $key => $value) : ?>
                            <option value="<?= $value->id ?>" <?php if ($value->id == $datos->plataforma_id) { echo "selected";}?>><?= $value->descripcion ?></option>
                          <?php endforeach ?>
                          </select>
                                 </div>
                                </div>
                           

                                <div class="row">
                                <div class="col">
                                <div class="form-group boxed">
                                    <label class="label">Kms. Recogida</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="kms_recogida" name="kms_recogida" class="form-control" value="<?= $datos->kms_recogida ?>">
                                    </div>
                                </div>
                                </div>
                                <div class="col">
                                <div class="form-group boxed">
                                    <label class="label">Minutos Recogida</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" class="form-control" id="mins_recogida" name="mins_recogida" value="<?= $datos->mins_recogida ?>">

                                    </div>
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col">
                                <div class="form-group boxed">
                                    <label class="label">Kms. Destino</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="kms_destino" name="kms_destino" class="form-control" value="<?= $datos->kms_destino ?>">
                                    </div>
                                </div>
                                </div>
                                <div class="col">
                                <div class="form-group boxed">
                                    <label class="label">Minutos Destino</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="mins_destino" name="mins_destino" class="form-control" value="<?= $datos->mins_destino ?>">
                                    </div>
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                    <div class="form-group boxed">
                                    <label class="label">Efectivo</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="efectivo" name="efectivo" class="form-control sumar" 
                                    value="<?= $datos->efectivo ?>">
                                    </div>
                                </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group boxed">
                                    <label class="label">Tarjeta</label>
                                    <div class="input-group mb-2">
                                    <input type="number" inputmode="number" step="any" pattern="^-?\d*\.{0,1}\d+$" id="tarjeta" name="tarjeta" class="form-control sumar" 
                                    value="<?= $datos->tarjeta ?>">
                                    </div>
                                </div>
                                    </div>
                                    <div class="col">
                                    <div class="form-group boxed">
                                    <label class="label">Propina</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="propina" name="propina" class="form-control sumar"value="<?= $datos->propina ?>">
                                    </div>
                                </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <input type="text" id="total" name="total" class="form-control" value="<?= $datos->total ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <button type="button" id="btn_guardar" class="btn btn-primary btn-block btn-lg"><i class="fas fa-edit me-2"></i>Actualizar</button>
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


$("#btn_guardar").on("click", function() {

$("#btn_guardar").prop('disabled', true);

array_viaje = [];

var fecha_format = $("#fecha").val();
var fecha = moment(fecha_format).format('YYYY-MM-DD H:mm:ss');
var kms_recogida = $("#kms_recogida").val();
var mins_recogida = $("#mins_recogida").val();
var kms_destino = $("#kms_destino").val();
var mins_destino = $("#mins_destino").val();
var efectivo = $("#efectivo").val();
var tarjeta = $("#tarjeta").val();
var propina = $("#propina").val();
var id_plataforma = $("#id_plataforma").val();
var dia_id = $("#dia_id").val();  
var id = $("#id").val();  



var viaje_detalles = {id, fecha, kms_recogida, mins_recogida, kms_destino, mins_destino, efectivo, tarjeta, propina, id_plataforma, dia_id};
array_viaje.push(viaje_detalles);

$.ajax({
type: "POST",
url: "<?= base_url('viajes/update')?>",
data: {array_viaje: JSON.stringify(array_viaje)},
success: function(data) { 

    Swal.fire({
    icon: 'success',
    title: "Actualizado!",
    showCloseButton: true,
    html: 'Su viaje fue actualizado satisfactoriamente!',
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