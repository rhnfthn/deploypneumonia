<?php
// Test Python dari PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TEST PYTHON FROM PHP ===\n";

// Test different Python commands
$python_commands = ["python", "python3", "py"];

foreach ($python_commands as $cmd) {
    echo "\nTesting command: " . $cmd . "\n";
    
    // Test version
    $version_output = shell_exec($cmd . " --version 2>&1");
    echo "Version output: " . $version_output . "\n";
    
    // Test simple Python script
    $test_script = "print('Hello from Python')";
    $test_output = shell_exec($cmd . " -c \"" . $test_script . "\" 2>&1");
    echo "Test output: " . $test_output . "\n";
    
    if (strpos($version_output, "Python") !== false) {
        echo "✅ Command works: " . $cmd . "\n";
        
        // Test our prediction script
        $image_path = "assets/uploads/xray.jpg";
        $model_path = "application/models/model_vgg16_pneumonia.h5";
        $script_path = "application/models/predict_pneumonia.py";
        
        if (file_exists($image_path) && file_exists($model_path) && file_exists($script_path)) {
            echo "Testing prediction script...\n";
            
            $command = $cmd . " " . escapeshellarg($script_path) . " " . 
                       escapeshellarg($image_path) . " " . 
                       escapeshellarg($model_path) . " 2>&1";
            
            echo "Command: " . $command . "\n";
            $output = shell_exec($command);
            echo "Output: " . $output . "\n";
            
            // Parse JSON
            $lines = explode("\n", trim($output));
            $json_line = "";
            
            for ($i = count($lines) - 1; $i >= 0; $i--) {
                $line = trim($lines[$i]);
                if (strpos($line, '{') === 0 && strpos($line, '}') !== false) {
                    $json_line = $line;
                    break;
                }
            }
            
            if (!empty($json_line)) {
                $result = json_decode($json_line, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    echo "✅ JSON parsed successfully!\n";
                    echo "Result: " . print_r($result, true) . "\n";
                } else {
                    echo "❌ JSON parse error: " . json_last_error_msg() . "\n";
                }
            } else {
                echo "❌ No JSON found in output\n";
            }
        } else {
            echo "❌ Required files not found\n";
        }
        
        break; // Use first working command
    } else {
        echo "❌ Command failed: " . $cmd . "\n";
    }
}

echo "\n=== TEST COMPLETED ===\n";
?> 