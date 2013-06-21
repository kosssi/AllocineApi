<?php
namespace kosssi\AllocineApi;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * Allocine API
 *
 * PHP 5.3
 *
 * @author     Simon Constans <kosssi@gmail.com>
 * @git        https://github.com/kosssi/AllocineApi
 * @see        http://wiki.gromez.fr/dev/api/allocine_v3
 */
class AllocineApi
{
    const PARTNER_KEY = '100043982026';
    const SECRET_KEY  = '29d185d98c984a359e6e6f26a0474269';
    const API_URL     = 'http://api.allocine.fr/rest/v3/';

    protected $userAgent;
    protected $serializer;

    /**
     * constructor
     */
    public function __construct($userAgent = '')
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
        $this->userAgent = $userAgent;
    }

    // public

    /**
     * Recherche
     *
     * @param string $q
     * @param null $filter
     * @param null $count
     * @param null $page
     * @return Entity\Search
     */
    public function search($q, $filter = null, $count = null, $page = null)
    {
        /** @var \kosssi\AllocineApi\Entity\Search $search */
        $search = $this->doRequest(__FUNCTION__, get_defined_vars(), 'kosssi\AllocineApi\Entity\Search');
        $search->setSerializer($this->getSerializer());

        return $search;
    }

    /**
     * Informations sur un film
     *
     * @param $code
     * @param string $profile
     * @param null $mediafmt
     * @param null $filter
     * @param null $striptags
     * @return Entity\Movie
     */
    public function movie($code, $profile = 'large', $mediafmt = null, $filter = null, $striptags = null)
    {
        /** @var \kosssi\AllocineApi\Entity\Movie $movie */
        $movie = $this->doRequest(__FUNCTION__, get_defined_vars(), 'kosssi\AllocineApi\Entity\Movie');
        $movie->setSerializer($this->getSerializer());

        return $movie;
    }

    public function complete($mediafmt = null, $filter = null, $striptags = null)
    {
        $class = get_class($this);

        if ($class == 'kosssi\AllocineApi\Entity\Movie') {
            return $this->movie($this->getCode(), $profile = 'large', $mediafmt, $filter, $striptags);
        }

        return null;
    }

    // private

    /**
     * @param $method
     * @param $params
     * @param $class
     * @return object
     */
    private function doRequest($method, array $params, $class)
    {
        $queryUrl = $this->getQueryUrl($method, $params);

        // do the request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $queryUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($response, true);
        list(,$jsonObject) = each($json);

        return $this->serializer->denormalize($jsonObject, $class, 'json');
    }

    /**
     * @param $method
     * @param array $params
     * @return string
     */
    private function getQueryUrl($method, array $params)
    {
        // build the URL
        $query_url = AllocineApi::API_URL.'/'.$method;

        $params['partner'] = AllocineApi::PARTNER_KEY;

        $sed = date('Ymd');
        $sig = urlencode(base64_encode(sha1(AllocineApi::SECRET_KEY.http_build_query($params).'&sed='.$sed, true)));
        $query_url .= '?'.http_build_query($params).'&sed='.$sed.'&sig='.$sig;

        return $query_url;
    }

    /**
     * @param \Symfony\Component\Serializer\Serializer $serializer
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return \Symfony\Component\Serializer\Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }
}
