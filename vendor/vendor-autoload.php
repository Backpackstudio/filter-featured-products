<?php
/**
 * Loads automatically all classes from 'vendor' directory if needed.
 * 
 * The folder 'vendor' should be the parent directory of
 * current script, otherwise PHP files are not loaded.
 * An anonymous function is used for autoload, which makes
 * 100% sure that there will be no any conflicts, if same
 * script is used for multiple times.
 * 
 * Class names should follow the PSR-4 standard,
 * which means that _ in names don’t have any special meaning.
 * On some platforms files names are be case-sensitive,
 * so file name should correspond to the class name.
 * 
 * @package BPS-Tools
 * @author Backpack.Studio
 * @version 1.0.0
 */
// Prevent direct acces, use only exclusively as an include.
if (count(get_included_files()) == 1) {
    http_response_code(403);
    die();
}

// Path of the 'vendor' directory.
$vendor_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;

// Register autoload function.
spl_autoload_register(function ($class_name) use ($vendor_path) {
    $class_file = $vendor_path . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    if (file_exists($class_file)) {
        require_once $class_file;
    }
}, false, true);