<?php

namespace App\Models;

use CodeIgniter\Model;

class RecursoModel extends Model
{
    protected $table = 'recursos';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'archivo',
        'tipo',
        'tag',
        'titulo',
        'subtitulo',
        'genero',
        'isbn',
        'anio_publicacion',
        'idioma',
        'editorial',
        'edicion',
        'descripcion',
        'portada',
        'paginas',
        'fecha_publicacion',
        'clasificacion',
        'temas',
        'formato',
        'precio',
        'sellado',
        'etiquetado',
        'notas',
        'numero_ejemplares'
    ];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    
    
    public function autores()
    {
        return $this->belongsToMany(AutorModel::class, 'autores_recursos', 'recurso_id', 'autor_id');
    }

    public function genero()
    {
        return $this->belongsTo(GeneroModel::class, 'genero', 'id');
    }

    public function editorial()
    {
        return $this->belongsTo(EditorialModel::class, 'editorial', 'id');
    }

    public function tag()
    {
        return $this->belongsTo(TagModel::class, 'tag', 'id');
    }


    public function agregarAutores($recursoId, $autoresIds)
    {
        $data = [];
        foreach ($autoresIds as $autorId) {
            $data[] = [
                'recurso_id' => $recursoId,
                'autor_id' => $autorId
            ];
        }
        $this->db->table('autores_recursos')->insertBatch($data);
    }


    public function getAutoresByRecursoId($recursoId)
    {
        return $this->db->table('autores')
            ->join('autores_recursos', 'autores.id = autores_recursos.autor')
            ->where('autores_recursos.recurso', $recursoId)
            ->get()
            ->getResultArray();
    }


    public function getAutores($id)
    {
        return $this->db->table('autores_recursos')
            ->join('autores', 'autores.id = autores_recursos.autor_id')
            ->where('autores_recursos.recurso_id', $id)
            ->select('autores.*')
            ->get()
            ->getResultArray();
    }

    public function getGenero($id)
    {
        return $this->db->table('generos')
            ->join('recursos', 'generos.id = recursos.genero_id')
            ->where('recursos.id', $id)
            ->select('generos.*')
            ->get()
            ->getRowArray();
    }

    public function getEditorial($id)
    {
        return $this->db->table('editoriales')
            ->join('recursos', 'editoriales.id = recursos.editorial_id')
            ->where('recursos.id', $id)
            ->select('editoriales.*')
            ->get()
            ->getRowArray();
    }

    public function getTag($id)
    {
        return $this->db->table('tags')
            ->join('recursos', 'tags.id = recursos.tag_id')
            ->where('recursos.id', $id)
            ->select('tags.*')
            ->get()
            ->getRowArray();
    }


    public function getRecursoCompleto($id)
    {
        $recurso = $this->select('recursos.*, generos.nombre as genero_nombre, editoriales.nombre as editorial_nombre, tags.nombre as tag_nombre')
            ->join('generos', 'generos.id = recursos.genero', 'left')
            ->join('editoriales', 'editoriales.id = recursos.editorial', 'left')
            ->join('tags', 'tags.id = recursos.tag', 'left')
            ->where('recursos.id', $id)
            ->first();

        if (!$recurso) {
            throw new \Exception('Recurso no encontrado');
        }

        $recurso['autores'] = $this->getAutoresByRecursoId($id);

        return $recurso;
    }



    public function obtenerAutoresRecurso($idRecurso)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('autores_recursos');
        $builder->select('autores.nombre');
        $builder->join('autores', 'autores.id = autores_recursos.autor');
        $builder->where('autores_recursos.recurso', $idRecurso);
        return $builder->get()->getResultArray();
    }


    public function estaDisponible($idRecurso)
    {
        $recurso = $this->find($idRecurso);
        return $recurso && $recurso['numero_ejemplares'] > 0;
    }


    public function registrarDevolucion($idRecurso)
    {
        $recurso = $this->find($idRecurso);
        if ($recurso) {
            $nuevaCantidad = $recurso['numero_ejemplares'] + 1;
            $this->update($idRecurso, ['numero_ejemplares' => $nuevaCantidad]);
        }
    }

}
