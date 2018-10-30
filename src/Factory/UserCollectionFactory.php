<?php declare(strict_types=1);

namespace App\Factory;

use App\Domain\Collection\UserCollection;
use App\Domain\Collection\UserCollectionInterface;
use App\Domain\Model\User;
use App\Domain\Model\UserInterface;
use LogicException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserCollectionFactory
{
    /** @var ParameterBagInterface */
    private $parameterBag;

    /** @var SerializerInterface */
    private $serializer;

    public function __construct(ParameterBagInterface $parameterBag, SerializerInterface $serializer)
    {
        $this->parameterBag = $parameterBag;
        $this->serializer = $serializer;
    }

    /**
     * @throws LogicException
     */
    public function create(string $format): UserCollectionInterface
    {
        $path = sprintf('data.%s.path', $format);

        if (!$this->parameterBag->has($path)) {
            throw new LogicException(
                sprintf("Invalid format '%s', no parameter '%s' was configured.", $format, $path)
            );
        }

        /** @var UserInterface[] $users */
        $users = $this->serializer->deserialize(
            file_get_contents($this->parameterBag->get($path)),
            User::class . '[]',
            $format
        );

        return new UserCollection($users);
    }
}
