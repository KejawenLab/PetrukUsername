<?php

namespace Ihsan\UsernameGenerator\Generator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class WesternUsernameGenerator extends AbstractGenerator
{
    private $reservedNames = array(
        'ALEX' => 'ALE',
        'ALEXANDER' => 'ALE',
        'MIKE' => 'MIK',
        'MICHAEL' => 'MIC',
        'JON' => 'JON',
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
    );

    /**
     * @param string $fullName
     * @param int    $limit
     *
     * @return array
     */
    public function genarate($fullName, $limit = 8)
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
     * @return bool
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
