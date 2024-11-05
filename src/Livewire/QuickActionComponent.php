<?php

namespace IbrahimBougaoua\ClicDroitMenu\Livewire;

use App\Models\QuickActionSetting;
use IbrahimBougaoua\ClicDroitMenu\Services\QuickActionService;
use Livewire\Component;

class QuickActionComponent extends Component
{
    public $menus = [];
    public $setting;

    public function mount()
    {
        $this->setting = QuickActionSetting::first();
        $this->menus = QuickActionService::getActions();
    }

    public function render()
    {
        return view('clic-droit-menu::livewire.quick-action-component');
    }
}
