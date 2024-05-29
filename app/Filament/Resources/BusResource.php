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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

    protected static ?int $navigationSort = 11;

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
                            ->numeric(),
                        Forms\Components\TextInput::make('file'),
                        Forms\Components\Textarea::make('notes')
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_available')
                            ->required(),
                        Forms\Components\TextInput::make('available_days'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('id_card_no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
                Tables\Columns\TextColumn::make('available_days')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
