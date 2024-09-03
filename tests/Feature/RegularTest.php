<?php

use ToneflixCode\Cuttly\Facades\Cuttly;

beforeEach(function () {
    $this->link = 'https://facebook.com/marxemi';
}); //->skip('All tests in this file are temporarily disabled but they work');

test('can shorten link', function () {
    $create = Cuttly::regular()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    Cuttly::regular()->delete($create->shortLink);

    expect($create->fullLink)->toBe($this->link);
}); //->skip('temporarily disabled but it works.');

test('can shorten link with minimal params', function () {
    $create = Cuttly::regular()->shorten($this->link);
    Cuttly::regular()->delete($create->shortLink);

    expect($create->fullLink)->toBe($this->link);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links can be edited
 */
test('can edit link', function () {
    $name = 'john'.rand();
    $create = Cuttly::regular()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    $edit = Cuttly::regular()->noTitle()->name($name)->edit($create->shortLink);
    Cuttly::regular()->delete(explode('john', $create->shortLink)[0].$name);

    expect($edit->status)->toBe(1);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links can be deleted
 */
test('can delete link', function () {
    $create = Cuttly::regular()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    $delete = Cuttly::regular()->delete($create->shortLink);

    expect($delete->status)->toBe(1);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links stats can be aquired
 */
test('can get stats', function () {
    $create = Cuttly::regular()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    $stats = Cuttly::regular()->stats($create->shortLink);
    Cuttly::regular()->delete($create->shortLink);

    expect($stats->fullLink)->toBe($this->link);
    expect($stats->shortLink)->toBe($create->shortLink);
}); //->skip('temporarily disabled but it works.');
