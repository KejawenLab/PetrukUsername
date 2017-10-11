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
    public function isExist($username);

    /**
     * @param int $characters
     */
    public function countUsage($characters);

    /**
     * @param UsernameInterface $username
     */
    public function save(UsernameInterface $username);
}
