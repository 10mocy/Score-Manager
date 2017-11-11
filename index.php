<?php
    include "include.php";
    $title = "スコア管理システム";
    include "header.php";

    if(isset($_GET["p"]) && $_GET["p"] !== "") {
        $p = intval($_GET["p"]);
        if($p <= 0) {
            $p = 1;
        }
    } else {
        $p = 1;
    }
    require "./api/Database.php";
    $Database = new mnmonzk\Database();
    $scoreslist = $Database->getAllScores()["scores"];
    $scoresdata = array_slice($scoreslist, ($p -1) * 50, 50);
    $scorecount = count($scoreslist);
    $allp = intval(ceil($scorecount / 50));
?>
        <div class="container">
            <h1>スコア管理システム</h1>
            <h2 class="page-header">登録されているスコア<small> - 全<?= $scorecount ?>件</small></h2>
            <?php //var_dump($Database->getAllScores()); ?>

            <ul class="pager">
                <li><a href="?p=<?= ($p - 1) > 0 ? $p-1 : 1; ?>">番号が小さい</a></li>
                <li><?= $scorecount ?>件中 <?= ($p -1) * 50 + 1 ?> 〜 <?= $p * 50 ?> 件</li>
                <li><a href="?p=<?= $p < $allp ? $p + 1 : $allp;?>">番号が大きい</a></li>
            </ul>

            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>曲名</th>
                        <th>格納場所</th>
                        <th>検索用</th>
                        <th>状態</th>
                        <th>所有団体</th>
                    </tr>
                </thead>
                <tbody>
<?php
    foreach($scoresdata as $scores) {
        $latestlog = $Database->getLatestLog(intval($scores["scoreID"]));
        $status = intval($latestlog["logClass"]);
        switch($status) {
            case 1: $class = "info"; break;
            case 2: $class = "success"; break;
            case 3: $class = "warning"; break;
            case 4: $class = "danger"; break;
            default: $class = ""; break;
        }
?>
                    <tr class="<?= $class ?>">
                        <td><?= $scores["scoreID"] ?></td>
                        <td><a href="./scores.php?scoreID=<?= $scores["scoreID"] ?>"><?= $scores["scoreName"] ?></a></td>
                        <td><?= $scores["scoreInitial"] ?></td>
                        <td><?= $scores["scoreKana"] ?></td>
                        <td><?= $Database->classID2className($status) ?></td>
                        <td><?= $Database->getSchool(intval($scores["schoolID"]))["schools"]["schoolName"] ?></td>
                    </tr>

<?php
    }
?>
                </tbody>
            </table>

            <ul class="pager">
                <li><a href="?p=<?= ($p - 1) > 0 ? $p-1 : 1; ?>">番号が小さい</a></li>
                <li><?= $scorecount ?>件中 <?= ($p -1) * 50 + 1 ?> 〜 <?= $p * 50 ?> 件</li>
                <li><a href="?p=<?= $p < $allp ? $p + 1 : $allp;?>">番号が大きい</a></li>
            </ul>

        </div>

<?php include "footer.php"; ?>