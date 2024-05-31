<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'fas-people-group';

    // Main Title
    public static function getPluralModelLabel(): string
    {
        return __('all.customer-labels');
    }

    public static function getModelLabel(): string
    {
        return __('all.customer-label');
    }


    // Group Name
    public static function getNavigationGroup(): string
    {
        return __('all.group-1');
    }

    protected static bool $shouldRegisterNavigation = true;

    protected static ?int $navigationSort = 2;

    public static function getGloballySearchableAttributes(): array
    {
        return ['email', 'name', 'phone_no'];
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
                            ->directory('Customer')
                            ->downloadable()
                            ->label(__('all.file')),
                        Forms\Components\Textarea::make('notes')
                            ->columnSpanFull()
                            ->label(__('all.notes')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('all.name')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(__('all.email')),
                Tables\Columns\TextColumn::make('phone_no')
                    ->searchable()
                    ->label(__('all.phone_no')),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
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
