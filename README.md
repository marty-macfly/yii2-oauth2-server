yii2-oauth2-server
==================

A wrapper for Filsh/yii2-oauth2server(https://github.com/Filsh/yii2-oauth2-server) which implement an OAuth2 Server(https://github.com/bshaffer/oauth2-server-php)

Add missing code that make it easy to use with social network aware user module like the one from dektrium/yii2-user(https://github.com/dektrium/yii2-user)

Add controller:

* Authorize (http://bshaffer.github.io/oauth2-server-php-docs/controllers/authorize/)
* Token (http://bshaffer.github.io/oauth2-server-php-docs/controllers/token/)
* User (Provide user information id, username, e-mail, ...)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist macfly/yii2-oauth2-server "*"
```

or add

```json
"macfly/yii2-oauth2-server": "*"
```

to the require section of your composer.json.

To use this extension,  simply add the following code in your application configuration as a new module:

```php
'modules'=>[
        //other modules .....
        'oauth2' => [
            'class' => 'macfly\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'userModel' => 'app\models\User',
        ]
    ],
```

Also, extend ```app\models\User``` - user model - implementing the interface ```\OAuth2\Storage\UserCredentialsInterface```, so the oauth2 credentials data stored in user table.

You should implement (for convenience a trait is provide):
- findIdentityByAccessToken()
- checkUserCredentials()
- getUserDetails()

You can extend the model if you prefer it (please, remember to update the config files) :

```
use Yii;

class User extends app\models\User implements \OAuth2\Storage\UserCredentialsInterface
{
	use \macfly\oauth2server\traits\Oauth2User;
}
```

The next step you should run migration

```php
yii migrate --migrationPath=@vendor/filsh/yii2-oauth2-server/migrations
```

this migration create the oauth2 database scheme and insert test user credentials ```testclient:testpass``` for ```http://fake/```

Usage
-----

You can see the filsh documentation to use token (https://github.com/Filsh/yii2-oauth2-server/tree/v2.0.0#usage)

