<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: *");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Tester</title>

    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./js/jquery-3.4.0.min.js"></script>
    <script src="./js/app.js.php"></script>
</head>
<body>
    <nav class="d-flex align-items-center py-3 px-5 justify-content-between">
        <div class="container-fluid">
            <label for="" class="form-label">API Tester file</label>
            <input type="file" class="form-file" id="input-file">
            <button class="btn btn-sm btn-primary" id="btn-load">Load</button>
        </div>


        <div>
            <button class="btn btn-sm btn-success" id="btn-run">RUN</button>
        </div>
    </nav>
    
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div id="current-json-text" class="w-100 h-100"></div>
            </div>
            <div class="col-md-6">
                <div id="output-console" class="border p-3"></div>
            </div>
            <div class="col-md-12">
                <hr>
                <div class="text-center h3 my-4">Result Table</div>
                <div id="resultTable"></div>
            </div>
        </div>
    </div>
</body>
</html>