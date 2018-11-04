<?php

namespace Basecom\Bundle\CronUiBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * A custom compiler pass which will load all services, tagged with "basecom.cronjob" and add
 * them to the cronjob builder. So they don't need to be registred manually.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
class CronActionPass implements CompilerPassInterface
{
    /** @var string */
    private const BUILDER_ID = 'basecom.cron-ui.builder.cronjob';

    /** @var string */
    private const TAG_NAME = 'basecom.cronjob';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(static::BUILDER_ID)) {
            return;
        }

        $definition = $container->findDefinition(static::BUILDER_ID);

        $taggedServices = $container->findTaggedServiceIds(self::TAG_NAME);
        foreach ($taggedServices as $id => $tag) {
            $definition->addMethodCall('addCronjob', [new Reference($id)]);
        }
    }
}
