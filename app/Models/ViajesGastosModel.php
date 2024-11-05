<?php

namespace App\Models;
use CodeIgniter\Model;

class ViajesGastosModel extends Model {
    
	protected $table = 'viajes_gastos';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['tipo_transaccion','categoria_id','kms_recogida', 'mins_recogida', 'kms_destino', 'mins_destino', 'propina', 'total', 'plataforma_id', 
	'tarjeta', 'efectivo', 'dia_id', 'hora_creacion', 'kms_recorridos','precio_galon'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   
	
	public function ObtenerBalance() {

		 return $this->query("SELECT 
			(SUM(CASE WHEN tipo_transaccion = 1 THEN total ELSE 0 END) - 
			 SUM(CASE WHEN tipo_transaccion = 2 THEN total ELSE 0 END)) AS balance FROM viajes_gastos")->getRow()->balance;

	}

	public function ObtenerBalancebyDate($fecha, $anio) {

		return $this->query("SELECT 
    (SUM(CASE WHEN tipo_transaccion = 1 THEN total ELSE 0 END) - 
     SUM(CASE WHEN tipo_transaccion = 2 THEN total ELSE 0 END)) AS balance
FROM viajes_gastos
LEFT JOIN dias ON viajes_gastos.dia_id = dias.id
WHERE $fecha(dias.fecha) = $fecha(CURRENT_DATE) 
AND YEAR(dias.fecha) = $anio")->getRow()->balance;

   }

 public function ObtenerBalancebyDay($day) {

return $this->query("SELECT 
(SUM(CASE WHEN tipo_transaccion = 1 THEN total ELSE 0 END) - 
 SUM(CASE WHEN tipo_transaccion = 2 THEN total ELSE 0 END)) AS balance
FROM viajes_gastos
LEFT JOIN dias ON viajes_gastos.dia_id = dias.id
WHERE DATE(dias.fecha) = $day")->getRow()->balance;

}

public function ObtenerBalancebyTipoPago($tipo_pago) {

	return $this->query("SELECT SUM($tipo_pago) as balance from viajes_gastos 
	LEFT JOIN dias ON viajes_gastos.dia_id = dias.id
	WHERE WEEK(dias.fecha) = WEEK(CURRENT_DATE)")->getRow()->balance;
}

public function ObtenerBalancebyTipoTransaccion($tipo_transaccion, $fecha) {

	return $this->query("SELECT SUM(total) as balance from viajes_gastos 
	LEFT JOIN dias ON viajes_gastos.dia_id = dias.id
	WHERE viajes_gastos.tipo_transaccion = $tipo_transaccion AND $fecha(dias.fecha) = $fecha(CURRENT_DATE)")->getRow()->balance;
}

public function ObtenerBalancesGlobalesbyTipoTransaccion($tipo_transaccion) {

	return $this->query("SELECT SUM(total) as balance from viajes_gastos 
	LEFT JOIN dias ON viajes_gastos.dia_id = dias.id
	WHERE viajes_gastos.tipo_transaccion = $tipo_transaccion")->getRow()->balance;
}

}