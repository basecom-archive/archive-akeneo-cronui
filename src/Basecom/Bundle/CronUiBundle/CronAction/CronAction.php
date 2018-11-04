<?php

namespace Basecom\CronUi\CronAction;

/**
 * Basic interface for all cron actions.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
interface CronAction
{
    /**
     * Get the expression in cron format.
     * More information: http://www.nncron.ru/help/EN/working/cron-format.htm.
     *
     * @return string
     */
    public function getCronExpression(): string;

    /**
     * The logic to execute this cronjob action. It must return true, if the job
     * succeed or false if it has failed.
     *
     * @return bool
     */
    public function execute(): bool;
}
