<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers;
use App\Models\Account;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Account Name')
                    ->required(),

                Forms\Components\TextInput::make('reference')
                    ->label('Reference')
                    ->required(),

                Forms\Components\Select::make('type')
                    ->label('Account Type')
                    ->options([
                        'Owner' => 'Owner',
                        'Guest' => 'Guest',
                        'User' => 'User',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('docs')
                    ->label('Documents')
                    ->placeholder('Comma-separated documents')
                    ->dehydrateStateUsing(function ($state) {
                        if (is_string($state)) {
                            return array_map('trim', explode(',', $state));
                        }
                        return $state;
                    })
                    ->mutateDehydratedStateUsing(function ($state) {
                        return is_array($state) ? $state : [];
                    }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Account Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reference')
                    ->label('Reference'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->date(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
