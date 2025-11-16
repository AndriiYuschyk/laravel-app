<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Kved extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)
            ->withPivot('is_primary')
            ->withTimestamps();
    }
}
