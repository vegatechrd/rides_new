<?php

namespace App\Controllers;
use App\Models\DiasModel;
use App\Models\ViajesGastosModel;

class Home extends BaseController
{
    protected $diasModel, $viajesgastosModel;
    
    public function __construct()
	{
        $this->diasModel = new DiasModel();
        $this->viajesgastosModel = new ViajesGastosModel();
	
	}

    public function index()
    {

    $hoy = new \DateTime();

    // identificar primer dia de la semana y ultimo dia de la semana

    $primer_dia_semana = $hoy->modify('Monday this Week')->format('Y-m-d');
    $ultimo_dia_semana = $hoy->modify('Sunday this Week')->format('Y-m-d');
    $primer_dia_mes = $hoy->modify('first day of this month')->format('Y-m-d');
    $ultimo_dia_mes = $hoy->modify('last day of this month')->format('Y-m-d');
     
     $data = [ 'ganancias_semana'  => $this->viajesgastosModel->GetGananciasAll($primer_dia_semana, $ultimo_dia_semana),
               'efectivo_semana'   => $this->viajesgastosModel->getTotalesAll('efectivo', $primer_dia_semana, $ultimo_dia_semana, null, null),
               'tarjeta_semana'    => $this->viajesgastosModel->getTotalesAll('tarjeta', $primer_dia_semana, $ultimo_dia_semana, null, null),
               'recaudado_mes'     => $this->viajesgastosModel->getTotalesAll('total', $primer_dia_mes, $ultimo_dia_mes, 1, null),
               'gastos_mes'        => $this->viajesgastosModel->getTotalesAll('total', $primer_dia_mes, $ultimo_dia_mes, 2, null),
               'ganancias_mes'     => $this->viajesgastosModel->GetGananciasAll($primer_dia_mes, $ultimo_dia_mes), 
               'ingresos_globales' => $this->viajesgastosModel->getTotalesAll('total', null, null, 1, null),
               'gastos_globales'   => $this->viajesgastosModel->getTotalesAll('total', null, null, 2, null),
               'ganancias_globales'  => $this->viajesgastosModel->GetGananciasAll()];

         return view('theme/dashboard', $data);
     }
}
