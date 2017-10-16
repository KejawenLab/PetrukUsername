<?php

namespace KejawenLab\Library\PetrukUsername\Repository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface UsernameInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getFullName(): string;

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @param string $username
     */
    public function setUsername(string $username): void;

    /**
     * @return \DateTimeInterface
     */
    public function getDateOfBirth(): \DateTimeInterface;

    /**
     * @param \DateTimeInterface $date
     */
    public function setDateOfBirth(\DateTimeInterface $date);
}
