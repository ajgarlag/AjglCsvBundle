AjglCsvBundle
=====================

This bundle integrates the AjglCsv library into Symfony.


Instalation
-----------

###Download AjglCsvBundle

Add AjglCsvBundle in your composer.json:

```js
{
    "require": {
        "ajgl/csv-bundle": "*"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update ajgl/csv-bundle
```

Composer will install the bundle to your project's `vendor/ajgl` directory.


###Enable the Bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Ajgl\Bundle\CsvBundle\AjglCsvBundle(),
    );
}
```

###Add new constraints to your classes

You can now the CSV service. For example:

```php
<?php
namespace Acme\UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class DefaultController extends Controller
{
    public function indexAction()
    {
        $csv = $this->container->get('ajgl_csv');
        $path = tempnam(sys_get_temp_dir(), 'CSV-');
        $writer = $csv->createWrite($path);
        $writer->writeRow(array('a', 'b', 'c', 'd'));
        $writer->writeRow(array(0, 1, 2, 3));
        $writer->close();
        return new BinaryFileResponse($path);
    }

}

```

By default, the new constraints namespace is aliased as `AjglEs`. You can
modify in the bundle configuration

Configuration
-------------

To configure the bundle, add the following configuration to your `config.yml`
file.

``` yaml
# app/config/config.yml
ajgl_csv:
    reader_default_type: "rfc" #"php" by default. The default reader type.
    writer_default_type: "rfc" #"php" by default. The default writer type.
```
