<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    public function index()
    {
        if ($this->isLoggedIn()) {
            return view('index', ['username' => $this->getUsername()]);
        }
        return redirect()->route('login');
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            return redirect()->route('index');
        } else {
            return view('login');
        }
    }

    public function loginPost(Request $request)
    {
        $credentials = $this->getCredentials();
        if ($credentials && $this->checkCredentials($request->input('username'), $request->input('password'), $credentials)) {
            $this->setSession($request->input('username'));
            return redirect()->route('index');
        } else {
            return redirect()->route('login')->withErrors('Invalid credentials');
        }
    }

    public function logout()
    {
        $this->clearSession();
        return redirect()->route('login');
    }

    private function isLoggedIn()
    {
        return Session::has('username');
    }

    private function getUsername()
    {
        $usernameData = Session::get('username');
        return $usernameData['name'] ?? null;
    }

    private function getCredentials()
    {
        $filePath = base_path('credentials.txt');
        if (file_exists($filePath)) {
            $fileContents = file_get_contents($filePath);
            return array_map('trim', explode("\n", $fileContents));
        }
        return null;
    }

    private function checkCredentials($username, $password, $credentials)
    {
        return $username == $credentials[0] && $password == $credentials[1];
    }

    private function setSession($username)
    {
        Session::put('username', ['name' => $username, 'timestamp' => now()->timestamp]);
    }

    private function clearSession()
    {
        Session::flush();
    }
}
