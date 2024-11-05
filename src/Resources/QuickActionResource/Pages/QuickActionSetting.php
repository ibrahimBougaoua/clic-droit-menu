<?php

namespace IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use IbrahimBougaoua\ClicDroitMenu\Models\QuickActionSetting as QuickActionSettings;
use IbrahimBougaoua\ClicDroitMenu\Resources\QuickActionResource;

class QuickActionSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = QuickActionResource::class;

    public ?array $data = [];

    public function mount(): void
    {
        $existingSettings = QuickActionSettings::first();

        if ($existingSettings) {
            $this->form->fill($existingSettings->toArray());
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('quick-actions')
                ->label(__('Quick Actions'))
                ->icon('heroicon-o-bars-4')
                ->color('primary')
                ->url(fn (): string => route('filament.admin.resources.quick-actions.index')),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('header_label')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('header_url')
                            ->maxLength(255),
                        TextInput::make('header_icon')
                            ->maxLength(255),
                        ColorPicker::make('header_back_color')
                            ->label(__('background color')),
                        ColorPicker::make('header_btn_color')
                            ->label(__('button Color')),
                        Toggle::make('header_status')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
                Section::make()
                    ->schema([
                        Toggle::make('search_status')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make()
                    ->schema([
                        TextInput::make('footer_label')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('footer_icon')
                            ->maxLength(255),
                        ColorPicker::make('footer_btn_color')
                            ->label(__('Color')),
                        Toggle::make('footer_status')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
                Section::make()
                    ->schema([
                        TextInput::make('max_items')
                            ->required()
                            ->numeric()
                            ->default(5),
                        TextInput::make('max_sub_items')
                            ->required()
                            ->numeric()
                            ->default(5),
                        Toggle::make('is_collapsed')
                            ->required(),
                        Toggle::make('is_global')
                            ->required(),
                        Toggle::make('status')
                            ->required(),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function update(): void
    {
        QuickActionSettings::updateOrCreate(
            ['id' => 1], $this->form->getState()
        );
    }

    protected static string $view = 'filament.resources.quick-action-resource.pages.quick-action-setting';
}
