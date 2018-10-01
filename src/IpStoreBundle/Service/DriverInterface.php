<?php
/**
 * Created by PhpStorm.
 * User: petro
 * Date: 01.10.18
 * Time: 19:47
 */

namespace IpStoreBundle\Service;


interface DriverInterface
{
    /**
     * @param string $ip
     * @return int
     */
    public function add(string $ip): int;

    /**
     * @param string $ip
     * @return int
     */
    public function query(string $ip): int;

}