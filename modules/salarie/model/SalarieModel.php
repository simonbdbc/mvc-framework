<?php
    namespace Model;
    use Core\Model\Model as Model;

    class Page extends Model
    {
        protected $tableName = "sections";

        function __construct()
        {
            parent::__construct();
        }
    }