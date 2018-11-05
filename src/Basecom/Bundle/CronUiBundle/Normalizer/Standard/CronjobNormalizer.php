<?php

namespace Basecom\Bundle\CronUiBundle\Normalizer\Standard;

use Basecom\Bundle\CronUiBundle\Entity\Cronjob;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Default normalizer for the cronjob entity.
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 */
class CronjobNormalizer implements NormalizerInterface
{
    /** @var string[] */
    protected $supportedFormats = ['standard', 'flat'];

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        /* @var Cronjob $object */
        return [
            'id'         => $object->getId(),
            'code'       => $object->getCode(),
            'command'    => $object->getCommand(),
            'expression' => $object->getExpression(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Cronjob && in_array($format, $this->supportedFormats, true);
    }
}
