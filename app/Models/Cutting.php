<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

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

    // protected static function booted(): void
    // {
    //     if (auth()->check()) {
    //         static::addGlobalScope('team', function (Builder $query) {
    //             $query->where('id', auth()->user()->id);
    //             // // or with a `team` relationship defined:
    //             // $query->whereBelongsTo(auth()->user()->team);
    //         });
    //     }
    // }
}
