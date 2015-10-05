<?php namespace Mrsuh\RealEstateBundle\Model;

use Mrsuh\RealEstateBundle\Security\Authentication\Token\WsseToken;
use Artvisio\CdnApiBundle\Service\CommonFunction;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class SecurityModel
{
    private $userModel;
    private $mailModel;
    private $dbName;
    private $rootDir;

    public function __construct($userModel, $mailModel, $dbName, $rootDir)
    {
        $this->userModel = $userModel;
        $this->mailModel = $mailModel;
        $this->dbName = $dbName;
        $this->rootDir = $rootDir;
    }

    public function createDbDump()
    {
        $date = new \DateTime();

        $attach = $this->rootDir . '/../' . $this->dbName . '_' . $date->format('Y-m-d') . '.sql';

        exec('mysqldump ' . $this->dbName . ' > ' . $attach);
        if(!file_exists($attach)){
            throw new \Exception('Database dump error');
        }

        $email = $this->userModel->getSystemUser()->getEmail();
        $this->mailModel->sendMail([
            'to'=> $email,
            'body' => 'DB dump',
            'subject' => 'Real-Estate DB Dump ' .  $date->format('Y-m-d'),
            'attach' => $attach
        ]);

        unlink($attach);
    }
}