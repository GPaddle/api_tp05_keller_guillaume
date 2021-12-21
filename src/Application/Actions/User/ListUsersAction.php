<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

//use App\Domain\User\User;

use App\Application\Actions\Action;
use App\Domain\Users;
use Psr\Http\Message\ResponseInterface as Response;

class ListUsersAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // $users = User::all();
        $users = self::$entityManager->getRepository(Users::class)->findAll();
        $users = array_map([$this, 'describe'], $users);

        $this->logger->info("Users list was viewed.");

        return $this->respondWithData($users);
    }
}
