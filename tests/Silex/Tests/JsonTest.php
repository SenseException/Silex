<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Silex\Tests;

use PHPUnit\Framework\TestCase;
use Silex\Application;

/**
 * JSON test cases.
 *
 * @author Igor Wiedler <igor@wiedler.ch>
 */
class JsonTest extends TestCase
{
    public function testJsonReturnsJsonResponse(): void
    {
        $app = new Application();

        $response = $app->json();
        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $response = json_decode($response->getContent(), true);
        $this->assertSame([], $response);
    }

    public function testJsonUsesData(): void
    {
        $app = new Application();

        $response = $app->json(['foo' => 'bar']);
        $this->assertSame('{"foo":"bar"}', $response->getContent());
    }

    public function testJsonUsesStatus(): void
    {
        $app = new Application();

        $response = $app->json([], 202);
        $this->assertSame(202, $response->getStatusCode());
    }

    public function testJsonUsesHeaders(): void
    {
        $app = new Application();

        $response = $app->json([], 200, ['ETag' => 'foo']);
        $this->assertSame('foo', $response->headers->get('ETag'));
    }
}
