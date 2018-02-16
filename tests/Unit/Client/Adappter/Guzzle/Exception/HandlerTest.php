<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Tests\Unit\Http\Adapter\Guzzle\Exception;

use GuzzleHttp\Exception\RequestException;
use Mockery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Http\Adapter\Guzzle\Exception\Handler;

/**
 * @small
 */
final class HandlerTest extends TestCase
{
    /**
     * @test
     * @expectedException \Werkspot\KvkApi\Exception\KvkApiException
     */
    public function handleRequestException_shouldThrowGenericException(): void
    {
        Handler::handleRequestException($this->getException());
    }

    /**
     * @test
     * @expectedException \Werkspot\KvkApi\Http\Adapter\Guzzle\Exception\NotFoundException
     */
    public function handleRequestException_shouldThrowNotFoundException(): void
    {
        Handler::handleRequestException($this->getException(404));
    }

    private function getException(?int $code = 400): RequestException
    {
        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->andReturn($code);

        return new RequestException('', Mockery::mock(RequestInterface::class), $response);
    }
}
