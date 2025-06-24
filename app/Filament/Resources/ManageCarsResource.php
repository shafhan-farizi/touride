<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManageCarsResource\Pages;
use App\Filament\Resources\ManageCarsResource\RelationManagers;
use App\Models\Cars;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ManageCarsResource extends Resource
{
    protected static ?string $model = Cars::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationLabel = 'Manage Cars';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->required()
                    ->options([
                        'suv' => 'SUV',
                        'sedan' => 'Sedan',
                        'hatchback' => 'Hatchback',
                        'mpv' => 'MPV (Multi-Purpose Vehicle)',
                        'sport' => 'Sport Car',
                        'luxury' => 'Luxury Car',
                        'electric' => 'Electric Car',
                        'hybrid' => 'Hybrid Car',
                        'pickup' => 'Pickup Truck',
                        'van' => 'Van',
                        'minibus' => 'Minibus',
                        'convertible' => 'Convertible',
                        'coupe' => 'Coupe',
                        'wagon' => 'Station Wagon',
                    ]),
                Textarea::make('description')
                    ->required()
                    ->maxLength(255),
                TextInput::make('plate_number')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('rental_price')
                    ->numeric()
                    ->required()
                    ->minValue(0),
                TextInput::make('insurance')
                    ->numeric()
                    ->required()
                    ->minValue(0),
                TextInput::make('service_fee')
                    ->numeric()
                    ->required()
                    ->minValue(0),
                FileUpload::make('image')
                    ->label('Car')
                    ->previewable(true)
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->size(100, 100),
                TextColumn::make('name')
                    ->label('Car')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->searchable(),
                TextColumn::make('plate_number')
                    ->label('Plate Number')
                    ->searchable(),
                TextColumn::make('rental_price')
                    ->label('Rental Price (Days)')
                    ->formatStateUsing(fn($state) => 'Rp. ' . number_format($state, 0, ',', '.')),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'available' => 'success',
                        'rented' => 'warning',
                        'maintenance' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('View')
                    ->infolist([
                        ImageEntry::make('image')
                            ->label('Car Image')
                            ->size(200, 300),
                        TextEntry::make('name')
                            ->label('Car Name'),
                        TextEntry::make('plate_number')
                            ->label('Plate Number'),
                        TextEntry::make('rental_price')
                            ->label('Rental Price (Days)')
                            ->formatStateUsing(fn($state) => 'Rp. ' . number_format($state, 0, ',', '.')),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'available' => 'success',
                                'rented' => 'warning',
                                'maintenance' => 'danger',
                            }),
                    ])->modalWidth(MaxWidth::Large),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->after(function (Cars $record) {
                        // delete single
                        if ($record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCars::route('/'),
        ];
    }
}
