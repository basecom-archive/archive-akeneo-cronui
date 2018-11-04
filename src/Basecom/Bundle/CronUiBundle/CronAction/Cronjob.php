<?php

namespace Basecom\Bundle\CronUiBundle\CronAction;

/**
 * Basic interface for all cronjobs.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
interface Cronjob
{
    /** @var string */
    public const YEARLY = '@yearly';

    /** @var string */
    public const MONTHLY = '@monthly';

    /** @var string */
    public const WEEKLY = '@weekly';

    /** @var string */
    public const DAILY = '@daily';

    /** @var string */
    public const HOURLY = '@hourly';

    /** @var string */
    public const MINUTELY = '* * * * *';

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

    /**
     * Get the label that is used on the front-end and console output.
     *
     * @return string
     */
    public function getLabel(): string;
}
