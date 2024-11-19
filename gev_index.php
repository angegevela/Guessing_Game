<? 
    require('session.php');
    session_start();

    $message_for_user = "I've picked a random number between " . 
    SECRET_NUMBER_MINIMUM_VALUE . " and " .
    SECRET_NUMBER_MAXIMUM_VALUE . ". Can you guess it?";

    $user_correct = user_correct ($_POST, $_SESSION);
    if (user_guess($_POST)) {
        increase_count($_SESSION);
        
        if ($user_correct) {
            $message_for_user = "You got it in {$_SESSION['guess_count']} guesses!";
        } else if (guessed_too_low($_POST, $_SESSION)) {
            $message_for_user = 'Incorrect Guess! Try a larger number.';
        } else if (too_high($_POST, $_SESSION)) {
            $message_for_user = 'Incorrect Guess! Try a smaller number.';
        } 
    }

    if (user_leaderboard($_POST)) {
        add_user_name_to_ldrbrd($_POST, $_SESSION);
        reset_secret_number_and_guess_count($_SESSION);
    }
    
    if ( secret_number_has_not_yet_been_set($_POST, $_SESSION)
         || user_has_requested_a_reset($_POST)) {
        reset_secret_number_and_guess_count($_SESSION);
    }    
    ?>