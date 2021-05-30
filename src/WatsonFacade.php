<?php

namespace EGALL\Watson;

use Illuminate\Support\Facades\Facade;

/**
 * IBM Watson Laravel facade.
 *
 * @author Erik Galloway <egalloway@claruscare.com>
 */
class WatsonFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'watson';
    }
}
