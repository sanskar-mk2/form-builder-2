<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contents'];
    protected $appends = ['fields_count'];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    protected function contents(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }

    protected function fieldsCount(): Attribute
    {
        return new Attribute(
            get: fn () => count($this->contents),
        );
    }
}
