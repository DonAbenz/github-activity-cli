<?php

class Events
{
   private $api_url;

   public function __construct($username)
   {
      $this->api_url = "https://api.github.com/users/{$username}/events";
   }

   public function fetchEvents()
   {
      $opts = [
         'http' => [
            'method' => 'GET',
            'header' => [
               'User-Agent: GitHub-Activity-CLI'
            ]
         ]
      ];

      $context = stream_context_create($opts);
      $json_data = @file_get_contents($this->api_url, false, $context);

      if ($json_data === false) {
         $error = error_get_last();
         throw new Exception("Failed to fetch data from GitHub API. Error: " . $error['message']);
      }

      $decoded_data = json_decode($json_data, true);

      if (json_last_error() !== JSON_ERROR_NONE) {
         throw new Exception("Failed to decode JSON response: " . json_last_error_msg());
      }

      return $decoded_data;
   }

   public function display() {
      try {
         $events = $this->fetchEvents();

         echo "Recent GitHub activity:\n";
         foreach ($events as $event) {
            $type = $event['type'];
            $repo = $event['repo']['name'];

            switch ($type) {
               case 'PushEvent':
                  $commit_count = count($event['payload']['commits']);
                  echo "- Pushed {$commit_count} commit(s) to {$repo}\n";
                  break;
               case 'IssuesEvent':
                  $action = ucfirst($event['payload']['action']);
                  echo "- {$action} a new issue in {$repo}\n";
                  break;
               case 'WatchEvent':
                  echo "- Starred {$repo}\n";
                  break;
               case 'ForkEvent':
                  $forked_repo = $event['payload']['forkee']['full_name'];
                  echo "- Forked {$repo} to {$forked_repo}\n";
                  break;
               case 'CreateEvent':
                  $ref_type = $event['payload']['ref_type'];
                  $ref = $event['payload']['ref'] ?? '';
                  echo "- Created a new {$ref_type} {$ref} in {$repo}\n";
                  break;
            }
         }
      } catch (Exception $e) {
         echo $e->getMessage() . "\n";
      }
   }
}
