<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ClubResource\Pages;
use App\Models\Club;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClubResource extends Resource
{
    protected static ?string $model = Club::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Clubs';
    protected static ?string $modelLabel = 'Club';
    protected static ?string $pluralModelLabel = 'Clubs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(100),
                Forms\Components\TextInput::make('short_name')->maxLength(50),
                Forms\Components\TextInput::make('city')->required()->maxLength(100),
                Forms\Components\TextInput::make('country')->required()->maxLength(100),
                Forms\Components\TextInput::make('founded_year')->numeric()->required(),
                Forms\Components\TextInput::make('owner_name')->required()->maxLength(100),
                Forms\Components\TextInput::make('contact_email')->email()->maxLength(100),
                Forms\Components\TextInput::make('contact_phone')->tel()->maxLength(20),
                Forms\Components\TextInput::make('stadium_name')->required()->maxLength(100),
                Forms\Components\TextInput::make('stadium_address')->required()->maxLength(150),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('short_name'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\TextColumn::make('founded_year'),
                Tables\Columns\TextColumn::make('owner_name'),
                Tables\Columns\TextColumn::make('contact_email'),
                Tables\Columns\TextColumn::make('stadium_name'),
                Tables\Columns\TextColumn::make('api_token')->label('api_token')
                    ->label('API Token')
                    ->copyable()
                    ->copyMessage('Token copied to clipboard!')
                    ->copyMessageDuration(1500),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
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
        return [
            // Bisa tambahkan RelationManager ke Players di sini
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }
}
