# PHP Rate Limiting with Redis


PHP script for rate limiting with Redis.
This script was written on a Ubuntu Machine.

## Usage

#### Setup Project

##### Git Clone Via Command Line

`git clone https://github.com/Blesson-dev/rate-limiting.git` to the project folder under /var/www/

##### Composer Install

Run `composer install` inside project folder to get all dependencies under vendor folder.

#### Create env file from .env.example file

Copy contents from .env.example to a newly created .env file.
Replace with appropriate values inside .env file.
If Redis doesn't need authentication, remove REDIS_PASSWORD from .env

### Test Ratelimiter

Execute Following command from the terminal.
Replace project_folder with appropriate name.


```
curl -H "Accept: text/plain" -H "Content-Type: text/plain" -X GET http://localhost/project_folder/index.php?[1-5]
```

#### Output
Assuming values 
MAX_CALLS_LIMIT=3
TIME_PERIOD=10

```
[1/5]: http://localhost/project_folder/index.php?1 --> <stdout>
--_curl_--http://localhost/project_folder/index.php?1
Client 127.0.0.1 total calls made 1 in 10 seconds
[2/5]: http://localhost/project_folder/index.php?2 --> <stdout>
--_curl_--http://localhost/project_folder/index.php?2
Client 127.0.0.1 total calls made 2 in 10 seconds
[3/5]: http://localhost/project_folder/index.php?3 --> <stdout>
--_curl_--http://localhost/project_folder/index.php?3
Client 127.0.0.1 total calls made 3 in 10 seconds
[4/5]: http://localhost/project_folder/index.php?4 --> <stdout>
--_curl_--http://localhost/project_folder/index.php?4
User 127.0.0.1 limit exceeded.
[5/5]: http://localhost/project_folder/index.php?5 --> <stdout>
--_curl_--http://localhost/project_folder/index.php?5
User 127.0.0.1 limit exceeded.
```

### Directory Structure Before Execution

```
.
|-- vendor/
|-- .env
|-- .env.example
|-- composer.json
|-- composer.lock
|-- .scrutinizer.yml
|-- index.php
`-- README.md

```
