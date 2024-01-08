<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Domain\Token\Service\TokenFinder;
use App\Domain\Token\Service\TokenCreator;
use App\Domain\User\Data\UserLoginResult;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class UserLogin
{

    private UserRepository $repository;
    
    private LoggerInterface $logger;

    private TokenFinder $tokenFinder;
    private TokenCreator $tokenCreator;

    public function __construct(
        UserRepository $repository,
        LoggerFactory $loggerFactory,
        TokenFinder $tokenFinder,
        TokenCreator $tokenCreator
    ) {
        $this->repository = $repository;
        $this->tokenCreator = $tokenCreator;
        $this->tokenFinder = $tokenFinder;
        $this->logger = $loggerFactory
            ->addFileHandler('user_login.log')
            ->createLogger();
    }

    public function loginUser(array $data): UserLoginResult
    {
        // Get user and get new user ID
             
        $data = [ 'email' => $data["user"],
                  'pass' => $data["pass"]];
        $user = $this->repository->getUserLogin($data['email'], $data['pass']);
        $scope = $this->repository->getPermissionsByUser($user['id_rol'] + 0);
        $token = $this->tokenFinder->finderToken($user['id']);
        if (count($token)===0) {
            $token = $this->tokenCreator->createToken(["user_id"=>$user['id'], "scope"=>$scope]);
        }
        // Logging
        $this->logger->info(sprintf('User reader successfully: %s', $user));
        // Return response
        $result = new UserLoginResult();
        $result->id = $user['id'];
        $result->token = $token['token'];
        $result->id_rol = $user['id_rol'];
        $result->name = $user['nombre'].' '.$user['apellido'];

        return $result;
    }
}
