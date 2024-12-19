<?php

namespace App\Controllers;

use App\Models\CarouselModel;

class Home extends BaseController
{
    private $db;
    private $carouselModel;

    public function __construct() {
        helper(['url', 'form', 'session']);
        $this->db = \Config\Database::connect();
        $this->carouselModel = new CarouselModel();
        $this->session = \Config\Services::session();
    }



    public function index()
    {
        $model = new CarouselModel();
        $data['images'] = $model->where('estado', 'activo')->where('tipo', 'imagen')->findAll();
        $data['gestorbibliografico'] = $model->where('estado', 'activo')->where('tipo', 'gestorbibliografico')->findAll();
        $data['buscadoracademico'] = $model->where('estado', 'activo')->where('tipo', 'buscadoracademico')->findAll();
        $data['traductor'] = $model->where('estado', 'activo')->where('tipo', 'traductor')->findAll();
        $data['tppsicometricas'] = $model->where('estado', 'activo')->where('tipo', 'tppsicometricas')->findAll();
        $data['diccionario'] = $model->where('estado', 'activo')->where('tipo', 'diccionario')->findAll();
        $data['enciclopedia'] = $model->where('estado', 'activo')->where('tipo', 'enciclopedia')->findAll();
        $data['prelectronicos'] = $model->where('estado', 'activo')->where('tipo', 'prelectronicos')->findAll();
        // $data[] = $model->where('estado', 'activo')->where('tipo', 'gestorbibliografico')->findAll();




        return view('frontend/index', $data);
    }


    public function reglamento()
    {
        return view('frontend/reglamento');
    }

    public function servicios()
    {
        return view('frontend/servicios');
    }

    public function recursos()
    {
        return view('frontend/recinfo', $data);
    }

    public function equipo()
    {
        return view('frontend/equipo');
    }

    public function investigadores()
    {
        return view('frontend/investigadores');
    }

    public function acercade()
    {
        return view('frontend/acercade');
    }



    public function mostrarResultados()
    {
        $buscar = $this->request->getGet('buscar');

        $model = new RecursoBibliograficoModel();
        $resultados = $model->buscar($buscar);

        return view('resultados_busqueda', ['resultados' => $resultados]);
    }

}
