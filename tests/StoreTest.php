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
        //   Brand::deleteAll();
        //   Store::deleteAll();

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

    }
?>
