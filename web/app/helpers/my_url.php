<?php

if(!function_exists('files_url')) {
    function files_url($file) {
        return base_url() . 'files/' . $file;
    }
}
