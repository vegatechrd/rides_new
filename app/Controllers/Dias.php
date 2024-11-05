<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiasModel;
use App\Models\ViajesGastosModel;
use CodeIgniter\I18n\Time;

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
	
     	$total_dia = $this->viajesgastosModel->ObtenerBalancebyDay(date('Y-m-d', strtotime($value->fecha)));
		$datos[$key]->total_dia = number_format($total_dia,2);
		$total_gastos = $this->viajesgastosModel->ObtenerBalancebyTipoTransaccion(2, $value->fecha);	
		$datos[$key]->total_gastos = number_format($total_gastos,2);
		$datos[$key]->pendiente = number_format(intval($value->meta) - intval($total_dia),2);
		$datos[$key]->fecha_formateada = strftime('%a, %d %B %g', strtotime($value->fecha));
		
		// Calcular el total de kilòmetros del día

//		$total_kms = $this->viajesModel->select('SUM(kms_recogida) + sum(kms_destino) as total')->where('dia_id', $value->id)->first();
//		$total_kms_dia = $total_kms->total;
//		$datos[$key]->total_kms_dia = $total_kms_dia;
		
		
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

		$lista_viajes = $this->viajesModel->select('viajes.*, plataformas.descripcion as plataforma')
		->join('plataformas', 'viajes.plataforma_id = plataformas.id', 'left')
		->where('viajes.dia_id', $id)->findAll();

		$lista_gastos = $this->gastosModel->select('gastos.*, gastos_categorias.descripcion as categoria')
		->join('gastos_categorias', 'gastos.id_categoria_gasto = gastos_categorias.id', 'left')
		->where('gastos.dia_id', $id)->findAll();
		
		$conteo_viajes = 1;
		$conteo_gastos = 1;

		foreach ($lista_viajes as $key => $value) {
	
			$total_mins =  date('H:i',strtotime($value->mins_recogida) + strtotime($value->mins_destino));	
			$lista_viajes[$key]->total_mins = $total_mins;

			$total_kms = $value->kms_recogida + $value->kms_destino;
			$lista_viajes[$key]->total_kms = $total_kms;
			$valor_x_km = $value->total / $total_kms;	
						
			if (floatval($valor_x_km) > 25.0) {
			
			$tipo_viaje =  'text-success';	

			}
			elseif (floatval($valor_x_km) > 20.0 AND floatval($total_kms) < 25.0) {
			
				$tipo_viaje = 'text-warning';		

			}
			else {
			
				$tipo_viaje =  'text-danger';	

			}
			$lista_viajes[$key]->tipo_viaje = $tipo_viaje;
			$lista_viajes[$key]->conteo_viajes = $conteo_viajes++;
			
		}

		foreach ($lista_gastos as $key => $value) {

			$lista_gastos[$key]->conteo_gastos = $conteo_gastos++;


		}
		
		$dia = $this->diasModel->where('id', $id)->first();
		$total_recaudado = $this->viajesModel->select('SUM(total) as total')->where('dia_id', $id)->first();
		$total_gastos = $this->gastosModel->select('SUM(total) as total')->where('dia_id', $id)->first();
		$dia->balance = $total_recaudado->total - $total_gastos->total;
		$dia->pendiente = intval($dia->meta) - intval($total_recaudado->total);
		$total_propinas = $this->viajesModel->select('SUM(propina) as total')->where('dia_id', $id)->first();
		$dia->total_propinas = $total_propinas->total;
		$dia->recaudado = $total_recaudado->total;
	 	$cant_viajes = $this->viajesModel->select('COUNT(id) as cantidad')->where('dia_id', $id)->first();
		$dia->cantidad_viajes = $cant_viajes->cantidad;
		$total_tarjeta = $this->viajesModel->select('SUM(tarjeta) as total')->where('dia_id', $id)->first();
		$total_efectivo = $this->viajesModel->select('SUM(efectivo) as total')->where('dia_id', $id)->first();
		$dia->total_tarjeta = $total_tarjeta->total;
		$dia->total_efectivo = $total_efectivo->total;
		$total_kms = $this->viajesModel->select('SUM(kms_recogida) + SUM(kms_destino) as total')->where('dia_id', $id)->first();
		$dia->total_kms_dia = $total_kms->total > 0 ? $total_kms->total : 0;
		$dia->precio_km_viaje = $total_kms->total > 0 ? $total_recaudado->total / $total_kms->total : 0;


		setlocale(LC_TIME, 'es_ES.utf8', 'es_ES', 'esp');
		$fecha = strftime('%A %d %B', strtotime($dia->fecha));
		
			    $data = [
                'controller'    	=> 'dias',
                'title'     		=> $fecha,
				'lista_viajes'		=> $lista_viajes,
				'lista_gastos'		=> $lista_gastos,
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
