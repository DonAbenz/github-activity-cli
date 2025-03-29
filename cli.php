<?php
include_once 'Events.php';

$arg = $argv[1] ?? null;

if ($arg === null) {
   echo "Please provide a username.\n";
   exit(1);
}

$events = new Events($arg);

$events->display();
