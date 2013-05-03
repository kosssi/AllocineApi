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
    const USER_AGENT  = 'Dalvik/1.6.0 (Linux; U; Android 4.2.2; Nexus 4 Build/JDQ39E)';

    private $serializer;

    /**
     * constructor
     */
    public function __construct()
    {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
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
        return $this->doRequest(__FUNCTION__, get_defined_vars(), 'kosssi\AllocineApi\Entity\Search');
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
        return $this->doRequest(__FUNCTION__, get_defined_vars(), 'kosssi\AllocineApi\Entity\Movie');
    }

    public function complete($mediafmt = null, $filter = null, $striptags = null)
    {
        $class = get_class($this);

        if ($class == 'kosssi\AllocineApi\Entity\Movie') {
            return $this->movie($this->getCode(), $profile = 'large', $mediafmt, $filter, $striptags);
        }

        return null;
    }

    // protected

    /**
     * @param $element
     * @param string $key
     * @return mixed
     */
    protected function getValue($element, $key = '$')
    {
        if (isset($element->$key)) {
            return $element->$key;
        }

        return $element;
    }

    /**
     * @param array $array
     * @param string $key
     * @return array
     */
    protected function getArray($array, $key = '$')
    {
        $result = array();

        foreach ($array as $element) {
            if (isset($element->$key)) {
                $result[] = $element->$key;
            }
        }

        return $result;
    }

    /**
     * @param array $array
     * @param string $key
     * @param string $value
     * @return array
     */
    protected function getArrayWithKey($array, $key = 'type', $value = '$')
    {
        $result = array();

        foreach ($array as $element) {
            if (isset($element->$key) && isset($element->$value)) {
                $result[$key] = $element->$value;
            }
        }

        return $result;
    }

    /**
     * @param array $array
     * @param string $class
     * @return array
     */
    protected function getArrayOfObject($array, $class)
    {
        $result = array();

        foreach ($array as $element) {
            $result[] = $this->serializer->denormalize($element, $class, 'json');
        }

        return $result;
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
        curl_setopt($ch, CURLOPT_USERAGENT, AllocineApi::USER_AGENT);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);

        list(,$jsonObject) = each(json_decode($response));

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
}
