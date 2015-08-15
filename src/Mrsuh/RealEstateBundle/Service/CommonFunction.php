<?php

namespace Mrsuh\RealEstateBundle\Service;

class CommonFunction
{

    public static function checkEmail($email, $exception = true)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if($exception) {
                throw new \Exception('Опечатка в имени почтового ящика: ' . $email);
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

    public static function stringToDateTime($date)
    {
        if(null === $date) {
            return null;
        }

        list($day, $month, $year) = explode('.', $date);
        $date = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year));
        return new \DateTime($date);
    }

    public static function imageCrop($file_input, $file_output, $width, $quality) {
        list($w_i, $h_i, $type) = getimagesize($file_input);
        if (!$w_i || !$h_i) {
            throw new \Exception('Can not get height or width of file');
        }
        $types = array('','gif','jpeg','png');
        $ext = $types[$type];
        if ($ext) {
            $func = 'imagecreatefrom'.$ext;
            $img = $func($file_input);
        } else {
            throw new \Exception('Invalid format');
        }

        $squire = $w_i > $h_i ? $h_i : $w_i;

        $img_o = imagecreatetruecolor($width, $width);
        ImageCopyResampled($img_o, $img, 0, 0, 0, 0, $width, $width, $squire, $squire);
        if ($type == 2) {
            return imagejpeg($img_o,$file_output,$quality);
        } else {
            $func = 'image'.$ext;
            return $func($img_o,$file_output);
        }
    }
} 