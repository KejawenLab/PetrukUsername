<?php

namespace Ihsan\UsernameGenerator\Util;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class DateGenerator
{
    /**
     * @param \DateTime $date
     *
     * @return array
     */
    public static function generate(\DateTime $date)
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
