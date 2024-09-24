<?php

namespace IbrahimBougaoua\ClicDroitMenu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IbrahimBougaoua\ClicDroitMenu\ClicDroitMenu
 */
class ClicDroitMenu extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \IbrahimBougaoua\ClicDroitMenu\ClicDroitMenu::class;
    }
}
