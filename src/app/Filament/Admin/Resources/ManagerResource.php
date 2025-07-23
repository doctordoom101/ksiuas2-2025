<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ManagerResource\Pages;
use App\Filament\Admin\Resources\ManagerResource\RelationManagers;
use App\Models\Manager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManagerResource extends Resource
{
    protected static ?string $model = Manager::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Club Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')->required(),
            TextInput::make('nationality')->required(),
            DatePicker::make('birth_date')->required(),
            TextInput::make('experience_years')->numeric()->required(),
            TextInput::make('license_type')->required(),
            TextInput::make('contact_email')->email()->required(),
            TextInput::make('contact_phone')->tel()->required(),
            Select::make('club_id')
                ->relationship('club', 'name')
                ->searchable()
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('nationality'),
            TextColumn::make('birth_date')->date('d M Y'),
            TextColumn::make('experience_years'),
            TextColumn::make('club.name')->label('Club'),
        ])->filters([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListManagers::route('/'),
            'create' => Pages\CreateManager::route('/create'),
            'edit' => Pages\EditManager::route('/{record}/edit'),
        ];
    }
}
