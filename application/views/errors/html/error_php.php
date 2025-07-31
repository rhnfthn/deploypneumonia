<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP Error</title>
    <style>
        div.container:first-of-type {
            margin-left: auto;
            margin-right: auto;
            max-width: 525px;
            text-align: center;
        }
        div.container:last-of-type {
            margin-left: auto;
            margin-right: auto;
            max-width: 525px;
            border: 1px solid #0a0;
            padding: 1em;
            margin-top: 1em;
        }
        h1 {
            color: #0a0;
        }
        .error {
            color: #a00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $heading; ?></h1>
        <div class="error">
            <?php echo $message; ?>
        </div>
    </div>
</body>
</html> 