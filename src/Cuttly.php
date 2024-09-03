<?php

namespace ToneflixCode\Cuttly;

use ToneflixCode\CuttlyPhp\Cuttly as CuttlyPhp;

class Cuttly extends CuttlyPhp
{
    public function __construct()
    {
        $this->apiKey = config('cuttly.key');
        $this->teamApiKey = config('cuttly.team_key');
    }
}
