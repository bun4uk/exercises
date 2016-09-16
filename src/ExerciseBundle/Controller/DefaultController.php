<?php

namespace ExerciseBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ExerciseBundle\Entity\Exercise;
use Doctrine\ORM\EntityRepository;
use ExerciseBundle\Entity\User;

/**
 * Class DefaultController
 * @package ExerciseBundle\Controller
 */
class DefaultController extends Controller
{
    const CALENDAR_TODAY = 'today';
    const CALENDAR_ONE_WEEK_AGO = 'one_week_ago';
    const CALENDAR_TWO_WEEKS_AGO = 'two_weeks_ago';

    /**
     * @Route("/", name="exercises")
     */
    public function indexAction()
    {
        $exercises = $this->get('exercise_service')->getData($this->getUser());

        return $this->render('ExerciseBundle:exercises:archive.html.twig',
            [
                'exercises' => $exercises,
                'user' => $this->getUser()
            ]
        );
    }
}
