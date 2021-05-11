<?php

declare(strict_types=1);

namespace Werkspot\KvkApi\Test\Unit\Http\Adapter\Guzzle\Exception;

use GuzzleHttp\Exception\RequestException;
use Mockery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Werkspot\KvkApi\Exception\KvkApiException;
use Werkspot\KvkApi\Http\Adapter\Guzzle\Exception\Handler;
use Werkspot\KvkApi\Http\Adapter\Guzzle\Exception\NotFoundException;

/**
 * @small
 *
 * @internal
 */
final class HandlerTest extends TestCase
{
    /**
     * @test
     */
    public function handle_request_exception_should_throw_generic_exception(): void
    {
        $this->expectException(KvkApiException::class);
        Handler::handleRequestException($this->getException());
    }

    /**
     * @test
     */
    public function handle_request_exception_should_throw_not_found_exception(): void
    {
        $this->expectException(NotFoundException::class);
        Handler::handleRequestException($this->getException(404));
    }

    private function getException(?int $code = 400): RequestException
    {
        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->andReturn($code);

        return new RequestException('', Mockery::mock(RequestInterface::class), $response);
    }
}
