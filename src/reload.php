<?php

require_once __DIR__ . '/init.php';

use init\DiscordApi;

$DiscordApi = new DiscordApi();

return $DiscordApi->activity();