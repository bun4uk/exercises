<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 15/09/2016
 * Time: 18:24
 */

namespace ExerciseBundle\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use ExerciseBundle\Entity\User;

/**
 * Exercise Service
 * Class ExerciseService
 *
 * @package ExerciseBundle\Service
 */
class ExerciseService
{
    const CALENDAR_TODAY = 'today';
    const CALENDAR_ONE_WEEK_AGO = 'one_week_ago';
    const CALENDAR_TWO_WEEKS_AGO = 'two_weeks_ago';

    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;


    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getData(User $user)
    {
        $exercises = [
            self::CALENDAR_TWO_WEEKS_AGO => [],
            self::CALENDAR_ONE_WEEK_AGO => [],
            self::CALENDAR_TODAY => []
        ];
        $now = new \DateTimeImmutable('today');

//        $exerciseRepository = $this->entityManager->getRepository(
//            'ExerciseBundle:Exercise'
//        );
//        $exercises = [
//
//            self::CALENDAR_TWO_WEEKS_AGO => $exerciseRepository->findBy(
//                [
//                    'date' => $now->modify('2 weeks ago'),
//                ]
//            ),
//            self::CALENDAR_ONE_WEEK_AGO => $exerciseRepository->findBy(
//                [
//                    'date' => $now->modify('1 week ago'),
//                ]
//            ),
//            self::CALENDAR_TODAY => $exerciseRepository->findBy(
//                [
//                    'date' => $now,
//                ]
//            )
//
//        ];

        $query = $this->entityManager->createQuery(
            '
            SELECT e, u FROM ExerciseBundle:Exercise e
            JOIN e.user u
            WHERE u.id =
            ' . $user->getId()
        );
        $results = $query->getResult();

        $dates = [
            self::CALENDAR_TWO_WEEKS_AGO => 14,
            self::CALENDAR_ONE_WEEK_AGO => 7,
            self::CALENDAR_TODAY => 0
        ];

        foreach ($results as $result) {
            foreach ($dates as $date => $days) {
                if ($now->diff($result->getDate())->days <= $days) {
                    $exercises[$date][] = [
                        'id' => $result->getId(),
                        'description' => $result->getDescription(),
                        'weight' => $result->getWeight(),
                        'count' => $result->getExerciseCount(),
                        'date' => $result->getDate()->format('d.m.Y'),
                        'user' => $result->getUser()->getUsername(),
                    ];
                }
            }
        }

        return $exercises;

    }

}