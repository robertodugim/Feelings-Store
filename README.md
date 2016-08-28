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
