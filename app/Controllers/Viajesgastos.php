<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiasModel;
use App\Models\ViajesGastosModel;
use App\Models\PlataformasModel;

class Viajesgastos extends BaseController
{
	
	protected $diasModel, $viajesgastosModel, $plataformasModel;
	
	public function __construct()
	{
		$this->diasModel = new DiasModel();
        $this->viajesgastosModel = new ViajesGastosModel();
       	$this->plataformasModel = new PlataformasModel();
		
	}


	public function new($id)
	{

	 		    $data = [
                'controller'    	=> 'viajes',
                'title'     		=> 'Nuevo Viaje',
				'plataformas'		=> $this->plataformasModel->findAll(),
				'dia_id'			=> $id		
			];
		
		return view('viajes_gastos/new', $data);
			
	}

	// function convertirMinutosATime($minutos) {
	// 	$horas = floor($minutos / 60);
	// 	$minutosRestantes = $minutos % 60;
		
	// 	return sprintf('%02d:%02d:00', $horas, $minutosRestantes);
	// }

// 	public function add()
// 	{

// 		$fecha = $myTime = new Time('now', 'America/Santo_Domingo', 'es_ES');

// 		$viaje = json_decode($_POST['array_viaje'], true);
		
//         $response = array();

// $fields['kms_recogida'] = $viaje[0]['kms_recogida'];
// $fields['mins_recogida'] = $this->convertirMinutosATime($viaje[0]['mins_recogida']);
// $fields['kms_destino'] = $viaje[0]['kms_destino'];
// $fields['mins_destino'] = $this->convertirMinutosATime($viaje[0]['mins_destino']);
// $fields['efectivo'] = $viaje[0]['efectivo'];
// $fields['tarjeta'] = $viaje[0]['tarjeta'];
// $fields['total'] = $viaje[0]['efectivo'] +  $viaje[0]['tarjeta'] ;
// $fields['propina'] = $viaje[0]['propina'];
// $fields['plataforma_id'] = $viaje[0]['id_plataforma'];
// $fields['dia_id'] = $viaje[0]['dia_id'];
// $fields['fecha_hora'] = $fecha;



//             if ($this->viajesModel->insert($fields)) {
												
//                 $response['success'] = true;
               				
//             } else {
				
//                 $response['success'] = false;
//                 $response['messages'] = lang("App.insert-error") ;
				
//             }
       
		
//         return $this->response->setJSON($response);
// 	}


	// function convertirTiempoAMinutos($tiempo) {
	// 	// Divide el tiempo en horas, minutos y segundos
	// 	list($horas, $minutos, $segundos) = explode(':', $tiempo);
		
	// 	// Convierte todo a minutos
	// 	$totalMinutos = ($horas * 60) + $minutos + ($segundos / 60);
		
	// 	return round($totalMinutos);
	// }

	// public function edit($id)
	// {
   
	// $datos = $this->viajesModel->where('id', $id)->first();

	// $datos->mins_recogida = $this->horaAMinutos($datos->mins_recogida);
	// $datos->mins_destino = $this->horaAMinutos($datos->mins_destino);

	// $data = [
	
	// 'controller' => 'viajes',
	// 'title'		 => 'Editar Viaje',
	// 'plataformas' => $this->plataformasModel->findAll(),
	// 'datos'		 => $datos];

	// return view('viajes/edit', $data);	
	// }
	
	// public function remove()
	// {
	// 	$response = array();
		
	// 	$id = $this->request->getPost('id');
		
	
	// 		if ($this->viajesModel->where('id', $id)->delete()) {
								
	// 			$response['success'] = true;
								
	// 		} else {
				
	// 			$response['success'] = false;
								
	// 		}
			
	
    //     return $this->response->setJSON($response);		
	// }
	
// 	public function update()
// 	{


// 		$viaje = json_decode($_POST['array_viaje'], true);
		
//         $response = array();

// $fields['fecha'] = $viaje[0]['fecha'];
// $fields['kms_recogida'] = $viaje[0]['kms_recogida'];
// $fields['mins_recogida'] = $this->convertirMinutosATime($viaje[0]['mins_recogida']);
// $fields['kms_destino'] = $viaje[0]['kms_destino'];
// $fields['mins_destino'] = $this->convertirMinutosATime($viaje[0]['mins_destino']);
// $fields['efectivo'] = $viaje[0]['efectivo'];
// $fields['tarjeta'] = $viaje[0]['tarjeta'];
// $fields['subtotal'] = $viaje[0]['efectivo'] +  $viaje[0]['tarjeta'] ;
// $fields['propina'] = $viaje[0]['propina'];
// $fields['total'] = $fields['subtotal'] + $viaje[0]['propina'];
// $fields['plataforma_id'] = $viaje[0]['id_plataforma'];
// $fields['dia_id'] = $viaje[0]['dia_id'];
// $fields['id'] = $viaje[0]['id'];


// if ($this->viajesModel->update($fields['id'], $fields)) {
												
//                 $response['success'] = true;
              				
//             } else {
				
//                 $response['success'] = false;
//                 $response['messages'] = lang("App.insert-error") ;
				
//             }
       
		
//         return $this->response->setJSON($response);
// 	}

	public function horaAMinutos($hora) {
		list($h, $m) = explode(':', $hora);
		return ($h * 60) + $m; 
	}

// 	// Convertir el resultado a horas y minutos
// 	public function minutosAHora($minutos) {
//     $h = floor($minutos / 60);
//     $m = $minutos % 60;
//     return sprintf('%02d:%02d', $h, $m);
// }


	public function detail($id)
	{

		$viaje = $this->viajesgastosModel->select('viajes_gastos.*, plataformas.descripcion as plataforma, 
		categorias.subcategoria, categorias.categoria')
		->join('plataformas', 'viajes_gastos.plataforma_id = plataformas.id', 'left')
		->join('categorias', 'viajes_gastos.categoria_id = categorias.id', 'left')
		->where('viajes_gastos.id', $id)->first();

		$response_viaje = (object) array();
		$response_gasto = (object) array();
		
		
		if ($viaje->tipo_transaccion == 1) {

			$response_viaje->total_kms = $viaje->kms_recogida + $viaje->kms_destino;
			$response_viaje->total_mins =  date('H:i',strtotime($viaje->mins_recogida) + strtotime($viaje->mins_destino));	
			$response_viaje->valor_km = $viaje->total / $response_viaje->total_kms;		
			$response_viaje->valor_hr = $viaje->total / ($this->horaAMinutos($response_viaje->total_mins) / 60);		
			$response_viaje->valor_min = $viaje->total / $this->horaAMinutos($response_viaje->total_mins);	

			$data = [
                'controller'    	=> 'viajesgastos',
                'title'     		=> 'Detalles Del Viaje',
				'datos'				=> $response_viaje,
				'viaje'				=> $viaje				
			];
		
		return view('viajes_gastos/detail_viaje', $data);		
		
		} else {

		
			// $response_gasto->total_kms = $viaje->kms_recogida + $viaje->kms_destino;
			// $response_gasto->total_mins =  date('H:i',strtotime($viaje->mins_recogida) + strtotime($viaje->mins_destino));	
			// $response_gasto->valor_km = $viaje->total / $response_gasto->total_kms;		
			// $response_gasto->valor_hr = $viaje->total / ($this->horaAMinutos($response_gasto->total_mins) / 60);		
			// $response_gasto->valor_min = $viaje->total / $this->horaAMinutos($response_gasto->total_mins);	
			
			$data = [
                'controller'    	=> 'viajesgastos',
                'title'     		=> 'Detalles Del Gasto',
			//	'datos'				=> $response_gasto,
				'viaje'				=> $viaje				
			];
		
		return view('viajes_gastos/detail_gasto', $data);		

		}
	
	}

	// public function simular()
	// {

	//     $data = [
    //             'controller'    	=> 'viajes',
    //             'title'     		=> 'Simular Viaje',
	// 			'plataformas'		=> $this->plataformasModel->findAll()	
	// 		];
		
	// 	return view('viajes/simular', $data);
			
	// }


		
}	
