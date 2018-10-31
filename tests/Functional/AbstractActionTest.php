<?php declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractActionTest extends WebTestCase
{
    /** @var Client */
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    protected function assertResponseContains(Response $response, array $data): void
    {
        $this->assertArraySubset($data, json_decode($response->getContent(), true));
    }
}