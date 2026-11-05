<?php

namespace App\Filament\Siswa\Resources\Transaksis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'id'),
                Select::make('buku_id')
                    ->relationship('buku', 'id'),
                DatePicker::make('tgl_pinjam')
                    ->required(),
                DatePicker::make('tgl_jatuh_tempo')
                    ->required(),
                DatePicker::make('tgl_kembali'),
                Select::make('status')
                    ->options(['dipinjam' => 'Dipinjam', 'dikembalikan' => 'Dikembalikan'])
                    ->default('dipinjam')
                    ->required(),
            ]);
    }
}
