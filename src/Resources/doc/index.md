AjglCsvBundle Documentation
===========================


Installation
------------

###Download the bundle

To install the latest stable version, open a console and execute the following command:
```
$ composer require ajgl/csv-bundle
```

###Enable the bundle

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


Usage
-----

You can now use the CSV service getting it from the container with the key `ajgl_csv`.

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
