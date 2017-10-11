<?php

namespace KejawenLab\Library\PetrukUsername\Generator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class BalinesePetrukUsername extends AbstractGenerator
{
    private $reservedNames = array(
        'PUTU' => 'PU',
        'WAYAN' => 'WA',
        'GUSTI' => 'GU',
        'KETUT' => 'KE',
        'KOMANG' => 'KO',
        'KADEK' => 'KA',
        'GEDE' => 'GE',
        'IDA' => 'ID',
        'MADE' => 'MA',
    );

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

        if (-1 === $index = $this->isReservedName($fullName)) {
            return array();
        }

        $temp = explode(' ', strtoupper($fullName));
        if (3 > count($temp)) {
            return array();
        }

        $temp[$index] = $this->reservedNames[$temp[$index]];
        $fullName = substr(implode('', $temp), 0, $limit);
        if ($limit > strlen($fullName)) {
            $fullName = $original;
        } else {
            $original = $index === 1 ? sprintf('%s%s', $temp[0], $temp[$index]) : $temp[$index];
        }

        return $this->shift($fullName, $original);
    }

    /**
     * @param string $fullName
     *
     * @return int
     */
    public function isReservedName($fullName)
    {
        $temp = explode(' ', strtoupper($fullName));
        if (in_array($temp[0], array_keys($this->reservedNames))) {
            return 0;
        }

        if (in_array($temp[1], array_keys($this->reservedNames))) {
            return 1;
        }

        return -1;
    }
}
