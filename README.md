# PHP Rate Limiting With Redis


PHP script for rate limiting with Redis.\
The maximum number of calls  and the timeframe in seconds can be defined from .env.\
This script was written on an Ubuntu Machine.

## Usage

#### Prerequisites

- LAMP Stack
- Composer 2.0 
  - Install composer from : `https://getcomposer.org/download/`
- Redis Server
- Redis Library for PHP
  - Install the php-redis extension : `sudo apt-get install php{$PHP_VERSION}-redis`

#### Setup Project

##### Git clone via command line

`git clone https://github.com/Blesson-dev/rate-limiting.git .` to the project folder under /var/www/html/

##### Composer install

Run `composer install` inside project folder to get all dependencies under vendor folder.

#### Create .env file from .env.example file

Copy contents from .env.example to a newly created .env file.\
Replace with appropriate values inside .env file.\
If Redis doesn't need authentication, remove REDIS_PASSWORD from .env

```
MAX_CALLS_LIMIT : is the maximum number of calls a user can access the resource.
TIME_PERIOD : defines the timeframe in seconds within which a user is allowed to access the resource per the MAX_CALLS_LIMIT.\
(Set this to 1 if ratelimiting is per sec.)
REDIS_URL : Redis connection url (example localhost value being 127.0.0.1)
REDIS_PORT : Redis Port to connect (example port being 6379)
REDIS_PASSWORD : redis password if authentication is required, if not remove this from .env

```

### Test Ratelimiter

Execute Following command from the terminal.
Replace project_folder with project folder name.


```
curl -H "Accept: text/plain" -H "Content-Type: text/plain" -X GET http://localhost/project_folder/index.php?[1-5]
```

#### Output
Assuming values 
```
MAX_CALLS_LIMIT=3
TIME_PERIOD=10
```

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
