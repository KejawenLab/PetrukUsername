<?php

namespace KejawenLab\Library\PetrukUsername\Repository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface UsernameInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getFullName();

    /**
     * @param string $fullName
     */
    public function setFullName($fullName);

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $username
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getBirthDay();

    /**
     * @param \DateTime $date
     */
    public function setBirthDay(\DateTime $date);
}
