<?php

/**
 * Using flags with filter_var()
 */

// lets imagine that this is the contents of $_POST after a user submits a form for an advert selling their car
$examplePostData = [
    'sales_price_gbp'   =>'57,000.00',
    'model'             => 'Vauxhall👹😀<script>alert("xss");</script>'
];

// allow users to use a comma to separate thousands in the number they input
$options = [
    'flags' => FILTER_FLAG_ALLOW_THOUSAND
];
$validSalesPrice = filter_var($examplePostData['sales_price_gbp'], FILTER_VALIDATE_FLOAT, $options);

// encode special characters
$options = [
    'flags' => FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_AMP
];
$sanitizedModel = filter_var($examplePostData['model'], FILTER_SANITIZE_STRING, $options);

var_dump(compact('validSalesPrice', 'sanitizedModel'));
