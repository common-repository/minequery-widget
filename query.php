<?php

if (!class_exists('Minequery')) {
	require('minequery.class.php');
}

$mq_ip = $_GET["mq_ip"];
$mq_port = $_GET["mq_port"];

$online = $_GET["online"];
$offline = $_GET["offline"];
$players = $_GET["players"];
$latency = $_GET["latency"];

$thisarray = Minequery::query($mq_ip,$mq_port);
if (!$thisarray) {
	echo("<div class='mq-status' style='color:red;'>".offline."</div>\n");
} else {
	echo("<div class='mq-status' style='color:green;'>".online."</div>\n");
	echo("<div class='mq-playercount'>$thisarray[playerCount] / $thisarray[maxPlayers] ".players."</div>\n");
	$players=$thisarray[playerList];
	echo("<div class='mq-playerarea'>\n<div class='mq-playertoggle'>Show players</div>\n");
	echo("<div class='mq-players' style='display:none;'>");
	foreach ($players as $player) {
		echo ("<span class='mq-player' style='margin-right:10px;'>$player</span>");
	}
	echo("</div>\n</div>\n");
	echo("<div class='mqlatency'>");
	$latency=number_format($thisarray[latency],3);
	echo($latency);
	echo(" ".latency."</div>\n");
}

