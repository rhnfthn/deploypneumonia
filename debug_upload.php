<?php
// Debug script untuk upload dan prediksi
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== DEBUG UPLOAD & PREDICTION ===\n";

// Simulasi upload process
$upload_path = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
echo "Upload path: " . $upload_path . "\n";

// Test dengan file yang ada
$test_files = [
    'assets/uploads/xray.jpg',
    'assets/uploads/person1_bacteria_2.jpeg',
    'assets/uploads/NORMAL2-IM-1437-0001.jpeg'
];

foreach ($test_files as $test_file) {
    echo "\n--- Testing: " . $test_file . " ---\n";
    
    if (file_exists($test_file)) {
        echo "File exists: YES\n";
        echo "File size: " . filesize($test_file) . " bytes\n";
        
        // Test model prediction
        require_once 'index.php';
        $CI =& get_instance();
        $CI->load->model('pneumonia_model');
        
        $result = $CI->pneumonia_model->predict($test_file);
        
        if ($result) {
            echo "✅ Prediction successful!\n";
            echo "Result: " . $result['prediction'] . "\n";
            echo "Confidence: " . $result['confidence'] . "%\n";
            if (isset($result['probability'])) {
                echo "Probability: " . $result['probability'] . "\n";
            }
        } else {
            echo "❌ Prediction failed!\n";
            
            // Test Python script directly
            $model_path = APPPATH . 'models/model_vgg16_pneumonia.h5';
            $python_script = APPPATH . 'models/predict_pneumonia.py';
            
            $command = "python " . escapeshellarg($python_script) . " " . 
                       escapeshellarg($test_file) . " " . 
                       escapeshellarg($model_path) . " 2>&1";
            
            echo "Testing Python command: " . $command . "\n";
            $output = shell_exec($command);
            echo "Python output: " . $output . "\n";
        }
    } else {
        echo "File exists: NO\n";
    }
}

echo "\n=== DEBUG COMPLETED ===\n";
?> 