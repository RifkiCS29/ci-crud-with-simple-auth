<?php

class Mahasiswa extends CI_Controller {
    public function __construct()
    {
        //agar database atau model bisa diload di semua method di controller ini
        parent::__construct();
        $this->load->model('Mahasiswa_model');
        $this->load->library('form_validation');

        $this->load->helper('Login');
        cek_session();
    }

    public function index()
    {
        //kirim data judul ke header
        $data['judul'] = 'Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();

        //jika ada yang dicari
        if ($this->input->post('keyword')){
            $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/index',$data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Form Tambah Mahasiswa';
        //data jurusan dikirim ke view ubah
        $data['jurusan'] = ['Ilmu Komputer', 'Sistem Informasi', 'Teknik Informatika'];

        //validasi pada form nya
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/tambah',$data);
            $this->load->view('templates/footer');
        }else{
            //untuk menyimpan data buat method tambahDataMahasiswa di MODEL
           $this->Mahasiswa_model->tambahDataMahasiswa();
           //buat session flash_data
           $this->session->set_flashdata('flash', 'Ditambahkan');
           redirect('mahasiswa');
        }
    }

    public function hapus($id)
    {
        //untuk menghapus data dikirimkan ke MODEL berdasarkan id
        $this->Mahasiswa_model->hapusDataMahasiswa($id);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('mahasiswa');
    }

    public function detail($id)
    {
        //id mahasiswa dikirimkan ke method Model untuk melihat detail
        $data['judul'] = 'Detail Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        $data['judul'] = 'Form Ubah Data Mahasiswa';
        //memanfaatkan method getMahasiswaById untuk menampilkan data mahasiswa berdasarkan id
        $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
        //data jurusan dikirim ke view ubah
        $data['jurusan'] = ['Ilmu Komputer', 'Sistem Informasi', 'Teknik Informatika'];

        //validasi pada form nya
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/ubah',$data);
            $this->load->view('templates/footer');
        }else{
            //untuk mengubah data buat method ubahDataMahasiswa di MODEL
           $this->Mahasiswa_model->ubahDataMahasiswa();
           //buat session flash_data
           $this->session->set_flashdata('flash', 'Diubah');
           redirect('mahasiswa');
        }
    }
}