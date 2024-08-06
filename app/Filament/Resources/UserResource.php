<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\Page;

class UserResource extends Resource
{
    protected static ?string $modelLabel = 'ユーザー';
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'ユーザー管理';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('personal_id')
                    ->label('個人番号')
                    ->disabled(fn (Page $livewire) => $livewire instanceof EditRecord),
                TextInput::make('password')->hidden()->default('password'),

                // dateのフォームのサンプル
                // Forms\Components\DatePicker::make('date')
                //     ->required()
                //     ->afterOrEqual(now()->format('Y-m-d')),

                // Using Select Component
                Select::make('roles')
                    ->relationship('roles', 'name')
                    // ->multiple()
                    ->preload(),

                // Using CheckboxList Component
                // CheckboxList::make('roles')
                //     ->relationship('roles', 'name')
                //     ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('personal_id')->sortable(),
                Tables\Columns\TextColumn::make('roles.name'),
                Tables\Columns\TextColumn::make('created_at')->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->sortable(),
            ])
            ->filters([
                SelectFilter::make('personal_id')
                    ->options(User::all()->pluck('personal_id', 'personal_id'))
                    ->searchable()
                    ->multiple(),
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->persistFiltersInSession();
    }

    public static function getRelations(): array
    {
        return [
            // UserRolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}