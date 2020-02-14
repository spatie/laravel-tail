<?php

namespace Spatie\Tail\Tests;

class TailCommandTest extends TestCase
{
    /** @test */
    public function it_will_throw_an_exception_if_the_given_environment_is_not_configured()
    {
        $this->expectExceptionMessageMatches('/^No configuration set/');

        $this->artisan('tail', [
           'environment' => 'non-existing-environment',
        ]);
    }
}