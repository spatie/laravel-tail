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

    /** @test */
    public function the_tail_command_is_correct()
    {
        $this
            ->artisan('tail', [
                '--debug' => true,
            ])
            ->expectsOutput('\\tail -f -n 0 "`\\ls -t | \\head -1`"');
    }

    /** @test */
    public function the_tail_command_with_file_is_correct()
    {
        $this
            ->artisan('tail', [
                '--debug' => true,
                '--file' => 'file.log',
            ])
            ->expectsOutput('\\tail -f -n 0 "file.log"');
    }

    /** @test */
    public function the_command_when_grepping_is_correct()
    {
        $this
            ->artisan('tail', [
                '--debug' => true,
                '--grep' => 'test',
            ])
            ->expectsOutput('\\tail -f -n 0 "`\\ls -t | \\head -1`" | \\grep "test"');
    }
}
