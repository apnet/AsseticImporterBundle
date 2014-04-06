Assetic Importer Bundle [![Travis-ci status](https://travis-ci.org/apnet/AsseticImporterBundle.png?branch=master)](https://travis-ci.org/apnet/AsseticImporterBundle/)
=======================

The main purpose of a `Bundle` is to exclude `cssrewrite` filter and to bypass known issue
that causes the `cssrewrite` to fail when using the `@AcmeFooBundle` syntax for CSS Stylesheets.

`Bundle` allows you to import files from non-public directories via `assetic` directly into `routing`.
These files can either be a result of an `external program`, or created on the fly from `Symfony`.
`Bundle` и `assetic` keep track of changes to files automatically on every request.

Installation
------------

Add requirements to composer.json:

``` json
{
  "require" : {
    "apnet/assetic-importer-bundle" : "~1.0"
  }
}
```

Register the bundle
-------------------

Register the bundle in the `AppKernel.php` file

``` php
// ...other bundles ...
$bundles[] = new Apnet\AsseticImporterBundle\ApnetAsseticImporterBundle();
if ($this->getEnvironment() == 'dev') {
    // ...other bundles ...
    $bundles[] = new Apnet\AsseticWatcherBundle\ApnetAsseticWatcherBundle();
}
```

Configuration
-------------

Let's assume that you have two directories inside `app/Resources`:

1. `app/Resources/simple_dir` with `style1.css` file
2. `app/Resources/compass_dir` with `config.rb` and all other compass-project files
   (e.g. `sass/style2.scss` and `stylesheets/style2.css`)

Then add the configuration into your `config.yml`

``` yml
apnet_assetic_importer:
    assets:
        dir1:
            source: %kernel.root_dir%/Resources/simple_dir
            target: example1
        dir2:
            source: %kernel.root_dir%/Resources/compass_dir/config.rb
            target: example2
            importer: compass
```

After these changes two css files will be accessible via `/app_dev.php`

1. `/app_dev.php/example1/style1.css`
2. `/app_dev.php/example2/stylesheets/style2.css`.
   Also all files inside `css_dir`, `images_dir`, `javascripts_dir`, `fonts_dir` will ba available.
   `sass_dir` directory contents will be private.

All files will be dumped with `assetic:dump` command.

Assetic Watcher Bundle
======================

Actualy there are two bundles inside `apnet/assetic-importer-bundle`:

1. Apnet\AsseticImporterBundle
2. Apnet\AsseticWatcherBundle

Watcher is a tool, that could be used with `dev` environment to compile
compass project without any external file watchers or IDE.

* Of course Apache user needs write permissions to the `compass_dir/stylesheets` directory

`AsseticWatcherBundle` is disabled by default.

Configuration
-------------

First, to enable Assetic Watcher add these lines to `config_dev.yml`

``` yml
apnet_assetic_watcher:
    compiler_root: %kernel.root_dir%/Resources
    enabled: true
```

And second, add `watcher` parameter to imported asset configuration in `config.yml`

``` yml
apnet_assetic_importer:
    assets:
        # ...
        dir2:
            source: %kernel.root_dir%/Resources/compass_dir/config.rb
            target: example2
            importer: compass
            watcher: true
```
