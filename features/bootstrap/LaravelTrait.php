# features/bootstrap/LaravelTrait.php

<?php

use Illuminate\Foundation\Testing\ApplicationTrait;

trait LaravelTrait
{
    /**
     * Responsible for providing a Laravel app instance.
     */
    use ApplicationTrait;

    /**
     * @BeforeScenario
     */
    public function setUp()
    {
        if ( ! $this->app)
        {
            $this->refreshApplication();
        }
    }

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

        return require __DIR__.'/../../bootstrap/start.php';
    }
}