<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        // Tampilkan form login
        return view('user/login');
    }
    
    public function proses()
    {
        helper('form');
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Cek ke database
        $model = new UserModel();
        $user = $model->where('useremail', $email)->first();
        
        if ($user && password_verify($password, $user['userpassword'])) {
            // Set session
            session()->set([
                'logged_in' => true,
                'user_id' => $user['id'],
                'user_name' => $user['username'],
                'user_email' => $user['useremail']
            ]);
            
            session()->setFlashdata('success', 'Login berhasil!');
            return redirect()->to('/admin/dashboard');
        } else {
            session()->setFlashdata('error', 'Email atau password salah!');
            return redirect()->to('/login');
        }
    }
    
    public function dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'nama_user' => session()->get('user_name'),
            'user_email' => session()->get('user_email')
        ];
        
        return view('artikel/admin_index', $data);
    }
    
    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'Anda telah logout.');
        return redirect()->to('/login');
    }
}