<?php
namespace kosssi\AllocineApi\Entity;
use kosssi\AllocineApi\Traits\AllocineHelp;

/**
 * Movie
 *
 * PHP 5.3
 *
 * @author     Simon Constans <kosssi@gmail.com>
 * @git        https://github.com/kosssi/AllocineApi
 * @see        http://wiki.gromez.fr/dev/api/allocine_v3
 */
class Movie
{
    use AllocineHelp;

    private $code;
    private $movieType;
    private $originalTitle;
    private $title;
    private $keywords;
    private $productionYear;
    private $nationality; // array
    private $genre;
    private $release; // object
    private $runtime;
    private $color;
    private $formatList; // object
    private $language;
    private $budget;
    private $synopsis;
    private $synopsisShort;
    private $castingShort; // object
    private $castMember; // object
    private $poster; // object
    private $trailer; // object
    private $link;
    private $media;
    private $statistics; // object
    private $news;
    private $feature;
    private $trivia;
    private $tag;
    private $festivalAward; // object
    private $boxOffice; // object

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

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getColor()
    {
        return $this->getValue($this->color);
    }

    public function setFeature($feature)
    {
        $this->feature = $feature;
    }

    public function getFeature()
    {
        return $this->getArrayOfObject($this->feature, 'kosssi\AllocineApi\Entity\News');
    }

    public function setFestivalAward($festivalAward)
    {
        $this->festivalAward = $festivalAward;
    }

    public function getFestivalAward()
    {
        return $this->festivalAward;
    }

    public function setFormatList($formatList)
    {
        $this->formatList = $formatList;
    }

    public function getFormatList()
    {
        return $this->formatList;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    public function getGenre()
    {
        return $this->getArray($this->genre);
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->getArray($this->language);
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->getArrayWithKey($this->link, 'name', 'href');
    }

    public function setMedia($media)
    {
        $this->media = $media;
    }

    public function getMedia()
    {
        return $this->getArrayOfObject($this->media, 'kosssi\AllocineApi\Entity\Media');
    }

    public function setMovieType($movieType)
    {
        $this->movieType = $movieType;
    }

    public function getMovieType()
    {
        return $this->getValue($this->movieType);
    }

    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    public function getNationality()
    {
        return $this->getArray($this->nationality);
    }

    public function setNews($news)
    {
        $this->news = $news;
    }

    public function getNews()
    {
        return $this->getArrayOfObject($this->news, 'kosssi\AllocineApi\Entity\News');
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

    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;
    }

    public function getRuntime()
    {
        return $this->runtime;
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

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getTag()
    {
        return $this->getArray($this->tag);
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return is_null($this->title)?$this->originalTitle:$this->title;
    }

    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
    }

    public function getTrailer()
    {
        return $this->trailer;
    }

    public function setTrivia($trivia)
    {
        $this->trivia = $trivia;
    }

    public function getTrivia()
    {
        return $this->getArrayOfObject($this->trivia, 'kosssi\AllocineApi\Entity\News');
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
