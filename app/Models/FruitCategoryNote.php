<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FruitCategoryNote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'unit',
        'price',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function fruitCategory(): BelongsTo
    {
        return $this->belongsTo(FruitCategory::class);
    }
}
