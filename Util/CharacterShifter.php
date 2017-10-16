<?php

namespace KejawenLab\Library\PetrukUsername\Util;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class CharacterShifter
{
    /**
     * @param string $username
     * @param string $base
     * @param int    $limit
     *
     * @return array
     */
    public static function shift(string $username, string $base, int $limit = 8): array
    {
        if ($username === $base && $limit < strlen($base)) {
            $base = substr($base, 0, $limit);
        }

        $list = array();
        $replacement = self::replace($username, $base);
        $length = strlen($base);

        for ($i = 0; $i <= $length; ++$i) {
            $list[] = substr(sprintf('%s%s%s', substr($base, 0, ($length - $i)), $replacement, substr($base, (-1 * $i))), 0, $limit);
        }

        return array_unique($list);
    }

    /**
     * @param string $username
     * @param string $base
     *
     * @return string
     */
    public static function replace(string $username, string $base): string
    {
        return preg_replace(sprintf('/%s/', $base), '', $username, 1);
    }
}
