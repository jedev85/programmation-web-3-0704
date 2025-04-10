<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PingouinControllerTest extends WebTestCase
{
    public function testListPingouin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/pingouin');

        $this->assertResponseIsSuccessful();

        $this->assertCount(
            20,
            $crawler->filter('tr.pingouin'),
            'La liste des pingouins comporte 20 éléments.'
        );
    }

    public function testSearchPingouinNoneResult(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/pingouin?search=Pingouin+00');

        $this->assertResponseIsSuccessful();

        $this->assertCount(
            0,
            $crawler->filter('tr.pingouin'),
            'Aucun élément sur une recherche de Pingouin 00.'
        );
    }

    public function testSearchPingouinOneResult(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/pingouin?search=Pingouin+1');

        $this->assertResponseIsSuccessful();

        $this->assertCount(
            1,
            $crawler->filter('tr.pingouin'),
            '1 élément sur une recherche de Pingouin 1.'
        );
    }
}
