<?php

namespace KejawenLab\Library\PetrukUsername\Generator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
final class GenericUsernameGenerator extends AbstractGenerator
{
    /**
     * @param string $fullName
     * @param int    $limit
     *
     * @return array
     */
    public function generate($fullName, $limit = 8)
    {
        $original = str_replace(' ', '', $fullName);
        if ($limit > strlen($original)) {
            return array();
        }

        $temp = explode(' ', strtoupper($fullName));
        $fullName = substr(implode('', $temp), 0, $limit);
        if ($limit > strlen($fullName)) {
            $fullName = $original;
        }

        return $this->shift($original, $fullName);
    }
}
