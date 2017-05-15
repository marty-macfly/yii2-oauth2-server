<?php
$I = new FunctionalTester($scenario);
$I->wantTo('perform client credential');
$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
$I->sendPOST('/token', ['grant_type' => 'client_credentials', 'client_id' => 'testclient','client_secret'=>'testpass']);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
$I->seeResponseIsJson();
$I->seeResponseMatchesJsonType([
    'access_token' => 'string',
    'expires_in' => 'integer',
    'token_type' => 'string'
]);
