<?php

namespace Basecom\Bundle\CronUiBundle\Validator\Constraint;

use Cron\CronExpression;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @author Jordan Kniest <j.kniest@basecom.de>
 *
 * Validates that the given cron expression is valid. Since there are like 100000 different
 * possibilities to contruct these expressions (and special cases like @daily, etc.) we just
 * throw it into the cron library and see if it throws an exception.
 */
class CronExpressionValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint): void
    {
        try {
            CronExpression::factory($value);
        } catch (\InvalidArgumentException $e) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
