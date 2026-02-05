<?php

    // Gets the country code from the ip adress
    include_once 'geoplugin.php';

	// To have a multilingual page
    // Chcking if country code is available
    if (!isset($_SESSION['lang'])){
        if (ip_info("Visitor", "Country Code") == "TR"){
            $_SESSION['lang'] = "tr";
        }
        elseif (ip_info("Visitor", "Country Code") == "En") {
            $_SESSION['lang'] = "en";
        }
        // If country code not available set default language
        else {$_SESSION['lang'] = "ar";}
        
    }

    // Changing language with button click
    else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])){
        if ($_GET['lang'] == "tr"){
            $_SESSION['lang'] = "tr";
        }
        else if ($_GET['lang'] == "en"){
            $_SESSION['lang'] = "en";
        }
        else if ($_GET['lang'] == "ar"){
            $_SESSION['lang'] = "ar";
        }
    }

    require_once $_SESSION['lang'] . ".php";
?>