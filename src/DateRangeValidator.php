<?php declare(strict_types=1);

namespace Vojtamaniak\DateValidator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DateRangeValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     * @throws \InvalidArgumentException
     */
    public function validate($value, Constraint $constraint)
    {
        if ($value instanceof \DateTime)
            $value = $value->getTimestamp();
        else if (is_string($value))
            $value = strtotime($value);

        if($constraint->getMax() != null && $value > $constraint->getMax()->getTimestamp()){
            $this->context->buildViolation($constraint->getMessage())
                ->setParameter("{{ min }}", $constraint->getMin()->format('c'))
                ->setParameter("{{ max }}", $constraint->getMax()->format('c'))
                ->addViolation();
        }
        elseif($constraint->getMin() != null && $value < $constraint->getMin()->getTimestamp()){
            $this->context->buildViolation($constraint->getMessage())
                ->setParameter("{{ min }}", $constraint->getMin()->format('c'))
                ->setParameter("{{ max }}", $constraint->getMax()->format('c'))
                ->addViolation();
        }
    }
}