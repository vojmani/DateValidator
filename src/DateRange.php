<?php declare(strict_types=1);

namespace Vojtamaniak\DateValidator;


use Symfony\Component\Validator\Constraint;

/**
 * Class DateRange
 * @package Vojtamaniak\DateRange
 * @Annotation
 */
class DateRange extends Constraint
{
    /**
     * @var \DateTime
     */
    public $min;

    /**
     * @var \DateTime
     */
    public $max;

    /**
     * @var string
     */
    public $message;

    public function __construct(array $options = null)
    {
        parent::__construct($options);
        if(!isset($options['min']) && !isset($options['max']))
            throw new \InvalidArgumentException("No range set. At least 'min' or 'max' has to be set.");
    }

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    /**
     * @return \DateTime
     */
    public function getMin(): \DateTime
    {
        return $this->min;
    }

    /**
     * @param \DateTime $min
     */
    public function setMin(\DateTime $min)
    {
        $this->min = $min;
    }

    /**
     * @return \DateTime
     */
    public function getMax(): \DateTime
    {
        return $this->max;
    }

    /**
     * @param \DateTime $max
     */
    public function setMax(\DateTime $max)
    {
        $this->max = $max;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


}