<?php

namespace Modules\Egresados\Models;

use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Course;

/**
 * Modelo Egresado para el Módulo SIGE.
 * Mapea directamente sobre la entidad institucional Apprentice sin crear tablas redundantes.
 */
class Egresado extends Apprentice
{
    /**
     * Nombre de la tabla de aprendices del ERP.
     */
    protected $table = 'apprentices';

    /**
     * Scope para filtrar únicamente aprendices graduados/certificados.
     */
    public function scopeEgresados($query)
    {
        return $query->whereIn('apprentice_status', ['CERTIFICADO', 'EGRESADO']);
    }

    /**
     * Relación con la entidad de persona.
     */
    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    /**
     * Relación con el curso / ficha de formación.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
