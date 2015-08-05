<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;

class UserModel
{

    private $userRepo;


    public function __construct($em)
    {
        $this->userRepo = $em->getRepository(C::REPO_USER);
    }

    public function getAll()
    {
        return $this->userRepo->findAll();
    }
}