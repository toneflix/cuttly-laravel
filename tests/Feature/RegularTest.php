<?php

use ToneflixCode\Cuttly\Cuttly;

beforeEach(function () {
    $this->link = 'https://facebook.com/marxemi';
}); //->skip('All tests in this file are temporarily disabled but they work');

test('can shorten link', function () {
    $cuttly = new Cuttly;

    $create = $cuttly->regular()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    $cuttly->regular()->delete($create->shortLink);

    expect($create->fullLink)->toBe($this->link);
}); //->skip('temporarily disabled but it works.');

test('can shorten link with minimal params', function () {
    $cuttly = new Cuttly;

    $create = $cuttly->regular()->shorten($this->link);
    $cuttly->regular()->delete($create->shortLink);

    expect($create->fullLink)->toBe($this->link);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links can be edited
 */
test('can edit link', function () {
    $name = 'john'.rand();
    $cuttly = new Cuttly;

    $create = $cuttly->regular()->noTitle()->public()->name('john1'.rand())->shorten($this->link);
    $edit = $cuttly->regular()->noTitle()->name($name)->edit($create->shortLink);
    $cuttly->regular()->delete(explode('john', $create->shortLink)[0].$name);

    expect($edit->status)->toBe(1);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links can be deleted
 */
test('can delete link', function () {
    $cuttly = new Cuttly;

    $create = $cuttly->regular()->noTitle()->public()->name('john2'.rand())->shorten($this->link);
    $delete = $cuttly->regular()->delete($create->shortLink);

    expect($delete->status)->toBe(1);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links stats can be aquired
 */
test('can get stats', function () {
    $cuttly = new Cuttly;

    $create = $cuttly->regular()->noTitle()->public()->name('john2'.rand())->shorten($this->link);
    $stats = $cuttly->regular()->stats($create->shortLink);
    $cuttly->regular()->delete($create->shortLink);

    expect($stats->fullLink)->toBe($this->link);
    expect($stats->shortLink)->toBe($create->shortLink);
}); //->skip('temporarily disabled but it works.');
