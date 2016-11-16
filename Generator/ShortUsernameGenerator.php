<?php

namespace Ihsan\UsernameGenerator\Generator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class ShortUsernameGenerator extends AbstractGenerator
{
    /**
     * @param string $fullName
     * @param int    $limit
     *
     * @return array
     */
    public function genarate($fullName, $limit = 8)
    {
        $original = str_replace(' ', '', $fullName);
        if ($limit < strlen($original)) {
            return array();
        }

        $fullName = strtoupper(substr(str_repeat($original, $limit), 0, $limit));

        return $this->shift($fullName, $original);
    }
}
