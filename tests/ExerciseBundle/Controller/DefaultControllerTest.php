<?php

namespace Tests\ExerciseBundle\Controller;

use Doctrine\ORM\EntityManager;
use ExerciseBundle\Repository\ExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use ExerciseBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Client;
use ExerciseBundle\Service\ExerciseService;
use ExerciseBundle\Entity\Exercise;

class DefaultControllerTest extends WebTestCase
{
    /**
     * Client for making requests
     *
     * @var Client
     */
    protected $client;


    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertEquals(301, $client->getResponse()->getStatusCode());
        $this->assertContains('en', $client->getResponse()->getContent());
    }

    public function testExerciseService()
    {

        $this->client = static::createClient();
        $user = $this->getMockBuilder(User::class)->getMock();
        $user->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(22));


        $exerciseRepository = $this
            ->getMockBuilder(ExerciseRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $exerciseRepository->expects($this->once())
            ->method('findExercisesByUser')
            ->withConsecutive(
                [
                    'user' => $user,
                ]
            )
            ->will($this->returnValue(
                [
                    ExerciseService::CALENDAR_TWO_WEEKS_AGO => [],
                    ExerciseService::CALENDAR_ONE_WEEK_AGO => [],
                    ExerciseService::CALENDAR_TODAY => []
                ]
            ));

        $exerciseService = new ExerciseService($exerciseRepository);

        $expectedResult = [
            'two_weeks_ago' => [],
            'today' => [],
            'one_week_ago' => [],
        ];


        $this->assertEquals($expectedResult, $exerciseService->getData($user));

    }
}
