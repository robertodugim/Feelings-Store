# Feelings Store

**Feelings Store project**

##Requirements

`PHP >= 5.6`

`Composer`

##Installation
My installation was made in http://localhost/Feelings-Store/

-> Download the Zip

-> Change .htaccess RewriteBase
```php
RewriteBase /Feelings-Store/src
```

-> Change src/index.html tag <base>
```php
<base href="http://localhost/Feelings-Store/">
```

-> Change src/includes/feelings-api.js "self.url" on line 6
```php
self.url = "http://localhost/Feelings-Store/api/";
```

-> run `composer install`

##PHP API Documentation

The PHP Class/Methods documentation is in the folder `docs/api`. Powered by [PHPDoc](https://www.phpdoc.org/)

##Storage

The products json is storage in `src/api/storage/basic/products.json`

The cart files will be storage in `src/api/storage/cart/`

##API Requests

All Rest request must be made by GET.

The return always be a json in follow format:
```php
{
"result": "success",//can be error or success
"error": "none",//error message or the string 'none'
"data": null//a json object or a int. If error will be null
}
```

###API Rest Methods Documentation

For a better exemple I will use [Guzzle](http://docs.guzzlephp.org/en/latest/) library:

```php
self::$client = new \GuzzleHttp\Client(['cookies' => true,'base_uri' => 'http://localhost/Feelings-Store/api/']);
```

####Get list of all Products
```php
$response = self::$client->get('products/get_list');
```
*Response*
```php
{
  "result":"success",
  "error":"none",
  "data":{
    "love":{
      "name":"Love",
      "description":"Love is in the air!",
      "author":"Tom Jones",
      "value":1000
    },
    "happiness":{
      "name":"Happiness",
      "description":"Love is in the air!",
      "author":"Tom Jones",
      "value":2000
    }
  }
}
```
