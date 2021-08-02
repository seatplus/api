<?php

namespace Seatplus\Api\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Seatplus\Auth\AuthenticationServiceProvider;
use Seatplus\Auth\Models\User;
use Seatplus\Api\ApiServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Seatplus\\Api\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            ApiServiceProvider::class,
            AuthenticationServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        // Use memory SQLite, cleans it self up
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        config(['app.debug' => true]);

        //$app['router']->aliasMiddleware('auth', Authenticate::class);

        // Use test User model for users provider
        $app['config']->set('auth.providers.users.model', User::class);

        $app['config']->set('cache.prefix', 'seatplus_tests---');

        //Setup Inertia for package development
        /*config()->set('inertia.testing.page_paths', array_merge(
            config()->get('inertia.testing.page_paths', []),
            [
                realpath(__DIR__ . '/../src/resources/js/Pages'),
                realpath(__DIR__ . '/../src/resources/js/Shared')
            ],
        ));*/
    }

    /**
     * Resolve application HTTP Kernel implementation.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function resolveApplicationHttpKernel($app)
    {
        //$app->singleton('Illuminate\Contracts\Http\Kernel', Kernel::class);
    }

    /**
     * @param \Illuminate\Foundation\Application  $app
     */
    private function setupDatabase($app)
    {
        // Path to our migrations to load
        //$this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->artisan('migrate', ['--database' => 'testbench']);
    }
}
