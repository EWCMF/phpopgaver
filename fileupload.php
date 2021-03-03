<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="fileupload.css">
</head>
<body>

<div class="flex">
    <div class="col">

        <form action="/phpopgaver/fileupload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="fileToUpload">Vælg en billedfil til upload.</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <input type="submit" value="Upload Billede" name="submit">
        </form>

        <?php
        //WS3schools eksemplet er brugt uden store ændringer men alt er wrappede i en isset således at fejl ikke vises ved første indgang.
        if (isset($_FILES['fileToUpload'])) {

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "Filen er et billede - " . $check["mime"] . ". </br>";
                $uploadOk = 1;
            } else {
                echo "Filen er ikke et billede. </br>";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Filen eksisterer allerede. </br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 1000000) {
            echo "Din fil er for stor. </br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Kun JPG, JPEG, PNG & GIF filer er tilladte. </br>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Din fil blev ikke uploadet. </br>";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Filen " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " er blevet uploadet. </br>";
            } else {
                echo "Der var en fejl i uploadningen af din fil.";
            }
        }

        }
        ?>

        <div class="margin">
          <p>Uploadede filer vil blive listede her</p>
            <?php
              // Her sker visningen af filerne. Et a tag bliver brugt så billede kan vises i fuld via browseren.
              $dir = "uploads/";

              // Mappen uploads bliver læst
              if (is_dir($dir)) {
                  if ($dh = opendir($dir)) {
                      while (($file = readdir($dh)) !== false) {
                          // Check at vi har med en oprigtig fil at gøre og ikke stigerne . og ..
                          if (is_file($dir . $file)) {
                              echo "$file <a href='/phpopgaver/uploads/$file'>Link</a></br>";
                          }
                      }
                      closedir($dh);
                  }
              }
              ?>
        </div>
    </div>
</div>

</body>
</html>