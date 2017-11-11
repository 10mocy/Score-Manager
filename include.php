<?php
    session_start();

    if(isset($_SESSION["status"]) && $_SESSION["status"] !== []) {
        $statusdata = $_SESSION["status"];
    }

    if(isset($_SESSION["screenName"]) && $_SESSION["screenName"] !== "") {
        $screenName = $_SESSION["screenName"];
    } else {
        $screenName = " - Guest - ";
    }
    $_SESSION["status"] = [];
