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

        // protected function tearDown()
        // {
        //     Brand::deleteAll();
        //     Store::deleteAll();
        // }

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
    }
?>
