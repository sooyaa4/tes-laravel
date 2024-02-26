<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'description',
        'tags',
        'posts_id',  
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'posts_id');
    }
}
