<?php

namespace App\Controllers;

use App\Models\PrestamoModel;
use CodeIgniter\Controller;

class Prestamos extends Controller
{
    protected $prestamoModel;

    public function __construct()
    {
        $this->prestamoModel = new PrestamoModel();
    }

    public function index()
    {
        $data['prestamos'] = $this->prestamoModel->obtenerPrestamos();
        return view('prestamos/index', $data);
    }

    public function crear()
    {
        $recursoModel = new \App\Models\RecursoModel();
        $usuarioModel = new \App\Models\UsuarioModel();

        $data['recursos'] = $recursoModel->findAll();
        $data['usuarios'] = $usuarioModel->findAll();

        return view('prestamos/crear', $data);
    }

    public function guardar()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_usuario' => 'required',
            'fecha_prestamo' => 'required|valid_date',
            'fecha_devolucion' => 'required|valid_date|after_or_equal[fecha_prestamo]',
            'recursos' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $dataPrestamo = [
            'id_usuario' => $this->request->getPost('id_usuario'),
            'fecha_prestamo' => $this->request->getPost('fecha_prestamo'),
            'fecha_devolucion' => $this->request->getPost('fecha_devolucion'),
            'estado' => 'en curso',
            'observaciones' => $this->request->getPost('observaciones'),
        ];

        $this->prestamoModel->save($dataPrestamo);
        $idPrestamo = $this->prestamoModel->insertID();

        $recursos = explode(',', $this->request->getPost('recursos'));
        $recursoModel = new \App\Models\RecursoModel();

        foreach ($recursos as $idRecurso) {
            $dataDetalle = [
                'id_prestamo' => $idPrestamo,
                'id_recurso' => $idRecurso,
            ];
            $this->prestamoModel->db->table('prestamos_detalle')->insert($dataDetalle);

            $recurso = $recursoModel->find($idRecurso);

            if ($recurso && $recurso['numero_ejemplares'] > 0) {
                $nuevaCantidad = $recurso['numero_ejemplares'] - 1;
                if ($nuevaCantidad != $recurso['numero_ejemplares']) {
                    $recursoModel->update($idRecurso, ['numero_ejemplares' => $nuevaCantidad]);
                }
            } else {
                // Manejar el error de forma más robusta, por ejemplo, eliminando el préstamo creado
                $this->prestamoModel->delete($idPrestamo);
                return redirect()->back()->withInput()->with('error', 'El recurso no existe o no tiene ejemplares disponibles. Favor de esperar.');
            }
        }

        return redirect()->to('/admin/prestamos')->with('success', 'Préstamo creado con éxito');
    }

    public function editar($id)
    {
        $prestamo = $this->prestamoModel->find($id);

        if (!$prestamo) {
            return redirect()->to('/admin/prestamos')->with('error', 'Préstamo no encontrado');
        }

        $recursoModel = new \App\Models\RecursoModel();
        $usuarioModel = new \App\Models\UsuarioModel();

        $data['recursos'] = $recursoModel->findAll();
        $data['usuarios'] = $usuarioModel->findAll();
        $data['prestamo'] = $prestamo;
        $data['detalles'] = $this->prestamoModel->obtenerDetallesPrestamo($id);

        return view('prestamos/editar', $data);
    }

    public function actualizar($id)
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_usuario' => 'required',
            'fecha_prestamo' => 'required|valid_date',
            'fecha_devolucion' => 'required|valid_date|after_or_equal[fecha_prestamo]',
            'recursos' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $dataPrestamo = [
            'id_usuario' => $this->request->getPost('id_usuario'),
            'fecha_prestamo' => $this->request->getPost('fecha_prestamo'),
            'fecha_devolucion' => $this->request->getPost('fecha_devolucion'),
            'estado' => $this->request->getPost('estado'),
            'observaciones' => $this->request->getPost('observaciones'),
        ];

        $this->prestamoModel->update($id, $dataPrestamo);

        // Obtener los detalles del préstamo antes de actualizar
        $detallesAnteriores = $this->prestamoModel->obtenerDetallesPrestamo($id);

        // Eliminar los detalles anteriores
        $this->prestamoModel->db->table('prestamos_detalle')->where('id_prestamo', $id)->delete();

        // Guardar los nuevos detalles
        $recursos = explode(',', $this->request->getPost('recursos'));
        $recursoModel = new \App\Models\RecursoModel();

        foreach ($recursos as $idRecurso) {
            $dataDetalle = [
                'id_prestamo' => $id,
                'id_recurso' => $idRecurso,
            ];
            $this->prestamoModel->db->table('prestamos_detalle')->insert($dataDetalle);

            // Restar la cantidad de ejemplares si es un nuevo recurso en el préstamo
            $recursoAnterior = array_search($idRecurso, array_column($detallesAnteriores, 'id_recurso'));
            if ($recursoAnterior === false) {
                $recurso = $recursoModel->find($idRecurso);

                if ($recurso && $recurso['numero_ejemplares'] > 0) {
                    $nuevaCantidad = $recurso['numero_ejemplares'] - 1;
                    if ($nuevaCantidad != $recurso['numero_ejemplares']) {
                        $recursoModel->update($idRecurso, ['numero_ejemplares' => $nuevaCantidad]);
                    }
                } else {
                    // Manejar el error de forma más robusta, por ejemplo, revirtiendo los cambios
                    $this->prestamoModel->db->transRollback();
                    return redirect()->back()->withInput()->with('error', 'El recurso no existe o no tiene ejemplares disponibles.');
                }
            }
        }

        // Sumar la cantidad de ejemplares de los recursos que ya no están en el préstamo
        foreach ($detallesAnteriores as $detalleAnterior) {
            if (!in_array($detalleAnterior['id_recurso'], $recursos)) {
                $recurso = $recursoModel->find($detalleAnterior['id_recurso']);
                $nuevaCantidad = $recurso['numero_ejemplares'] + 1;
                $recursoModel->update($detalleAnterior['id_recurso'], ['numero_ejemplares' => $nuevaCantidad]);
            }
        }

        return redirect()->to('/admin/prestamos')->with('success', 'Préstamo actualizado con éxito');
    }

    public function eliminar($id)
    {
        $detalles = $this->prestamoModel->obtenerDetallesPrestamo($id);
        $recursoModel = new \App\Models\RecursoModel();

        $this->prestamoModel->db->table('prestamos_detalle')->where('id_prestamo', $id)->delete();

        foreach ($detalles as $detalle) {
            $recurso = $recursoModel->find($detalle['id_recurso']);
            $nuevaCantidad = $recurso['numero_ejemplares'] + 1;
            $recursoModel->update($detalle['id_recurso'], ['numero_ejemplares' => $nuevaCantidad]);
        }

        $this->prestamoModel->delete($id);
        return redirect()->to('/admin/prestamos')->with('success', 'Préstamo eliminado con éxito');
    }

    public function ver($id)
    {
        $prestamo = $this->prestamoModel->find($id);

        if (!$prestamo) {
            return redirect()->to('/admin/prestamos')->with('error', 'Préstamo no encontrado');
        }

        $data['prestamo'] = $prestamo;
        $data['detalles'] = $this->prestamoModel->obtenerDetallesPrestamo($id);

        return view('prestamos/ver', $data);
    }
}