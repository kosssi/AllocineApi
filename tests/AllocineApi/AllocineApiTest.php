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
    /**
     * test construct
     */
    public function testConstruct()
    {
        $allocineApi = new AllocineApi();

        $this->assertInstanceOf('kosssi\AllocineApi\AllocineApi', $allocineApi);
    }

    /**
     * test search
     *
     * @dataProvider searchData
     */
    public function testSearch($page, $count, $results, $totalResults, $movie, $tvseries, $news, $media)
    {
        $allocineApi = new AllocineApi();
        $search = $allocineApi->search('avatar');

//        var_dump($search->getPage());
//        var_dump($search->getCount());
//        var_dump($search->getResults());
//        var_dump($search->getTotalResults());
//        var_dump($search->getMovie());
//        var_dump($search->getTvseries());
//        var_dump($search->getNews());
//        var_dump($search->getMedia());

        $this->assertEquals($page, $search->getPage());
        $this->assertEquals($count, $search->getCount());
        $this->assertCount($results, $search->getResults());
        $this->assertGreaterThan($totalResults, $search->getTotalResults());
        $this->assertCount($movie, $search->getMovie());
        $this->assertCount($tvseries, $search->getTvseries());
        $this->assertCount($news, $search->getNews());
        $this->assertCount($media, $search->getMedia());
    }

    /**
     * @return array
     */
    public function searchData()
    {
        return array(
            array(1, 10, 1, 160, 10, 1, 10, 20),
        );
    }

    /**
     * test movie
     *
     * @dataProvider movieData
     */
    public function testMovie(
        $code, $movieType, $originalTitle, $title, $keywords, $productionYear, $nationality, $genre, $release, $runtime,
        $color, $formatList, $language, $budget, $synopsis, $synopsisShort, $castingShort, $castMember, $poster,
        $trailer, $link, $media, $statistics, $news, $feature, $trivia, $tag, $festivalAward, $boxOffice
    )
    {
        $allocineApi = new AllocineApi();
        $movie = $allocineApi->movie($code);

//        var_dump($movie->getCode());
//        var_dump($movie->getMovieType());
//        var_dump($movie->getOriginalTitle());
//        var_dump($movie->getTitle());
//        var_dump($movie->getKeywords());
//        var_dump($movie->getProductionYear());
//        var_dump($movie->getNationality());
//        var_dump($movie->getGenre());
//        var_dump($movie->getRelease());
//        var_dump($movie->getRuntime());
//        var_dump($movie->getColor());
//        var_dump($movie->getFormatList());
//        var_dump($movie->getLanguage());
//        var_dump($movie->getBudget());
//        var_dump($movie->getSynopsis());
//        var_dump($movie->getSynopsisShort());
//        var_dump($movie->getCastingShort());
//        var_dump($movie->getCastMember());
//        var_dump($movie->getPoster());
//        var_dump($movie->getTrailer());
//        var_dump($movie->getLink());
//        var_dump($movie->getMedia());
//        var_dump($movie->getStatistics());
//        var_dump($movie->getNews());
//        var_dump($movie->getFeature());
//        var_dump($movie->getTrivia());
//        var_dump($movie->getTag());
//        var_dump($movie->getFestivalAward());
//        var_dump($movie->getBoxOffice());

        $this->assertEquals($code, $movie->getCode());
        $this->assertEquals($movieType, $movie->getMovieType());
        $this->assertEquals($originalTitle, $movie->getOriginalTitle());
        $this->assertEquals($title, $movie->getTitle());
        $this->assertEquals($keywords, $movie->getKeywords());
        $this->assertEquals($productionYear, $movie->getProductionYear());
        $this->assertCount($nationality, $movie->getNationality());
        $this->assertCount($genre, $movie->getGenre());
        $this->assertCount($release, $movie->getRelease());
        $this->assertEquals($runtime, $movie->getRuntime());
        $this->assertEquals($color, $movie->getColor());
        $this->assertEquals($formatList, $movie->getFormatList());
        $this->assertCount($language, $movie->getLanguage());
        $this->assertEquals($budget, $movie->getBudget());
        $this->assertStringStartsWith($synopsis, $movie->getSynopsis());
        $this->assertStringEndsWith($synopsisShort, $movie->getSynopsisShort());
        $this->assertCount($castingShort, $movie->getCastingShort());
        $this->assertCount($castMember, $movie->getCastMember());
        $this->assertCount($poster, $movie->getPoster());
        $this->assertCount($trailer, $movie->getTrailer());
        $this->assertCount($link, $movie->getLink());
        $this->assertCount($media, $movie->getMedia());
        $this->assertCount($statistics, $movie->getStatistics());
        $this->assertCount($news, $movie->getNews());
        $this->assertCount($feature, $movie->getFeature());
        $this->assertCount($trivia, $movie->getTrivia());
        $this->assertCount($tag, $movie->getTag());
        $this->assertEquals($festivalAward, $movie->getFestivalAward());
        $this->assertCount($boxOffice, $movie->getBoxOffice());
    }

    /**
     * @return array
     */
    public function movieData()
    {
        return array(
            array(
                '175607', 'Long-métrage', 'Jappeloup', 'Jappeloup', 'Jappeloup ', 2012, 1, 2, 4, 7800, 'Couleur', null,
                1, '26.000.000 €', 'Au début des années 80', 'vraiment : Jappeloup.', 2, 52, 2, 3, 1, 22, 14, 4, 1, 4,
                16, null, 6,
            ),
        );
    }
}
