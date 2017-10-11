<?php

namespace KejawenLab\Library\PetrukUsername\Generator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class WesternPetrukUsername extends AbstractGenerator
{
    private $reservedNames = array(
        'ALEX' => 'ALE',
        'ALEXANDER' => 'ALE',
        'MIKE' => 'MIK',
        'MICHAEL' => 'MIC',
        'JON' => 'JON',
        'JOHN' => 'JHN',
        'JONATHAN' => 'JON',
        'DAVID' => 'DAV',
        'DAVE' => 'DAV',
        'TOM' => 'TOM',
        'THOMAS' => 'TOM',
        'DOUG' => 'DOU',
        'DOUGLAS' => 'DOU',
        'ROB' => 'ROB',
        'ROBERT' => 'ROB',
        'ANNE' => 'ANN',
        'AGNES' => 'AGN',
        'CHRIS' => 'CHR',
        'CHRISTINE' => 'CHR',
        'MARIA' => 'MAR',
        'PETER' => 'PET',
        'ALBERT' => 'ALB',
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
        if (2 > count($temp)) {
            return array();
        }

        $temp[$index] = $this->reservedNames[$temp[$index]];
        $fullName = substr(implode('', $temp), 0, $limit);
        if ($limit > strlen($fullName)) {
            $fullName = $original;
        } else {
            $original = $temp[$index];
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

        return -1;
    }
}
