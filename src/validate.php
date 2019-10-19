<?php

/**
 * Using filter_var() to validate input
 */

// lets imagine that this is the contents of $_POST after a user submits a registration form
$examplePostData = [
    'email' => "chuck@example.com%0ACc:spamtarget@example.com%0ABcc:anotherperson@example.com ",
    'homepage' => "https://www.example.com?PHPSESSID=1234'; DROP TABLE users",
    'age' => '23.99'
];

// false
$validEmail = filter_var($examplePostData['email'], FILTER_VALIDATE_EMAIL);

// false
$validHomepage = filter_var($examplePostData['homepage'], FILTER_VALIDATE_URL);

// false
$validAge = filter_var($examplePostData['age'], FILTER_VALIDATE_INT);

/*
    array(3) {
      'validEmail' =>
      bool(false)
      'validHomepage' =>
      bool(false)
      'validAge' =>
      bool(false)
    }
 */
var_dump(compact('validEmail', 'validHomepage', 'validAge'));