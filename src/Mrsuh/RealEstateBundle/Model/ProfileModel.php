<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;

class ProfileModel
{
    private $userRepo;

    public function __construct($em)
    {
       $this->userRepo = $em->getRepository(C::REPO_USER);
    }

    public function update($user, $params)
    {
        $this->userRepo->update($user, $params);
    }

}