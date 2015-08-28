# _Shoe Store_

##### _App to list shoe stores and the brands they carry, 8/28/15_

#### By _**Don Schemmel**_

## Description

_App that uses a database to create a many to many relationship between shoe stores
and the shoe brands they carry. Allows create, read, update, and delete functionality._

## Setup

* _Clone the repository and database_
* _Import database_
* _Start up MAMP to run Apache and MySQL server_
* _Run composer install_
* _Configure the correct port number for localhost_
* _Run localhost:8000 out of web folder to view_

## MySQL Commands

* _CREATE DATABASE shoes;_
* _USE shoes;_
* _CREATE TABLE stores (id serial PRIMARY KEY, name varchar (255));_
* _CREATE TABLE brands (id serial PRIMARY KEY, type varchar (255));_
* _CREATE TABLE brands_stores (id serial PRIMARY KEY, brand_id int, store_id int);_

## Technologies Used

* _HTML_
* _CSS/Bootstrap_
* _PHP_
* _MySQL_
* _Silex_
* _Twig_
* _PHPUnit_

### Legal

Copyright (c) 2015 **_Don Schemmel_**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
