<?php include 'header.php';

    if (!empty($_SESSION['result'])):

        include 'result.php';

    elseif (!empty($_SESSION['word'])):

        include 'hangmanGame.php';

    else:

        include 'chooseWord.php';

    endif;

include 'footer.php'; ?>