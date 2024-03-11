<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SetupDatabase extends Command
{
    protected $signature = 'db:setup';

    protected $description = 'Setup the application';

    public function handle()
    {
        $this->info('Welcome to the application setup.');

        if ($this->confirm('Do you want to create a new database?', true)) {
            if ($this->confirm('Do you want to use mysql?', true)) {
                $host     = $this->ask('Database Host (default: 127.0.0.1)', '127.0.0.1');
                $port     = $this->ask('Database Port (default: 3306)', '3306');
                $database = $this->ask('Database Name');
                $username = $this->ask('Database Username (default: root)', 'root');
                $password = $this->secret("Database Password (default: 'blank')", '');

                // Create the database
                try {
                    $this->createDatabase($host, $port, $database, $username, $password);
                } catch (\Exception $e) {
                    $this->error('Error creating database: ' . $e->getMessage());
                    return;
                }

                $this->updateEnvironmentFile([
                    "DB_CONNECTION"  => 'mysql',
                    "DB_HOST"        => $host,
                    "DB_PORT"        => $port,
                    "DB_DATABASE"    => $database,
                    "DB_USERNAME"    => $username,
                    "DB_PASSWORD"    => $password,
                ]);

                $this->info('Database configuration saved successfully.');
                if ($this->confirm('Do you want to run the migration?', true)) {
                    $this->runMigration();
                    $this->info('Database migration run successfully.');
                }
            } else {
                $this->info('Skipping database setup.');
            }
        } else {
            $this->info('Skipping database setup.');
        }
    }

    protected function runMigration()
    {
        Artisan::call('migrate');
    }

    protected function createDatabase($host, $port, $database, $username, $password)
    {
        // Connect to MySQL without specifying a database name
        $pdo = new \PDO("mysql:host={$host};port={$port}", $username, $password);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        // Create the database if it doesn't exist
        $statement = $pdo->prepare("CREATE DATABASE IF NOT EXISTS `{$database}`");
        $statement->execute();
    }


    protected function updateEnvironmentFile(array $data)
    {
        $envFile = base_path('.env');

        foreach ($data as $key => $value) {
            $key  = strtoupper($key);
            $pair = "{$key}={$value}";

            // Read existing content of the .env file
            $contents = file_get_contents($envFile);

            // Check if the key exists in the .env file
            if (strpos($contents, "{$key}=") !== false) {
                // Key exists, update its value
                $contents = preg_replace("/^{$key}=.*/m", $pair, $contents);
            } else {
                // Key does not exist, append the new key-value pair
                $contents .= "\n{$pair}";
            }

            // Write the updated content back to the .env file
            file_put_contents($envFile, $contents);
        }
    }
}
