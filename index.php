<!DOCTYPE html>
<?php
include 'src/functions.php';
// reference the function so you can create a drop down with the list of full cat names
$breeds = getCatBreeds();
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cat Carousel</title>

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
   rel="stylesheet" crossorigin="anonymous"
   integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3">
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Cat Carousel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container mt-5">
        <h1>Select a Cat Breed</h1>
    <form method="GET" action="carousel.php">
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="breed" class="col-form-label">Breed:</label>
        </div>
        <div class="col-auto">
          <select class="form-select" name="breed" id="breed" required>
            <option value="" selected disabled>Select a breed</option>

            <!-- dropdown menu created in src/functions -->
            <?php echo indexDropdown($breeds); ?>
          </select>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary">View Carousel</button>
        </div>
      </div>
    </form>
        



        <!-- have not touched below -->
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>