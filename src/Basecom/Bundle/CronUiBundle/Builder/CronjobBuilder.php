<?php

namespace Basecom\Bundle\CronUiBundle\Builder;

use Basecom\Bundle\CronUiBundle\CronAction\CronAction;

/**
 * This class builds all cronjobs based on service tags and the database entities.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
class CronjobBuilder
{
    /** @var CronAction[] */
    private $cronjobs = [];

    /**
     * Add a new cronjob to the internal cronjob list.
     *
     * @param CronAction $action
     */
    public function addCronjob(CronAction $action): void
    {
        $this->cronjobs[] = $action;
    }

    /**
     * Get all cronjobs.
     *
     * @return CronAction[]
     */
    public function getCronjobs(): array
    {
        return $this->cronjobs;
    }
}