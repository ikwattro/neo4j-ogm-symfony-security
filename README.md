neo4j-symfony-user-provider
===========================

Quick demo using a custom UserProvider backed by a Neo4j database.

## Install :

```bash
composer install
```

## Steps 

Create a User node in your database :

```php
CREATE (n:User {username:"Chris", password:"$2y$13$MAKog3FJcJ0PL4LOhlWplOoQmGOfO2HJVu9LA/bX6maWCYS5g5GWq"})
```

The demo uses the standard bcrypt algo for hashing passwords (see SF Security Provider documentation).

For making it easy, I created a command to hash a plain password so you can set it to the user node in the db.

```bash
php bin/console app:encode-password {your-password}

ex:

ikwattro@graphaware-team ~/d/p/neo4j-symfony-user-provider> php bin/console app:encode-password cool
$2y$13$MAKog3FJcJ0PL4LOhlWplOoQmGOfO2HJVu9LA/bX6maWCYS5g5GWq
```

Head to http://localhost:8001/app_dev.php or the url you are using for SF dev, it will prompt you for a user/pass combination 

It will fail to login because of the usage of the AdvancedUserInterface, the implemented method checks if the user is
active or not. 

It uses the OGM `@Label` tag for the label name `ActiveUser`

```bash
[2017-03-30 22:41:51] security.INFO: Basic authentication Authorization header found for user. {"username":"Chris"} []
[2017-03-30 22:41:51] security.INFO: Basic authentication failed for user. {"username":"Chris","exception":"[object] (Symfony\\Component\\Security\\Core\\Exception\\LockedException(code: 0): User account is locked. at /Users/ikwattro/dev/php/neo4j-symfony-user-provider/vendor/symfony/symfony/src/Symfony/Component/Security/Core/User/UserChecker.php:36)"} []
```

Add this label to your user in the db

```
MATCH (n:User {username:"Chris"}) SET n:ActiveUser
```

Try again to log-in :

Success :

```
oute":"homepage"},"request_uri":"http://localhost:8001/app_dev.php/","method":"GET"} []
[2017-03-30 22:42:14] security.INFO: Basic authentication Authorization header found for user. {"username":"Chris"} []
[2017-03-30 22:42:15] security.DEBUG: Stored the security token in the session. {"key":"_security_main"} []
```

## User Roles from Neo4j

Want to see how to use user roles backed by Neo4j as well, check this PR : 

https://github.com/ikwattro/neo4j-ogm-symfony-security/pull/1