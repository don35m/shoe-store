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



    }
?>
