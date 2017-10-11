<?php

namespace KejawenLab\Library\PetrukUsername\Generator;

use KejawenLab\Library\PetrukUsername\Util\CharacterShifter;

/**
 * @author Muhamad Surya Iksanudin <surya.iksanudin@bisnis.com>
 */
abstract class AbstractGenerator implements GeneratorInterface
{
    /**
     * @param string $fullName
     * @param string $base
     *
     * @return array
     */
    protected function shift($fullName, $base)
    {
        return CharacterShifter::shift($fullName, $base);
    }
}
