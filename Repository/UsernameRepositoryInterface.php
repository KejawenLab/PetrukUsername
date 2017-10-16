<?php

namespace KejawenLab\Library\PetrukUsername\Repository;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
interface UsernameRepositoryInterface
{
    /**
     * @param string $username
     *
     * @return bool
     */
    public function isExist(string $username): bool;

    /**
     * @param string $characters
     *
     * @return int
     */
    public function countUsage(string $characters): int;

    /**
     * @param UsernameInterface $username
     */
    public function save(UsernameInterface $username): void;
}
