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
    public function generate($fullName, $limit = 8);
}
