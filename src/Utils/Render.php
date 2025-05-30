<?php

function render($view, $data = []) {
    // Extract the data array to variables
    extract($data);

    // Start output buffering
    ob_start();

    // Include the view file
    include __DIR__ . '/../views/' . $view . '.php';
    
    // Get the contents of the output buffer
    $output = ob_get_clean();

    // Return the rendered output
    return $output;
}

function render_view($view, $data = []) {
    $result = render($view, $data);

    flash()->clear();

    return $result;
}