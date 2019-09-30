<?php
return array(
	"siteUrl" => "https://deploy-advert-board.herokuapp.com/",
	"database" => [
		"type" => "mysql",
		"dbName" => "5guXXl7T6b",
		"serverName" => "remotemysql.com",
		"port" => "3306",
		"user" => "5guXXl7T6b",
		"password" => "6gXBHqZaCG",
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
