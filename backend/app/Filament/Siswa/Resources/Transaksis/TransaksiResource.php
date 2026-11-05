<?php

namespace App\Filament\Siswa\Resources\Transaksis;

use App\Filament\Siswa\Resources\Transaksis\Pages\CreateTransaksi;
use App\Filament\Siswa\Resources\Transaksis\Pages\EditTransaksi;
use App\Filament\Siswa\Resources\Transaksis\Pages\ListTransaksis;
use App\Filament\Siswa\Resources\Transaksis\Schemas\TransaksiForm;
use App\Filament\Siswa\Resources\Transaksis\Tables\TransaksisTable;
use App\Models\Transaksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Override;

class TransaksiResource extends Resource
{
    protected static ?string $modelLabel = 'Pengembalian';
    protected static ?string $pluralModelLabel = 'Pengembalian';
    protected static ?string $navigationLabel = 'Pengembalian Buku';

    protected static ?string $model = Transaksi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TransaksiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransaksisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransaksis::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
