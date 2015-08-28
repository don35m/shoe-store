<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Brand::deleteAll();
          Store::deleteAll();

        }

        function testGetName()
        {
            //Arrange
            $name = "Foot Locker";
            $test_store = new Store($name);

            //Act
            $result = $test_store->getName();

            //Assert
            $this->assertEquals($name, $result);

        }

        function testSetName()
        {
            //Arrange
            $name = "Foot Locker";
            $test_store = new Store($name);

            //Act
            $test_store->setName("Zappos");
            $result = $test_store->getName();

            //Assert
            $this->assertEquals("Zappos", $result);
        }

        function testGetId()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $test_store = new Store($name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }


        function testGetAll()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $name2 = "Zappos";
            $id2 = 2;
            $test_store = new Store($name, $id);
            $test_store->save();
            $test_store2 = new Store($name2, $id2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $name2 = "Zappos";
            $id2 = 2;
            $test_store2 = new Store($name2, $id2);
            $test_store2->save();

            //Act
            Store::deleteAll();

            //Assert
            $result = Store::getAll();
            $this->assertEquals([], $result);
        }

        function testDeleteStore()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $name2 = "Zappos";
            $id2 = 2;
            $test_store2 = new Store($name2, $id2);
            $test_store2->save();


            //Act
            $test_store->delete();

            //Assert
            $this->assertEquals([$test_store2], Store::getAll());
        }

        function testFind()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $name2 = "Zappos";
            $id2 = 2;
            $test_store2 = new Store($name2, $id2);
            $test_store2->save();

            //Act
            $result = Store::find($test_store->getId());

            //Assert
            $this->assertEquals($test_store, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $new_name = "Zappos";

            //Act
            $test_store->update($new_name);

            //Assert
            $this->assertEquals("Zappos", $test_store->getName());
        }

        function testAddBrand()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $type = "Nike";
            $id2 = 2;
            $test_brand = new Brand($type, $id2);
            $test_brand->save();

            //Act
            $test_store->addBrand($test_brand);

            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand]);
        }

        function testGetBrands()
        {
            //Arrange
            $name = "Foot Locker";
            $id = 1;
            $test_store = new Store($name, $id);
            $test_store->save();

            $type = "Nike";
            $id2 = 2;
            $test_brand = new Brand($type, $id2);
            $test_brand->save();

            $type2 = "Adidas";
            $id3 = 3;
            $test_brand2 = new Brand($type2, $id3);
            $test_brand2->save();

            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);

            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand, $test_brand2]);
        }
    }
?>
