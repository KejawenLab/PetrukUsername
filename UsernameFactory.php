<?php

namespace KejawenLab\Library\PetrukUsername;

use KejawenLab\Library\PetrukUsername\Generator\BalineseUsernameGenerator;
use KejawenLab\Library\PetrukUsername\Generator\GenericUsernameGenerator;
use KejawenLab\Library\PetrukUsername\Generator\IslamicUsernameGenerator;
use KejawenLab\Library\PetrukUsername\Generator\ShortUsernameGenerator;
use KejawenLab\Library\PetrukUsername\Generator\WesternUsernameGenerator;
use KejawenLab\Library\PetrukUsername\Repository\UsernameInterface;
use KejawenLab\Library\PetrukUsername\Repository\UsernameRepositoryInterface;
use KejawenLab\Library\PetrukUsername\Util\DateGenerator;
use KejawenLab\Library\PetrukUsername\Util\UniqueNumberGenerator;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class UsernameFactory
{
    /**
     * @var UsernameRepositoryInterface
     */
    private $repository;

    /**
     * @var string
     */
    private $class;

    /**
     * @var bool
     */
    private $autoSave;

    /**
     * @var array
     */
    private $characters;

    /**
     * @var array
     */
    private $dates;

    /**
     * @var int
     */
    private $hit = 0;

    /**
     * @param UsernameRepositoryInterface $usernameRepository
     * @param string                      $usernameClass
     * @param bool                        $autoSave
     */
    public function __construct(UsernameRepositoryInterface $usernameRepository, string $usernameClass, bool $autoSave = false)
    {
        $this->repository = $usernameRepository;
        $this->class = $usernameClass;
        $this->autoSave = $autoSave;
    }

    /**
     * @param string             $fullName
     * @param \DateTimeInterface $birthday
     * @param int                $characterLimit
     * @param int                $maxUsernamePerPrefix
     *
     * @return null|string
     */
    public function generate(string $fullName, \DateTimeInterface $birthday, int $characterLimit = 8, int $maxUsernamePerPrefix = 1000)
    {
        $fullName = strtoupper($fullName);
        $characters = array();
        $isShort = false;

        if ($characterLimit > strlen($fullName)) {
            $shortGenerator = new ShortUsernameGenerator();
            $characters = array_merge($characters, $shortGenerator->generate($fullName, $characterLimit));

            $isShort = true;
        }

        if (!$isShort) {
            $characters = $this->doGenerate($fullName, $characterLimit, $characters);
        }

        $realUsername = $this->getUsername($birthday, $characters, $maxUsernamePerPrefix);

        if ($this->autoSave) {
            $this->save($birthday, $fullName, $realUsername);
        }

        return $realUsername;
    }

    /**
     * @return array
     */
    public function getAllCharacter()
    {
        return $this->characters;
    }

    /**
     * @return array
     */
    public function getAllDates()
    {
        return $this->dates;
    }

    /**
     * @return int
     */
    public function getTotalHit()
    {
        return $this->hit;
    }

    /**
     * @return int
     */
    public function getTotalSuggestion()
    {
        return ($this->getTotalCharacter() * $this->getTotalDate()) + ($this->getTotalCharacter() * $this->getTotalNumber());
    }

    /**
     * @return int
     */
    public function getTotalCharacter()
    {
        return count($this->characters);
    }

    /**
     * @return int
     */
    public function getTotalDate()
    {
        return count($this->dates);
    }

    /**
     * @return int
     */
    public function getTotalNumber()
    {
        return 10000;
    }

    /**
     * @param \DateTimeInterface $birthday
     * @param array              $characters
     * @param int                $maxUsernamePerPrefix
     *
     * @return string
     */
    private function getUsername(\DateTimeInterface $birthday, array $characters, int $maxUsernamePerPrefix)
    {
        $dates = DateGenerator::generate($birthday);

        $this->characters = $characters;
        $this->dates = $dates;

        $realUsername = null;
        foreach ($characters as $character) {
            foreach ($dates as $date) {
                $username = sprintf('%s%s', $character, $date);
                if (!$this->repository->isExist($username) && $maxUsernamePerPrefix >= $this->repository->countUsage($character)) {
                    $realUsername = $username;

                    break;
                } else {
                    ++$this->hit;
                }
            }

            if ($realUsername) {
                break;
            }
        }

        if (!$realUsername) {
            foreach ($characters as $character) {
                $flag = true;
                while ($flag) {
                    $username = sprintf('%s%s', $character, UniqueNumberGenerator::generate());
                    if (!$this->repository->isExist($username) && $maxUsernamePerPrefix >= $this->repository->countUsage($character)) {
                        $realUsername = $username;

                        $flag = false;
                    } else {
                        ++$this->hit;
                    }
                }

                if (!$flag) {
                    break;
                }
            }

            return $realUsername;
        }

        return $realUsername;
    }

    /**
     * @param string             $fullName
     * @param \DateTimeInterface $birthday
     * @param string             $username
     */
    private function save(\DateTimeInterface $birthday, string $fullName, string $username)
    {
        /** @var UsernameInterface $user */
        $user = new $this->class();
        $user->setFullName($fullName);
        $user->setDateOfBirth($birthday);
        $user->setUsername($username);

        $this->repository->save($user);
    }

    /**
     * @param string $fullName
     * @param int    $characterLimit
     * @param array  $characters
     *
     * @return array
     */
    private function doGenerate(string $fullName, int $characterLimit, array $characters = [])
    {
        $balineseGenerator = new BalineseUsernameGenerator();
        if (-1 !== $balineseGenerator->isReservedName($fullName)) {
            $characters = array_merge($characters, $balineseGenerator->generate($fullName, $characterLimit));
        }

        $islamicGenerator = new IslamicUsernameGenerator();
        if (-1 !== $islamicGenerator->isReservedName($fullName)) {
            $characters = array_merge($characters, $islamicGenerator->generate($fullName, $characterLimit));
        }

        $westernGenerator = new WesternUsernameGenerator();
        if (-1 !== $westernGenerator->isReservedName($fullName)) {
            $characters = array_merge($characters, $westernGenerator->generate($fullName, $characterLimit));
        }

        $genericGenerator = new GenericUsernameGenerator();
        $characters = array_merge($characters, $genericGenerator->generate($fullName, $characterLimit));

        return $characters;
    }
}
