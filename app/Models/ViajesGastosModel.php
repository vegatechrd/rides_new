<?php

namespace App\Models;
use CodeIgniter\Model;

class ViajesGastosModel extends Model {
    
	protected $table = 'viajes_gastos';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['tipo_transaccion','categoria_id','kms_recogida', 'mins_recogida', 'kms_destino', 'mins_destino', 'propina', 'total', 'plataforma_id', 
	'tarjeta', 'efectivo', 'dia_id', 'hora_creacion', 'kms_recorridos','precio_galon', 'comentario'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;   

	
	public function GetGananciasAll($fecha_inicio = null, $fecha_fin = null) {
	
		// Comenzamos con la consulta básica
		$sql = "SELECT 
					(SUM(CASE WHEN tipo_transaccion = 1 THEN total ELSE 0 END) - 
					 SUM(CASE WHEN tipo_transaccion = 2 THEN total ELSE 0 END)) AS balance
				FROM viajes_gastos
				LEFT JOIN dias ON viajes_gastos.dia_id = dias.id
				WHERE 1=1";  // Esto asegura que no se rompa la lógica de concatenación
	
		// Parámetros que vamos a pasar a la consulta
		$params = [];
	
		// Agregar condición para fecha_inicio si no es null
		if ($fecha_inicio !== null) {
			$sql .= " AND dias.fecha >= ?";
			$params[] = $fecha_inicio;  // Agregar parámetro
		}
	
		// Agregar condición para fecha_fin si no es null
		if ($fecha_fin !== null) {
			$sql .= " AND dias.fecha <= ?";
			$params[] = $fecha_fin;  // Agregar parámetro
		}
	
	
		// Ejecutar la consulta con los parámetros dinámicos
		return $this->query($sql, $params)->getRow()->balance ?? 0;
	}

	public function getTotalesAll($tipo_pago, $fecha_inicio=null, $fecha_fin=null, $tipo_transaccion=null, $dia_id=null) {

		$sql = "SELECT SUM($tipo_pago) as balance FROM viajes_gastos 
		LEFT JOIN dias ON viajes_gastos.dia_id = dias.id
		WHERE 1=1";

	// Parámetros que vamos a pasar a la consulta
	$params = [];

	// Agregar condición para tipo_transaccion si no es null
    if ($tipo_transaccion !== null) {
        $sql .= " AND viajes_gastos.tipo_transaccion = ?";
        $params[] = $tipo_transaccion;  // Agregar parámetro
    }

	
	// Agregar condición para fecha_inicio si no es null
	if ($fecha_inicio !== null) {
		$sql .= " AND dias.fecha >= ?";
		$params[] = $fecha_inicio;  // Agregar parámetro
	}

	// Agregar condición para fecha_fin si no es null
	if ($fecha_fin !== null) {
		$sql .= " AND dias.fecha <= ?";
		$params[] = $fecha_fin;  // Agregar parámetro
	}

	// Agregar condición para tipo_transaccion si no es null
    if ($dia_id !== null) {
        $sql .= " AND viajes_gastos.dia_id = ?";
        $params[] = $dia_id;  // Agregar parámetro
    }


	// Ejecutar la consulta con los parámetros dinámicos
	return $this->query($sql, $params)->getRow()->balance ?? 0;
	
}	

public function getTotalKms($fecha_inicio = null, $fecha_fin = null, $dia_id = null) {
    // Construir la consulta básica
    $sql = "SELECT SUM(kms_recogida + kms_destino) as balance 
            FROM viajes_gastos 
            LEFT JOIN dias ON viajes_gastos.dia_id = dias.id
            WHERE 1=1";  // Esto asegura que no se rompa la lógica al concatenar condiciones

    // Parámetros que vamos a pasar a la consulta
    $params = [];

    // Agregar condición para fecha_inicio si no es null
    if ($fecha_inicio !== null) {
        $sql .= " AND dias.fecha >= ?";
        $params[] = $fecha_inicio;  // Agregar parámetro
    }

    // Agregar condición para fecha_fin si no es null
    if ($fecha_fin !== null) {
        $sql .= " AND dias.fecha <= ?";
        $params[] = $fecha_fin;  // Agregar parámetro
    }

    // Agregar condición para dia_id si no es null
    if ($dia_id !== null) {
        $sql .= " AND viajes_gastos.dia_id = ?";
        $params[] = $dia_id;  // Agregar parámetro
    }

    // Ejecutar la consulta con los parámetros dinámicos y devolver el resultado
    $result = $this->query($sql, $params)->getRow();
    return $result->balance ?? 0;  // Si no hay resultados, devolver 0
}


}