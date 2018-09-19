<?php

namespace Liuggio\StatsDClientBundle\Tests\StatsCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Liuggio\StatsDClientBundle\StatsCollector\UserStatsCollector;

class UserStatsCollectorTest extends StatsCollectorBase
{
    public function mockSecurityContext($return)
    {
        $phpunit = $this;
        $statsDFactory = $this->getMockBuilder('Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface')
            ->setMethods(array('isGranted', 'getToken', 'setToken'))
            ->getMock();

        $statsDFactory->expects($this->any())
            ->method('isGranted')
            ->will($this->returnValue($return));

        return $statsDFactory;
    }

    /**
     * @dataProvider provider
     */
    public function testCollect($isLogged, $dataKey)
    {
        $c = new UserStatsCollector('prefix', $this->mockStatsDFactory('prefix.' . $dataKey));
        $c->setSecurityContext($this->mockSecurityContext($isLogged));
        $c->collect(new Request(), new Response(), null);
        $this->assertTrue(true);
    }

    public function provider()
    {
        return array(
            array(true, 'logged'),
            array(false, 'anonymous'));
    }
}
