<?php

namespace Erikgall\IbmWatsonSdk;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Erikgall\IbmWatsonSdk\Skeleton\SkeletonClass
 */
class IbmWatsonSdkFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ibm-watson-sdk';
    }
}
