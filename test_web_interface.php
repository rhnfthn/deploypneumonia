<?php
// Test web interface
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TEST WEB INTERFACE ===\n";

// Simulate web request
$_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
$_FILES['image'] = array(
    'name' => 'test_xray.jpg',
    'type' => 'image/jpeg',
    'tmp_name' => 'assets/uploads/xray.jpg',
    'error' => 0,
    'size' => filesize('assets/uploads/xray.jpg')
);

// Load CodeIgniter
require_once 'index.php';

// Get controller instance
$CI =& get_instance();
$CI->load->model('pneumonia_model');

// Test prediction directly
$test_image = "assets/uploads/xray.jpg";
echo "Testing with image: " . $test_image . "\n";

if (file_exists($test_image)) {
    $result = $CI->pneumonia_model->predict($test_image);
    
    if ($result) {
        echo "✅ Prediction successful!\n";
        echo "Result: " . $result['prediction'] . "\n";
        echo "Confidence: " . $result['confidence'] . "%\n";
        echo "Probability: " . $result['probability'] . "\n";
        
        // Simulate JSON response
        $response = array(
            'success' => true,
            'prediction' => $result['prediction'],
            'confidence' => $result['confidence'],
            'image_path' => 'assets/uploads/xray.jpg'
        );
        
        echo "\nJSON Response:\n";
        echo json_encode($response, JSON_PRETTY_PRINT) . "\n";
    } else {
        echo "❌ Prediction failed!\n";
        
        $response = array(
            'success' => false,
            'message' => 'Gagal melakukan prediksi. Silakan coba lagi.'
        );
        
        echo "\nJSON Response:\n";
        echo json_encode($response, JSON_PRETTY_PRINT) . "\n";
    }
} else {
    echo "❌ Test image not found!\n";
}

echo "\n=== TEST COMPLETED ===\n";
?> 