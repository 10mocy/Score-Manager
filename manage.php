<?php
    include "include.php";
    
    if(empty($_SESSION["isLogin"]) && !$_SESSION["isLogin"]) {
        $_SESSION["status"] = [
            "title" => "ログインされていません。",
            "detail" => "ログイン用QRコードを読み取ってログインしてください。"
        ];
        header("Location: ./");
    }
    
    if(empty($_GET["scoreID"]) || $_GET["scoreID"] === "") {
        header("Location: ./");
    } else {
        $scoreID = intval(htmlspecialchars($_GET["scoreID"]));
    }

    
    require "./api/Database.php";
    $Database = new mnmonzk\Database();

    if(isset($_GET["mode"]) && $_GET["mode"] === "writelog") {
        $Database->writeLog($scoreID, intval($_GET["logclass"]), $screenName);
        header("Location: ./manage.php?scoreID=".$scoreID);
    }

    $score = $Database->getScoreInfo($scoreID)["scores"];
    $logs = $Database->getLogs($scoreID)["logs"];
    $latestlog = $Database->getLatestLog($scoreID);

    $title = $score["scoreName"];
    include "header.php";


?>
        <div class="container">

            <h1>スコア管理システム</h1>
            <h2 class="page-header"><?= $score["scoreName"] ?><small> - No.<?= $score["scoreID"] ?></small></h2>
            <h3 class="text-center">スコア位置管理モード</h3>

            <div class="row">

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
            <div class="row">

                <div class="col-sm-push-8 col-sm-4">
                    <h4 class="page-header">操作</h4>
<?php
    switch($latestlog["logClass"]) {
        case 0:
            $logclass[0] = ["tagclass" => "", "logclass" => 1, "name" => "格納登録"];
            $logclass[1] = ["tagclass" => "disabled", "logclass" => 1, "name" => " - "];
            $logclass[2] = ["tagclass" => "disabled", "logclass" => 1, "name" => " - "];
            break;
        case 1:
            $logclass[0] = ["tagclass" => "", "logclass" => 2, "name" => "持ち出し"];
            $logclass[1] = ["tagclass" => "", "logclass" => 3, "name" => "破棄・返却"];
            $logclass[2] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            break;
        case 1:
            $logclass[0] = ["tagclass" => "", "logclass" => 2, "name" => "持ち出し"];
            $logclass[1] = ["tagclass" => "", "logclass" => 3, "name" => "破棄・返却"];
            $logclass[2] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            break;
        case 2:
            $logclass[0] = ["tagclass" => "", "logclass" => 0, "name" => "格納完了"];
            $logclass[1] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            $logclass[2] = ["tagclass" => "", "logclass" => 4, "name" => "紛失"];
            break;
        case 3:
            $logclass[0] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            $logclass[1] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            $logclass[2] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            break;
        case 4:
            $logclass[0] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            $logclass[1] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            $logclass[2] = ["tagclass" => "disabled", "logclass" => 2, "name" => " - "];
            break;
    }
?>
                    <a href="?scoreID=<?= $scoreID ?>&mode=writelog&logclass=<?= $logclass[0]["logclass"] ?>" class="btn btn-primary btn-lg btn-block <?= $logclass[0]["tagclass"] ?>">
                        <?= $logclass[0]["name"] ?>
                    </a>
                    <a href="?scoreID=<?= $scoreID ?>&mode=writelog&logclass=<?= $logclass[1]["logclass"] ?>" class="btn btn-warning btn-lg btn-block <?= $logclass[1]["tagclass"] ?>">
                        <?= $logclass[1]["name"] ?>
                    </a>
                    <a href="?scoreID=<?= $scoreID ?>&mode=writelog&logclass=<?= $logclass[2]["logclass"] ?>" class="btn btn-danger btn-lg btn-block <?= $logclass[2]["tagclass"] ?>">
                        <?= $logclass[2]["name"] ?>
                    </a>
                </div>

                <div class="col-sm-pull-4 col-sm-8">
                    <h4 class="page-header">ログ</h4>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>ログ番</td>
                                <td>種別</td>
                                <td>時間</td>
                                <td>実行者</td>
                            </tr>
                        </thead>
                        <tbody>
<?php
    foreach($logs as $log) {
?>
                            <tr>
                                <td><?= $log["logID"] ?></td>
                                <td><?= $Database->classID2className($log["logClass"]) ?></td>
                                <td><?= date("Y年m月d日 H時i分", $log["timestamp"]) ?></td>
                                <td><?= $log["screenName"] ?></td>
                            </tr>

<?php
    }
?>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>

<?php include "footer.php"; ?>