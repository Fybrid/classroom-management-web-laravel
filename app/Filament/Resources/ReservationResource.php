<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;


class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;
    protected static ?string $modelLabel = '教室予約';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('personal_id')->default(Auth::user()->personal_id)->disabled()->label('個人番号'),
                Select::make('room_id')->required()->options(Room::all()->pluck('number', 'id'))->label('部屋番号'),
                DatePicker::make('date')->required()->minDate(now())->afterOrEqual(now()->format('Y-m-d'))->label('日付'),

                //TODO 部屋番号みたいな選択形式に変更
                Select::make('period')
                ->required()
                // ->multiple()
                ->options([
                    '9:10 ~ 10:40',
                    '10:50 ~ 12:20',
                    '13:10 ~ 14:40',
                    '14:50 ~ 16:20',
                    '16:30 ~ 18:00',
                    '18:00 ~ 20:00',
                ])
                ->label('時間')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('personal_id')->label('ID'),
                Tables\Columns\TextColumn::make('rooms.number')->label('教室番号'),
                Tables\Columns\TextColumn::make('date')->label('日付'),
                Tables\Columns\TextColumn::make('period_name')->label('時間'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at'),
            ])
            ->filters([
                SelectFilter::make('personal_id')
                    ->options(User::all()->pluck('personal_id', 'personal_id'))
                    ->default(Auth::user()->personal_id)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
