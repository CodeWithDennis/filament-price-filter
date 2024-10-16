<?php

namespace CodeWithDennis\FilamentPriceFilter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CodeWithDennis\FilamentPriceFilter\FilamentPriceFilter
 */
class FilamentPriceFilter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \CodeWithDennis\FilamentPriceFilter\FilamentPriceFilter::class;
    }
}
