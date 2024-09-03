<?php

use ToneflixCode\Cuttly\CuttlyFacade as Cuttly;

beforeEach(function () {
    $this->link = 'https://facebook.com/marxemi';
}); //->skip('All tests in this file are temporarily disabled but they work');

test('can shorten link', function () {
    $create = Cuttly::team()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    Cuttly::team()->delete($create->shortLink);

    expect($create->fullLink)->toBe($this->link);
});

/**
 * Test if links can be edited
 */
test('can edit link', function () {
    $name = 'john'.rand();
    $create = Cuttly::team()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    $edit = Cuttly::team()->noTitle()->name($name)->edit($create->shortLink);
    Cuttly::team()->delete(explode('john', $create->shortLink)[0].$name);

    expect($edit->status)->toBe(1);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links can be deleted
 */
test('can delete link', function () {
    $create = Cuttly::team()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    $delete = Cuttly::team()->delete($create->shortLink);

    expect($delete->status)->toBe(1);
}); //->skip('temporarily disabled but it works.');

/**
 * Test if links stats can be aquired
 */
test('can get stats', function () {
    $create = Cuttly::team()->noTitle()->public()->name('john'.rand())->shorten($this->link);
    $stats = Cuttly::team()->stats($create->shortLink);
    Cuttly::team()->delete($create->shortLink);

    expect($stats->fullLink)->toBe($this->link);
    expect($stats->shortLink)->toBe($create->shortLink);
}); //->skip('temporarily disabled but it works.');
