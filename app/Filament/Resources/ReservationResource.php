<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
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
                TextInput::make('personal_id')->default(Auth::user()->personal_id)->disabled(),
                
                Select::make('room_id')->options(Room::all()->pluck('number', 'id')),

                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->afterOrEqual(now()->format('Y-m-d')),

                    //本日以前の日付は選択不可
                    DateTimePicker::make('date')
                    ->label('Appointment date')
                    ->minDate(now())
                    //表示日数を30
                    ->maxDate(ReservationResource::now()->addDays(30))
                    ->afterOrEqual(to: new Date()),
                    //月曜から日曜表示
                    DateTimePicker::make('published_at')->weekStartsOnMonday()
                    DateTimePicker::make('published_at')->weekStartsOnMonday()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('personal_id')->label('個人番号'),
                Tables\Columns\TextColumn::make('rooms.number'),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('period_name'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at'),
            ])
            ->filters([
                //
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
