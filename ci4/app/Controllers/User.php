<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        return view('user/login');
    }
    
    public function proses_login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $model = new UserModel();
        $user = $model->where('useremail', $email)->first();
        
        if ($user && password_verify($password, $user['userpassword'])) {
            session()->set([
                'logged_in' => true,
                'user_id' => $user['id'],
                'user_name' => $user['username'],
                'user_email' => $user['useremail']
            ]);
            
            // UBAH INI: redirect ke /admin/artikel (bukan /admin/index)
            return redirect()->to('/admin/artikel');
            
        } else {
            session()->setFlashdata('flash_msg', 'Login gagal!');
            return redirect()->to('/user/login');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}