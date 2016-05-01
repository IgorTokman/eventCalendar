# eventCalendar

A Symfony project created on March 25, 2016, 10:10 pm.

The "eventCalendar" is a reference application created to show how
to develop Symfony applications following the recommended best practices.

Requirements
------------

  * PHP 5.3 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements](http://symfony.com/doc/current/reference/requirements.html).

If unsure about meeting these requirements, download the demo application and
browse the `http://localhost:8000/config.php` script to get more detailed
information.

Installation
------------

```sh
$ git clone https://github.com/IgorTokman/eventCalendar.git && cd eventCalendar
$ composer install
```

Usage
-----

If you have PHP 5.4 or higher, there is no need to configure a virtual host in your web server to access the application.
Just use the built-in web server:

```sh
$ cd eventCalendar
$ php bin/console server:run
```

This command will start a web server for the Symfony application. Now you can
access the application in your browser at <http://localhost:8000>. You can
stop the built-in web server by pressing `Ctrl + C` while you're in the
terminal.

> **NOTE**
>
> If you're using PHP 5.3, configure your web server to point at the `web/`
> directory of the project. For more details, see:
> http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html