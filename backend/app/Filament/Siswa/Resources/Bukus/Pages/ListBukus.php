<?php

namespace App\Filament\Siswa\Resources\Bukus\Pages;

use App\Filament\Siswa\Resources\Bukus\BukuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBukus extends ListRecords
{
    protected static string $resource = BukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
