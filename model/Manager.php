<?php
	namespace projet4.vthamarai.com\model;

	class Manager
	{
	    protected function dbConnect()
	    {
	        $db = new \PDO('mysql:host=localhost;dbname=;charset=utf8', '', '');
	        return $db;
	    }
	}