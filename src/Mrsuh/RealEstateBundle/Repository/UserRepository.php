<?php

namespace Mrsuh\RealEstateBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class UserRepository extends EntityRepository
{
    public function create($params)
    {
        $this->_em->beginTransaction();
        try {
            $user = new User();
            $user->setUsername($params['username'])
                ->setRoles($params['role'])
                ->setEmail($params['email'])
                ->setFirstName(isset($params['first_name']) ? $params['first_name'] : null)
                ->setLastName(isset($params['last_name']) ? $params['last_name'] : null)
                ->setMiddleName(isset($params['middle_name']) ? $params['middle_name'] : null)
                ->setPhone(isset($params['phone']) ? $params['phone'] : null)
                ->setStatus(C::STATUS_USER_ACTIVE);

            $salt = md5(time());
            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
            $password = $encoder->encodePassword($params['password'], $salt);
            $user->setPassword($password);
            $user->setSalt($salt);

            $this->_em->persist($user);

            $this->_em->flush();
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $user;
    }

    public function update($user, $params)
    {
        $this->_em->beginTransaction();
        try {
            $user->setEmail(isset($params['email']) ? $params['email'] : null)
                ->setFirstName(isset($params['first_name']) ? $params['first_name'] : null)
                ->setLastName(isset($params['last_name']) ? $params['last_name'] : null)
                ->setMiddleName(isset($params['middle_name']) ? $params['middle_name'] : null)
                ->setPhone(isset($params['phone']) ? $params['phone'] : null);


            if (isset($params['password'])) {
                $salt = md5(time());
                $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
                $password = $encoder->encodePassword($params['password'], $salt);
                $user->setPassword($password);
                $user->setSalt($salt);
            }

            $this->_em->flush();
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $user;
    }

    public function delete($user)
    {
        $this->_em->remove($user);
    }
}
