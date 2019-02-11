<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class <?= $class_name ?> extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/<?= strtolower($class_name) ?>/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/<?= strtolower($class_name) ?>/1');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testAdd()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/<?= strtolower($class_name) ?>/new');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function testEdit()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/<?= strtolower($class_name) ?>/1/edit');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
