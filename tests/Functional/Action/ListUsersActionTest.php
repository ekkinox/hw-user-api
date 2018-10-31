<?php declare(strict_types=1);

namespace App\Tests\Functional\Action;

use App\Tests\Functional\AbstractActionTest;

/**
 * By default, from test json file.
 * @see config/packages/test/parameters.yaml
 * @see tests/data/
 */
class ListUsersActionTest extends AbstractActionTest
{
    public function testItReturns400OnInvalidParameters()
    {
        $this->client->request('GET', sprintf('/v1/users?offset=%s&limit=%s', -1, -1));

        $response = $this->client->getResponse();

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertResponseContains(
            $response,
            [
                'message' => "[offset]: This value should be greater than or equal to 0.,"
                             . "[limit]: This value should be greater than or equal to 0."
            ]
        );
    }

    public function testItCanSearchParticularUserOnLogin()
    {
        $this->client->request('GET', sprintf('/v1/users?login=%s', 'john'));

        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertResponseContains(
            $response,
            [
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
            ]
        );
    }

    public function testItCanSearchSeveralUsersOnLogin()
    {
        $this->client->request('GET', sprintf('/v1/users?login=%s', 'doe'));

        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertResponseContains(
            $response,
            [
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
                ],
                [
                    'login'=>'json_janedoe',
                    'password'=>'password',
                    'title'=>'mrs',
                    'lastname'=>'doe',
                    'firstname'=>'jane',
                    'gender'=>'female',
                    'email'=>'jane@doe.com',
                    'picture'=>'https://example.com/janedoe.jpg',
                    'address'=>'123 Other Street OtherVille 11111'
                ]
            ]
        );
    }

    public function testItCanSearchSeveralUsersOnLoginWithPagination()
    {
        $this->client->request('GET', sprintf('/v1/users?login=%s&offset=%s&limit=%s', 'doe', 1, 1));

        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertResponseContains(
            $response,
            [
                [
                    'login'=>'json_janedoe',
                    'password'=>'password',
                    'title'=>'mrs',
                    'lastname'=>'doe',
                    'firstname'=>'jane',
                    'gender'=>'female',
                    'email'=>'jane@doe.com',
                    'picture'=>'https://example.com/janedoe.jpg',
                    'address'=>'123 Other Street OtherVille 11111'
                ]
            ]
        );
    }
}