<?php

namespace KejawenLab\Library\PetrukUsername\Util;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
final class UniqueNumberGenerator
{
    /**
     * @return int
     */
    public static function generate(): int
    {
        return rand(1000, 9999);
    }
}
