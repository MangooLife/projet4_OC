<?php
	namespace app\P4_model;

	class Manager
	{
	    protected function dbConnect()
	    {
	        $db = new \PDO('mysql:host=localhost;dbname=;charset=utf8', '', '');
	        return $db;
	    }
	}