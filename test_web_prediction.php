<?php
// Test script untuk prediksi web
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Simulasi upload dan prediksi
echo "=== TEST WEB PREDICTION ===\n";

// Load CodeIgniter
require_once 'index.php';

// Test dengan gambar yang ada
$test_image = "assets/uploads/xray.jpg";

if (file_exists($test_image)) {
    echo "Testing with image: " . $test_image . "\n";
    
    // Simulasi prediksi
    $CI =& get_instance();
    $CI->load->model('pneumonia_model');
    
    $result = $CI->pneumonia_model->predict($test_image);
    
    if ($result) {
        echo "✅ Prediction successful!\n";
        echo "Result: " . $result['prediction'] . "\n";
        echo "Confidence: " . $result['confidence'] . "%\n";
        echo "Probability: " . $result['probability'] . "\n";
    } else {
        echo "❌ Prediction failed!\n";
    }
} else {
    echo "❌ Test image not found: " . $test_image . "\n";
}

echo "\n=== TEST COMPLETED ===\n";
?> 