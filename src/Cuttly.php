<?php

namespace ToneflixCode\Cuttly;

class Cuttly
{
    protected $key;

    public function __construct()
    {
        $this->key = config('cuttly.key');
    }

    public function build()
    {
        http_build_query([]);
    }
}