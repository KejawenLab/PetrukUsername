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
    protected function shift(string $fullName, string $base): array
    {
        return CharacterShifter::shift($fullName, $base);
    }

    /**
     * @param string $fullName
     *
     * @return int
     */
    public function isReservedName(string $fullName): int
    {
        return -1;
    }
}
