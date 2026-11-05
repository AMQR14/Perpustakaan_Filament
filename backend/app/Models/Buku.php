<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $guarded = [
        'id'
    ];

    public function kategori() : BelongsTo {
        return $this->belongsTo(Kategori::class);
    }

    public function transaksi() : HasMany {
        return $this->hasMany(Transaksi::class, 'buku_id');
    }
}
