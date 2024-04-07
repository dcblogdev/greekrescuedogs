<?php

test('can see dashboard as admin regardless of permission', function () {
    $this->authenticate();
    $this->get(route('dashboard'))->assertOk();
});
