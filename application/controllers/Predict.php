<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predict extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pneumonia_model');
    }

    public function index() {
        $data['title'] = 'Predict Pneumonia - Pneumonia Detector';
        $data['page'] = 'predict';
        $this->load->view('templates/header', $data);
        $this->load->view('predict', $data);
        $this->load->view('templates/footer', $data);
    }

    public function upload() {
        // Check if it's an AJAX request or if X-Requested-With header is set
        if ($this->input->is_ajax_request() || isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            // Custom upload handling to bypass CodeIgniter upload library issues
            $upload_path = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
            
            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $response = array(
                    'success' => false,
                    'message' => 'No file uploaded or upload error occurred.'
                );
            } else {
                $file = $_FILES['image'];
                $allowed_types = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif');
                
                // Validate file type
                if (!in_array($file['type'], $allowed_types)) {
                    $response = array(
                        'success' => false,
                        'message' => 'Invalid file type. Only JPG, PNG, and GIF are allowed.'
                    );
                } else if ($file['size'] > 2 * 1024 * 1024) { // 2MB limit
                    $response = array(
                        'success' => false,
                        'message' => 'File size must be less than 2MB.'
                    );
                } else {
                    // Generate unique filename
                    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $file_name = uniqid() . '.' . $file_extension;
                    $file_path = $upload_path . $file_name;
                    
                    if (move_uploaded_file($file['tmp_name'], $file_path)) {
                        // Lakukan prediksi menggunakan model VGG-16 yang sebenarnya
                        $result = $this->pneumonia_model->predict($file_path);
                        
                        if ($result) {
                            $response = array(
                                'success' => true,
                                'prediction' => $result['prediction'],
                                'confidence' => $result['confidence'],
                                'image_path' => 'assets/uploads/' . $file_name
                            );
                        } else {
                            $response = array(
                                'success' => false,
                                'message' => 'Gagal melakukan prediksi. Silakan coba lagi.'
                            );
                        }
                    } else {
                        $response = array(
                            'success' => false,
                            'message' => 'Failed to save uploaded file.'
                        );
                    }
                }
            }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // Non-AJAX request (fallback)
            $config['upload_path'] = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                redirect('predict');
            } else {
                $upload_data = $this->upload->data();
                $file_path = $upload_data['full_path'];
                $file_name = $upload_data['file_name'];

                // Lakukan prediksi menggunakan model VGG-16 yang sebenarnya
                $result = $this->pneumonia_model->predict($file_path);
                
                if ($result) {
                    $data = array(
                        'image_path' => 'assets/uploads/' . $file_name,
                        'prediction' => $result['prediction'],
                        'confidence' => $result['confidence'],
                        'timestamp' => date('Y-m-d H:i:s')
                    );
                    
                    $this->session->set_userdata('prediction_result', $data);
                    redirect('predict/result');
                } else {
                    $this->session->set_flashdata('error', 'Gagal melakukan prediksi. Silakan coba lagi.');
                    redirect('predict');
                }
            }
        }
    }

    public function result() {
        $prediction_result = $this->session->userdata('prediction_result');
        
        if (!$prediction_result) {
            redirect('predict');
        }

        $data['title'] = 'Prediction Result - Pneumonia Detector';
        $data['page'] = 'predict';
        $data['result'] = $prediction_result;
        
        $this->load->view('templates/header', $data);
        $this->load->view('predict_result', $data);
        $this->load->view('templates/footer', $data);
    }
} 