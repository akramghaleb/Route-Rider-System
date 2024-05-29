<?php

namespace App\Filament\Resources\TripResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripCustomersRelationManager extends RelationManager
{
    protected static string $relationship = 'trip_customers';

    public static function getPluralModelLabel(): string
    {
        return __('all.customer-labels');
    }

    public static function getModelLabel(): string
    {
        return __('all.customer-label');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([

                            Forms\Components\Select::make('customer_id')
                                ->relationship('customer', 'name')
                                ->required()
                                ->searchable()
                                ->label(__('all.customer-label')),

                            Forms\Components\Select::make('trip_id')
                                ->relationship('trip', 'id')
                                ->required()
                                ->default(function (RelationManager $livewire): int {
                                    return $livewire->ownerRecord->id;
                                })
                                ->disabled()
                                ->label(__('all.trip-label')),
                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Select::make('type')
                                ->options([
                                    'vip'=>'VIP',
                                    'normal'=>'Normal',
                                ])
                                ->required()
                                ->label(__('all.type')),
                            Forms\Components\TextInput::make('number_of_seats')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->label(__('all.number_of_seats')),
                            Forms\Components\Textarea::make('notes')
                                ->columnSpanFull()
                                ->label(__('all.notes')),
                        ]),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')->label(__('all.customer-label')),
                Tables\Columns\TextColumn::make('number_of_seats')
                ->summarize(Sum::make())
                ->label(__('all.number_of_seats')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
