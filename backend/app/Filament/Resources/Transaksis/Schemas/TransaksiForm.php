<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Anggota')
                    ->relationship('user', 'nama', modifyQueryUsing: fn(Builder $query) => $query->where('role', 'siswa'))
                    ->searchable()
                    ->preload()
                    ->disabled(fn(string $operation) => $operation === 'edit')
                    ->required(),
                Select::make('buku_id')
                    ->label('Buku')
                    ->relationship('buku', 'judul', modifyQueryUsing: fn(Builder $query) => $query->where('stok', '>', 0))
                    ->searchable()
                    ->preload()
                    ->disabled(fn(string $operation) => $operation === 'edit')
                    ->required(),
                DatePicker::make('tgl_pinjam')
                    ->required()
                    ->default(now()),
                DatePicker::make('tgl_jatuh_tempo')
                    ->required()
                    ->default(now()->addDays(7)),
                Hidden::make('status')->default('dipinjam')
            ]);
    }
}
