<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

//use App\Domain\User\User;

use App\Application\Actions\Action;
use App\Domain\Users;
use Psr\Http\Message\ResponseInterface as Response;

class ViewUserAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');
        
        // $user = $this->userRepository->findUserOfId($userId);
        // $user = User::find($userId);
        $user = self::$entityManager->getRepository(Users::class)->findOneBy(['id' => $userId]);
        
        $this->logger->info("User of id `${userId}` was viewed.");

        return $this->respondWithData($user->getAsArray());
    }
}
