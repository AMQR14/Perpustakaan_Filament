<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class Transaksi extends Model
{
    protected $guarded = [
        'id'
    ];

    public function buku() : BelongsTo {
        return $this->belongsTo(Buku::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function (Transaksi $t) {
            Buku::where('id', $t->buku_id)->decrement('stok');
        });

        static::deleting(function (Transaksi $t) {
            if($t->status === 'dipinjam'){
                Buku::where('id', $t->buku_id)->increment('stok');
            }
        });
    }

    public function kembalikan()  {
        if($this->status === 'dikembalikan'){
            return;
        }

        $this->update([
            'status'=> 'dikembalikan',
            'tgl_kembali'=> today()
        ]);

        $this->buku()->increment('stok');
    }
}
