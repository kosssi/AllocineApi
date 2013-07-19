<?php

namespace kosssi\AllocineApi\Entity;

use kosssi\AllocineApi\Traits\AllocineHelp;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Search
 *
 * @author Simon Constans <kosssi@gmail.com>
 */
class Search
{
    use AllocineHelp;

    private $page;          // integer
    private $count;         // integer
    private $results;       // array (key => value)
    private $totalResults;  // integer
    private $movie;         // array
    private $tvseries;      // array
    private $news;          // array
    private $media;         // array


    /**
     * constructor
     */
    public function __construct()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $this->serializer = new Serializer($normalizers, $encoders);
    }


    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setMedia($media)
    {
        $this->media = $media;
    }

    public function getMedia()
    {
        // return $this->getArrayOfObject($this->media, 'kosssi\AllocineApi\Entity\Media');
        return $this->media;
    }

    public function setMovie($movie)
    {
        $this->movie = $movie;
    }

    public function getMovie()
    {
        return $this->getArrayOfObject($this->movie, 'kosssi\AllocineApi\Entity\Movie');
    }

    public function setNews($news)
    {
        $this->news = $news;
    }

    public function getNews()
    {
        //return $this->getArrayOfObject($this->news, 'kosssi\AllocineApi\Entity\News');
        return $this->news;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setResults($results)
    {
        $this->results = $results;
    }

    public function getResults()
    {
        return $this->getArrayWithKey($this->results);
    }

    public function setTotalResults($totalResults)
    {
        $this->totalResults = $totalResults;
    }

    public function getTotalResults()
    {
        return $this->totalResults;
    }

    public function setTvseries($tvseries)
    {
        $this->tvseries = $tvseries;
    }

    public function getTvseries()
    {
        //return $this->getArrayOfObject($this->movie, 'kosssi\AllocineApi\Entity\Serie');
        return $this->tvseries;
    }
}
