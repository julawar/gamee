<?php
$router->map('POST','/scores','App\Controllers\ScoresController@receive');
$router->map('POST','/leaderboards','App\Controllers\LeaderboardsController@receive');