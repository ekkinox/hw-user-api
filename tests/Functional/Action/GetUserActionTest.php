<?php declare(strict_types=1);

namespace App\Tests\Functional\Action;

use App\Tests\Functional\AbstractActionTest;

/**
 * By default, from test json file.
 * @see config/packages/test/parameters.yaml
 * @see tests/data/
 */
class GetUserActionTest extends AbstractActionTest
{
    public function testItReturns404OnUserNotFound()
    {
        $this->client->request('GET', '/v1/users/invalid');

        $response = $this->client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertResponseContains(
            $response,
            [
                'message' => "User with id 'invalid' cannot be found."
            ]
        );
    }

    public function testItReturnsUserData()
    {
        $this->client->request('GET', '/v1/users/json_johndoe');

        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertResponseContains(
            $response,
            [
                'login'=>'json_johndoe',
                'password'=>'password',
                'title'=>'mr',
                'lastname'=>'doe',
                'firstname'=>'john',
                'gender'=>'male',
                'email'=>'john@doe.com',
                'picture'=>'https://example.com/johndoe.jpg',
                'address'=>'123 Some Street SomeVille 99999'
            ]
        );
    }
}