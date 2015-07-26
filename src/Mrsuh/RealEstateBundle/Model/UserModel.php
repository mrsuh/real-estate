<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;

class UserModel
{

    private $em;
    private $securityContext;
    private $session;


    public function __construct($em, $securityContext, $session)
    {
        $this->em = $em;
        $this->securityContext;
        $this->session = $session;
    }

    public function createUser($data)
    {
        if ($this->isUserExist($data['username'])) {
            throw new \Exception(__FUNCTION__ . ' USER_EXIST');
        }

        $this->em->getRepository('AdventureTimeBundle:User')->createUser($data);

        return C::OK;
    }

    public function isUserExist($username)
    {
        return (bool)$this->em->getRepository('AdventureTimeBundle:User')->findOneByUsername($username);
    }

    public function getUser()
    {
        $username =  $this->session->get('username');
        return $this->em->getRepository('AdventureTimeBundle:User')->findOneByUsername($username);

    }

    public function setPersonageToUser($personage){
        $user = $this->getUser();

        if(!$user || !is_null($user->getPersonage())) {
            return;
        }

        $personage->setActive(true);
        $user->setPersonage($personage);
        $this->em->flush();
    }
}