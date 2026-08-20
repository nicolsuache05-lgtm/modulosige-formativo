<?php

namespace Modules\Egresados\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\SICA\Entities\Apprentice;

class Egresado extends Model
{
    use SoftDeletes;

    protected $table = 'egresados';

    protected $fillable = [
        'apprentice_id',
        'graduation_date',
        'employment_status',
        'company',
        'position',
        'salary',
        'contact_email',
        'contact_phone',
        'linkedin',
        'observations',
    ];

    protected $dates = ['deleted_at', 'graduation_date'];

    /**
     * Relación con el Aprendiz
     */
    public function apprentice()
    {
        return $this->belongsTo(Apprentice::class, 'apprentice_id');
    }
}
