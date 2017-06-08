<?php
namespace uccu\JoinSql\Base;

use uccu\JoinSql\Traits;

abstract class Model{

    use Traits\ModelConfigure;
    use Traits\ModelAction;
    use Traits\ModelSet;
    
    # 设置
    abstract public function init();

    
}