<?php

namespace Basecom\Bundle\CronUiBundle;

use Basecom\Bundle\CronUiBundle\DependencyInjection\Compiler\CronActionPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * This bundle provides an UI for managing Cronjobs in Akeneo.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
class BasecomCronUiBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new CronActionPass());
    }
}
