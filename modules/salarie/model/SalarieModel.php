<?php
    namespace Modules\Salarie\Model;
    use Core\Model\Model as Model;

    class SalarieModel extends Model
    {
        protected $tableName = "salaries";

        function __construct()
        {
            parent::__construct();
        }
    }