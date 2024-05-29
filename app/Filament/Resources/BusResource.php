<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Filament\Resources\BusResource\RelationManagers;
use App\Models\Bus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    // protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    // Main Title
    public static function getPluralModelLabel(): string
    {
        return __('all.bus-labels');
    }

    public static function getModelLabel(): string
    {
        return __('all.bus-label');
    }


    // Group Name
    public static function getNavigationGroup(): string
    {
        return __('all.group-1');
    }

    protected static bool $shouldRegisterNavigation = true;

    protected static ?int $navigationSort = 1;

    public static function getGloballySearchableAttributes(): array
    {
        return ['email','name','phone_no'];
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
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label(__('all.name')),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->label(__('all.email')),
                        Forms\Components\TextInput::make('phone_no')
                            ->tel()
                            ->label(__('all.phone_no')),
                        Forms\Components\TextInput::make('address')
                            ->label(__('all.address')),
                        Forms\Components\TextInput::make('id_card_no')
                            ->numeric()
                            ->label(__('all.id_card_no')),
                        Forms\Components\FileUpload::make('file')
                            ->downloadable()
                            ->directory('Buses')
                            ->label(__('all.file')),
                        Forms\Components\Textarea::make('notes')
                            ->columnSpanFull()
                            ->label(__('all.notes')),

                        Forms\Components\Toggle::make('is_available')
                            ->required()
                            ->label(__('all.is_available')),
                        Forms\Components\Select::make('available_days')
                        ->multiple()
                        ->options(
                            [
                                1 => __('all.Sunday'),
                                2 => __('all.Monday'),
                                3 => __('all.Tuesday'),
                                4 => __('all.Wednesday'),
                                5 => __('all.Thursday'),
                                6 => __('all.Friday'),
                                7 => __('all.Saturday'),
                            ]
                        )
                        ->columnSpanFull()
                        ->label(__('all.available_days')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('all.name')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label(__('all.email')),
                Tables\Columns\TextColumn::make('phone_no')
                    ->searchable()
                    ->sortable()
                    ->label(__('all.phone_no')),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label(__('all.is_available')),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label(__('all.address')),
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
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
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
