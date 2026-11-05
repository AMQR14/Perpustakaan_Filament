<?php

namespace App\Filament\Siswa\Resources\Bukus\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BukuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori_id')
                    ->relationship('kategori', 'id'),
                TextInput::make('kode')
                    ->required(),
                TextInput::make('judul')
                    ->required(),
                TextInput::make('pengarang')
                    ->required(),
                TextInput::make('penerbit'),
                TextInput::make('tahun')
                    ->required(),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
