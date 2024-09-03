<?php

use ToneflixCode\Cuttly\CuttlyFacade as Cuttly;

test('can call Cuttly from facade', function () {
    expect(Cuttly::init())->toBeInstanceOf(\ToneflixCode\CuttlyPhp\Cuttly::class);
});