<?php
    include "include.php";

    if(empty($_GET["scoreID"]) || $_GET["scoreID"] === "") {
        header("Location : ./");
    } else {
        $scoreID = intval(htmlspecialchars($_GET["scoreID"]));
    }

    require "./api/Database.php";
    $Database = new mnmonzk\Database();

    $score = $Database->getScoreInfo($scoreID)["scores"];
    $latestlog = $Database->getLatestLog($scoreID);

    if($score === null) {
        $_SESSION["status"] = [
            "title" => "ログインされていません。",
            "detail" => "ログイン用QRコードを読み取ってログインしてください。"
        ];
        header("Location: ./");
    }

    $title = $score["scoreName"];
    include "header.php";
?>
        <div class="container">
            <h1>スコア管理システム</h1>
            <h2 class="page-header"><?= $score["scoreName"] ?><small> - No.<?= $score["scoreID"] ?></small></h2>
            
            <div class="row">

                <div class="col-sm-12 text-center">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">スコア所有団体</h3>
                        </div>
                        <div class="panel-body">
                            <?= $Database->getSchool($score["schoolID"])["schools"]["schoolName"] ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-success text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">現在の状態</h3>
                        </div>
                        <div class="panel-body">
                        <?= $Database->classID2className($latestlog["logClass"]) ?>(<?= date("Y年m月d日 H時i分", $latestlog["timestamp"]) ?>現在)
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-success text-center">
                        <div class="panel-heading">
                            <h3 class="panel-title">管理番号</h3>
                        </div>
                        <div class="panel-body">
                            <?= $score["scoreInitial"] ?> - <?= $score["scoreID"] ?>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row text-center">

                <div class="col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">格納場所</h3>
                        </div>
                        <div class="panel-body">
                            <?= $score["scoreInitial"] ?>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">検索用文字列</h3>
                        </div>
                        <div class="panel-body">
                            <?= $score["scoreKana"] ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>

<?php include "footer.php"; ?>