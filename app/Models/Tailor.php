<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tailor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tailors';
    protected $with = ['getenhancer'];
    protected $fillable = ['enhancer', 'motive', 'amount', 'type', 'image', 'information'];
    public function getenhancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enhancer');
    }
}
