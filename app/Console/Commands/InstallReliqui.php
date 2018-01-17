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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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

        $this->updateEnvFile($this->requestDBCredentials());

        if ($this->confirm('Do you want to migrate the database?', false)) {
            $this->call('migrate');

            $this->line('~ Database migrated.');
        }

        $this->call('cache:clear');

        $this->thanks();
    }

    protected function thanks()
    {
        $this->info('>> The installation process is complete. Happy coding! <<');
    }

    protected function requestDBCredentials()
    {
        return [
            'DB_DATABASE' => $this->ask('Database name'),
            'DB_USERNAME' => $this->ask('Database user'),
            'DB_PASSWORD' => $this->secret('Database password ("null" for no password)'),
        ];
    }

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

    protected function generateAppKey()
    {
        if (strlen(config('app.key')) === 0) {
            $this->call('key:generate');

            $this->line('~ Secret key properly generated.');
        }
    }

    protected function createEnvFile()
    {
        if (! file_exists('.env')) {
            copy('.env.example', '.env');

            $this->line('.env file successfully created');
        }
    }
}
