<?php
    include "include.php";
    
    $_SESSION["isLogin"] = true;
    $screenName = "";

    if(isset($_GET["screenName"]) && $_GET["screenName"] !== "") {
        $screenName = htmlspecialchars($_GET["screenName"]);
        $screenNameMessage = $screenName."でログインしました。";
        $_SESSION["screenName"] = $screenName;
    }

    $_SESSION["status"] = [
        "title" => "ログインしました。",
        "detail" => $screenNameMessage."続いて、スコアのQRコードを読み取ってください。"
    ];
    header("Location: ./");