<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\NotificationController;
use App\Models\Bookings;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Bookings::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Booking List';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_id')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => __("#BK-{$state}")),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('car.name')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'completed' => 'success',
                        'ongoing' => 'warning',
                        'confirmed' => 'info',
                        'not confirmed' => 'gray',
                        'canceled' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('View')
                    ->form([
                        TextInput::make('booking_id'),
                        Placeholder::make('user.name')
                            ->label('Customer Name')
                            ->content(fn($record) => $record->user->name ?? 'N/A'),
                        Placeholder::make('car.name')
                            ->label('Car')
                            ->content(fn($record) => $record->car->name ?? 'N/A'),
                        TextInput::make('period')
                            ->label('Period (days)')
                            ->integer(),
                        TextInput::make('pickup_date')
                            ->label('Pickup Date'),
                        TextInput::make('return_date')
                            ->label('Return Date'),
                        TextInput::make('pickup_location')
                            ->label('Pickup Location'),
                        TextInput::make('dropoff_location')
                            ->label('Dropoff Location'),
                        TextInput::make('status'),
                    ]),
                Tables\Actions\EditAction::make()
                    ->label('confirm')
                    ->color('success')
                    ->modalHeading('Change Status Bookings')
                    ->form([
                        Hidden::make('user_id'),
                        Hidden::make('id'),
                        Select::make('status')
                            ->options([
                                'canceled' => 'Canceled',
                                'confirmed' => 'Confirmed',
                                'ongoing' => 'Ongoing',
                                'completed' => 'Completed',
                            ])
                            ->label('Status')
                            ->required(),
                    ])
                    ->action(function (Bookings $record, array $data) {
                        if($record->status == $data['status']) {
                            return;
                        }

                        $record->update([
                            'status' => $data['status']
                        ]);

                        if ($record->status == 'confirmed') {
                            NotificationController::send($record->user->id, 'Pengajuan Diterima', 'Silakan lanjutkan pembayaran!');
                        } elseif ($record->status == 'canceled') {
                            NotificationController::send($record->user->id, 'Pengajuan Ditolak', 'Pengajuan booking anda ditolak karena mobil sedang maintenance!');
                        } elseif ($record->status == 'ongoing') {
                            NotificationController::send($record->user->id, 'Pembayaran Dikonfirmasi', 'Silakan tunggu informasi selanjutnya!');

                            EmailController::sendEmail($data['user_id'], $data['id']);
                        } elseif ($record->status == 'completed') {
                            NotificationController::send($record->user->id, 'Booking Selesai', 'Silakan beri rating atas pengalaman anda!');
                        }
                    }),
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
            'index' => Pages\ManageBookings::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('user', function (Builder $query) {
                $query->role('customer');
            })
            ->orderBy('updated_at', 'desc');;
    }
}
