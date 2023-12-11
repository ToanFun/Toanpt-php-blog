<?php

use Illuminate\Support\Carbon;

/**
 * Return a formatted Carbon date.
 */
function customizeDate(Carbon $date, string $format = 'd F Y'): string
{
    return $date->format($format);
}