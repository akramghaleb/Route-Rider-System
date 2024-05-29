<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Filament\Resources\TripResource\RelationManagers;
use App\Models\Trip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';

    // Main Title
    public static function getPluralModelLabel(): string
    {
        return __('all.trip-labels');
    }

    public static function getModelLabel(): string
    {
        return __('all.trip-label');
    }

    protected static bool $shouldRegisterNavigation = true;

    protected static ?int $navigationSort = 3;

    public static function getGloballySearchableAttributes(): array
    {
        return ['from', 'to'];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('bus_id')
                            ->relationship('bus', 'name')
                            ->required()
                            ->label(__('all.bus-label')),
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('from')
                                ->required()
                                ->label(__('all.from')),
                            Forms\Components\TextInput::make('to')
                                ->required()
                                ->label(__('all.to')),
                        ]),

                        Forms\Components\DateTimePicker::make('date_of_trip')
                            ->required()
                            ->label(__('all.date_of_trip')),
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('vip_chairs')
                                ->required()
                                ->numeric()
                                ->default(1)
                                ->label(__('all.vip_chairs')),
                            Forms\Components\TextInput::make('customer_chairs')
                                ->required()
                                ->numeric()
                                ->default(1)
                                ->label(__('all.customer_chairs')),
                        ]),
                        Forms\Components\FileUpload::make('file')
                            ->directory('Customer')
                            ->downloadable()
                            ->label(__('all.file')),
                        Forms\Components\Textarea::make('notes')
                            ->columnSpanFull()
                            ->label(__('all.notes')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bus.name')
                    ->searchable()
                    ->sortable()
                    ->label(__('all.bus-label')),
                Tables\Columns\TextColumn::make('from')
                    ->searchable()
                    ->label(__('all.from')),
                Tables\Columns\TextColumn::make('to')
                    ->searchable()
                    ->label(__('all.to')),
                Tables\Columns\TextColumn::make('date_of_trip')
                    ->dateTime()
                    ->sortable()
                    ->label(__('all.date_of_trip')),
                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('all.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('all.updated_at')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('all.deleted_at')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
