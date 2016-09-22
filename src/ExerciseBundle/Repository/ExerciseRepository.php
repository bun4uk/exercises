<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 22/09/2016
 * Time: 12:08
 */

namespace ExerciseBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use ExerciseBundle\Entity\User;

/**
 * Class ExerciseRepository
 * @package ExerciseBundle\Entity
 */
class ExerciseRepository extends EntityRepository
{
a
    /**
     * @param User $user
     * @return array
     */
    public function findExercisesByUser(User $user)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT e, u FROM ExerciseBundle:Exercise e
            JOIN e.user u
            WHERE u.id = :userId')
            ->setParameter('userId', $user->getId());


        return $query->getResult();
    }
}