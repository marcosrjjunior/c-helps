<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Exception;
use Guzzle\Http\Client;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Socialite;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return redirect('auth/github');
        }

        if ( ! $this->verifyOrganization($user->user['organizations_url'])) {
            return redirect()->back()->with('company_error', 'You must belong to this company!');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/');
    }

    public function verifyOrganization($organizationsUrl)
    {
        $companies = [];
        $client = new Client();
        $response = $client->get($organizationsUrl)->send();

        if ( ! is_array($response->json())) {
            return false;
        }

        // Get organizations names
        foreach($response->json() as $data) {
            $companies[] = $data['login'];
        }

        if (in_array(env('C-HELPS_COMPANY'), $companies)) {
            return true;
        }

        return false;
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::whereGithubId($githubUser->id)->first()) {
            return $authUser;
        }

        return User::create([
            'name'      => $githubUser->name,
            'email'     => $githubUser->email,
            'github_id' => $githubUser->id,
            'avatar'    => $githubUser->avatar
        ]);
    }

}
