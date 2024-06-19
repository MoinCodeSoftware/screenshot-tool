<?php
// generate.php

// by Timm Kluth | www.MoinCode.de

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urls = $_POST['urls'];
    $resolution = $_POST['resolution'];
    $format = $_POST['format']; // Added: Get selected format
    $outputWidth = $_POST['outputWidth'];
    $outputHeight = $_POST['outputHeight'];

    // Handle custom resolution if selected
    if ($resolution === 'custom') {
        $width = $_POST['customWidth'];
        $height = $_POST['customHeight'];
    } else {
        // Parse resolution string like "1920x1080"
        list($width, $height) = explode('x', $resolution);
    }

    // Validate URLs (basic check)
    $urlsArray = explode("\n", $urls);
    $validUrls = array();
    foreach ($urlsArray as $url) {
        $url = trim($url);
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $validUrls[] = $url;
        }
    }

    // Generate screenshots
    $screenshots = array();
    foreach ($validUrls as $url) {
        // Escape URL and filename for Windows
        $escapedUrl = escapeshellarg($url);
        
        // Replace not allowed characters in filenames
        $safeUrl = preg_replace('/[^A-Za-z0-9\-]/', '_', parse_url($url, PHP_URL_HOST));
        $filename = 'screenshots/' . $safeUrl . '-Screenshot.' . $format; // Filename with selected format
        
        $outputPath = escapeshellarg(__DIR__ . '/' . $filename);
        $command = "node screenshot.js $escapedUrl $width $height $format $outputPath $outputWidth $outputHeight";
        exec($command, $output, $return_var); // Execute command (requires Node.js and Puppeteer)
        if ($return_var === 0) {
            $screenshots[$url] = $filename;
        } else {
            echo "Error generating screenshot for $url";
        }
    }

    // Output links to screenshots
    echo '<h2>Screenshots erstellt:</h2>';
    foreach ($screenshots as $url => $file) {
        echo "<p><a href='$file'>$url</a></p>";
    }
}
?>
