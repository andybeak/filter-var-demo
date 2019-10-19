<?php

/**
 * Using filter_var() to sanitize input
 */

// lets imagine that this is the contents of $_POST after a user submits a registration form
$examplePostData = [
    'username' => "Chuck<script>alert('xss');</script>",
    'email' => "chuck@example.com%0ACc:spamtarget@example.com%0ABcc:anotherperson@example.com ",
    'homepage' => "https://www.example.com?PHPSESSID=1234'; DROP TABLE users",
    'age' => '23.99'
];

// strip tags
$username = filter_var($examplePostData['username'], FILTER_SANITIZE_STRING);

// Remove all characters except letters, digits and !#$%&'*+-=?^_`{|}~@.[].
// Note that email header injection is still possible
$email = filter_var($examplePostData['email'], FILTER_SANITIZE_EMAIL);

// Remove all characters except letters, digits and $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.
// Note that a session fixation attack is still possible
$homepage = filter_var($examplePostData['homepage'], FILTER_SANITIZE_URL);

// Remove all characters except digits, plus and minus sign.
$age = filter_var($examplePostData['age'], FILTER_SANITIZE_NUMBER_INT);

/*
    array(4) {
    'username' =>
    string(26) "Chuckalert(&#39;xss&#39;);"
    'email' =>
    string(32) "chuck@example.com'DROPTABLEusers"
    'homepage' =>
    string(38) "https://www.example.com?PHPSESSID=1234"
    'age' =>
    string(4) "2399"
    }
 */
var_dump(compact(array_keys($examplePostData)));