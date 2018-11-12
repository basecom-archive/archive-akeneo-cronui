<?php

namespace Basecom\Bundle\CronUiBundle\CronAction;

use Basecom\Bundle\CronUiBundle\Entity\Cronjob as CronjobEntity;
use Cocur\BackgroundProcess\BackgroundProcess;

/**
 * @author Jordan Kniest <j.kniest@basecom.de>
 *
 * This class is used for cronjobs which are saved as entities in the database.
 * By default every database cronjob will run in background.
 */
class DatabaseCronjob implements Cronjob
{
    /** @var CronjobEntity */
    private $entity;

    /** @var string */
    private $basePath;

    /**
     * DatabaseCronjob constructor.
     *
     * @param CronjobEntity $entity
     * @param string        $basePath
     */
    public function __construct(CronjobEntity $entity, string $basePath)
    {
        $this->entity   = $entity;
        $this->basePath = $basePath;
    }

    /**
     * Get the expression in cron format.
     * More information: http://www.nncron.ru/help/EN/working/cron-format.htm.
     *
     * @return string
     */
    public function getCronExpression(): string
    {
        return $this->entity->getExpression();
    }

    /**
     * The logic to execute this cronjob action. It must return true, if the job
     * succeed or false if it has failed.
     *
     * @return bool
     */
    public function execute(): bool
    {
        $process = new BackgroundProcess(
            "cd {$this->basePath}/.. && {$this->entity->getCommand()} &"
        );

        try {
            $process->run();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the label that is used on the front-end and console output.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->entity->getCode();
    }
}
