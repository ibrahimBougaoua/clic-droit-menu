<?php

namespace IbrahimBougaoua\ClicDroitMenu\Resources;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use IbrahimBougaoua\ClicDroitMenu\Models\QuickAction;
use IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource\Pages;
use IbrahimBougaoua\ClicDroitMenu\Services\HeroiconService;
use IbrahimBougaoua\ClicDroitMenu\Services\RoutesService;

class QuickActionResource extends Resource
{
    protected static ?string $model = QuickAction::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-4';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(255)
                            ->label(__('Label'))
                            ->columnSpanFull(),
                        //Hidden::make('url'),
                        //Hidden::make('icon'),
                        Tabs::make('Tabs')
                            ->label(__('Url'))
                            ->tabs([
                                Tabs\Tab::make('Default')
                                    ->schema([
                                        Select::make('url')
                                            ->label(__('Url'))
                                            ->options(
                                                RoutesService::getResourceRoutes()
                                            )
                                            ->reactive()
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('url', $state))
                                            ->searchable(),
                                        Select::make('icon')
                                            ->label(__('Icon'))
                                            ->options(HeroiconService::getIcons())
                                            ->reactive() // Make the field reactive
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('icon', $state)) // Track the selected icon
                                            ->searchable(),
                                    ])
                                    ->columns(2),
                                Tabs\Tab::make('Custom')
                                    ->schema([
                                        TextInput::make('url')
                                            ->maxLength(255)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('url', $state))
                                            ->label(__('Url')),
                                        TextInput::make('icon')
                                            ->maxLength(255)
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('url', $state))
                                            ->label(__('Icon')),
                                    ])
                                    ->columns(2),
                            ])
                            ->columnSpanFull(),
                        TextInput::make('badge_text')
                            ->maxLength(255)
                            ->label(__('Badge Value')),
                        ColorPicker::make('badge_color')
                            ->label(__('Badge Color')),
                        Select::make('parent_id')
                            ->label(__('Action'))
                            ->options(QuickAction::pluck('label', 'id')->toArray())
                            ->searchable()
                            ->label(__('Action')),
                        Toggle::make('status')
                            ->required()
                            ->label(__('Status')),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->searchable()
                    ->badge()
                    ->color('success')
                    ->label(__('Label')),
                TextColumn::make('url')
                    ->searchable()
                    ->badge()
                    ->color('primary')
                    ->label(__('Url')),
                TextColumn::make('badge_text')
                    ->searchable()
                    ->badge()
                    ->color('success')
                    ->label(__('Badge Value')),
                ColorColumn::make('badge_color')
                    ->searchable()
                    ->label(__('Badge Color')),
                TextColumn::make('parent.label')
                    ->badge()
                    ->color('success')
                    ->default(__('Root'))
                    ->sortable()
                    ->label(__('Parent')),
                ToggleColumn::make('status')
                    ->label(__('Status')),
                TextColumn::make('created_at')
                    ->dateTime('d, M Y h:s A')
                    ->badge()
                    ->color('success')
                    ->label(__('Created at')),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListQuickActions::route('/'),
            'quick-action-setting' => Pages\QuickActionSetting::route('/quick-action-setting'),
            //'create' => Pages\CreateQuickAction::route('/create'),
            //'edit' => Pages\EditQuickAction::route('/{record}/edit'),
        ];
    }
}
