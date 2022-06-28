<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pos',
        'topic'
    ];

    public $timestamps = false;
}
