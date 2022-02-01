<?php

namespace App\Main\Obis;

use Illuminate\Support\Collection;

interface ObisInterface
{
    public function getHexCodes(): Collection;

    public function getDecimalCodes(): Collection;
}
