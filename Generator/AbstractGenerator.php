<?php

namespace Ihsan\UsernameGenerator\Generator;

use Ihsan\UsernameGenerator\Util\CharacterShifter;

abstract class AbstractGenerator implements GeneratorInterface
{
    /**
     * @var CharacterShifter
     */
    protected $shifter;

    /**
     * @param CharacterShifter $shifter
     */
    public function __construct(CharacterShifter $shifter)
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
