<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    // Main Title
    public static function getPluralModelLabel(): string
    {
        return __('user.labels');
    }

    public static function getModelLabel(): string
    {
        return __('user.label');
    }


    // Group Name
    public static function getNavigationGroup(): string
    {
        return __('user.group');
    }

    protected static bool $shouldRegisterNavigation = true;

    protected static ?int $navigationSort = 11;

    public static function getGloballySearchableAttributes(): array
    {
        return ['email','name'];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'update_password',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(191)
                    ->label(__('user.name')),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(191)
                    ->label(__('user.email')),
                Grid::make(2)->schema([
                    TextInput::make('password')
                        ->password()
                        ->confirmed()
                        ->required()
                        ->hiddenOn(['edit', 'view'])
                        ->label(__('user.password')),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->required()
                        ->hiddenOn(['edit', 'view'])
                        ->label(__('user.password_confirmation')),
                ]),
                Select::make('roles')
                    // ->options(Role::where('name', '!=', 'super_admin')->pluck('name', 'id'))
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->multiple()
                    ->preload()
                    ->columnSpanFull()
                    ->label(__('user.roles')),
                Forms\Components\DateTimePicker::make('created_at')
                    ->hiddenOn(['create', 'edit'])
                    ->label(__('user.created_at')),
                Forms\Components\DateTimePicker::make('updated_at')
                    ->hiddenOn(['create', 'edit'])
                    ->label(__('user.updated_at')),
            ]);
    }

    public static function table(Table $table): Table
    {
        $actions = [
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ];
        if(auth()->user()->can('update_password_user')){
            $actions[] = Action::make('Change password')
            ->label(__('user.change_password'))
            ->icon('heroicon-o-shield-check')
            ->form([
                Grid::make(2)->schema([
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->minLength(8)
                        ->confirmed()
                        ->label(__('user.password')),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->required()
                        ->password()
                        ->label(__('user.password_confirmation')),
                ]),
            ])
            ->action(function (array $data, $record) {
                $record->update([
                    'password' => Hash::make($data['password']),
                ]);
            });
        }

        $actions[] = Tables\Actions\DeleteAction::make();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label(__('user.name')),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label(__('user.email')),
                TextColumn::make('roles.name')
                ->label(__('user.roles')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('user.created_at')),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->label(__('user.roles')),
            ])
            ->actions([
                ActionGroup::make([
                    ...$actions
                ]),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsers::route('/'),
        ];
    }
}
