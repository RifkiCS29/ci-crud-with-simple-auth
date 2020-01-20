<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        //agar database atau model bisa diload di semua method di controller ini
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        //kirim data judul ke view login
        $data['judul'] = 'Login Mahasiswa';

        //validasi pada form nya
        //$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        //$this->form_validation->set_rules('password', 'Password', 'required');

        $this->load->view('auth/login',$data);
        $this->load->view('templates/footer');
    }

    public function cek_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data = array(
            'email' => $email,
            'password' => md5($password),
        );

        $cek_user = $this->Auth_model->cek_user($data);

        if($cek_user->num_rows() > 0){
            $row = $cek_user->row();
            $email = $row->email;
            $nama_lengkap = $row->nama_lengkap;

            $user = array(
                'email' => $email,
                'nama_lengkap' => $nama_lengkap,
            );

            $this->session->set_userdata($user);
            redirect('home');
        } else{
            $this->session->set_flashdata('pesan_login', 'Username atau Password Salah');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}