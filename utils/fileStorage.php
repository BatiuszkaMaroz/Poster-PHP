<?php
function saveImage($errors) {
  if (isset($_FILES['image'])) {
    $fileName = $_FILES['image']['name'];
    $fileTmp = $_FILES['image']['tmp_name'];

    $split = explode('.', $fileName);
    $fileExt = strtolower(end($split));
    $extensions = array("jpeg", "jpg", "png");
    if (in_array($fileExt, $extensions) === false) {
      $errors[] = "Invalid File Extension";
    }

    $fileSize = $_FILES['image']['size'];
    if ($fileSize > 2097152) {
      $errors[] = 'Maximum File Size Exceeded (2MB)';
    }

    if (empty($errors) == true) {
      $uniqueName = uniqid('image-') . $fileName;
      $url = '/poster/uploads/' . $uniqueName;
      $serverPath = $_SERVER['DOCUMENT_ROOT'] . $url;

      move_uploaded_file($fileTmp, $serverPath);
      return $url;
    }
  } else {
    $errors[] = 'Invalid Image Input';
  }
}
