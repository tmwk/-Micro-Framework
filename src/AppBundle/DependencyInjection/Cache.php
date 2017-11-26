<?php

/**
 * Created by PhpStorm.
 * User: mfigueroa
 * Date: 08/07/2016
 * Time: 12:05
 */

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Cache
{
    protected $container;

    /**
     * CacheManager constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Elimina el cache de una URL
     * @param $route
     * @param array $parameters
     */
    public function invalidate($route, array $parameters = array())
    {
        $url = $this->container->get('router')->generate($route, $parameters, true);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_exec($curl);
    }
}