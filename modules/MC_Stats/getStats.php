<?php
function getStats($uuid_short)
{
    $uuid_long = substr_replace($uuid_short, "-", 8, 0);
    $uuid_long = substr_replace($uuid_long, "-", 13, 0);
    $uuid_long = substr_replace($uuid_long, "-", 18, 0);
    $uuid_long = substr_replace($uuid_long, "-", 23, 0);

    $conns = [
        "geld" => new mysqli("localhost", "forum_Geld", "Ibpw91^1", "Geld"),
        "modularBungee" => new mysqli("localhost", "forum_ModularBungee", "Wymu60#5", "ModularBungee")
    ];

    $stats = [
        "MONEY_CITYBUILD_VALUE" => "0 €",
        "MONEY_FREEBUILD_VALUE" => "0 €",
        "MONEY_SKYBLOCK_VALUE" => "0 €",
        "TERRA_VALUE" => "0 Terra",
        "PLAYTIME_VALUE" => "0h 0m"
    ];

    $result = $conns["geld"]->query("SELECT `money` FROM `Money_CityBuild` WHERE `player_uuid`='" . $uuid_long . "' LIMIT 1");
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $stats["MONEY_CITYBUILD_VALUE"] = number_format($row["money"], 2, ",", ".") . " €";
        }
    }

    $result = $conns["geld"]->query("SELECT `money` FROM `Money_FreeBuild` WHERE `player_uuid`='" . $uuid_long . "' LIMIT 1");
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $stats["MONEY_FREEBUILD_VALUE"] = number_format($row["money"], 2, ",", ".") . " €";
        }
    }

    $result = $conns["modularBungee"]->query("SELECT `time` FROM `PlayerOnlineTime` WHERE `uuid`='" . $uuid_short . "' LIMIT 1");
    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $stats["PLAYTIME_VALUE"] = floor($row["time"] / 60) . "h ";
            $stats["PLAYTIME_VALUE"] += ($row["time"] % 60) . "m";
        }
    }

    return $stats;
}
