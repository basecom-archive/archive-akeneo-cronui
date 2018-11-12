<?php

namespace Basecom\Bundle\CronUiBundle\Repository;

use Basecom\Bundle\CronUiBundle\Entity\Cronjob;
use Doctrine\ORM\EntityManager;
use Pim\Bundle\CustomEntityBundle\Entity\Repository\CustomEntityRepository;

/**
 * @author Jordan Kniest <j.kniest@basecom.de>
 *
 * Repository for the cronjob entity.
 */
class CronjobRepository extends CustomEntityRepository
{
    /**
     * CronjobRepository constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em, $em->getClassMetadata(Cronjob::class));
    }
}
