<!DOCTYPE html>
<html>
    <head>
        <title>Upload Conference Presentations</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' crossorigin='anonymous'>
        <link rel='stylesheet' type='text/css' href='dist/css/style.css'>
        <link rel="stylesheet" type="text/css" href="dist/css/file-upload.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="dist/js/jquery.js"></script>
        <script src="dist/js/file-upload.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.file-upload').file_upload();
            });
        </script>
    </head>
    <body>
      <div class='register-photo'>
        <div class='form-container'>
            <div class='image-holder'></div>
            <form action='insert.php'  method='post' enctype="multipart/form-data">
                <h2 class='text-center'><strong>Upload</strong> Your Presentation</h2>
                <div class='form-group'><input class='form-control' type='email' name='email' placeholder='Email' required></div>
                <div class='form-group'><input class='form-control' type='text' name='first_name' placeholder='First Name' required></div>
                <div class='form-group'><input class='form-control' type='text' name='last_name' placeholder='Last Name' required></div>                
                <div class='form-group'><input class='form-control' type='text' name='abstract_title' placeholder='Abstract Title' required></div>
                <div class='form-group'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input class="form-check-input" type="radio" value="Oral" name="mode" required>Oral</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input class="form-check-input" type="radio" value="Poster" name="mode" required>Poster</label></div>
                <div class='form-group'><label class='file-upload btn btn-primary btn-block'>Browse for file... <input type='file' name='file' onchange="fileValidation()" required></label></div>
                <div class='form-group'><button class='btn btn-success btn-block' type='submit'>Submit</button></div>
            </form>
          </div>
        </div>
    </body>
<!-- /******************************************************************************/
/* Developer        :   Megha G.
/* Created Date     :   2019-08
/* Developer Email  :   me@megha.dev
/* License          :   BSD 3
/* Prduct           :   PHP/Jquery Presentation File UPloader
/******************************************************************************/ -->
</html>
