<?php
namespace uccu\JoinSql\Sql;

use uccu\JoinSql\Traits;

class Table {

    use Traits\InstanceTrait;

    public $database;

    function __construct(string $tableName,Database $database){

        $this->database = $database;
        $this->prefix = $database->defaultPrefix;

        $this->sqlName = Handle::quoteField($this->prefix.$tableName);
        $this->name = $this->prefix.$tableName;


    }

    function setDatabase(Database $database){

        $this->database = $database;
        $this->prefix = $database->defaultPrefix;
        $this->sqlName = Handle::quoteField($this->prefix.$tableName);
        $this->name = $this->prefix.$tableName;

    }
    
    function __toString(){

        return $this->sqlName;
    }
    











}