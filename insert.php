<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>

<?php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'db_user');
define('DB_PASSWORD', 'db_pw');
define('DB_NAME', 'db_name');

$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

session_start();

// Escape user inputs for security
$email = validate_input(mysqli_real_escape_string($conn, $_REQUEST['email']));
$fname = validate_input(mysqli_real_escape_string($conn, $_REQUEST['first_name']));
$lname = validate_input(mysqli_real_escape_string($conn, $_REQUEST['last_name']));
$title = validate_input(mysqli_real_escape_string($conn, $_REQUEST['abstract_title']));
$mode = validate_input(mysqli_real_escape_string($conn, $_REQUEST['mode']));

// Store uploaded file

$target_dir = "uploads/";
$file = $_FILES['file']['name'];
$path = pathinfo($file);
$filename = $fname . '_' . $lname . '_' .$mode . '_' . date('Ymdhs');
$ext = $path['extension'];

// Error messages if file size or extension invalid

if (isset($_FILES['file'])) {
    $maxsize = 20971620; //20Mb file max size
    $acceptable = array('pdf','pptx','ppt','pps','ppsx','PDF','PPTX','PPT','PPS','PPSX');

    if (($_FILES['file']['size'] > $maxsize) || ($_FILES["file"]["size"] == 0)) {
        echo "
        <script type='text/javascript'>
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'File too large. File must be less than 20 megabytes.',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Try Again'
        }).then((result) => {
          if (result.value) {
            window.location.href = \"index.php\";
          }
        })
        </script>
        ";
        unlink($_FILES['file']);
        die();
    }
    else if ((!in_array($ext, $acceptable)) && (!empty($ext))) {
      echo "
      <script type='text/javascript'>
      Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'Invalid file type. Only PowerPoint and PDF files are accepted.',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Try Again'
      }).then((result) => {
        if (result.value) {
          window.location.href = \"index.php\";
        }
      })
      </script>
      ";
      unlink($_FILES['file']);
      die(); 
    }

    else {
      $temp_name = $_FILES['file']['tmp_name'];
      $file_uploaded = $target_dir . $filename . "." . $ext;
      move_uploaded_file($temp_name, $file_uploaded);
    }
}

//email settings
$subject = "Presentation Uploaded";
$message = '<html><body>';
$message .= '<h2 style="color:#f40;" align="center">Presentation Uploaded</h2>';
$message .= '<p style="color:#080;font-size:18px;" align="center">Thank you for submitting your presentation ($file_uploaded) for the abstract titled "' . $title . '" for ' . $mode . ' presentation.</p>';
$message .= '</body></html>';
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: <mail@example.com>' . "\r\n";

// Check if there are any errors, If not add to the DB, Else Display Errors and Ask for Input again
if (!empty($email || $fname || $lname || $title || $mode || $file_uploaded)) {
    $sql = $conn->prepare('INSERT INTO presentations (email, first_name, last_name, abstract_title, mode, file_uploaded) VALUES (?, ?, ?, ?, ?, ?)');
    $sql->bind_param('ssssss', $email, $fname, $lname, $title, $mode, $file_uploaded);

    if ($sql->execute()) {
        //successful
        echo "
        <script type='text/javascript'>
                Swal.fire({
                  title: 'Thank You!',
                  text: 'You have successfully submitted your presentation.',
                  imageUrl: 'assets/img/icbdthumb.jpg',
                  footer: '<a href=\"index.php\">Submit another presentation?</a>',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.value) {
                    window.location.href = enterTargetURL;
                  }
                })
                </script>
                ";
        //send email
        mail($email, $subject, $message, $headers);

    } else {
        echo "
        <script type='text/javascript'>
                Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: 'Something went wrong',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Try Again'
                }).then((result) => {
                  if (result.value) {
                    window.location.href = \"index.php\";
                  }
                })
                </script>
                ";
    }
    $sql->close();

    // close connection
    $conn->close();

}

function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/******************************************************************************/
/* Developer        :   Megha G.
/* Created Date     :   2019-08
/* Developer Email  :   me@megha.dev
/* License          :   BSD 3
/* Prduct           :   PHP/Jquery Presentation File UPloader
/******************************************************************************/

?>
</body>
</html>