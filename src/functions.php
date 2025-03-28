<?php 
session_start(); /* this allows you to save data in $_SESSION */
/* https://www.w3schools.com/php/php_sessions.asp */

/* write PHP functions here */
// checking committ status
// incldue the config file at the top
include 'config/config.php';

// function to get all the cat breeds to select from on index
function getCatBreeds() {
    $url = 'https://api.thecatapi.com/v1/breeds?api_key=' . CAT_API_KEY;
    $response = file_get_contents($url);
    // if nothing appears the key isn't working and just give an empty array
    if ($response === false) {
        return [];
    }
    // get breeds using json_decode (return the array)
    $breeds = json_decode($response, true);
    return $breeds;
}

// dropdown on index.php page
function indexDropdown($breeds) {
    // start empty and ADD each id + name from all breed
    $html = '';
    foreach ($breeds as $breed) {
        // Each breed has an 'id' and 'name'
        $html .= '<option value="' . htmlspecialchars($breed['id']) . '">' . htmlspecialchars($breed['name']) . '</option>';
    }
    return $html;
}

// get the 10 cat images, using the given breedID to specify in 
function getCatImages($breedId) {
    $url = 'https://api.thecatapi.com/v1/images/search?limit=10&breed_ids=' . urlencode($breedId) . '&api_key=' . CAT_API_KEY;
    $response = file_get_contents($url);
    
    // if we do not get any response we just give an empty array
    if ($response === false) {
        return [];
    }

    $images = json_decode($response, true);
    return $images;
}

// generate the HTML for carousel using the 10 images you collected
function generateCarousel($images) {
    if (empty($images)) {
        return "<p>No images available.</p>";
    }
    $html = '<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">';
    
    // Carousel indicators
    $html .= '<div class="carousel-indicators">';
    foreach ($images as $index => $image) {
        $activeClass = ($index === 0) ? 'active' : '';
        $html .= '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $index . '" class="' . $activeClass . '" aria-label="Slide ' . ($index + 1) . '"></button>';
    }
    $html .= '</div>'; // end indicators
    
    // Carousel items
    $html .= '<div class="carousel-inner">';
    foreach ($images as $index => $image) {
        $activeClass = ($index === 0) ? ' active' : '';
        $html .= '<div class="carousel-item' . $activeClass . '">';
        $html .= '<img src="' . htmlspecialchars($image['url']) . '" class="d-block w-100" alt="Cat Image">';
        $html .= '</div>';
    }
    $html .= '</div>'; 
    // close the inside of the carasouel
    
    // Carousel controls
    $html .= '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">';
    $html .= '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
    $html .= '<span class="visually-hidden">Previous</span>';
    $html .= '</button>';
    $html .= '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">';
    $html .= '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
    $html .= '<span class="visually-hidden">Next</span>';
    $html .= '</button>';
    
    // close the outside of the caraousel
    $html .= '</div>'; 
    return $html;
}

function generateBreedInfo($images) {
    // Use the breed info from the first image 
    $breedInfo = isset($images[0]['breeds'][0]) ? $images[0]['breeds'][0] : null;
    if (!$breedInfo) {
        return "<p>No breed information available.</p>";
    }

    // example code given below: ultimately did not implement
    // Default rating: 4 solid stars and 1 regular star.
    // $ratingHtml = '<span class="rating">
        // <i class="fa-solid fa-star"></i>
        // <i class="fa-solid fa-star"></i>
        // <i class="fa-solid fa-star"></i>
        // <i class="fa-solid fa-star"></i>
        // <i class="fa-regular fa-star"></i>
    // </span>';

    // concatenate the information to the html section below
    $html = '<h2>' . htmlspecialchars($breedInfo['name']) . '</h2>';
    $html .= '<p><strong>Temperament:</strong> ' . htmlspecialchars($breedInfo['temperament']) . '</p>';
    $html .= '<p><strong>Origin:</strong> ' . htmlspecialchars($breedInfo['origin']) . '</p>';
    $html .= '<p>' . htmlspecialchars($breedInfo['description']) . '</p>';

    return $html;
}

?>