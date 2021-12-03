<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class CorsMiddleware implements Middleware
{
	/**
	 * {@inheritdoc}
	 */
	public function process(Request $request, RequestHandler $handler): Response
	{
		$response = $handler->handle($request);

		$response = $response
			->withHeader('Access-Control-Expose-Headers', '*')
			->withHeader('Access-Control-Allow-Origin', '*')
			->withHeader('Access-Control-Allow-Headers', '*')
			->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
			->withHeader('Access-Control-Allow-Credentials', 'true');

		return $response;
	}
}
