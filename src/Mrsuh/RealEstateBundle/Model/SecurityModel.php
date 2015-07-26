<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\Security\Authentication\Token\WsseToken;
use Artvisio\CdnApiBundle\Service\CommonFunction;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class SecurityModel
{

    private $tokenStorage;
    private $em;
    private $userModel;
    private $session;

    public function __construct($tokenStorage, $em, $userModel, $mailModel, $session)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
        $this->userModel = $userModel;
        $this->session = $session;
    }

    public function authorize($user, $role)
    {
        $token = new WsseToken(array($role));
        $token->setUser($user);
        $this->tokenStorage->setToken($token);
    }
}