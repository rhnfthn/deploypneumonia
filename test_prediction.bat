@echo off
echo Testing PneumoDetect VGG-16 Model...
echo.

REM Test model loading
echo Testing model loading...
python test_model.py

echo.
echo Testing prediction with sample image...
if exist "assets\images\xray.jpg" (
    python application\models\predict_pneumonia.py assets\images\xray.jpg application\models\model_vgg16_pneumonia.h5
) else (
    echo Sample image not found, creating test image...
    python -c "import numpy as np; from PIL import Image; img = np.random.randint(0, 255, (224, 224, 3), dtype=np.uint8); Image.fromarray(img).save('test_image.jpg')"
    python application\models\predict_pneumonia.py test_image.jpg application\models\model_vgg16_pneumonia.h5
    del test_image.jpg
)

echo.
echo Test completed!
pause 