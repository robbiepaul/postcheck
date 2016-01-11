<?php

namespace PostCheck\Http\Controllers;

use Illuminate\Http\Request;

use PostCheck\Http\Requests;
use PostCheck\Http\Controllers\Controller;
use PostCheck\User;

class FacebookController extends Controller
{

    public function callback(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
    {
        // Obtain an access token.
        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Access token will be null if the user denied the request
        // or if someone just hit this URL outside of the OAuth flow.
        if (! $token) {
            // Get the redirect helper
            $helper = $fb->getRedirectLoginHelper();

            if (! $helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            // User denied the request
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
            );
        }

        if (! $token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauth_client = $fb->getOAuth2Client();

            // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

        // Save for later
        \Session::put('fb_user_access_token', (string) $token);

        // Get basic info on the user from Facebook.
        try {
            $response = $fb->get('/me?fields=id,name,email');
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
        $facebook_user = $response->getGraphUser();

        $user = User::firstOrCreate([
            'facebook_user_id' => $facebook_user->getId()
        ]);

        $user->name = $facebook_user->getName();
        $user->email = $facebook_user->getEmail();
        $user->save();

        flash()->success('Successfully logged in with Facebook');

        // Log the user into Laravel
        \Auth::login($user);

        return redirect('/dashboard');
    }
}
