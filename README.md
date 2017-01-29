Zaymer test
=========

## Installation
    composer global require "fxp/composer-asset-plugin:^1.2.0"

### Clone the Repository
    $ git clone https://github.com/googlle/zaymer.git

### Creating the MySQL Database

Create database "zaymer" and create tables "users" and "comments" :

```sql
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  INDEX index_user_id (user_id),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
### Test data
```sql
INSERT INTO `users` (`id`, `name`, `balance`, `email`, `password`, `auth_key`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '1000.00', 'admin@gmail.com', '$2y$13$VppRtDcJWVrH6ddq2bLb1./eOA943h3DM0ourZJex23sfNsOHZ6Su', 'GPTFUnJhKaPv1huPTSq1mToZMFhqIj1v', 1, 1, '2017-01-29 10:49:04', '2017-01-29 10:49:05'),
(2, 'user', '1000.00', 'user@gmail.com', '$2y$13$C0FK268b9US71.twl3a1S.KBn0wmLFxEcUM1cM7L7pDz/saROhTg.', '06d30EBqr4v8ArvTTbOnGJxBhXlpOq_G', 1, 1, '2017-01-29 10:49:18', '2017-01-29 10:49:18');

INSERT INTO `comments` (`id`, `user_id`, `text`, `created_at`) VALUES
(1, 2, 'Test', '2017-01-29 10:49:33'),
(2, 2, 'Text', '2017-01-29 10:49:37'),
(3, 1, 'Text', '2017-01-29 10:49:56'),
(4, 1, 'Comment', '2017-01-29 10:50:01');
```

### Setup the `config/db.php` file
```php
<?php

//DATABASE CONNECTION
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=zaymer',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];

```