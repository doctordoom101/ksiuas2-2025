<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PlayerResource\Pages;
use App\Models\Player;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Players';
    protected static ?string $pluralModelLabel = 'Players';
    protected static ?string $modelLabel = 'Player';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('name')->required()->maxLength(100),
                    Forms\Components\TextInput::make('position')->required()->maxLength(50),
                    Forms\Components\TextInput::make('nationality')->required()->maxLength(100),
                    Forms\Components\DatePicker::make('birth_date')->required(),
                    Forms\Components\TextInput::make('birth_place')->required()->maxLength(100),
                    Forms\Components\TextInput::make('passport_number')->required()->maxLength(50),
                    Forms\Components\TextInput::make('salary')->required()->numeric(),
                    Forms\Components\DatePicker::make('contract_start')->required(),
                    Forms\Components\DatePicker::make('contract_end')->required(),
                    Forms\Components\Textarea::make('medical_record')->maxLength(65535),
                ])->columns(2),

                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('agent_name')->required()->maxLength(100),
                    Forms\Components\TextInput::make('contact_email')->email()->maxLength(100),
                    Forms\Components\TextInput::make('contact_phone')->tel()->maxLength(20),
                    Forms\Components\Select::make('club_id')
                        ->relationship('club', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('nationality'),
                Tables\Columns\TextColumn::make('birth_date')->date(),
                Tables\Columns\TextColumn::make('salary')->money('USD', true),
                Tables\Columns\TextColumn::make('club.name')->label('Club')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('contract_end')->label('Contract Ends')->date(),
                Tables\Columns\TextColumn::make('api_token')->label('api_token')
                    ->label('API Token')
                    ->copyable()
                    ->copyMessage('Token copied to clipboard!')
                    ->copyMessageDuration(1500),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('club_id')
                    ->relationship('club', 'name')
                    ->label('Club'),
                Tables\Filters\SelectFilter::make('position')
                    ->options([
                        'Forward' => 'Forward',
                        'Midfielder' => 'Midfielder',
                        'Defender' => 'Defender',
                        'Goalkeeper' => 'Goalkeeper',
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }
}
