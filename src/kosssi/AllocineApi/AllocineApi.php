<?php

namespace kosssi\AllocineApi;

/**
 * Allocine API
 *
 * PHP 5.3
 *
 * @author     Simon Constans <kosssi@gmail.com>
 * @version    GIT:  https://github.com/kosssi/AllocineApi
 * @see        http://wiki.gromez.fr/dev/api/allocine_v3
 */

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

/**
 * AllocineApi
 *
 * @author Simon Constans <kosssi@gmail.com>
 */
class AllocineApi
{
    const PARTNER = 'YW5kcm9pZC12M3M';
    const URL = 'http://api.allocine.fr/rest/v3/';

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

    /**
     * Informations sur un film
     *
     * @param $code
     * @param string $profile
     * @param string $mediafmt
     * @param string $filter
     * @param string $striptags
     * @return AllocineMovie
     */
    public function movie(
        $code,
        $profile = 'large',
        $mediafmt = null,
        $filter = null,
        $striptags = null
    )
    {
        $url = $this->getUrl(__FUNCTION__, get_defined_vars());

        return $this->request(__FUNCTION__, $url, 'kosssi\AllocineApi\Entity\Movie');
    }

    private function request($page, $url, $class)
    {
        $file = file_get_contents($url);
        $json = json_decode($file);

        return $this->serializer->denormalize($json->$page, $class, 'json');
    }

    private function getUrl($page, array $args)
    {
        $urlParameters = '';
        foreach ($args as $key => $value) {
            if (!is_null($value)) {
                if (is_array($value)) {
                    $urlParameters .= '&' . $key . '=' . implode(',', $value);
                } else {
                    $urlParameters .= '&' . $key . '=' . $value;
                }
            }
        }

        return self::URL . $page . '?partner=' . self::PARTNER . $urlParameters;
    }
}