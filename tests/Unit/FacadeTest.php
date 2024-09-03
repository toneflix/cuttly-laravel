<?php

use ToneflixCode\Cuttly\Facades\Cuttly;

test('can call Cuttly from facade', function () {
    expect(Cuttly::init())->toBeInstanceOf(\ToneflixCode\CuttlyPhp\Cuttly::class);
});
