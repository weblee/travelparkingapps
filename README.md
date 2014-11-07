TravelParkingApps
=================

SOAP API for TravelParkingApps

Requirements
-------------

PHP 5.3 and later.

Documentation
--------------
[Full documentation can be found here.](https://www.travelparkingapps.com/Api/Docs/)

Installation via Composer
-------------------------
The recommended method to install _TravelParkingApps_ is through [Composer](http://getcomposer.org).

1. Add ``weblee/travelparkingapps`` as a dependency in your project's ``composer.json`` file (change version to suit your version of TravelParkingApps):

    ```json
        {
            "require": {
                "weblee/travelparkingapps": "~1.0"
            }
        }
    ```

2. Download and install Composer:

    ```bash
        curl -s http://getcomposer.org/installer | php
    ```

3. Install your dependencies:

    ```bash
        php composer.phar install --no-dev
    ```

4. Require Composer's autoloader

    Composer also prepares an autoload file that's capable of autoloading all of the classes in any of the libraries that it downloads. To use it, just add the following line to your code's bootstrap process:

    ```php
        <?php
        require 'vendor/autoload.php';

        $service = new TravelParkingApps\Client('your-api-key');
    ```
You can find out more on how to install Composer, configure autoloading, and other best-practices for defining dependencies at [getcomposer.org](http://getcomposer.org).

You'll notice that the installation command specified `--no-dev`.  This prevents Composer from installing the various testing and development dependencies.  For average users, there is no need to install the test suite (which also includes the complete source code of Elasticsearch).  If you wish to contribute to development, just omit the `--no-dev` flag to be able to run tests.


