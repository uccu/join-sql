<?php
namespace uccu\JoinSql\Sql;

use uccu\JoinSql\Traits;
    
class Database {

    use Traits\InstanceTrait;

    function __construct(string $name,string $prefix){

        $this->sqlName = Handle::quoteField($name);
        $this->name = $name;
        $this->defaultPrefix = $prefix;

    }

    function reset(string $name,string $prefix){

        $this->sqlName = Handle::quoteField($name);
        $this->name = $name;
        $this->defaultPrefix = $prefix;

    }
    












}