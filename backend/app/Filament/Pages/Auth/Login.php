<?php

namespace App\Filament\Pages\Auth;

use \Filament\Auth\Pages\Login as BaseLogin;
use \Filament\Forms\Components\TextInput;
use \Filament\Schemas\Schema;
use Illuminate\Validation\ValidationException;
use Override;

class Login extends BaseLogin
{
    public function form(Schema $schema) : Schema {
        return $schema->components([
            TextInput::make('username')
                ->label('Username')
                ->required()
                ->autofocus(),
            $this->getPasswordFormComponent(),
            $this->getRememberFormComponent()
        ]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'username'=> $data['username'],
            'password'=> $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.username'=> 'Username or password is incorrect',
            'data.password'=> 'Username or password is incorrect',
        ]);
    }
}
