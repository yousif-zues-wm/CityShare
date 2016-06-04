<!DOCTYPE html>
<html>
<head>
    <title>CityShare</title>
    <link rel="stylesheet" href="Assets/BootStrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>


<?php
define('GW_UPLOADPATH', 'images/');
define('GW_MAXFILESIZE', '66000000');

if (isset($_POST['submit'])) {

    // Grab the data from the POST
    $item = $_POST['item']
    $cityName = $_POST['cityName'];
    $contact = $_POST['contact'];
    $quanity = $_POST['quanity'];
    $description = $_POST['description'];
    $image = $_FILES['image']['cityName'];

    $image_type = $_FILES['image']['type'];
    $image_size = $_FILES['image']['size'];

    if (!empty($item) && !empty($cityName) && !empty($contact) && !empty($quanity) && !empty($description) && !empty($image))  {

        if ((($image_type == 'image/gif') || ($image_type == 'image/jpeg') ||
                ($image_type == 'image/pjpeg') || ($image_type == 'image/png')) &&
            ($image_size > 0) && ($image_size <= GW_MAXFILESIZE)
        ) {

            if (1 == 1) {

                $target = GW_UPLOADPATH . $image;

                // Connect to the database

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {

                    $cityName = $_POST['cityName'];

                    $description = $_POST['description'];

                    if (!empty($cityName) && !empty($description)) {


                        $dbc = new PDO('mysql:host=localhost:3306;dbname=cityshare', 'root', '');

                        // Write the data to the database

                        $query = "INSERT INTO resource VALUES (0, :item, :cityName, :contact, :quanity, :description, :image)";

                        $stmt = $dbc->prepare($query);

                        $stmt->execute(

                            array(
                                'item' => $item,
                                'cityName' => $cityName,
                                'contact' => $contact,
                                'quanity' => $quanity,
                                'description' => $description,
                                'image' => $image,
                            ));

                        // Confirm success with the user
                        echo '<p>Thanks for submiting!</p>';
                        echo '<p><strong>Item:</strong> ' . $item . '<br />';
                        echo '<p><strong>City name:</strong> ' . $cityName . '<br />';
                        echo '<strong>Contact:</strong> ' . $contact . '</p>';
                        echo '<p><strong>Quanity:</strong> ' . $quanity . '<br />';
                        echo '<strong>Description:</strong> ' . $description . '</p>';
                        echo '<p><a href="index.html">&lt;&lt; Back to home page.</a></p>';
                        // Clear the data to clear the form
                        $item = "";
                        $cityName = "";
                        $contact = "";
                        $quanity = "";
                        $description = "";
                    }
                    else {
                        echo '<p class="error">Sorry, there was a problem uploading your image.</p>';

                    }
                }
                else{
                    echo '<p class="error">A file with that name already exists.</p>';
                }
                @unlink($_FILES['image']['tmp_name']);
            }
        }
        else {
            echo '<p class="error">The screen shot must be a GIF, JPEG or PNG image file no ' .
                'greater than ' . (GW_MAXFILESIZE / 1024) . ' KB IN SIZE. </p>';
        }
    }
    else {
        echo '<p class="error">Please enter all of the information to add your high score.</p>';
    }
}


?>


<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <input type="hidden" name="MAX_FILE_SIZE" value="66000000" />
    
    <label for="item">Item:</label>
    
    <input type="text" id="item" name="item" value="<?php if (!empty($item)) echo $item; ?>" />
    
    <br />

    <label for="cityName">City name:</label>
    
    <input type="text" id="cityName" name="cityName" value="<?php if (!empty($cityName)) echo $cityName; ?>" />
    
    <br />

    <label for="contact">Contact:</label>
    
    <input type="text" id="contact" name="contact" value="<?php if (!empty($contact)) echo $contact; ?>" />
    
    <br />
    
    <label for="quanity">Quanity:</label>
    
    <input type="text" id="quanity" name="quanity" value="<?php if (!empty($quanity)) echo $quanity; ?>" />
    
    <br />
    
    <label for="description">Description:</label>
    
    <input type="text" id="description" name="description" value="<?php if (!empty($description)) echo $description; ?>" />
    
    <br />

    <label for="image">Image:</label>
    
    <input type="file" id="image" name="image" />
    
    <hr />
    
    <input type="submit" value="Add" name="submit" />

</form>

</html>
