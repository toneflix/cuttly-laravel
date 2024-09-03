<?php

test('can publish config', function () {
    $this->artisan('vendor:publish --tag="cuttly-config"')
        ->assertExitCode(0);
});