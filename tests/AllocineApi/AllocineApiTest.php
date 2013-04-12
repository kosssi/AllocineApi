<?php
namespace kosssi\AllocineApi\Tests\AllocineApi;

use kosssi\AllocineApi\AllocineApi;
use kosssi\AllocineApi\Entity\Movie;

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

    /**
     * @dataProvider getUrlData
     */
    public function testGetUrl($page, $args, $result)
    {
        $method = new \ReflectionMethod('kosssi\AllocineApi\AllocineApi', 'getUrl');
        $method->setAccessible(true);
        $url = $method->invoke(new AllocineApi, $page, $args);

        $this->assertEquals($result, $url);
    }

    public function getUrlData()
    {
        return array(
            array(
                'movie',
                array(),
                AllocineApi::URL . 'movie?partner=' . AllocineApi::PARTNER
            ),
            array(
                'movie',
                array('code' => 'yes'),
                AllocineApi::URL . 'movie?partner=' . AllocineApi::PARTNER . '&code=yes'
            ),
            array(
                'movie',
                array('code' => null),
                AllocineApi::URL . 'movie?partner=' . AllocineApi::PARTNER
            ),
            array(
                'movie',
                array('code' => array('filtre1', 'filtre2')),
                AllocineApi::URL . 'movie?partner=' . AllocineApi::PARTNER . '&code=filtre1,filtre2'
            ),
        );
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