<?php
    class Brand
    {
        private $type;
        private $id;

        function __construct($type, $id = null)
        {
            $this->type = $type;
            $this->id = $id;
        }

        function setType($new_type)
        {
            $this->type = (string) $new_type;
        }

        function getType()
        {
            return $this->type;
        }

        function getId()
        {
            return $this->id;
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $type = $brand['type'];
                $id = $brand['id'];
                $new_brand = new Brand($type, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }


        function save()
        {
              $GLOBALS['DB']->exec("INSERT INTO brands (type) VALUES ('{$this->getType()}');");
              $this->id = $GLOBALS['DB']->lastInsertId();
        }
    }
?>
