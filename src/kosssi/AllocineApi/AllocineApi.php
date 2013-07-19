<?php

namespace kosssi\AllocineApi;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * Allocine API
 *
 * @author Simon Constans <kosssi@gmail.com>
 */
class AllocineApi
{
    const PARTNER_KEY = '100043982026';
    const SECRET_KEY  = '29d185d98c984a359e6e6f26a0474269';
    const API_URL     = 'http://api.allocine.fr/rest/v3/';

    /** @var \Symfony\Component\Serializer\Serializer */
    protected $serializer;


    /**
     * constructor
     */
    public function __construct()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $this->serializer = new Serializer($normalizers, $encoders);
    }


    /**
     * Recherche
     *
     * @param string $q
     * @param null $filter
     * @param null $count
     * @param null $page
     *
     * @return Entity\Search
     */
    public function search($q, $filter = null, $count = null, $page = null)
    {
        /** @var \kosssi\AllocineApi\Entity\Search $search */
        $search = $this->doRequest(__FUNCTION__, get_defined_vars(), 'kosssi\AllocineApi\Entity\Search');

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
     *
     * @return Entity\Movie
     */
    public function movie($code, $profile = 'large', $mediafmt = null, $filter = null, $striptags = null)
    {
        /** @var \kosssi\AllocineApi\Entity\Movie $movie */
        $movie = $this->doRequest(__FUNCTION__, get_defined_vars(), 'kosssi\AllocineApi\Entity\Movie');

        return $movie;
    }

    // private

    /**
     * Fait la requete allocine
     *
     * @param string $method
     * @param array  $params
     * @param string $class
     *
     * @return object
     */
    private function doRequest($method, array $params, $class)
    {
        $queryUrl = $this->getQueryUrl($method, $params);

        // do the request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $queryUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->getRandomUserAgent());
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($response, true);
        list(,$jsonObject) = each($json);

        return $this->serializer->denormalize($jsonObject, $class, 'json');
    }

    /**
     * Création de l'url
     *
     * @param string $method
     * @param array  $params
     *
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
     * Retourne un user-agent aléatoire
     *
     * @return string
     */
    public static function getRandomUserAgent()
    {
        $v = rand(1, 4) . '.' . rand(0, 9);
        $a = rand(0, 9);
        $b = rand(0, 99);
        $c = rand(0, 999);

        $userAgents = array(
            "Mozilla/5.0 (Linux; U; Android $v; fr-fr; Nexus One Build/FRF91) AppleWebKit/5$b.$c (KHTML, like Gecko) Version/$a.$a Mobile Safari/5$b.$c",
            "Mozilla/5.0 (Linux; U; Android $v; fr-fr; Dell Streak Build/Donut AppleWebKit/5$b.$c+ (KHTML, like Gecko) Version/3.$a.2 Mobile Safari/ 5$b.$c.1",
            "Mozilla/5.0 (Linux; U; Android 4.$v; fr-fr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30",
            "Mozilla/5.0 (Linux; U; Android 4.$v; fr-fr; HTC Sensation Build/IML74K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30",
            "Mozilla/5.0 (Linux; U; Android $v; en-gb) AppleWebKit/999+ (KHTML, like Gecko) Safari/9$b.$a",
            "Mozilla/5.0 (Linux; U; Android $v.5; fr-fr; HTC_IncredibleS_S710e Build/GRJ$b) AppleWebKit/5$b.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/5$b.1",
            "Mozilla/5.0 (Linux; U; Android 2.$v; fr-fr; HTC Vision Build/GRI$b) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",
            "Mozilla/5.0 (Linux; U; Android $v.4; fr-fr; HTC Desire Build/GRJ$b) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",
            "Mozilla/5.0 (Linux; U; Android 2.$v; fr-fr; T-Mobile myTouch 3G Slide Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",
            "Mozilla/5.0 (Linux; U; Android $v.3; fr-fr; HTC_Pyramid Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",
            "Mozilla/5.0 (Linux; U; Android 2.$v; fr-fr; HTC_Pyramid Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari",
            "Mozilla/5.0 (Linux; U; Android 2.$v; fr-fr; HTC Pyramid Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/5$b.1",
            "Mozilla/5.0 (Linux; U; Android 2.$v; fr-fr; LG-LU3000 Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/5$b.1",
            "Mozilla/5.0 (Linux; U; Android 2.$v; fr-fr; HTC_DesireS_S510e Build/GRI$a) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/$c.1",
            "Mozilla/5.0 (Linux; U; Android 2.$v; fr-fr; HTC_DesireS_S510e Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile",
            "Mozilla/5.0 (Linux; U; Android $v.3; fr-fr; HTC Desire Build/GRI$a) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",
            "Mozilla/5.0 (Linux; U; Android 2.$v; fr-fr; HTC Desire Build/FRF$a) AppleWebKit/533.1 (KHTML, like Gecko) Version/$a.0 Mobile Safari/533.1",
            "Mozilla/5.0 (Linux; U; Android $v; fr-lu; HTC Legend Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/$a.$a Mobile Safari/$c.$a",
            "Mozilla/5.0 (Linux; U; Android $v; fr-fr; HTC_DesireHD_A9191 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",
            "Mozilla/5.0 (Linux; U; Android $v.1; fr-fr; HTC_DesireZ_A7$c Build/FRG83D) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/$c.$a",
            "Mozilla/5.0 (Linux; U; Android $v.1; en-gb; HTC_DesireZ_A7272 Build/FRG83D) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/$c.1",
            "Mozilla/5.0 (Linux; U; Android $v; fr-fr; LG-P5$b Build/FRG83) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1"
        );

        return $userAgents[rand(0, count($userAgents) - 1)];
    }
}
