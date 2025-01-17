<?php

namespace App\Test\Controller;

use App\Entity\Tache;
use App\Repository\TacheRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TacheControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private TacheRepository $repository;
    private string $path = '/tache/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Tache::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Tache index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'tache[debut]' => 'Testing',
            'tache[fin]' => 'Testing',
            'tache[nom_tache]' => 'Testing',
        ]);

        self::assertResponseRedirects('/tache/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Tache();
        $fixture->setDebut('My Title');
        $fixture->setFin('My Title');
        $fixture->setNom_tache('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Tache');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Tache();
        $fixture->setDebut('My Title');
        $fixture->setFin('My Title');
        $fixture->setNom_tache('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'tache[debut]' => 'Something New',
            'tache[fin]' => 'Something New',
            'tache[nom_tache]' => 'Something New',
        ]);

        self::assertResponseRedirects('/tache/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDebut());
        self::assertSame('Something New', $fixture[0]->getFin());
        self::assertSame('Something New', $fixture[0]->getNom_tache());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Tache();
        $fixture->setDebut('My Title');
        $fixture->setFin('My Title');
        $fixture->setNom_tache('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/tache/');
    }
}
