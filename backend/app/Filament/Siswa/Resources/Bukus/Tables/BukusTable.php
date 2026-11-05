<?php

namespace App\Filament\Siswa\Resources\Bukus\Tables;

use App\Models\Buku;
use App\Models\Transaksi;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;

class BukusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategori.nama')
                    ->label('Kategori')
                    ->searchable(),
                TextColumn::make('kode')
                    ->searchable(),
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pengarang')
                    ->searchable(),
                TextColumn::make('penerbit')
                    ->searchable(),
                TextColumn::make('tahun'),
                TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
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
                //
            ])
            ->recordActions([
                Action::make('pinjam')
                    ->label('Pinjam')
                    ->icon('heroicon-o-book-open')
                    ->requiresConfirmation()
                    ->visible(fn (Buku $record) => $record->stok > 0)
                    ->action(function (Buku $record) {
                        $sudahDipinjam = Transaksi::where('user_id', Auth::id())
                            ->where('buku_id', $record->id)
                            ->where('status', 'dipinjam')
                            ->exists();

                        if($sudahDipinjam){
                            Notification::make()->title('Buku ini masih kamu pinjam')->danger()->send();
                            return;
                        }

                        Transaksi::create([
                            'user_id'=> Auth::id(),
                            'buku_id'=> $record->id,
                            'tgl_pinjam'=> today(),
                            'tgl_jatuh_tempo'=> today()->addDays(7),
                            'status'=> 'dipinjam'
                        ]);

                        Notification::make()->title('Peminjaman Berhasil')->success()->send();
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
