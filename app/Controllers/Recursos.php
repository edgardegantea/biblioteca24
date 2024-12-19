<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RecursoModel;
use App\Models\GeneroModel;
use App\Models\EditorialModel;
use App\Models\AutorModel;
use App\Models\TagModel;

class Recursos extends Controller
{
    protected $recursoModel;
    protected $generoModel;
    protected $editorialModel;
    protected $autorModel;
    protected $tagModel;
    protected $db;

    public function __construct()
    {
        $this->recursoModel = new RecursoModel();
        $this->generoModel = new GeneroModel();
        $this->editorialModel = new EditorialModel();
        $this->autorModel = new AutorModel();
        $this->tagModel = new TagModel();
        $this->db = \Config\Database::connect();
        helper('form');
    }

    public function index()
    {
        $data['recursos'] = $this->recursoModel
            ->select('recursos.*, generos.nombre as genero_nombre, editoriales.nombre as editorial_nombre')
            ->join('generos', 'generos.id = recursos.genero')
            ->join('editoriales', 'editoriales.id = recursos.editorial')
            ->orderBy('recursos.id', 'desc')
            ->findAll();

        foreach ($data['recursos'] as &$recurso) {
            $recurso['autores'] = $this->recursoModel->getAutoresByRecursoId($recurso['id']);
        }

        return view('admin/recursos/index', $data);
    }


    public function listarRecursos()
    {
        $model = new RecursoModel();
        $recursos = $model
            ->select('id, titulo')
            ->findAll();

        return $this->response->setJSON(['data' => $recursos]);
    }



    public function show($id = null)
    {
        if (!$id) {
            return redirect()->to('/admin/recursos')->with('error', 'ID de recurso no proporcionado');
        }

        $recurso = $this->recursoModel->getRecursoCompleto($id);

        if (!$recurso) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        return view('admin/recursos/show', ['recurso' => $recurso]);
    }



    public function edit($id = null)
    {
        $data['recurso'] = $this->recursoModel->find($id);

        if (!$data['recurso']) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        // Suponiendo que `getAutoresByRecursoId` devuelve un array de autores
        $data['recurso']['autores'] = $this->recursoModel->getAutoresByRecursoId($id);

        // Cargar listas para el formulario, estas también serán arrays
        $data['generos'] = $this->generoModel->findAll();
        $data['editoriales'] = $this->editorialModel->findAll();
        $data['autores'] = $this->autorModel->findAll();
        $data['tags'] = $this->tagModel->findAll();

        return view('admin/recursos/form', $data);
    }





    /*
    public function edit($id = null)
    {
        $data['recurso'] = $this->recursoModel->find($id);
        if (!$data['recurso']) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        // Obtener autores, género, editorial y tag relacionados
        $data['recurso']->autores = $this->recursoModel->find($id)->autores;
        $data['generos'] = $this->generoModel->findAll();
        $data['editoriales'] = $this->editorialModel->findAll();
        $data['autores'] = $this->autorModel->findAll();
        $data['tags'] = $this->tagModel->findAll();

        return view('admin/recursos/form', $data);
    }
    */


    public function update($id = null)
    {
        $data = $this->request->getPost();

        if (!$this->recursoModel->find($id)) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        $validationRules = $this->recursoModel->validationRules;
        $validationRules['isbn'] = "permit_empty|max_length[20]|is_unique[recursos.isbn,id,{$id}]";
        $validationRules['portada'] = 'permit_empty|max_size[portada,1024]|is_image[portada]';

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $portada = $this->request->getFile('portada');
        if ($portada && $portada->isValid() && !$portada->hasMoved()) {
            $nombrePortada = $portada->getRandomName();
            $$portada->move(ROOTPATH . 'public/uploads', $nombrePortada);
            $recurso = $this->recursoModel->find($id);
            if ($recurso['portada']) {
                unlink(ROOTPATH . 'public/uploads/' . $recurso['portada']);
            }
            $data['portada'] = $nombrePortada;
        }

        $archivo = $this->request->getFile('archivo');
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreOriginal = $archivo->getName();
            $archivo->move(ROOTPATH . 'public/uploads', $nombreOriginal);

            $recurso = $this->recursoModel->find($id);
            if ($recurso['archivo']) {
                unlink(ROOTPATH . 'public/uploads/' . $recurso['archivo']);
            }

            $data['archivo'] = $nombreOriginal;
        }

        $this->recursoModel->update($id, $data);

        $autoresSeleccionados = $this->request->getPost('autores');
        if ($autoresSeleccionados) {
            $this->recursoModel->autores()->sync($autoresSeleccionados);
        } else {
            $this->recursoModel->autores()->sync([]);
        }

        return redirect()->to('/admin/recursos')->with('success', 'Recurso actualizado exitosamente');
    }

    public function delete($id = null)
    {
        $recurso = $this->recursoModel->find($id);
        if ($recurso === null) {
            return redirect()->to('/admin/recursos')->with('error', 'Recurso no encontrado');
        }

        if ($recurso['portada']) {
            unlink(ROOTPATH . 'public/uploads/' . $recurso['portada']);
        }

        if ($recurso['archivo']) {
            unlink(ROOTPATH . 'public/uploads/' . $recurso['archivo']);
        }

        $this->recursoModel->delete($id);

        return redirect()->to('/admin/recursos')->with('success', 'Recurso eliminado exitosamente');
    }







    public function step1_autores()
    {
        $data['autores'] = $this->autorModel->findAll();
        return view('admin/recursos/step1_autores', $data);
    }


    public function processStep1()
    {
        $autoresSeleccionados = $this->request->getPost('autores') ?? [];
        $nuevosAutores = $this->request->getPost('nuevos_autores') ?? [];

        foreach ($nuevosAutores as $nombreAutor) {
            if (trim($nombreAutor) !== '') {
                $this->autorModel->save(['nombre' => $nombreAutor]);
                $autoresSeleccionados[] = $this->autorModel->insertID();
            }
        }

        session()->set('autores_seleccionados', $autoresSeleccionados);
        return redirect()->to('/admin/recursos/step2');
    }



    public function step2_categoria()
    {
        $data['generos'] = $this->generoModel->findAll();
        return view('admin/recursos/step2_categoria', $data);
    }

    public function processStep2()
    {
        $genero_id = $this->request->getPost('genero_id');

        if ($genero_id == 'nueva') {
            $nombreGenero = $this->request->getPost('nuevo_genero');
            $this->generoModel->save(['nombre' => $nombreGenero]);
            $genero_id = $this->generoModel->insertID();
        }

        session()->set('genero_id', $genero_id);
        return redirect()->to('/admin/recursos/step3');
    }


    public function step3_tag()
    {
        $data['tags'] = $this->tagModel->findAll();
        return view('admin/recursos/step3_tag', $data);
    }


    public function processStep3()
    {
        $tag_id = $this->request->getPost('tag_id');
        if ($tag_id == 'nueva') {
            $nombreTag = $this->request->getPost('nueva_tag');
            $this->tagModel->save(['nombre' => $nombreTag]);
            $tag_id = $this->tagModel->insertID();
        }

        session()->set('tag_id', $tag_id);
        return redirect()->to('/admin/recursos/step4');
    }

    public function step4_editorial()
    {
        $data['editoriales'] = $this->editorialModel->findAll();
        return view('admin/recursos/step4_editorial', $data);
    }

    /*
    public function processStep4()
    {
        $editorial_id = $this->request->getPost('editorial_id');
        if ($editorial_id == 'nueva') {
            $nombreEditorial = $this->request->getPost('nueva_editorial');
            $this->editorialModel->save(['nombre' => $nombreEditorial]);
            $editorial_id = $this->editorialModel->insertID();
        }

        session()->set('editorial_id', $editorial_id);
        return redirect()->to('/admin/recursos/step5');
    }
    */

    public function processStep4()
    {
        $editorial_id = $this->request->getPost('editorial_id');

        if ($editorial_id == 'nueva') {
            $nombreEditorial = $this->request->getPost('nueva_editorial');

            if ($this->editorialModel->insert(['nombre' => $nombreEditorial])) {
                $editorial_id = $this->editorialModel->insertID();
            } else {
                return redirect()->back()->with('error', 'Error al guardar la nueva editorial.');
            }
        }

        session()->set('editorial_id', $editorial_id);
        return redirect()->to('/admin/recursos/step5');
    }




    public function step5_recurso()
    {
        return view('admin/recursos/step5_recurso');
    }

    public function store()
    {
        // Definir las reglas de validación
        $rules = [
            'titulo' => 'required|min_length[3]|max_length[255]',
            'isbn' => 'required|is_unique[recursos.isbn]|max_length[20]',
            'anio_publicacion' => 'permit_empty|numeric|min_length[4]|max_length[4]',
            'idioma' => 'permit_empty',
            'edicion' => 'permit_empty|min_length[1]|max_length[50]',
            'portada' => 'permit_empty|is_image[portada]|max_size[portada,2048]',
            'paginas' => 'permit_empty|numeric',
            'fecha_publicacion' => 'permit_empty|valid_date',
            'clasificacion' => 'permit_empty',
            'formato' => 'permit_empty',
            'precio' => 'permit_empty|decimal',
            'sellado' => 'permit_empty|in_list[0,1]',
            'etiquetado' => 'permit_empty|in_list[0,1]',
            'archivo' => 'permit_empty|ext_in[archivo,pdf,epub,mobi]|max_size[archivo,5120]',
            'descripcion' => 'permit_empty|min_length[10]|max_length[5000]',
            'temas' => 'permit_empty|max_length[255]',
            'notas' => 'permit_empty|max_length[255]',
            'tipo' => 'permit_empty'
        ];

        // Mensajes personalizados para los errores de validación
        $errors = [
            'titulo' => [
                'required' => 'El título es obligatorio.',
                'min_length' => 'El título debe tener al menos 3 caracteres.',
                'max_length' => 'El título no debe exceder los 255 caracteres.',
            ],
            'isbn' => [
                'required' => 'El ISBN es obligatorio.',
                'is_unique' => 'Este ISBN ya está registrado.',
                'max_length' => 'El ISBN no debe exceder los 13 caracteres.',
            ],
            'anio_publicacion' => [
                'numeric' => 'El año de publicación debe ser un número.',
                'min_length' => 'El año de publicación debe tener 4 dígitos.',
                'max_length' => 'El año de publicación debe tener 4 dígitos.',
            ],
            'idioma' => [
                'required' => 'El idioma es obligatorio.',
            ],
            'edicion' => [
                'min_length' => 'La edición debe tener al menos 1 carácter.',
                'max_length' => 'La edición no debe exceder los 50 caracteres.',
            ],
            'portada' => [
                'is_image' => 'La portada debe ser una imagen válida.',
                'max_size' => 'La portada no debe exceder los 2MB.',
            ],
            'paginas' => [
                'numeric' => 'El número de páginas debe ser un valor numérico.',
            ],
            'fecha_publicacion' => [
                'valid_date' => 'La fecha de publicación debe ser válida.',
            ],
            'clasificacion' => [
                'required' => 'La clasificación es obligatoria.',
            ],
            'formato' => [
                'required' => 'El formato es obligatorio.',
            ],
            'precio' => [
                'decimal' => 'El precio debe ser un valor decimal válido.',
            ],
            'sellado' => [
                'in_list' => 'El campo de sellado debe ser 0 (no) o 1 (sí).',
            ],
            'etiquetado' => [
                'in_list' => 'El campo de etiquetado debe ser 0 (no) o 1 (sí).',
            ],
            'archivo' => [
                'ext_in' => 'El archivo debe tener una extensión válida (pdf, epub, mobi).',
                'max_size' => 'El archivo no debe exceder los 5MB.',
            ],
            'descripcion' => [
                'min_length' => 'La descripción debe tener al menos 10 caracteres.',
                'max_length' => 'La descripción no debe exceder los 5000 caracteres.',
            ],
            'temas' => [
                'max_length' => 'Los temas no deben exceder los 255 caracteres.',
            ],
            'notas' => [
                'max_length' => 'Las notas no deben exceder los 255 caracteres.',
            ],
            'tipo' => [
                'required' => 'El tipo es obligatorio.',
            ],
        ];

        // Verifica si la validación falla
        if (!$this->validate($rules, $errors)) {
            // Si la validación falla, redirige de vuelta con errores
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Si la validación es exitosa, continúa con la inserción en la base de datos
        $titulo = $this->request->getPost('titulo');
        $isbn = $this->request->getPost('isbn');
        $genero = session()->get('genero_id');
        $autoresSeleccionados = session()->get('autores_seleccionados');
        $editorial_id = session()->get('editorial_id');
        $tag_id = session()->get('tag_id');
        $anio_publicacion = $this->request->getPost('anio_publicacion');
        $idioma = $this->request->getPost('idioma');
        $edicion = $this->request->getPost('edicion');
        $portada = $this->request->getFile('portada');
        $paginas = $this->request->getPost('paginas');
        $fecha_publicacion = $this->request->getPost('fecha_publicacion');
        $clasificacion = $this->request->getPost('clasificacion');
        $formato = $this->request->getPost('formato');
        $precio = $this->request->getPost('precio');
        $sellado = $this->request->getPost('sellado');
        $etiquetado = $this->request->getPost('etiquetado');
        $archivo = $this->request->getFile('archivo');
        $descripcion = $this->request->getPost('descripcion');
        $temas = $this->request->getPost('temas');
        $notas = $this->request->getPost('notas');
        $tipo = $this->request->getPost('tipo');

        // Guarda el recurso en la base de datos
        $this->recursoModel->save([
            'titulo' => $titulo,
            'isbn' => $isbn,
            'genero' => $genero,
            'editorial' => $editorial_id,
            'tag' => $tag_id,
            'anio_publicacion' => $anio_publicacion,
            'idioma' => $idioma,
            'edicion' => $edicion,
            'portada' => $portada,
            'paginas' => $paginas,
            'fecha_publicacion' => $fecha_publicacion,
            'clasificacion' => $clasificacion,
            'formato' => $formato,
            'precio' => $precio,
            'sellado' => $sellado,
            'etiquetado' => $etiquetado,
            'archivo' => $archivo,
            'descripcion' => $descripcion,
            'temas' => $temas,
            'notas' => $notas,
            'tipo' => $tipo
        ]);

        $recurso_id = $this->recursoModel->insertID();

        foreach ($autoresSeleccionados as $autor) {
            $this->db->table('autores_recursos')->insert([
                'recurso' => $recurso_id,
                'autor' => $autor
            ]);
        }

        session()->remove(['genero', 'tag_id', 'autores_seleccionados', 'editorial_id']);
        return redirect()->to('/admin/recursos');
    }

}
