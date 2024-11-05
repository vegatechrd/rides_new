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
		
		// Calcular el total de kilòmetros del día

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


	public function add()
	{


		$viaje = json_decode($_POST['array_dia'], true);
		
        $response = array();

$fields['fecha'] = $viaje[0]['fecha'];
$fields['descripcion'] = $viaje[0]['descripcion'];
$fields['meta'] = $viaje[0]['meta'];


            if ($this->diasModel->insert($fields)) {
												
                $response['success'] = true;
              				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error") ;
				
            }
       
		
        return $this->response->setJSON($response);
	}

	public function list($id)
	{

		$lista_transacciones = $this->viajesgastosModel->select('viajes_gastos.*, plataformas.descripcion as plataforma')
		->join('plataformas', 'viajes_gastos.plataforma_id = plataformas.id', 'left')
		->where('viajes_gastos.dia_id', $id)->findAll();
			
		$conteo_viajes = 1;
		
		foreach ($lista_transacciones as $key => $value) {
	
			$lista_transacciones[$key]->total_mins = date('H:i',strtotime($value->mins_recogida) + strtotime($value->mins_destino));
			$lista_transacciones[$key]->total_kms =  $value->kms_recogida + $value->kms_destino;
			$valor_x_km = $value->total / $lista_transacciones[$key]->total_kms;	
						
			if (floatval($valor_x_km) > 25.0) {
			
			$tipo_viaje =  'text-success';	

			}
			elseif (floatval($valor_x_km) > 20.0 AND floatval($lista_transacciones[$key]->total_kms) < 25.0) {
			
				$tipo_viaje = 'text-warning';		

			}
			else {
			
				$tipo_viaje =  'text-danger';	

			}
			$lista_transacciones[$key]->tipo_viaje = $tipo_viaje;
			$lista_transacciones[$key]->conteo_viajes = $conteo_viajes++;
			
		}
		
		$dia = $this->diasModel->where('id', $id)->first();
		$total_recaudado = $this->viajesgastosModel->select('SUM(total) as total')->where('dia_id', $id)->first();
		$total_gastos = $this->viajesgastosModel->select('SUM(total) as total')->where('dia_id', $id)->first();
		$dia->balance = $total_recaudado->total - $total_gastos->total;
		$dia->pendiente = intval($dia->meta) - intval($total_recaudado->total);
		$total_propinas = $this->viajesgastosModel->select('SUM(propina) as total')->where('dia_id', $id)->first();
		$dia->total_propinas = $total_propinas->total;
		$dia->recaudado = $total_recaudado->total;
	 	$cant_viajes = $this->viajesgastosModel->select('COUNT(id) as cantidad')->where('dia_id', $id)->first();
		$dia->cantidad_viajes = $cant_viajes->cantidad;
		$total_tarjeta = $this->viajesgastosModel->select('SUM(tarjeta) as total')->where('dia_id', $id)->first();
		$total_efectivo = $this->viajesgastosModel->select('SUM(efectivo) as total')->where('dia_id', $id)->first();
		$dia->total_tarjeta = $total_tarjeta->total;
		$dia->total_efectivo = $total_efectivo->total;
		$total_kms = $this->viajesgastosModel->select('SUM(kms_recogida) + SUM(kms_destino) as total')->where('dia_id', $id)->first();
		$dia->total_kms_dia = $total_kms->total > 0 ? $total_kms->total : 0;
		$dia->precio_km_viaje = $total_kms->total > 0 ? $total_recaudado->total / $total_kms->total : 0;


		setlocale(LC_TIME, 'es_ES.utf8', 'es_ES', 'esp');
		$fecha = strftime('%A %d %B', strtotime($dia->fecha));
		
			    $data = [
                'controller'    	=> 'dias',
                'title'     		=> $fecha,
				'lista_transacciones'		=> $lista_transacciones,
				'dia'				=> $dia,
				'dia_id'			=> $id
			];
		
		return view('dias/list', $data);
			
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
