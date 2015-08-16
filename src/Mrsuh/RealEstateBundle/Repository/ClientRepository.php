<?php

namespace Mrsuh\RealEstateBundle\Repository;

use Mrsuh\RealEstateBundle\Service\CommonFunction;
use Doctrine\ORM\EntityRepository;
use Mrsuh\RealEstateBundle\Entity\Client;


class ClientRepository extends EntityRepository
{
    public function create($params)
    {
        $this->_em->beginTransaction();
        try {

            $obj = new Client();

            $time = new \DateTime();
            $obj->setCreateTime($time);
            $obj->setUpdateTime($time);

            foreach ([
                         'name1',
                         'name2',
                         'name3',
                         'phone1',
                         'phone2',
                         'phone3',
                         'city',
                         'object_type',
                         'price_from',
                         'price_to',
                         'room_from',
                         'room_to',
                         'common_area_from',
                         'common_area_to',
                         'live_area_from',
                         'live_area_to',
                         'kitchen_area_from',
                         'kitchen_area_to',
                         'section_area_from',
                         'section_area_to',
                         'floor_from',
                         'floor_to',
                         'floors_from',
                         'floors_to',
                         'user',
                         'birth_day',
                         'status',
                         'process_time',
                         'show_time',
                         'comment',
                         'mortgage',
                         'hot',

                     ] as $v) {
                if (isset($params[$v]) && !is_null($p = $params[$v])) {
                    $s = 'set' . CommonFunction::dashesToCamelCase($v);
                    $obj->$s($p);
                }
            }

            $this->_em->persist($obj);

            $this->_em->flush();
            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $obj;
    }

    public function update($obj, $params)
    {
        $this->_em->beginTransaction();
        try {
            $obj->setUpdateTime(new \DateTime());
            foreach ([
                         'name1',
                         'name2',
                         'name3',
                         'phone1',
                         'phone2',
                         'phone3',
                         'city',
                         'object_type',
                         'price_from',
                         'price_to',
                         'room_from',
                         'room_to',
                         'common_area_from',
                         'common_area_to',
                         'live_area_from',
                         'live_area_to',
                         'kitchen_area_from',
                         'kitchen_area_to',
                         'section_area_from',
                         'section_area_to',
                         'floor_from',
                         'floor_to',
                         'floors_from',
                         'floors_to',
                         'birth_day',
                         'status',
                         'comment',
                         'mortgage',
                         'hot',

                     ] as $v) {
                if (array_key_exists($v, $params)) {
                    $s = 'set' . CommonFunction::dashesToCamelCase($v);
                    $obj->$s($params[$v]);
                }
            }

            $this->_em->persist($obj);

            $this->_em->commit();
        } catch (\Exception $e) {
            $this->_em->rollback();
            throw $e;
        }

        return $obj;
    }

    public function findByParams($params)
    {
        $qb = $this->createQueryBuilder('c');


        if(!is_null($params['status'])) {
            $qb->andWhere('c.status= :status')
                ->setParameter('status', $params['status']);
        }

        if(!is_null($params['phone'])) {
            $qb->andWhere('c.phone1 LIKE :phone OR c.phone2 LIKE :phone OR c.phone3 LIKE :phone')
                ->setParameter('phone', '%'.$params['phone'].'%');
        }

        if(!is_null($params['user'])) {
            $qb->join('c.user', 'user');
            $qb->andWhere('user.id = :user')
                ->setParameter('user', $params['user']);
        }

        if(!is_null($params['order_field'])){
            switch($params['order_field']){
                case 'id':
                    $qb->orderBy('c.id', $params['order_type']);
                    break;
                case 'phone':
                    $qb->orderBy('c.phone1', $params['order_type']);
                    break;
                case 'name':
                    $qb->orderBy('c.name1', $params['order_type']);
                    break;
                case 'create_time':
                    $qb->orderBy('c.createTime', $params['order_type']);
                    break;
                case 'update_time':
                    $qb->orderBy('c.updateTime', $params['order_type']);
                    break;
                case 'hot':
                    $qb->orderBy('c.hot', $params['order_type']);
                    break;
                case 'mortgage':
                    $qb->orderBy('c.mortgage', $params['order_type']);
                    break;
                case 'status':
                    $qb->orderBy('c.status', $params['order_type']);
                    break;
                case 'user':
                    $qb->join('c.user', 'user');
                    $qb->orderBy('user.lastName', $params['order_type']);
                    break;
            }
        }

        return $qb->getQuery();
    }

    public function existClientByPhone($phone)
    {
        $qb = $this->createQueryBuilder('c');
            $qb->andWhere('c.phone1 = :phone OR c.phone2 = :phone OR c.phone3 = :phone')
                ->setParameter('phone', $phone);

        return $qb->getQuery()->getResult();
    }
}
