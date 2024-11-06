<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiasModel;
use App\Models\ViajesGastosModel;

class Dias extends BaseController
{
	
    protected $diasModel, $viajesgastosModel;
	
	public function __construct()
	{
	    $this->diasModel = new DiasModel();
        $this->viajesgastosModel = new ViajesGastosModel();
		
	}
		
	public function index()
	{

		setlocale(LC_TIME, 'es_ES.utf8', 'es_ES', 'esp');

		$datos = $this->diasModel->orderBy('fecha', 'DESC')->findAll(5);

		foreach ($datos as $key => $value) {

		$datos[$key]->total_recaudado_dia = number_format($this->viajesgastosModel->getTotalesAll('total', null, null, 1, $value->id),2);
		$datos[$key]->total_gastos = number_format($this->viajesgastosModel->getTotalesAll('total', null, null, 2,  $value->id),2);
		$datos[$key]->ganancias = number_format($this->viajesgastosModel->GetGananciasAll($value->fecha, $value->fecha),2);
		$datos[$key]->fecha_formateada = strftime('%a, %d %B %g', strtotime($value->fecha));
		$datos[$key]->total_kms_dia = $this->viajesgastosModel->getTotalKms(null, null, $value->id);
			
	 }

	    $data = [
                'controller'    	=> 'dias',
                'title'     		=> 'Días Trabajados',
				'datos'  			=> $datos
			];

			
		
	return view('dias/index', $data);
	

	
	}

	public function new()
	{

	    $data = [
                'controller'    	=> 'dias',
                'title'     		=> 'Registrar Nuevo Día'				
			];
		
		return view('dias/new', $data);
			
	}


	public function store()
	{


$viaje = json_decode($_POST['array_dia'], true);
		
$response = array();

$fields['fecha'] = $viaje[0]['fecha'];
$fields['descripcion'] = $viaje[0]['descripcion'];
$fields['meta'] = $viaje[0]['meta'];


 // Verificar si ya existe un registro con la misma fecha
 $existingRecord = $this->diasModel->where('fecha', $fields['fecha'])->first();

  // Formatear la fecha en formato d-m-Y
  $fecha_formateada = date('d-m-Y', strtotime($fields['fecha']));

 if ($existingRecord) {
	 return $this->response->setJSON([
		 'success' => false,
		 'messages' => 'Ya existe un registro con la fecha ' . $fecha_formateada . '.'
	 ]);
 }


            if ($this->diasModel->insert($fields)) {
												
                $response['success'] = true;
              				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error") ;
				
            }
       
		
        return $this->response->setJSON($response);
	}

	public function view($id)
	{

		$datos_dia = $this->diasModel->where('id', $id)->first();
		$lista_transacciones_dia = $this->viajesgastosModel->select('viajes_gastos.*, plataformas.descripcion as plataforma')
		->join('plataformas', 'viajes_gastos.plataforma_id = plataformas.id', 'left')
		->where('viajes_gastos.dia_id', $id)->findAll();
			
		$conteo_viajes = 1;
		
		foreach ($lista_transacciones_dia as $key => $value) {
	
			$lista_transacciones_dia[$key]->total_mins = date('H:i',strtotime($value->mins_recogida) + strtotime($value->mins_destino));
			$lista_transacciones_dia[$key]->total_kms =  $value->kms_recogida + $value->kms_destino;
			$valor_x_km = $value->total / $lista_transacciones_dia[$key]->total_kms;	
			
			
			
			if (floatval($valor_x_km) > 25.0) { $tipo_viaje =  'text-success'; }
			elseif (floatval($valor_x_km) > 20.0 AND floatval($lista_transacciones_dia[$key]->total_kms) < 25.0) {
			$tipo_viaje = 'text-warning';} else { $tipo_viaje =  'text-danger'; }

			if ($value->tipo_transaccion == 1) { $tipo_transaccion = '<span class="badge badge-success">VIAJE</span>'; } 
			else { $tipo_transaccion = '<span class="badge badge-danger">GASTO</span>';}
			

			$lista_transacciones_dia[$key]->tipo_viaje = $tipo_viaje;
			$lista_transacciones_dia[$key]->conteo_viajes = $conteo_viajes++;
			$lista_transacciones_dia[$key]->tipo_transaccion_badge = $tipo_transaccion;
			
		}
		
		
		$datos_dia->total_recaudado = $this->viajesgastosModel->getTotalesAll('total', null, null, 1, $id);
		$datos_dia->total_gastos = $this->viajesgastosModel->getTotalesAll('total', null, null, 2,  $id);
		$datos_dia->ganancias = $datos_dia->total_recaudado - $datos_dia->total_gastos;
		$datos_dia->pendiente_meta = intval($datos_dia->meta) - intval($datos_dia->total_recaudado);

		$datos_dia->total_propinas = $this->viajesgastosModel->getTotalesAll('propina', null, null, 1, $id);
		$cantidad = $this->viajesgastosModel->select('COUNT(id) as cantidad')->where('dia_id', $id)->first();
		$datos_dia->cantidad_viajes = $cantidad->cantidad;
		$datos_dia->total_kms_dia =  $this->viajesgastosModel->getTotalKms(null, null, $id); 
		$datos_dia->total_tarjeta = $this->viajesgastosModel->getTotalesAll('tarjeta', null, null, 1, $id);
		$datos_dia->total_efectivo = $this->viajesgastosModel->getTotalesAll('efectivo', null, null, 1, $id);
		$datos_dia->precio_km_viaje = $datos_dia->total_kms_dia > 0 ? $datos_dia->total_recaudado / $datos_dia->total_kms_dia : 0;
		
		setlocale(LC_TIME, 'es_ES.utf8', 'es_ES', 'esp');
		$fecha = strftime('%A %d %B', strtotime($datos_dia->fecha));
		
			    $data = [
                'controller'    	=> 'dias',
                'title'     		=> $fecha,
				'lista_transacciones_dia' => $lista_transacciones_dia,
				'datos_dia'				=> $datos_dia,
				'dia_id'			=> $id
			];
		
		return view('dias/view', $data);
			
	}

	

public function edit($id)
	{

$datos = $this->diasModel->where('id', $id)->first();


	    $data = [
                'controller'    	=> 'dias',
                'title'     		=> 'Editar Día',
				'datos'				=> $datos					
			];
		
		return view('dias/edit', $data);
			
	}

	
	public function update()
	{


		$viaje = json_decode($_POST['array_dia'], true);
		
        $response = array();

$fields['fecha'] = $viaje[0]['fecha'];
$fields['descripcion'] = $viaje[0]['descripcion'];
$fields['meta'] = $viaje[0]['meta'];
$fields['id'] = $viaje[0]['dia_id'];


// Verificar si ya existe un registro con la misma fecha, pero asegurarnos que no es el propio registro
$existingRecord = $this->diasModel->where('fecha', $fields['fecha'])->where('id !=', $fields['id'])->first();


if ($existingRecord) {

	 // Formatear la fecha en formato d-m-Y
	 $fecha_formateada = date('d-m-Y', strtotime($fields['fecha']));

	return $this->response->setJSON([
		'success' => false,
		'messages' => 'Ya existe un registro con la fecha ' . $fecha_formateada . ' que no es el actual.'
	]);
}

if ($this->diasModel->update($fields['id'], $fields)) {
												
                $response['success'] = true;
              				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error") ;
				
            }
       
		
        return $this->response->setJSON($response);
	}


	public function cerrar()
	{


		$id = json_decode($_POST['id'], true);
		
        $response = array();

$fields['cerrado'] = 1;
$fields['id'] = $id;


if ($this->diasModel->update($fields['id'], $fields)) {
												
                $response['success'] = true;
              				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error") ;
				
            }
       
		
        return $this->response->setJSON($response);
	}
	

	public function tabla_precios()
	{

	    $data = [
                'controller'    	=> 'dias',
                'title'     		=> 'Tabla Precios Servicios'				
			];
		
		return view('dias/tabla_precios', $data);
			
	}

		
}	
