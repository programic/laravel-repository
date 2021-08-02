<?php

namespace Programic\Repository\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle()
    {
        $className = Str::studly($this->argument('repository'));
        $fileName = $className . '.php';

        $stub = File::get(__DIR__ . '/../../stubs/repository.php.stub');
        $stub = str_replace('REPOSITORY_NAME', $className, $stub);

        $path = base_path() . '/app/Repositories';

        File::isDirectory($path) or File::makeDirectory($path);
        File::put($path . '/' . $fileName, $stub);

        $this->line('<info>Repository created:</info> ' . $fileName);
    }
}
