<?php

namespace IbrahimBougaoua\ClicDroitMenu\Livewire;

use IbrahimBougaoua\ClicDroitMenu\Services\QuickActionService;
use Livewire\Component;

class QuickActionComponent extends Component
{
    public $menus = [];

    public function mount()
    {
        $this->menus = QuickActionService::getActions();
    }

    public function render()
    {
        return view('clic-droit-menu::livewire.quick-action-component');
    }
}
