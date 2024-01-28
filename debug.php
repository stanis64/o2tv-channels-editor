<?php

// debug funkce
function dump() {
    foreach (func_get_args() as $arg) {
        echo '<pre>'.var_export($arg, true).' ('.gettype($arg).')</pre>';
    }
}
function dd() {
    foreach (func_get_args() as $arg) {
        dump($arg);
    }
    die;
}