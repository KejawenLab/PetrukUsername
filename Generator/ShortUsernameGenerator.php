<?php

namespace KejawenLab\Library\PetrukUsername\Generator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
final class ShortUsernameGenerator extends AbstractGenerator
{
    /**
     * @param string $fullName
     * @param int    $limit
     *
     * @return array
     */
    public function generate(string $fullName, int $limit = 8): array
    {
        $original = str_replace(' ', '', $fullName);
        if ($limit < strlen($original)) {
            return array();
        }

        $fullName = strtoupper(substr(str_repeat($original, $limit), 0, $limit));

        return $this->shift($fullName, $original);
    }
}
