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

    $balance = $this->viajesgastosModel->ObtenerBalance();   
    $balance_mes = $this->viajesgastosModel->ObtenerBalancebyDate('MONTH', '2024');
    $balance_semana = $this->viajesgastosModel->ObtenerBalancebyDate('WEEK', '2024');
    $balance_dia = $this->viajesgastosModel->ObtenerBalancebyDay('CURDATE()');
    $tarjeta_semana = $this->viajesgastosModel->ObtenerBalancebyTipoPago('tarjeta');
    $efectivo_semana = $this->viajesgastosModel->ObtenerBalancebyTipoPago('efectivo');
    $recaudado_mes = $this->viajesgastosModel->ObtenerBalancebyTipoTransaccion(1, 'MONTH');
    $gastos_mes = $this->viajesgastosModel->ObtenerBalancebyTipoTransaccion(2, 'MONTH');
    $ingresos_globales = $this->viajesgastosModel->ObtenerBalancesGlobalesbyTipoTransaccion(1);
    $gastos_globales = $this->viajesgastosModel->ObtenerBalancesGlobalesbyTipoTransaccion(2);

    $data = ['balance'      => $balance,
                 'balance_mes'  => $balance_mes,
                 'balance_semana'  => $balance_semana,
                'balance_dia'  => $balance_dia,
                'efectivo_semana' => $efectivo_semana,
                'tarjeta_semana' => $tarjeta_semana,
                'recaudado_mes' => $recaudado_mes,
                'gastos_mes' => $gastos_mes,
                'ingresos_globales' => $ingresos_globales,
                'gastos_globales' => $gastos_globales];

        return view('theme/dashboard', $data);
    }
}
