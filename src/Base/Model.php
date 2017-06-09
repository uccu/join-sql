<?php
namespace uccu\JoinSql\Base;

use uccu\JoinSql\Traits;
use stdClass;
use uccu\JoinSql\Sql;

abstract class Model{

    use Traits\ModelConfigure;
    use Traits\ModelAction;
    use Traits\ModelSet;
    use Traits\InstanceTrait;

    protected $_var;
    protected $_fun;
    protected $_tableName;
    

    function __construct($tableName = null){

        if(!$tableName)$tableName = $this->_tableName;

        $this->_var = new stdClass;
        $this->_fun = new stdClass;

        $this->_fun->handle = Sql\Handle::getSingleInstance();

        $database = Sql\Database::getMutiInstance(
            $this->_fun->handle->defaultDatabase,
            $this->_fun->handle->defaultPrefix
        );

        $table = Sql\Table::getMutiInstance($tableName,$database);

        $this->setTable($table);

        $this->init();

    }
    # 设置
    abstract protected function init();
    
    
}