<?php declare(strict_types=1);

namespace App\Tests\Integration\Responder;

use App\Responder\SerializerResponder;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class SerializerResponderTest extends KernelTestCase
{
    /** @var SerializerResponder */
    private $subject;

    public function setUp()
    {
        parent::setUp();

        static::bootKernel();

        $this->subject = new SerializerResponder(
            static::$container->get(SerializerInterface::class)
        );
    }

    public function testCreateDefaultJsonResponse()
    {
        $data = ['some' => 'data'];

        $response = $this->subject->createJsonResponse($data);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(json_encode($data), $response->getContent());
    }

    public function testCreateCustomJsonResponse()
    {
        $data = ['some' => 'data'];

        $response = $this->subject->createJsonResponse($data, 201, ['some' => 'header']);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('header', $response->headers->get('some'));
        $this->assertEquals(json_encode($data), $response->getContent());
    }

    public function testCreateDefaultErrorJsonResponse()
    {
        $exception = new Exception('error message');

        $response = $this->subject->createErrorJsonResponse($exception);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertArraySubset(
            [
                'message' => 'error message',
                'file' => __FILE__,
            ],
            json_decode($response->getContent(), true)
        );
    }

    public function testCreateCustomErrorJsonResponse()
    {
        $exception = new Exception('error message');

        $response = $this->subject->createErrorJsonResponse($exception, 501, ['some' => 'header']);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(501, $response->getStatusCode());
        $this->assertEquals('header', $response->headers->get('some'));
        $this->assertArraySubset(
            [
                'message' => 'error message',
                'file' => __FILE__,
            ],
            json_decode($response->getContent(), true)
        );
    }

    public function testCreateHttpErrorJsonResponse()
    {
        $exception = $this->createHttpException('error message');

        $response = $this->subject->createErrorJsonResponse($exception);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(417, $response->getStatusCode());
        $this->assertEquals('exceptionHeader', $response->headers->get('some'));
        $this->assertArraySubset(
            [
                'message' => 'error message',
                'file' => __FILE__,
            ],
            json_decode($response->getContent(), true)
        );
    }

    private function createHttpException(string $message): Throwable
    {
        return new class ($message) extends Exception implements HttpExceptionInterface
        {
            public function getStatusCode()
            {
                return 417;
            }

            public function getHeaders()
            {
                return ['some' => 'exceptionHeader'];
            }
        };
    }
}