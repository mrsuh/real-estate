<?php

namespace Artvisio\CdnApiBundle\Service;

class CommonFunction
{

    public static function checkEmail($email, $exception = true)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if($exception) {
                throw new \Exception('Typo in domain: ' . $email);
            }
            return false;
        }

        return true;
    }

    public static function dashesToCamelCase($string, $littleFirstLetter = false)
    {
        $words = explode('_', $string);
        if($littleFirstLetter){
            $str = array_shift($words);
        } else {
            $str = '';
        }
        foreach($words as $w) {
            $str .= str_replace(' ', '',(ucfirst($w)));
        }
        return $str;
    }

    public static function generatePassword($length = 8)
    {
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , $length );
    }

    public static function checkRoles($currentRole, $roles = [])
    {
        return in_array($currentRole, $roles);
    }
} 