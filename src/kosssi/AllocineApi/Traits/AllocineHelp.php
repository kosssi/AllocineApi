<?php

namespace kosssi\AllocineApi\Traits;

/**
 * Class AllocineHelp
 *
 * @author Simon Constans <kosssi@gmail.com>
 */
trait AllocineHelp
{
    /** @var \Symfony\Component\Serializer\Serializer */
    protected $serializer;

    /**
     * @param $element
     * @param string $key
     *
     * @return mixed
     */
    protected function getValue($element, $key = '$')
    {
        if (isset($element[$key])) {
            return $element[$key];
        }

        return $element;
    }

    /**
     * @param array  $array
     * @param string $key
     *
     * @return array
     */
    protected function getArray($array, $key = '$')
    {
        $result = array();

        foreach ($array as $element) {
            if (isset($element[$key])) {
                $result[] = $element[$key];
            }
        }

        return $result;
    }

    /**
     * @param array  $array
     * @param string $key
     * @param string $value
     *
     * @return array
     */
    protected function getArrayWithKey($array, $key = 'type', $value = '$')
    {
        $result = array();

        foreach ($array as $element) {
            if (isset($element[$key]) && isset($element[$value])) {
                $result[$key] = $element[$value];
            }
        }

        return $result;
    }

    /**
     * @param array  $array
     * @param string $class
     *
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
}
