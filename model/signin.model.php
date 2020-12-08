<?php

function selectUser($nickname, $db){
    $query = 'SELECT * FROM portfolio_user WHERE nickname_portfolio_user = "'.$nickname.'";';
    return $db->query($query);
}