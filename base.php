<?php
const ROOT_DIR = __DIR__.DIRECTORY_SEPARATOR;
const FILES_DIR = ROOT_DIR.'files'.DIRECTORY_SEPARATOR;

require ROOT_DIR.'debug.php';
require ROOT_DIR.'channels_functions.php';

function fileVersion($filePath) {
    return $filePath.'?v='.filemtime($filePath);
}