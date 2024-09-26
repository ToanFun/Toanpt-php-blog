<?php

use Illuminate\Support\Carbon;

/**
 * Return a Carbon instance.
 */
function parseTextToDate(string $parseString = '', string $tz = null): Carbon
{
    return new Carbon($parseString, $tz);
}

/**
 * Return a formatted Carbon date.
 */
function customizeDate(Carbon $date, string $format = 'd F Y'): string
{
    return $date->format($format);
}
