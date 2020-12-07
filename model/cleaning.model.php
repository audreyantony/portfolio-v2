<?php

// User/Admin entry cleaning
function entryCleaning($entry){
    return htmlspecialchars(strip_tags(trim($entry)), ENT_QUOTES, 'UTF-8');
}