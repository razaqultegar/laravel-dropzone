<?php

namespace RazaqulTegar\Dropzone\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \RazaqulTegar\Dropzone\Dropzone getFile()
 * 
 * @see \RazaqulTegar\Dropzone\Dropzone
 */
class Dropzone extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'dropzone';
    }
}
