<?php

use Modules\Pages\Models\Page;

uses(Tests\TestCase::class);

test('can see single page', function () {
    $page = Page::factory()->create();
    $this->get(route('pages.show', $page->slug))->assertOk();
});
