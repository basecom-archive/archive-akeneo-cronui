<?php

namespace Basecom\Bundle\CronUiBundle\CronAction;

/**
 * This cronjob actions is able to execute any job. It dispatches it to the queue.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
abstract class JobCronjobAction extends CommandCronjobAction
{
    /**
     * Get the name of the job, which should be executed.
     *
     * @return string
     */
    abstract public function getJobName(): string;

    /**
     * Get all parameters for the given job. This method must not be overridden.
     *
     * @return array
     */
    public function getJobParams(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getCommand(): string
    {
        return "akeneo:batch:publish-job-to-queue {$this->getJobName()}";
    }

    /**
     * {@inheritdoc}
     */
    public function getCommandParams(): array
    {
        if (count($this->getJobParams()) === 0) {
            return [];
        }

        return [
            '--config' => json_encode($this->getJobParams()),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel(): string
    {
        return $this->getJobName();
    }
}
