<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Pneumonia Detector - Home';
        $data['page'] = 'home';
        $this->load->view('templates/header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/footer', $data);
    }

    public function about() {
        $data['title'] = 'About - Pneumonia Detector';
        $data['page'] = 'about';
        $this->load->view('templates/header', $data);
        $this->load->view('about', $data);
        $this->load->view('templates/footer', $data);
    }

    public function faq() {
        $data['title'] = 'FAQ - Pneumonia Detector';
        $data['page'] = 'faq';
        $this->load->view('templates/header', $data);
        $this->load->view('faq', $data);
        $this->load->view('templates/footer', $data);
    }

    public function pneumonia_info() {
        $data['title'] = 'Pneumonia Information - Pneumonia Detector';
        $data['page'] = 'pneumonia_info';
        $this->load->view('templates/header', $data);
        $this->load->view('pneumonia_info', $data);
        $this->load->view('templates/footer', $data);
    }
} 