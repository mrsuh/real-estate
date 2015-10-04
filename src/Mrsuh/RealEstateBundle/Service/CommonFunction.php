<?php

namespace Mrsuh\RealEstateBundle\Service;

use Doctrine\ORM\Tools\Pagination\Paginator;

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

    public static function paginate($query, $data)
    {
        if(!isset($data['items_on_page'])){
            $data['items_on_page'] = 20;
        }

        if(!isset($data['pages_range'])){
            $data['pages_range'] = 5;
        }

        $paginator = new Paginator($query);//@todo double request

        $totalItems = count($paginator);
        $pagesCount = ceil($totalItems / $data['items_on_page']);

        if($data['current_page'] > $pagesCount){
            $data['current_page'] = 1;
        }

        $paginator
            ->getQuery()
            ->setFirstResult($data['items_on_page'] * ($data['current_page']-1)) // set the offset
            ->setMaxResults($data['items_on_page']); // set the limit

        return [
            'items' => $paginator,
            'pagination' => [
                'current_page' => $data['current_page'],
                'total_pages' => $pagesCount,
                'pages' => self::paginationNumbers($data['current_page'], $pagesCount, $data['pages_range'])
            ]
        ];
    }

    private static function paginationNumbers($page, $total, $range = 5)
    {
        if($range % 2 === 0){
            $range++;
        }

        $half = ($range - 1)/2;

        $right = $page + $half;

        if($right > $total){
            $left = $page - ($right - $total) - $half;
        } else {
            $left = $page - $half;
        }

        if($left <= 0){
            $right += abs($left);
            $right++;
            $left = 1;
        }

        $numbers = [];

        for($i=$left; $i<=$right && $i<=$total; $i++){
            $numbers[] = [
                'name' => $i,
                'index' => $i
            ];
        }

        return $numbers;
    }
} 