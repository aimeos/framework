<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Console\Generators\Concerns\ResolvesPresetStubs;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:job')]
class JobMakeCommand extends GeneratorCommand
{
    use CreatesMatchingTest,
        ResolvesPresetStubs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new job class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Job';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('sync')
                        ? $this->resolveStubPath('job.stub')
                        : $this->resolveStubPath('job.queued.stub');
    }

    /**
     * Resolve the default fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveDefaultStubPath($stub)
    {
        return __DIR__."/stubs/{$stub}";
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Jobs';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the job already exists'],
            ['sync', null, InputOption::VALUE_NONE, 'Indicates that job should be synchronous'],
        ];
    }
}
