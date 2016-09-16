<?php

// src/ExerciseBundle/Entity/Exercise.php
namespace ExerciseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ExerciseBundle\Entity\User;

/**
 * Exercise entity
 *
 * @ORM\Entity
 * @ORM\Table(name="exercise")
 */
class Exercise
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private $exerciseCount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="exercises")
     */
    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Exercise
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Exercise
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set exerciseCount
     *
     * @param integer $exerciseCount
     *
     * @return Exercise
     */
    public function setExerciseCount($exerciseCount)
    {
        $this->exerciseCount = $exerciseCount;

        return $this;
    }

    /**
     * Get exerciseCount
     *
     * @return integer
     */
    public function getExerciseCount()
    {
        return $this->exerciseCount;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Exercise
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Exercise
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
