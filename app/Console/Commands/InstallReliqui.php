<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallReliqui extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reliqui:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simplify installation process';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('>> Welcome to the reliqui installation process! <<');

        $this->createEnvFile();

        $this->generateAppKey();

        $credentials = $this->requestDBCredentials();

        $this->updateEnvFile($credentials);

        if ($this->confirm('Do you want to migrate the database?', false)) {
            $this->migrateDbWithFreshCredentials($credentials);

            $this->line('~ Database successfully migrated.');
        }

        $this->call('cache:clear');

        $this->thanks();
    }

    /**
     * Display the completion message.
     *
     * @return void
     */
    protected function thanks()
    {
        $this->info('>> The installation process is complete. Happy coding! <<');
    }

    /**
     * Request the local database details from the user.
     *
     * @return void
     */
    protected function requestDBCredentials()
    {
        return [
            'DB_DATABASE' => $this->ask('Database name'),
            'DB_PORT'     => $this->ask('Database port', 3306),
            'DB_USERNAME' => $this->ask('Database user'),
            'DB_PASSWORD' => $this->secret('Database password ("null" for no password)'),
        ];
    }

    /**
     * Update the .env file.
     *
     * @param array $updatedValues
     * @return void
     */
    protected function updateEnvFile($updatedValues)
    {
        $envFile = $this->laravel->environmentFilePath();

        foreach ($updatedValues as $key => $value) {
            file_put_contents($envFile, preg_replace(
                "/{$key}=(.*)/",
                "{$key}={$value}",
                file_get_contents($envFile)
            ));
        }
    }

    /**
     * Generate app key.
     *
     * @return void
     */
    protected function generateAppKey()
    {
        if (strlen(config('app.key')) === 0) {
            $this->call('key:generate');

            $this->line('~ Secret key properly generated.');
        }
    }

    /**
     * create initial .env file.
     *
     * @return void
     */
    protected function createEnvFile()
    {
        if (! file_exists('.env')) {
            copy('.env.example', '.env');

            $this->line('.env file successfully created');
        }
    }

    /**
     * Migrate the db with the new credentials.
     *
     * @param array $credentials
     * @return void
     */
    protected function migrateDbWithFreshCredentials($credentials)
    {
        foreach ($credentials as $key => $value) {
            $configKey = strtolower(str_replace('DB_', '', $key));

            if ($configKey === 'password' && $value == 'null') {
                config(["database.connections.mysql.{$configKey}" => '']);

                continue;
            }

            config(["database.connections.mysql.{$configKey}" => $value]);
        }

        $this->call('migrate');
    }
}
