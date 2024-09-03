<?php

use ToneflixCode\Cuttly\Cuttly;

beforeEach(function () {
    $this->link = 'https://facebook.com/marxemi';
}); //->skip('All tests in this file are temporarily disabled but they work');

test('can shorten link', function () {
    $cuttly = new Cuttly();

    $create = $cuttly->team()->noTitle()->public()->name('john' . rand())->shorten($this->link);
    $cuttly->team()->delete($create->shortLink);

    expect($create->fullLink)->toBe($this->link);
});

/**
 * Test if links can be edited
 */
test('can edit link', function () {
    $name = 'john' . rand();
    $cuttly = new Cuttly();

    $create = $cuttly->team()->noTitle()->public()->name('john' . rand())->shorten($this->link);
    $edit = $cuttly->team()->noTitle()->name($name)->edit($create->shortLink);
    $cuttly->team()->delete(explode('john', $create->shortLink)[0] . $name);

    expect($edit->status)->toBe(1);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links can be deleted
 */
test('can delete link', function () {
    $cuttly = new Cuttly();

    $create = $cuttly->team()->noTitle()->public()->name('john' . rand())->shorten($this->link);
    $delete = $cuttly->team()->delete($create->shortLink);

    expect($delete->status)->toBe(1);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links stats can be aquired
 */
test('can get stats', function () {
    $cuttly = new Cuttly();

    $create = $cuttly->team()->noTitle()->public()->name('john' . rand())->shorten($this->link);
    $stats = $cuttly->team()->stats($create->shortLink);
    $cuttly->team()->delete($create->shortLink);

    expect($stats->fullLink)->toBe($this->link);
    expect($stats->shortLink)->toBe($create->shortLink);
}); //->skip('temporarily disabled but it works.');