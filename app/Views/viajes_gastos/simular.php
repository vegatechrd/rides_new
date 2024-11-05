<?= $this->extend("theme/app") ?>

<?= $this->section("content") ?>  

 <!-- App Header -->
 <div class="appHeader">
        <div class="left">
        <a href="<?= base_url('home')?>" class="headerButton goBack">
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

        <div class="card">
            <div class="card-body">
                     
                           

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

                                <div class="form-group boxed">
                                    <label class="label">Monto</label>
                                    <div class="input-group mb-2">
                                    <input type="text" inputmode="decimal" pattern="^-?\d*\.{0,1}\d+$" id="monto" name="monto" class="form-control sumar">
                                    </div>
                                </div>
                               
                                <div class="form-group basic">
                                    <button type="button" id="btn_guardar" class="btn btn-primary btn-block btn-lg"><i class="fas fa-car me-2"></i>Simular</button>
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

$("#mins_recogida").inputmask("99:99"); 
$("#mins_destino").inputmask("99:99"); 


function sumarMinutos(time1, time2) {
    // Dividir las cadenas en horas y minutos
    const [hh1, mm1] = time1.split(':').map(Number);
    const [hh2, mm2] = time2.split(':').map(Number);
    
    // Sumar horas y minutos
    let totalHoras = hh1 + hh2;
    let totalMinutos = mm1 + mm2;

    // Convertir minutos en horas si es necesario
    totalHoras += Math.floor(totalMinutos / 60);
    totalMinutos = totalMinutos % 60;

    // Formatear la salida
    return `${String(totalHoras).padStart(2, '0')}:${String(totalMinutos).padStart(2, '0')}`;
}

function convertirAHorasTotales(hhmm) {
    // Dividir las horas y minutos
    const [horas, minutos] = hhmm.split(':').map(Number);
    
    // Convertir a minutos totales
    return horas * 60 + minutos;
}


function formatearMontoUS(monto) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(monto);
}



$("#btn_guardar").on("click", function() {

var kms_recogida = $("#kms_recogida").val();
var mins_recogida = $("#mins_recogida").val();
var kms_destino = $("#kms_destino").val();
var mins_destino = $("#mins_destino").val();
var monto = $("#monto").val() === "" ? 0 : $("#monto").val();


// Hacer Calculos viaje

let total_kms = parseFloat(kms_recogida) + parseFloat(kms_destino);
let total_mins = sumarMinutos(mins_recogida, mins_destino);
let valor_km = parseFloat(monto) / total_kms;
let valor_hora = parseFloat(monto) / (convertirAHorasTotales(total_mins) / 60);
let valor_minuto = parseFloat(monto) / convertirAHorasTotales(total_mins);

var semaforo, mensaje, mensaje2, estrellas;

if(valor_km > 30 && total_kms < 3.0 ) {

estrellas = '<i class="fa-solid fa-star" style="color: #FFD43B;"></i><i class="fa-solid fa-star" style="color: #FFD43B;"></i>'+
         '<i class="fa-solid fa-star" style="color: #FFD43B;"></i><i class="fa-solid fa-star" style="color: #FFD43B;"></i>'+
         '<i class="fa-solid fa-star" style="color: #FFD43B;"></i>';
         
semaforo = "background-color: black; color: white;";
mensaje = "Valor por Km Excelente!";
mensaje2= "Uber Black";    
    
}

// else if(valor_km > 30 && total_kms < 3.0 ) {

// $semaforo_valor_km = "background-color: green; color: white;"; 
// $mensaje = "Viaje bueno!";    
    
// }



const tablaHtml = `
                <table style="width: 100%; border-collapse: collapse;">
                      <tbody>
                        <tr>
                           <td colspan="3" style="border: 1px solid #000; padding: 4px;">`+total_kms.toFixed(1)+` Kilómetros      |      `+total_mins+` Minutos</td>
                      

                           
                        </tr>
                          <tr>
                            <td style="border: 1px solid #000; padding: 4px;">Valor / KM.</td>
                            <td style="border: 1px solid #000; padding: 4px;">Valor / Hora</td>
                            <td style="border: 1px solid #000; padding: 4px;">Valor / Minuto</td>
                           
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 4px;">`+formatearMontoUS(valor_km)+`</td>
                            <td style="border: 1px solid #000; padding: 4px;">`+formatearMontoUS(valor_hora)+`</td>
                              <td style="border: 1px solid #000; padding: 4px;">`+formatearMontoUS(valor_minuto)+`</td>
                           
                        </tr>
                         <tr>
            <td colspan="3" style="border: 1px solid #000; padding: 4px;`+semaforo+`">`+estrellas+`</td>   
                        </tr>
                          <tr>
            <td colspan="3" style="border: 1px solid #000; padding: 4px;`+semaforo+`">`+mensaje +`</td>   
                        </tr>
                    </tbody>
                </table>
            `;













Swal.fire({
    html: tablaHtml
  }).then(function() {
 window.location.href = "<?= base_url('viajes/simular')?>";
});

});






}); //document ready
</script>

    <?= $this->endSection() ?>