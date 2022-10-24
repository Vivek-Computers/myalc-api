<?php
require_once PATH_MIDDLEWARE . '/AuthenticationMiddleware.class.php';

// Server Check Route
$app->get('/', require_once PATH_CALLBACKS . '/server_check.php');

// Get token
$app->post('/getToken', require_once PATH_CALLBACKS . '/get_token.php');

// $app->group('secure_routes', function() use($app) {
    // Get learners
    $app->get('/getLearners', require_once PATH_CALLBACKS . '/get_learners.php');

    // Get learner
    $app->get('/getLearner/{roll}', require_once PATH_CALLBACKS . '/get_learner.php');

    // Get payments
    $app->get('/getPayments/{roll}', require_once PATH_CALLBACKS . '/get_payments.php');

    // Get learner image
    $app->get('/getLearnerImage/{roll}', require_once PATH_CALLBACKS . '/get_learner_image.php');

    // Add learner
    $app->post('/addLearner', require_once PATH_CALLBACKS . '/add_learner.php');

// })->add(AuthenticationMiddleware::class);
?>