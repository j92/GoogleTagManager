Google Tag Manager
==================

This extension inserts the Google Tag Manager code in your pages. Edit the `config.yml` file so
it contains the correct 'gtm_container_id'.

Google DataLayer
================

The Datalayer is inserted before the Tag Manager, just after the start of the <body> tag.
To add variables to the Datalayer you can use the following Twig function

```
{{ GoogleDataLayerPush('name','value') }}
```

To push variables from within the PHP, you can use `pushData` or `pushDataArray`.

```php
// Get DataLayer Service
$googleDataLayerService = $this->app['GoogleDataLayer'];

// Push and validate the data
$googleDataLayerService->pushData($key, $value);

// Push and validate a data array
$googleDataLayerService->pushDataArray(array('key'=>'value'));
```


