# GitHub Activity CLI

A simple command-line tool to fetch and display recent GitHub activity for a specified user. This project is inspired by the [GitHub User Activity](https://roadmap.sh/projects/github-user-activity) challenge.

## Features

-  Fetches recent GitHub events for a user using the GitHub API.
-  Displays activity such as:
   -  Push events (commits pushed to repositories).
   -  Issue events (created or updated issues).
   -  Watch events (starred repositories).
   -  Fork events (forked repositories).
   -  Create events (new branches, tags, or repositories).

## Requirements

-  PHP 7.4 or higher.
-  Internet connection to access the GitHub API.

## Installation

1. Clone this repository:
   ```bash
   git clone https://github.com/DonAbenz/github-activity-cli.git
   cd github-activity-cli
   ```
2. Ensure PHP is installed and available in your system's PATH.

## Usage

Run the CLI tool by providing a GitHub username as an argument:

```bash
php cli.php <github-username>
```

## Error Handling

-  If the username is not provided, the tool will prompt you to enter one.
-  Handles errors such as:
   -  Failed API requests.
   -  Invalid JSON responses.

## Future Improvements

-  Add support for authentication to increase API rate limits.
-  Display additional event types.
-  Improve output formatting for better readability.
