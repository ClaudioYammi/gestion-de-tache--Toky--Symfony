<?php

namespace App\Test\Controller;

use App\Entity\ListeTache;
use App\Repository\ListeTacheRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListeTacheControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ListeTacheRepository $repository;
    private string $path = '/liste/tache/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ListeTache::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ListeTache index');

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
            'liste_tache[nom_tache]' => 'Testing',
            'liste_tache[date_ajout]' => 'Testing',
        ]);

        self::assertResponseRedirects('/liste/tache/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ListeTache();
        $fixture->setNom_tache('My Title');
        $fixture->setDate_ajout('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ListeTache');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ListeTache();
        $fixture->setNom_tache('My Title');
        $fixture->setDate_ajout('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'liste_tache[nom_tache]' => 'Something New',
            'liste_tache[date_ajout]' => 'Something New',
        ]);

        self::assertResponseRedirects('/liste/tache/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom_tache());
        self::assertSame('Something New', $fixture[0]->getDate_ajout());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ListeTache();
        $fixture->setNom_tache('My Title');
        $fixture->setDate_ajout('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/liste/tache/');
    }
}
