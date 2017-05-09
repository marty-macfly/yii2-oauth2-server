<?php

namespace app\models;

class Oauth2Users extends User implements \OAuth2\Storage\UserCredentialsInterface
{
	use \macfly\oauth2server\traits\Oauth2User;
}
