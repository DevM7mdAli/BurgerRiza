<?php
function uploadFile($targetDir, $file)
{
  // Create directory if it doesn't exist
  if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
  }

  $uploadOk = 1;
  $fileName = basename($file["name"]);
  $target_file = $targetDir . '/' . $fileName;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is actual image
  $check = getimagesize($file["tmp_name"]);
  if ($check === false) {
    return false;
  }

  // Check file size (500KB limit)
  if ($file["size"] > 500000) {
    return false;
  }

  // Allow certain file formats
  if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
    return false;
  }

  // If file exists, rename it
  $counter = 1;
  $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
  while (file_exists($target_file)) {
    $fileName = $fileNameWithoutExt . '_' . $counter . '.' . $imageFileType;
    $target_file = $targetDir . '/' . $fileName;
    $counter++;
  }

  if (move_uploaded_file($file["tmp_name"], $target_file)) {
    return $target_file; // Return the file path that was actually used
  }

  return false;
}
