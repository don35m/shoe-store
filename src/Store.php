<?php
    class Store
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
              $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
              $this->id = $GLOBALS['DB']->lastInsertId();
        }
        //There was very little teahing on how to write out a join statement
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                  $found_store = $store;
                }
            }
            return $found_store;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand->getId()}, {$this->getId()});");
        }

        function getBrands()
        {
            $query = $GLOBALS['DB']->query("SELECT brand_id FROM brands_stores WHERE store_id = {$this->getId()};");
            $brand_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $brands = array();
            foreach($brand_ids as $id) {
                $brand_id = $id['brand_id'];
                $result = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$brand_id};");
                $returned_brand = $result->fetchAll(PDO::FETCH_ASSOC);

                $type = $returned_brand[0]['type'];
                $id = $returned_brand[0]['id'];
                $new_brand = new Brand($type, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
    }
?>
