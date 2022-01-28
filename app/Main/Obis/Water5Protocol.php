<?php

namespace App\Main\Obis;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Water5Protocol implements ObisInterface
{
    private \Illuminate\Support\Collection $codes;

    public function __construct()
    {
        $this->codes = collect(config('main.obis'))->filter(fn($value, $key) => !Str::start($key, '01'));
    }

    public function getHexCodes(): Collection
    {
        return $this->codes->values();
    }

    public function getDecimalCodes(): Collection
    {
        return $this->codes->keys();
    }
}
