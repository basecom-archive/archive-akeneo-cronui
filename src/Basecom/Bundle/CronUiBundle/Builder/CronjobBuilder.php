<?php

namespace Basecom\Bundle\CronUiBundle\Builder;

use Basecom\Bundle\CronUiBundle\CronAction\Cronjob;

/**
 * This class builds all cronjobs based on service tags and the database entities.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
class CronjobBuilder
{
    /** @var Cronjob[] */
    private $cronjobs = [];

    /**
     * Add a new cronjob to the internal cronjob list.
     *
     * @param Cronjob $action
     */
    public function addCronjob(Cronjob $action): void
    {
        $this->cronjobs[] = $action;
    }

    /**
     * Get all cronjobs.
     *
     * @return Cronjob[]
     */
    public function getCronjobs(): array
    {
        return $this->cronjobs;
    }
}
