## PHP & MySQL Demo

### Require

* PHP development environment
    * [XAMP](https://www.apachefriends.org/index.html)
    * [MAMP](https://www.mamp.info/en/)

* Code editor
    * [Atom](https://atom.io/)
    * [Visual Studio Code](https://code.visualstudio.com/)

### Import Database

1. Open browser go ``localhost/phpmyadmin``
2. Create table with name ``php-basic``
3. Import file ``php-basic/db.sql``

### Edit File Configs

path: ``php-basic/configs.php``

```php
$configs = array(
    'site_url' => 'http://localhost:8888/php-basic',
    'view_default' => 'posts',

    'db' => array(
        'server' => 'localhost',
        'user' => 'root',
        'pwd' => 'root',
        'db_name' => 'php-basic',
    )
);
```

### Run Demo

``localhost:8888/php-basic``