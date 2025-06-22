<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentsResource\Pages;
use App\Filament\Resources\PaymentsResource\RelationManagers;
use App\Models\Payments;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentsResource extends Resource
{
    protected static ?string $model = Payments::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('payment_id')
                    ->required()
                    ->maxLength(255),
                Placeholder::make('booking.booking_id')
                    ->label('Booking ID')
                    ->content(fn($record) => $record->booking->booking_id ?? 'N/A'),
                Placeholder::make('user.name')
                    ->label('Customer')
                    ->content(fn($record) => $record->user->name ?? 'N/A'),
                Select::make('booking.car.name')
                    ->label('Car')
                    ->relationship('booking.car', 'name')
                    ->default(fn($record) => $record->booking ?? 'N/A')
                    ->required(),
                Placeholder::make('booking.car.name')
                    ->label('Car Selected Before')
                    ->content(fn($record) => $record->booking->car->name ?? 'N/A'),
                Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'credit_card' => 'Credit Card',
                        'paypal' => 'PayPal',
                        'bank_transfer' => 'Bank Transfer',
                    ])
                    ->required(),
                TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->minValue(0),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'paid' => 'Paid',
                        'pending' => 'Pending',
                        'canceled' => 'Canceled',
                    ])
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('payment_id')
                    ->label('Payment ID')
                    ->formatStateUsing(fn (string $state): string => __("#PY-{$state}")),
                TextColumn::make('booking.booking_id')
                    ->label('Booking ID')
                    ->formatStateUsing(fn (string $state): string => __("#BK-{$state}")),
                TextColumn::make('payment_method.user.name')
                    ->label('Customer'),
                TextColumn::make('booking.car.name')
                    ->label('Car'),
                TextColumn::make('payment_method.bank_name')
                    ->label('Payment Method'),
                TextColumn::make('amount')
                    ->label('Amount')
                    ->prefix('Rp.')
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.')),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                    }),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->date()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('View Details')
                    ->form([
                        TextInput::make('payment_id')
                            ->label('Payment ID'),
                        Placeholder::make('booking.booking_id')
                            ->label('Booking ID')
                            ->content(fn($record) => $record->booking->booking_id ?? 'N/A'),
                        Placeholder::make('user.name')
                            ->label('Customer')
                            ->content(fn($record) => $record->user->name ?? 'N/A'),
                        Placeholder::make('booking.car.name')
                            ->label('Car')
                            ->content(fn($record) => $record->booking->car->name ?? 'N/A'),
                        TextInput::make('payment_method')
                            ->label('Payment Method'),
                        TextInput::make('amount')
                            ->label('Amount'),
                        TextInput::make('status')
                            ->label('Status'),
                        Placeholder::make('created_at')
                            ->label('Date')
                            ->content(fn($record) => $record->created_at ? $record->created_at->format('M d, Y') : 'N/A'),
                    ]),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePayments::route('/'),
        ];
    }
}
