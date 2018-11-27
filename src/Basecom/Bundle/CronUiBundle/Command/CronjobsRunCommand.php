<?php

namespace Basecom\Bundle\CronUiBundle\Command;

use Basecom\Bundle\CronUiBundle\Builder\CronjobBuilder;
use Basecom\Bundle\CronUiBundle\CronAction\Cronjob;
use Cron\CronExpression;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This is the primary command. This command should be scheduled to run every minute. It will
 * execute any overdue cronjobs.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
class CronjobsRunCommand extends Command
{
    /** @var CronjobBuilder */
    private $builder;

    /**
     * CronjobsRunCommand constructor.
     *
     * @param CronjobBuilder $builder
     */
    public function __construct(CronjobBuilder $builder)
    {
        parent::__construct(null);

        $this->builder = $builder;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->setName('cronjobs:run')
            ->setDescription('Execute any overdue cronjob actions.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        collect($this->builder->getCronjobs())->filter(function (Cronjob $job) {
            return CronExpression::factory($job->getCronExpression())->isDue();
        })->each(function (Cronjob $job) use ($output) {
            $output->writeln("Executing <comment>{$job->getLabel()}</comment>");
        })->each(function (Cronjob $job) {
            $job->execute();
        });
    }
}
