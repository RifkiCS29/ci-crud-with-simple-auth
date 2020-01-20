<?php

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('Login');
        cek_session();
    }
    public function index()
    {
        //kirim data judul ke header
        $data['judul'] = 'Halaman Home';
        $this->load->view('templates/header', $data);
        $this->load->view('home/index');
        $this->load->view('templates/footer');
    }
}