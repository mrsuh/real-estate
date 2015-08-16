<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\C;
use Mrsuh\RealEstateBundle\Service\CommonFunction;

class UserModel
{

    private $userRepo;
    private $roleRepo;
    private $advertRepo;
    private $mail;
    private $em;


    public function __construct($em, $mail)
    {
        $this->em = $em;
        $this->userRepo = $em->getRepository(C::REPO_USER);
        $this->roleRepo = $em->getRepository(C::REPO_ROLE);
        $this->advertRepo = $em->getRepository(C::REPO_ADVERT);
        $this->mail = $mail;
    }

    public function getAllExceptSystem()
    {
        return $this->userRepo->findAllExceptSystem();
    }

    public function getUserById($id)
    {
        return $this->userRepo->findOneById($id);
    }

    public function create($params)
    {
        if ($this->userRepo->findOneByUsername($params['username'])) {
            throw new \Exception('Пользователь с логином ' . $params['username'] . ' уже существует');
        };

        CommonFunction::checkEmail($params['email']);

        $password = CommonFunction::generatePassword();
        $params['password'] = $password;
        $params['role'] = $this->roleRepo->findOneByName(C::ROLE_USER);

        $mail = [
            'to' => $params['email'],
            'body' => 'login: ' . $params['username'] . '<br>' . 'pass: ' . $password,
            'subject' => 'Новый пользователь Real-Estate'];
        $this->mail->sendMail($mail);

        return $this->userRepo->create($params);
    }

    public function update($user, $params)
    {
        CommonFunction::checkEmail($params['email']);

        if (!empty($params['password'])) {
            if (C::PASSWORD_LENGTH > strlen($params['password'])) {
                throw new \Exception('Пароль должен содержать не менее ' . C::PASSWORD_LENGTH . ' символов ');
            }

            $mail = [
                'to' => $params['email'],
                'body' => 'login: ' . $params['username'] . '<br>' . 'pass: ' . $params['password'],
                'subject' => 'Новый пароль Real-Estate'];
            $this->mail->sendMail($mail);
        }

        return $this->userRepo->update($user, $params);
    }

    public function getUsersArray()
    {
        $users = [];
        foreach ($this->userRepo->findAll() as $obj) {
            $users[$obj->getId()] = $obj->getLastName() . ' ' . $obj->getFirstName() . ' ' . $obj->getMiddleName();
        }

        return $users;
    }

    public function delete($user)
    {
        $this->em->beginTransaction();
        try {

            $systemUser = $this->userRepo->findOneByUsername(C::SYSTEM_USER);
            foreach ($this->advertRepo->findByUser($user) as $a) {
                $a->setUser($systemUser);
            }

            $this->em->flush();

            $this->userRepo->delete($user);

            $this->em->flush();
            $this->em->commit();
        } catch (\Exception $e) {
            $this->em->rollback();
            throw $e;
        }
    }
}