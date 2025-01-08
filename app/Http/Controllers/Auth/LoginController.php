<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Cek apakah token sudah ada di cookies
        $token = Cookie::get('auth_token');

        if ($token) {
            // Jika token ada, cek apakah valid di database
            $user = User::where('token', $token)->first();

            if ($user) {
                // Jika token valid, langsung login pengguna
                Auth::loginUsingId($user->id);
                return redirect()->route('dashboard'); // Redirect ke dashboard
            } else {
                // Jika token di cookies tidak valid, hapus cookies
                Cookie::queue(Cookie::forget('auth_token'));
            }
        }

        // Validasi input
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Data yang akan dikirim ke API eksternal
        $apiUrl = 'https://api.galesong.co.id/checkUserLogin';
        $credentials = [
            'user' => $request->user,
            'password' => $request->password,
        ];

        // Melakukan request ke API eksternal dengan header
        $response = Http::asForm()->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded', // Header Content-Type
            'Authorization' => 'Bearer your-api-token', // Jika membutuhkan Authorization header
        ])->post($apiUrl, $credentials);

        // Jika request gagal, kembalikan error
        if ($response->failed()) {
            return redirect()->back()->withErrors([
                'login_failed' => 'Login gagal. Periksa username dan password Anda.',
            ]);
        }

        // Ambil data dari response API
        $data = $response->json();
        if (!isset($data['data'])) {
            return redirect()->route('login');
        }
        //dd($data);
        // Ambil token dari response API
        $token = $data['data']['token'];
        //$nama = $data['data']['full_name'];

        // Simpan data user ke database
        $user = User::create([
            'token' => $token,
            'full_name' => $data['data']['full_name'],
            'company' => $data['data']['company'],
            'company_name' => $data['data']['companyName'],
            'branch' => $data['data']['branch'],
            'branch_name' => $data['data']['branchName'],
            'organization' => $data['data']['organization'],
            'organization_name' => $data['data']['organizationName'],
            'job_level' => $data['data']['jobLevel'],
            'job_level_name' => $data['data']['jobLevelName'],
        ]);

        // Simpan token ke cookies selama 120 menit
        Cookie::queue('auth_token', $token, 120);
        Cookie::queue('user_full_name', $data['data']['full_name'], 120);        // Autentikasi pengguna menggunakan ID
        Auth::loginUsingId($user->id);

        // Redirect ke dashboard
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {

        Cookie::queue(Cookie::forget('auth_token'));

        // Logout pengguna
        Auth::logout();
        return redirect('/login'); // Ubah ke halaman login atau halaman lain sesuai kebutuhan
    }
}
