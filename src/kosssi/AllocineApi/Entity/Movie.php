<?php

/**
 * Allocine API
 *
 * PHP 5.3
 *
 * @author     Simon Constans <kosssi@gmail.com>
 * @copyleft   2012
 * @version    GIT:  https://github.com/kosssi/AllocineApi.php
 * @see        http://wiki.gromez.fr/dev/api/allocine_v3
 */

namespace kosssi\AllocineApi\Entity;

/**
 * AllocineMovie
 * Informations sur un film
 *
 * @author Simon Constans <kosssi@gmail.com>
 */
class Movie
{
    private $code;
    private $movieType; // value = $
    private $originalTitle;
    private $title;
    private $keywords;
    private $productionYear;
    private $nationality; // array
    private $genre; // array
    private $release;
    private $runtime;
    private $language;
    private $budget;
    private $synopsis;
    private $synopsisShort;
    private $castingShort;
    private $castMember;
    private $poster;
    private $trailer;
    private $link;
    private $media;
    private $statistics;
    private $news;
    private $feature;
    private $trivia;
    private $tag;
    private $boxOffice;

    public function setCastMember($castMember)
    {
        $this->castMember = $castMember;
    }

    public function getCastMember()
    {
        return $this->castMember;
    }

    public function setCastingShort($castingShort)
    {
        $this->castingShort = $castingShort;
    }

    public function getCastingShort()
    {
        return $this->castingShort;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    public function getGenre()
    {
        $value = '$';
        $genres = array();

        foreach ($this->genre as $genre) {
            $genres[] = $genre->$value;
        }

        return $genres;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        $value = '$';

        return $this->language->$value;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setMovieType($movieType)
    {
        $this->movieType = $movieType;
    }

    public function getMovieType()
    {
        $value = '$';

        return $this->movieType->$value;
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    public function getNationality()
    {
        $value = '$';

        return $this->nationality->$value;
    }

    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;
    }

    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    public function getPoster()
    {
        return $this->poster;
    }

    public function setProductionYear($productionYear)
    {
        $this->productionYear = $productionYear;
    }

    public function getProductionYear()
    {
        return $this->productionYear;
    }

    public function setRelease($release)
    {
        $this->release = $release;
    }

    public function getRelease()
    {
        return $this->release;
    }

    public function setStatistics($statistics)
    {
        $this->statistics = $statistics;
    }

    public function getStatistics()
    {
        return $this->statistics;
    }

    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }

    public function setSynopsisShort($synopsisShort)
    {
        $this->synopsisShort = $synopsisShort;
    }

    public function getSynopsisShort()
    {
        return $this->synopsisShort;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
    }

    public function getTrailer()
    {
        return $this->trailer;
    }

    public function setBoxOffice($boxOffice)
    {
        $this->boxOffice = $boxOffice;
    }

    public function getBoxOffice()
    {
        return $this->boxOffice;
    }

    public function setBudget($budget)
    {
        $this->budget = $budget;
    }

    public function getBudget()
    {
        return $this->budget;
    }

    public function setFeature($feature)
    {
        $this->feature = $feature;
    }

    public function getFeature()
    {
        return $this->feature;
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function setMedia($media)
    {
        $this->media = $media;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setNews($news)
    {
        $this->news = $news;
    }

    public function getNews()
    {
        return $this->news;
    }

    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;
    }

    public function getRuntime()
    {
        return $this->runtime;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTrivia($trivia)
    {
        $this->trivia = $trivia;
    }

    public function getTrivia()
    {
        return $this->trivia;
    }

    // add function

    public function getDirectors()
    {
        return $this->castingShort->directors;
    }

    public function getActors()
    {
        return $this->castingShort->actors;
    }
}
