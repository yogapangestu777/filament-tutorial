<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cutting extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'cutting';
    protected $with = ['getenhancer'];
    protected $fillable = ['enhancer', 'roll', 'cutting_result', 'material', 'size', 'model', 'motive', 'date', 'product'];

    public function getenhancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enhancer');
    }
}
