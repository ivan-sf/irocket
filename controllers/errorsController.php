<?php namespace controllers;

/**
* 
*/
class errorsController
{
	private $errors;

	public function __construct()
	{
		$this->errors = 'Isma';
	}

	public function create()
	{
		$datos = $this->errors;
		return $datos;
	}

	public function index()
	{
	}

}
$error = new errorsController();