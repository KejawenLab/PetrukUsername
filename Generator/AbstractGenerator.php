<?php

namespace Ihsan\UsernameGenerator\Generator;

use Ihsan\UsernameGenerator\Util\UsernameShifter;

abstract class AbstractGenerator implements GeneratorInterface
{
    /**
     * @var UsernameShifter
     */
    protected $shifter;

    /**
     * @param UsernameShifter $shifter
     */
    public function __construct(UsernameShifter $shifter)
    {
        $this->shifter = $shifter;
    }

    /**
     * @param string $fullName
     * @param string $base
     *
     * @return array
     */
    protected function shift($fullName, $base)
    {
        return $this->shifter->shift($fullName, $base);
    }
}
