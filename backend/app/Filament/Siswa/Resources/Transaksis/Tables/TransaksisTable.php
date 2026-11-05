<?php

namespace App\Filament\Siswa\Resources\Transaksis\Tables;

use App\Models\Transaksi;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('buku.judul')
                    ->label('Buku')
                    ->searchable(),
                TextColumn::make('tgl_pinjam')
                    ->date()
                    ->sortable(),
                TextColumn::make('tgl_jatuh_tempo')
                    ->date()
                    ->sortable(),
                TextColumn::make('tgl_kembali')
                    ->date()
                    ->placeholder('-'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                         'dipinjam'=> 'warning',
                         'terlambat'=> 'danger',
                         default => 'success'
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')->options(['dipinjam'=> 'Dipinjam', 'dikembalikan'=> 'Dikembalikan']),
                Filter::make('terlambat')
                    ->label('Terlambat')
                    ->toggle()
                    ->query(fn (Builder $query)=> $query->where('status', 'dipinjam')->whereDate('tgl_jatuh_tempo', '<', today()))
            ])
            ->recordActions([
                Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->requiresConfirmation()
                    ->visible(fn (Transaksi $record) => $record->status === 'dipinjam')
                    ->action(function (Transaksi $record) {
                        $record->kembalikan();
                        Notification::make()->title('Buku dikembalikan')->success()->send();
                    }),
                DeleteAction::make()->label('Hapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
