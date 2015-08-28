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

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                  $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
        }

        function getStores()
        {
            $query = $GLOBALS['DB']->query("SELECT store_id FROM brands_stores WHERE brand_id = {$this->getId()};");
            $store_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $stores = array();
            foreach($store_ids as $id) {
                $store_id = $id['store_id'];
                $result = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$store_id};");
                $returned_store = $result->fetchAll(PDO::FETCH_ASSOC);

                $name = $returned_store[0]['name'];
                $id = $returned_store[0]['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }
    }
?>
