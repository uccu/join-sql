<?php
namespace uccu\JoinSql\Traits;

Trait InstanceTrait{

    public static function getSingleInstance(){

        static $object;
		if(empty($object)){

            $params = func_get_args();
            $object = new self(...$params);
        }
		return $object;
    }

    public static function getMutiInstance(string $type){

        static $object;
		if(empty($object) && !isset($object[$type])){

            $params = func_get_args();
            $object[$type] = new self(...$params);
        }
		return $object[$type];
    }

    public static function copyMutiInstance(string $type){

        $params = func_get_args();
        $obj = clone self::getMutiInstance(...$params);
		return $obj;
    }

}