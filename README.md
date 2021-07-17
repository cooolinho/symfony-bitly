# Symfony Bitly

## Setup

### 1. Docker laden

```
docker-compose build
docker-compose up -d
```

### 1. Composer und NPM Packages installieren

```
composer install
yarn install && yarn encore dev
```

### 2. MySql Datenbank einrichten

```
php bin/console doctrine:scheme:create
```

oder

```
php bin/console doctrine:migrations:migrate
```

### 3. im Browser öffnen

> open [http://localhost]

### Problems

#### Debug Toolbar Error

``
composer require symfony/apache-pack
``

#### Composer could not find the config file ([ComposerIssue] auf GitHub):

``
unset COMPOSER
``

#### 404 Not Found

https://stackoverflow.com/questions/60537798/symfony-4-route-the-requested-url-was-not-found-on-this-server
``
composer require symfony/apache-pack
``

## [Admin-Dashboard]

```
E-Mail = admin@example.com
Passwort = secret
```

#### Database Connection

> **Note:** look in .env - File

Falls die IP Adresse sich von dw__symfony_bitly_db geändert hat, 
via Terminal auf DB Docker Service zugreifen und abfragen:

``
hostname -i
``

## DEV Tools

### [Adminer]

```
Benutzer = root
Passwort = db_root_password
```

### [Mailcatcher]

[http://localhost]: <http://localhost>

[Adminer]: <http://localhost:8080>

[Mailcatcher]: <http://localhost:1080>

[Admin-Dashboard]: <http://localhost/admin>

