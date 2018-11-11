<?php
$connection = mysqli_connect('localhost', 'root', '', 'rpgapp');
$connection->query('set character_set_client=utf8');
$connection->query('set character_set_connection=utf8');
$connection->query('set character_set_results=utf8');
$connection->query('set character_set_server=utf8');