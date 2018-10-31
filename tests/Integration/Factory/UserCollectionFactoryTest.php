<?php declare(strict_types=1);

namespace App\Tests\Integration\Factory;

use App\Factory\UserCollectionFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @see config/packages/test/parameters.yaml
 * @see tests/data/
 */
class UserCollectionFactoryTest extends KernelTestCase
{
    /** @var UserCollectionFactory */
    private $subject;

    public function setUp()
    {
        parent::setUp();

        static::bootKernel();

        $this->subject = new UserCollectionFactory(
            static::$container->get(ParameterBagInterface::class),
            static::$container->get(SerializerInterface::class)
        );
    }

    /**
     * @expectedException \LogicException
     * @expectedExceptionMessage Invalid format 'invalid', no parameter 'data.invalid.path' was configured.
     */
    public function testCreateFailureWithInvalidFormat()
    {
        $this->subject->create('invalid');
    }

    public function testCreateFromJson()
    {
        $userCollection = $this->subject->create('json');

        $this->assertCount(2, $userCollection->all());

        $this->assertEquals('json_johndoe', $userCollection->get('json_johndoe')->getId());
        $this->assertEquals('john', $userCollection->get('json_johndoe')->getFirstname());

        $this->assertEquals('json_janedoe', $userCollection->get('json_janedoe')->getId());
        $this->assertEquals('jane', $userCollection->get('json_janedoe')->getFirstname());
    }

    public function testCreateFromCsv()
    {
        $userCollection = $this->subject->create('csv');

        $this->assertCount(2, $userCollection->all());

        $this->assertEquals('csv_johndoe', $userCollection->get('csv_johndoe')->getId());
        $this->assertEquals('john', $userCollection->get('csv_johndoe')->getFirstname());

        $this->assertEquals('csv_janedoe', $userCollection->get('csv_janedoe')->getId());
        $this->assertEquals('jane', $userCollection->get('csv_janedoe')->getFirstname());
    }
}