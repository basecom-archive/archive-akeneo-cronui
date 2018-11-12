<?php

namespace Basecom\Bundle\CronUiBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 * @author Jordan Kniest <j.kniest@basecom.de>
 *
 * Contraint message for the custom "cron expression" constraint.
 */
class CronExpression extends Constraint
{
    /** @var string */
    public $message = 'The expression "{{ string }}" is invalid.';
}
