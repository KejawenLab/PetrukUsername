<?php

namespace KejawenLab\Library\PetrukUsername\Util;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
final class DateGenerator
{
    /**
     * @param \DateTimeInterface $date
     *
     * @return array
     */
    public static function generate(\DateTimeInterface $date): array
    {
        $list = array();
        $list[] = $date->format('ym');
        $list[] = $date->format('yd');
        $list[] = $date->format('my');
        $list[] = $date->format('md');
        $list[] = $date->format('dy');
        $list[] = $date->format('dm');

        return array_unique($list);
    }
}
