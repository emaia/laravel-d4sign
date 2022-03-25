<?php

it('can run command', function () {
    $this->artisan('d4sign:test')->assertSuccessful();
});
