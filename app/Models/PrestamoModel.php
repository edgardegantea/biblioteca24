<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestamoModel extends Model
{
    protected $table            = 'prestamos';
    protected $primaryKey       = 'id_prestamo';
    protected $allowedFields    = [
        'id_usuario',
        'fecha_prestamo',
        'fecha_devolucion',
        'fecha_devolucion_real',
        'estado',
        'observaciones'
    ];

    // Obtener todos los préstamos con detalles de usuario y recursos
    public function obtenerPrestamos()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('prestamos');
        $builder->select('prestamos.*, users.nombre as nombre_usuario');
        $builder->join('users', 'users.id = prestamos.id_usuario');
        $prestamos = $builder->get()->getResultArray();

        foreach ($prestamos as &$prestamo) {
            $prestamo['detalles'] = $this->obtenerDetallesPrestamo($prestamo['id_prestamo']);
        }

        return $prestamos;
    }

    // Obtener un préstamo por su ID
    public function obtenerPrestamoPorId($id)
    {
        return $this->find($id);
    }

    // Obtener los detalles de un préstamo (recursos asociados)
    public function obtenerDetallesPrestamo($idPrestamo)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('prestamos_detalle');
        $builder->select('prestamos_detalle.*, recursos.titulo as nombre_recurso');
        $builder->join('recursos', 'recursos.id = prestamos_detalle.id_recurso');
        $builder->where('prestamos_detalle.id_prestamo', $idPrestamo);
        return $builder->get()->getResultArray();
    }

    // ... otros métodos para la lógica de negocio ...
}