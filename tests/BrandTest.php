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

    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function testGetType()
        {
            //Arrange
            $type = "Nike";
            $test_brand = new Brand($type);

            //Act
            $result = $test_brand->getType();

            //Assert
            $this->assertEquals($type, $result);
        }

        function testSetType()
        {
            //Arrange
            $type = "Nike";
            $test_brand = new Brand($type);

            //Act
            $test_brand->setType("Adidas");
            $result = $test_brand->getType();

            //Assert
            $this->assertEquals("Adidas", $result);
        }

        function testGetId()
        {
            //Arrange
            $id = 1;
            $type = "Wash the dog";
            $test_brand = new Brand($type, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function testGetAll()
        {
            //Arrange
            $type = "Nike";
            $id = 1;
            $test_brand = new Brand($type, $id);
            $test_brand->save();


            $type2 = "Adidas";
            $id2 = 2;
            $test_brand2 = new Brand($type2, $id2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }


        function testSave()
        {
            //Arrange
            $type = "Nike";
            $id = 1;
            $test_brand = new Brand($type, $id);

            //Act
            $test_brand->save();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals($test_brand, $result[0]);
        }

        function testSaveSetsId()
        {
            //Arrange
            $type = "Nike";
            $id = 1;
            $test_brand = new Brand($type, $id);

            //Act
            $test_brand->save();

            //Assert
            $this->assertEquals(true, is_numeric($test_brand->getId()));
        }

        function testDeleteAll()
        {
            //Arrange
            $type = "Nike";
            $id = 1;
            $test_brand = new Brand($type, $id);
            $test_brand->save();

            $type2 = "Adidas";
            $id2 = 2;
            $test_brand2 = new Brand($type2, $id2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();

            //Assert
            $result = Brand::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $type = "Nike";
            $id = 1;
            $test_brand = new Brand($type, $id);
            $test_brand->save();

            $type2 = "Adidas";
            $id2 = 2;
            $test_brand2 = new Brand($type2, $id2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand->getId());

            //Assert
            $this->assertEquals($test_brand, $result);
        }

        function testAddStore()
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
            $test_brand->addStore($test_store);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }

        function testGetStores()
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

            $type = "Nike";
            $id3 = 3;
            $test_brand = new Brand($type, $id3);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
        }
    }
?>
