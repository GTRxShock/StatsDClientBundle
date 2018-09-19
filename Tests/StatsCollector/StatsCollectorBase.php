<?php

namespace Liuggio\StatsDClientBundle\Tests\StatsCollector;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class StatsCollectorBase extends WebTestCase
{
    public function mockStatsDFactory($compare, $method = 'increment')
    {
        $phpunit = $this;
        $statsDFactory = $this->getMockBuilder('\Liuggio\StatsdClient\Factory\StatsdDataFactory')
            ->disableOriginalConstructor()
            ->setMethods(array($method))
            ->getMock();

        $dataMock = $this->getMockBuilder('\Liuggio\StatsdClient\Entity\StatsdDataInterface')->getMock();

        $statsDFactory->expects($this->any())
            ->method($method)
            ->with($compare)
            ->will($this->returnValue($dataMock));

        return $statsDFactory;
    }
}
