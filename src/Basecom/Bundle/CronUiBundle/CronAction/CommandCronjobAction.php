<?php

namespace Basecom\Bundle\CronUiBundle\CronAction;

use Cocur\BackgroundProcess\BackgroundProcess;
use Symfony\Component\Process\Process;

/**
 * Basic cronjob action that just executes a given symfony console command.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
abstract class CommandCronjobAction implements CronAction
{
    /** @var string */
    private $basePath = '';

    /**
     * ExportCronjobAction constructor.
     *
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * Get the command which should be executed.
     *
     * @return string
     */
    abstract public function getCommand(): string;

    /**
     * Get the parameters for this command.
     *
     * @return array
     */
    public function getCommandParams(): array
    {
        return [];
    }

    /**
     * Should the job run in the background? This is useful for jobs which take longer
     * to execute.
     *
     * @return bool
     */
    public function runInBackground(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(): bool
    {
        $command = "{$this->getCommand()} {$this->convertParams()}";

        if ($this->runInBackground()) {
            return $this->startBackgroundProcess($command);
        }

        $process = new Process("{$this->basePath}/../bin/console {$command}", null, null, null, null);

        return $process->run() === 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel(): string
    {
        return $this->getCommand();
    }

    /**
     * Start the command in background.
     *
     * @param string $command
     *
     * @return bool
     */
    private function startBackgroundProcess(string $command): bool
    {
        $process = new BackgroundProcess("{$this->basePath}/../bin/console {$command}");

        try {
            $process->run();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Convert all parameters into the console format "key=value key2=value".
     *
     * @return string
     */
    private function convertParams(): string
    {
        $keyValue = collect($this->getCommandParams())->map(function ($value, $key) {
            $escaped = escapeshellarg($value);

            return "{$key}=${escaped}";
        })->toArray();

        return implode(' ', $keyValue);
    }
}
