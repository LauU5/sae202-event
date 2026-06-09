<?php
session_unset();
session_destroy();
header('Location: index.php?action=accueil');
exit();