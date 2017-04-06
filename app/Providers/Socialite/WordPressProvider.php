<?php namespace App\Providers\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class WordPressProvider extends AbstractProvider implements ProviderInterface 
{
    
    const IDENTIFIER = 'WORDPRESS';
    
    protected $scopes = [];
    
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://public-api.wordpress.com/oauth2/authorize', $state);
    }
    
    protected function getTokenUrl()
    {
        return 'https://public-api.wordpress.com/oauth2/token';
    }
    
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            'https://public-api.wordpress.com/rest/v1.1/me', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
    
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map(
            [
                'id' => $user['ID'],
                'nickname' => $user['username'],
                'name' => $user['display_name'],
                'email' => array_get($user, 'email'),
                'avatar' => $user['avatar_URL'],
            ]
        );
    }
    
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}