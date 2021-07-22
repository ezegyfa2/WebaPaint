<?php


namespace App\Helpers;


trait LoginTokenGetter
{
    static $currentToken = null;

    public function getLoginToken() {
        if (static::$currentToken == null) {
            echo static::$currentToken;
            static::$currentToken = $this->getNewLoginToken();
        }
        return static::$currentToken;
    }

    public function getNewLoginToken() {
        $response = $this->post('/api/users/login', [
            'email' => 'test@test.hu',
            'password' => 'test',
        ]);
        $responseObject = json_decode($response->content());
        return $responseObject->access_token;
    }
}
