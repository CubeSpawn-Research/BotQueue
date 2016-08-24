<?php

use Illuminate\Support\Str;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    protected function assertContainsKey($needle, $haystack, $message = '', $ignoreCase = false, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
    {
        $this->assertContains($needle, array_keys($haystack), $message, $ignoreCase, $checkForObjectIdentity, $checkForNonObjectIdentity);
    }

    protected function assertContainsJson($data, $actual, $negate = false) {
        $method = $negate ? 'assertFalse' : 'assertTrue';

        $actual = json_encode(array_sort_recursive(
            (array) $actual
        ));

        foreach (array_sort_recursive($data) as $key => $value) {
            $expected = $this->formatToExpectedJson($key, $value);

            $this->{$method}(
                Str::contains($actual, $expected),
                ($negate ? 'Found unexpected' : 'Unable to find')." JSON fragment [{$expected}] within [{$actual}]."
            );
        }
    }
}
