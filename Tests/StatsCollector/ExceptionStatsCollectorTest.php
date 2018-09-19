<?php

namespace Liuggio\StatsDClientBundle\Tests\StatsCollector;

use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Liuggio\StatsDClientBundle\StatsCollector\ExceptionStatsCollector;

class ExceptionStatsCollectorTest extends StatsCollectorBase
{
    public function testCollect()
    {
        $e = new \Exception('foo', 500);
        $c = new ExceptionStatsCollector('prefix', $this->mockStatsDFactory('prefix.exception.500'));
        $flattened = FlattenException::create($e);
        $trace = $flattened->getTrace();

        $c->collect(new Request(), new Response(), $e);
        $this->assertTrue(true);
    }
}
