<?php

namespace models;

class User
{
	/**
	 * @id
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	 **/
	private $id;

	/**
	 * @column("name"=>"email","nullable"=>false,"dbType"=>"varchar(320)")
	 * @validator("email","constraints"=>array("notNull"=>true))
	 * @validator("length","constraints"=>array("max"=>320))
	 **/
	private $email;

	/**
	 * @column("name"=>"name","nullable"=>false,"dbType"=>"varchar(64)")
	 * @validator("length","constraints"=>array("max"=>64,"notNull"=>true))
	 **/
	private $name;

	/**
	 * @column("name"=>"lastname","nullable"=>false,"dbType"=>"varchar(64)")
	 * @validator("length","constraints"=>array("max"=>64,"notNull"=>true))
	 **/
	private $lastname;

	/**
	 * @column("name"=>"password","nullable"=>false,"dbType"=>"char(32)")
	 * @validator("length","constraints"=>array("max"=>32,"notNull"=>true))
	 **/
	private $password;

	/**
	 * @column("name"=>"phone","nullable"=>false,"dbType"=>"varchar(20)")
	 * @validator("length","constraints"=>array("max"=>20,"notNull"=>true))
	 **/
	private $phone;

	/**
	 * @column("name"=>"role","nullable"=>false,"dbType"=>"varchar(10)")
	 **/
	private $role;

	/**
	 * @oneToMany("mappedBy"=>"user","className"=>"models\\Ads")
	 **/
	private $adss;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getLastname()
	{
		return $this->lastname;
	}

	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function setPhone($phone)
	{
		$this->phone = $phone;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function setRole($role)
	{
		$this->role = $role;
	}

	public function getAdss()
	{
		return $this->adss;
	}

	public function setAdss($adss)
	{
		$this->adss = $adss;
	}

	public function __toString()
	{
		return $this->email;
	}
}
