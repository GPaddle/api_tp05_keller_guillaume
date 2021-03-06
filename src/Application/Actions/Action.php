<?php

declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\DomainException\DomainRecordNotFoundException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

abstract class Action
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    /**
     * @var EntityManager
     */
    protected static $entityManager = null;

    /**
     * @param LoggerInterface $logger
     * @param EntityManager $em
     */
    public function __construct(LoggerInterface $logger, EntityManager $em = null)
    {
        $this->logger = $logger;
        self::$entityManager = self::createEntityManager();
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    abstract protected function action(): Response;

    /**
     * @return array|object
     * @throws HttpBadRequestException
     */
    protected function getFormData()
    {
        $input = json_decode(file_get_contents('php://input'));

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @param  string $name
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    /**
     * @param array|object|null $data
     * @param int $statusCode
     * @return Response
     */
    protected function respondWithData($data = null, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);

        return $this->respond($payload);
    }

    /**
     * @param array|object|null $data
     * @param int $statusCode
     * @return Response
     */
    protected function respondWithDataAndHeaders($data = null, $headers = null, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);

        $response = $this->respond($payload);

        foreach ($headers as $header) {
            $response = $response->withHeader($header[0], $header[1]);
        }

        return $response;
    }

    /**
     * @param ActionPayload $payload
     * @return Response
     */
    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($payload->getStatusCode());
    }

    /**
     * @return EntityManager
     */
    public static function createEntityManager()
    {
        if (!is_null(self::$entityManager)) {
            return self::$entityManager;
        }

        $devMode = true;

        $path = __DIR__ . "/../../../app/config/yaml";

        $config = Setup::createYAMLMetadataConfiguration(array($path), $devMode);

        // define credentials...
        $connectionOptions = array(
            'host' => getenv('db_host'),
            'driver' => getenv('db_driver'),
            'user' => getenv('db_user'),
            'password' => getenv('db_password'),
            'dbname' => getenv('db_dbname'),
            'port' => getenv('db_port')
        );

        self::$entityManager = EntityManager::create($connectionOptions, $config);

        return self::$entityManager;
    }

    protected function sendError(String $message)
    {
        $data = [
            'message' => ucfirst($message)
        ];

        return $this->respondWithData($data, 422);
    }

    protected function describe($item)
    {
		return is_null($item) ? [] : $item->getAsArray();
    }
}
