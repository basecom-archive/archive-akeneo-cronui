<?php

namespace Basecom\Bundle\CronUiBundle\Builder;

use Basecom\Bundle\CronUiBundle\CronAction\Cronjob;
use Basecom\Bundle\CronUiBundle\CronAction\DatabaseCronjob;
use Basecom\Bundle\CronUiBundle\Entity\Cronjob as CronjobEntity;
use Basecom\Bundle\CronUiBundle\Repository\CronjobRepository;

/**
 * This class builds all cronjobs based on service tags and the database entities.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
class CronjobBuilder
{
    /** @var Cronjob[] */
    private $cronjobs = [];

    /** @var DatabaseCronjob[]|null */
    private $databaseCronjobs = null;

    /** @var CronjobRepository */
    private $repository;

    /** @var string */
    private $basePath;

    /**
     * CronjobBuilder constructor.
     *
     * @param CronjobRepository $repository
     * @param string            $basePath
     */
    public function __construct(CronjobRepository $repository, string $basePath)
    {
        $this->repository = $repository;
        $this->basePath   = $basePath;
    }

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
        if (!$this->databaseCronjobs) {
            $this->getDatabaseCronjobs();
        }

        return array_merge($this->cronjobs, $this->databaseCronjobs);
    }

    /**
     * Fetch all cronjobs from the database.
     */
    private function getDatabaseCronjobs(): void
    {
        $entities = $this->repository->findAll();

        $this->databaseCronjobs = collect($entities)->map(function (CronjobEntity $cronjob) {
            return new DatabaseCronjob($cronjob, $this->basePath);
        })->toArray();
    }
}
