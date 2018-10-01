<?php

namespace IpStoreBundle\Tests\Controller;

use IpStoreBundle\Service\MySQLDriver;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IpStoreControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ip-store/add');

        $response ='Add IP addresses (IPv4 and IPv6)
<br>
<form action="/ip-store/add" method="post">
    <input type="text" value="" name="ip">
    <input type="submit" value="add">
</form>';
        $this->assertContains($response, $client->getResponse()->getContent());
    }

    public function testQuery()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ip-store/query');

        $response ='Querying IP addresses (IPv4 and IPv6)
<br>
<form action="/ip-store/query">
    <input type="text" value="" name="ip">
    <input type="submit">
</form>';
        $this->assertContains($response, $client->getResponse()->getContent());
    }
}