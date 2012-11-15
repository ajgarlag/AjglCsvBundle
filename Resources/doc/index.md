AjglCsvBundle
==============

The AjglCsvBundle provides some CSV helper clases to your symfony project

## Prerequisites

This version of the bundle has been tested with Symfony 2.1.

## Installation

Installation is a quick process:

1. Download AjglCsvBundle using composer
2. Enable the Bundle
3. Configure the bundle

### Step 1: Download AjglCsvBundle using composer

Add AjglCsvBundle in your composer.json:

```js
{
    "require": {
        "ajgl/csv-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update ajgl/csv-bundle
```

Composer will install the bundle to your project's `vendor/ajgl` directory.

### Step 2: Enable the bundle

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