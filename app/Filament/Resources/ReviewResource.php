<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Replys;
use App\Models\Reviews;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Reviews::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->width('250px'),
                TextColumn::make('description')
                    ->label('Comments')
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('Reply')
                    ->icon('heroicon-o-envelope-open')
                    ->form([
                        Hidden::make('review_id')
                            ->default(fn (Reviews $record) => $record->id),
                        Textarea::make('description')
                            ->label('Your Reply')
                    ])
                    ->action(function (Replys $reply, array $data): void {
                        $reply->description = $data['description'];
                        $reply->save();

                        $review = Reviews::find($data['review_id']);

                        $review->update([
                            'reply_id' => $reply->id
                        ]);
                        
                    })
                    ->hidden(function (Reviews $review) {
                        return $review->reply()->exists();
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageReviews::route('/'),
        ];
    }
}
