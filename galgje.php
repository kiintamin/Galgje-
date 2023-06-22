<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hangman - Playing!</title>
    <meta name="description" content="Play hangman">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main">
        <?php

        function generateRandomWords()
        {
            $randomWords = array(
                "HANGMAN", "BUTTERFLY", "APPLE", "AWKWARD", "DUPLICATE",
                "MONEY", "CAR"
            );
            if (isset($_POST['randomWord'])) {
                // rand:voor elke keer computer kies een woord van array beign van 0 index tot -1: latsste index
                $mtr = rand(0, count($randomWords) - 1);
                $woord = $randomWords[$mtr];
                // ik wil verwijzen naar groet Letter daarom ik gebruik strtoupper
                $_SESSION['word'] = strtoupper($woord);
                return $_SESSION['word'];
            }
        }
        $word = generateRandomWords();

        function chooseWords()
        {
            if (isset($_POST['chosenWord'])) {
                $woord = $_POST['chosenWord'];
                $_SESSION['word'] = strtoupper($woord);
            }
            return $_SESSION['word'] ?? true;
        }

        function checkLetter()
        {
            if (!isset($_SESSION['wrongLetters'])) {
                $_SESSION['wrongLetters'] = array();
                // nu wrong letter = empty array daarna ik push fout letter in deze array
            }
            if (!isset($_SESSION['rightLetters'])) {
                $_SESSION['rightLetters'] = array();
                // nu right letter = empty array daarna ik push right letter in deze array
            }
            if (isset($_POST['playerGuess'])) { // playerguess = letter kies van letters
                /*
            strpos(sensantief voor letter:je moet let op voor letter if grote of klien => daarom ik gebruik stripos
            want met i niet sesantief) stripos= string possion 3 parameter (1,2,3) 
            1:welke variable wil ik zoken(requierd moet ik uitvoeren),
            2:welke letter of nummer wil ik zoken(requierd),
            3: ofset van welke index wil ik beginnen(optional hoef niet uitvoeren)
            */
                if (stripos(chooseWords(), $_POST['playerGuess'][0]) === false) {
                    array_push($_SESSION['wrongLetters'], $_POST['playerGuess'][0]);
                } else {
                    array_push($_SESSION['rightLetters'], $_POST['playerGuess'][0]);
                }
            }
        }

        checkLetter();

        function replaceRightLetter()
        {
            $wordHint = "";
            for ($i = 0; $i < strlen(chooseWords()); $i++) {
                $wordHint .= in_array(substr(chooseWords(), $i, 1), $_SESSION['rightLetters']) ? substr(chooseWords(), $i, 1) : " _ ";
            }
            return $wordHint;
        }
        $wordHin = replaceRightLetter();

        echo "<h1>Hangman</h1>";
        $_SESSION['chances'] = 7 - count($_SESSION['wrongLetters']);
        echo '<p class="hint"> The word is: ' . $wordHin .  '</p>';
        echo '<p id="chances"> You have ' . strval($_SESSION['chances']) .  ' chances left. </p>';
        echo '<img id="hangman" src="hang' . count($_SESSION['wrongLetters']) . '.png" \>';

        function checkWinLoss()
        {
            if ($_SESSION['chances'] <= 0) {
                echo "<p>YOU DIED!</p>";
                echo '<p>The word was: <span>' . chooseWords() . '</span> </p>';
                session_destroy();
            }

            if (chooseWords() == replaceRightLetter()) {
                echo '<p>You did it!</p>';
                echo '<p>You guessed the word correctly.</p>';
                session_destroy();
            }
        }
        checkWinLoss();

        ?>
        <form action="destroy2.php" method="post" id="reset">
            <input type="submit" value="Reset the game and return to main menu." />
        </form>
        <form method="POST" id="letter">
            <?php
            echo '<p> Letters left: </p>';

            $alphabet = range("A", "Z");
            foreach ($alphabet as $letter) {
                if (!in_array($letter, $_SESSION['rightLetters']) && !in_array($letter, $_SESSION['wrongLetters'])) {
                    if ($_SESSION['chances'] > 0) {
                        if (chooseWords() != replaceRightLetter()) {
                            echo '<input name="playerGuess[]" id="' . $letter . '" type="submit" value="' . $letter . '" class="letterbutton" />';
                        }
                    }
                }
            }
            ?>
        </form>
    </div>
</body>

</html>
