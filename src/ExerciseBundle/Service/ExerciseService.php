<?php
/**
 * Created by PhpStorm.
 * User: v.bunchuk
 * Date: 15/09/2016
 * Time: 18:24
 */

namespace ExerciseBundle\Service;

use Doctrine\ORM\EntityManager;
use ExerciseBundle\Entity\Exercise;
use ExerciseBundle\Entity\User;
use ExerciseBundle\Repository\ExerciseRepository;

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
     * @var ExerciseRepository $exerciseRepository
     */
    private $exerciseRepository;


    public function __construct(ExerciseRepository $exerciseRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
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
        $results = $this->exerciseRepository->findExercisesByUser($user);

        $dates = [
            self::CALENDAR_TWO_WEEKS_AGO => 14,
            self::CALENDAR_ONE_WEEK_AGO => 7,
            self::CALENDAR_TODAY => 0
        ];

        foreach ($results as $result) {
            foreach ($dates as $date => $days) {
                if ((!empty($result)) && $now->diff($result->getDate())->days <= $days) {
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