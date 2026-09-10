<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Audit extends Model
{
    protected $table = 'audits';

    protected $guarded = ['id'];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
