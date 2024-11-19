<?
define('SECRET_NUMBER_MINIMUM_VALUE', 1);
define('SECRET_NUMBER_MAXIMUM_VALUE', 500);


function user_guess($post) {
    return isset($post['button']) && $post['button'] == 'Guess';
}


function user_has_requested_a_reset($post) {
    return isset($post['button']) && $post['button'] == 'Reset';
}

function user_leaderboard($post) {
    return isset($post['button']) && $post['button'] == 'Submit Name';
}

function secret_number_has_not_yet_been_set($post, $session) {
    return !isset($session['secret_number']) || !$post;
}


function leaderboard_does_not_exist($post, $session) {
    return !isset($session['leaderboard']) || count($session['leaderboard']) === 0;
}

function user_correct($post, $session) {
    return isset($post['user_guess']) && $post['user_guess'] == $session['secret_number'];
}

function too_high($post, $session) {
    return $post['user_guess'] > $session['secret_number'];
}

function guessed_too_low($post, $session) {
    return $post['user_guess'] < $session['secret_number'];
}

function reset_secret_number_and_guess_count(&$session) {
    $session['secret_number'] = rand(SECRET_NUMBER_MINIMUM_VALUE, SECRET_NUMBER_MAXIMUM_VALUE);
    $session['guess_count'] = 0;
}

function increase_count(&$session) {
    $session['guess_count']++;
}

?>