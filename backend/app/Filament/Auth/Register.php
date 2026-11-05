<?php

namespace App\Filament\Auth;

use \Filament\Auth\Pages\Register as BaseRegister;
use \Filament\Forms\Components\TextInput;
use \Filament\Schemas\Schema;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Override;

class Register extends BaseRegister
{
    public function form(Schema $schema) : Schema {
        return $schema->components([
            TextInput::make('nama')->required(),
            TextInput::make('username')->required()->unique(User::class, 'username'),
            TextInput::make('nis')->label('NIS')->nullable()->unique(User::class, 'nis'),
            TextInput::make('kelas')->nullable(),
            TextInput::make('password')->password()->required()->revealable()->minLength(6)
        ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $data['role'] = 'siswa';

        return User::create($data);
    }
}
