<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Exercise;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

class DefaultController extends Controller
{

    const CALENDAR_TODAY = 'today';
    const CALENDAR_ONE_WEEK_AGO = 'one_week_ago';
    const CALENDAR_TWO_WEEKS_AGO = 'two_weeks_ago';

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
//        $now = new \DateTimeImmutable('today');
//        $query = $this->getDoctrine()->getManager()->createQuery(
//            '
//            SELECT e, u FROM AppBundle:Exercise e
//            JOIN e.user u
//            WHERE u.username = \'dell\'
//            '
//        );
//        $results = $query->getResult();
//
//        $dates = [
//            self::CALENDAR_TWO_WEEKS_AGO => 14,
//            self::CALENDAR_ONE_WEEK_AGO => 7,
//            self::CALENDAR_TODAY => 0
//        ];
//
//        foreach ($results as $result) {
//            foreach ($dates as $date => $days) {
//                if ($now->diff($result->getDate())->days <= $days) {
//                    $exercises[$date][] = [
//                        'id' => $result->getId(),
//                        'description' => $result->getDescription(),
//                        'weight' => $result->getWeight(),
//                        'count' => $result->getExerciseCount(),
//                        'date' => $result->getDate()->format('d.m.Y'),
//                        'user' => $result->getUser()->getUsername(),
//                    ];
//                }
//            }
//        }

        $exercises = $this->get('exercise_service')->getData();



        return $this->render('exercises/archive.html.twig',
            ['exercises' => $exercises]
        );
    }
}
