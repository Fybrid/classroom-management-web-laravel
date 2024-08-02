<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Pages\Auth\Login as BaseLogin;

class Login extends BaseLogin
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        // 個人番号入力フォーム 追加
                        TextInput::make('personal_id')->label('個人番号'),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'personal_id' => $data['personal_id'],
            'password' => 'password',
        ];
    }
}