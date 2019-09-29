<?php
return array(
	"siteUrl" => "https://deploy-advert-board.herokuapp.com/",
	"database" => [
		"type" => "pgsql",
		"dbName" => "d96hdsptjm9ldh",
		"serverName" => "ec2-54-228-243-238.eu-west-1.compute.amazonaws.com",
		"port" => "5432",
		"user" => "yghrlyjtrhiovc",
		"password" => "59379cbbfec6115cf29004098ea6c91c7a25e5b13cfbf52947da907d83830dd4",
		"options" => [],
		"cache" => false
	],
	"sessionName" => "board",
	"namespaces" => [],
	"templateEngine" => 'Ubiquity\\views\\engine\\Twig',
	"templateEngineOptions" => array("cache" => false),
	"test" => false,
	"debug" => false,
	"logger" => function () {
		return new \Ubiquity\log\libraries\UMonolog("board", \Monolog\Logger::INFO);
	},
	"di" => ["@exec" => ["jquery" => function ($controller) {
		return \Ubiquity\core\Framework::diSemantic($controller);
	}]],
	"cache" => ["directory" => "cache/", "system" => "Ubiquity\\cache\\system\\ArrayCache", "params" => []],
	"mvcNS" => ["models" => "models", "controllers" => "controllers", "rest" => ""],
	"isRest" => function () {
		return \Ubiquity\utils\http\URequest::getUrlParts()[0] === "rest";
	}
);
