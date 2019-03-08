<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManager;

class <?= $class_name ?> extends WebTestCase
{
    public function init(){
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'unittest',
            'PHP_AUTH_PW'   => 'test1234',
            ]);

        return $client;
    }

    public function testIndex()
    {
        $client =  $this->init();
        $crawler = $client->request('GET', '/<?= strtolower($class_name) ?>/');
        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $repo = $this->createMock(<?= ($class_name) ?>Repository::class);
        $repo->expects($this->once())
        ->method('getList');
    }

    public function testShow()
    {
        $client =  $this->init();
        $crawler = $client->request('GET', '/<?= strtolower($class_name) ?>/1');
        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }

    public function testAdd()
    {
        $client =  $this->init();
        $crawler = $client->request('POST', '/<?= strtolower($class_name) ?>/new');
        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $token = $this->createMock(EntityManager::class);
        $token->expects($this->once())
        ->method('persist');
        $token->expects($this->once())
        ->method('flush');
    }

    public function testEdit()
    {
        $client =  $this->init();
        $crawler = $client->request('POST', '/<?= strtolower($class_name) ?>/1/edit');
        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $token = $this->createMock(EntityManager::class);
        $token->expects($this->once())
        ->method('persist');
        $token->expects($this->once())
        ->method('flush');
    }

    public function testDelete()
    {
        $client =  $this->init();
        $crawler = $client->request('DELETE', '/<?= strtolower($class_name) ?>/1/delete');
        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $token = $this->createMock(EntityManager::class);
        $token->expects($this->once())
        ->method('remove');
        $token->expects($this->once())
        ->method('flush');
    }
}
