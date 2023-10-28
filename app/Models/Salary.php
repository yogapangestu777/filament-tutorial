<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'salary';
    protected $with = ['getenhancer', 'getbonus'];
    protected $tabel = [
        'enhancer', 'bonus', 'amount', 'information', 'date'
    ];
    public function getenhancer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enhancer');
    }
    public function getbonus(): BelongsTo
    {
        return $this->belongsTo(Bonus::class, 'bonus');
    }
}
