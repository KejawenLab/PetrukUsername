<?php

namespace KejawenLab\Library\PetrukUsername\Generator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface GeneratorInterface
{
    /**
     * @param string $fullName
     * @param int    $limit
     *
     * @return array
     */
    public function generate(string $fullName, int $limit = 8): array;

    /**
     * @param string $fullName
     *
     * @return int
     */
    public function isReservedName(string $fullName): int;
}
