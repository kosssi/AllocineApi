<?php
namespace kosssi\AllocineApi\Tests\AllocineApi;

use kosssi\AllocineApi\AllocineApi;
use kosssi\AllocineApi\Entity\Movie;
use kosssi\AllocineApi\Entity\Search;

/**
 * AllocineTest
 *
 * @author Simon Constans <kosssi@gmail.com>
 */
class AllocineApiTest extends \PHPUnit_Framework_TestCase
{
    /** @var \kosssi\AllocineApi\AllocineApi */
    protected $allocineApi;

    protected function setUp()
    {
        $this->allocineApi = new AllocineApi();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('kosssi\AllocineApi\AllocineApi', $this->allocineApi);
    }

    public function testSearch()
    {
        /** @var $search Search */
        $search = $this->allocineApi->search('avatar');

        $this->assertCount(10, $search->getMovie());
    }

    /**
     * @dataProvider movieData
     */
    public function testMovie($code)
    {
        /** @var $movie Movie */
        $movie = $this->allocineApi->movie($code);

        $this->assertEquals($code, $movie->getCode());
    }

    public function movieData()
    {
        return array(
            array(
                '175607'
            ),
        );
    }
}
