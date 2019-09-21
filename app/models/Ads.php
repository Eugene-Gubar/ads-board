<?php

namespace models;

class Ads
{
	/**
	 * @column("name"=>"id","nullable"=>false,"dbType"=>"int(11)")
	 **/
	private $id;

	/**
	 * @column("name"=>"title","nullable"=>false,"dbType"=>"varchar(255)")
	 * @validator("length","constraints"=>array("max"=>255,"notNull"=>true))
	 **/
	private $title;

	/**
	 * @column("name"=>"body","nullable"=>true,"dbType"=>"varchar(2200)")
	 * @validator("length","constraints"=>array("max"=>2200))
	 **/
	private $body;

	/**
	 * @column("name"=>"imageName","nullable"=>true,"dbType"=>"char(32)")
	 * @validator("length","constraints"=>array("max"=>32))
	 **/
	private $imageName;

	/**
	 * @manyToOne
	 * @joinColumn("className"=>"models\\User","name"=>"id_user","nullable"=>false)
	 **/
	private $user;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function setBody($body)
	{
		$this->body = $body;
	}

	public function getImageName()
	{
		return $this->imageName;
	}

	public function setImageName($imageName)
	{
		$this->imageName = $imageName;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function __toString()
	{
		return $this->title;
	}
}
