<?php
$I = new FunctionalTester($scenario);
$I->wantTo('perform password credential');
$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
$I->sendPOST('/token', ['grant_type' => 'password', 'client_id' => 'testclient','client_secret'=>'testpass','username'=>'demo','password'=>'demo']);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
$I->seeResponseIsJson();
$I->seeResponseContainsJson(array('token_type' => 'Bearer'));
$I->seeResponseMatchesJsonType([
    'access_token' => 'string',
    'expires_in' => 'integer',
    'token_type' => 'string',
    'refresh_token' => 'string'
]);
$refresh_token = $I->grabDataFromResponseByJsonPath('$.refresh_token')[0];
$I = new FunctionalTester($scenario);
$I->wantTo('perform refresh_token');
$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
$I->sendPOST('/token', ['grant_type' => 'refresh_token', 'client_id' => 'testclient','client_secret'=>'testpass','refresh_token'=>$refresh_token]);
$I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
$I->seeResponseIsJson();
$I->seeResponseContainsJson(array('token_type' => 'Bearer'));
$I->seeResponseMatchesJsonType([
    'access_token' => 'string',
    'expires_in' => 'integer',
    'token_type' => 'string',
    'refresh_token' => 'string'
]);
