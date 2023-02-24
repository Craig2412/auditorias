<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserRepository;
use App\Domain\Token\Service\TokenFinder;
use App\Domain\User\Data\UserLoginResult;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;

final class UserLogin
{

    private UserRepository $repository;
    
    private LoggerInterface $logger;

    private TokenFinder $tokenFinder;

    public function __construct(
        UserRepository $repository,
        LoggerFactory $loggerFactory,
        TokenFinder $tokenFinder
    ) {
        $this->repository = $repository;
        $this->tokenFinder = $tokenFinder;
        $this->logger = $loggerFactory
            ->addFileHandler('user_login.log')
            ->createLogger();
    }

    public function loginUser(array $data): UserLoginResult
    {
        // Get user and get new user ID
        $user = $this->repository->getUserLogin($data['email'], $data['pass']);
        $token = $this->tokenFinder->finderToken($user['id']);
        // Logging
        $this->logger->info(sprintf('User reader successfully: %s', $user));

        $result = new UserLoginResult();
        $result->id = $user['id'];
        $result->token = $token['token'];

        return $result;
    }
}
