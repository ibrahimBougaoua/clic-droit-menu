<?php

namespace IbrahimBougaoua\ClicDroitMenu\Services;

use IbrahimBougaoua\ClicDroitMenu\Models\QuickAction;

class QuickActionService
{
    public static function getActions()
    {
        return QuickAction::active()->get();
    }
}
