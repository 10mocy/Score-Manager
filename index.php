<?php
    include "include.php";
    $title = "スコア管理システム";
    include "header.php";

    $sortOrder = [
        "scoreID" => "楽譜ID順",
        "scoreInitial" => "棚記号順",
        "scoreKana" => "よみあいうえお順",
        "schoolID" => "所有団体順"
    ];

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
    $titleText = "登録されているスコア";

    if(isset($_POST)) {
        if(isset($_POST["search"]) && isset($_POST["search"]["submit"])) {
            if(isset($_POST["search"]["text"])) {
                $searchText = $_POST["search"]["text"];
                $scoreslist = $Database->searchScores($searchText)["scores"];
                $titleText = "「".htmlspecialchars($searchText)."」の検索結果";
            }
        } elseif(isset($_POST["sort"])) {
            if(isset($_POST["sort"]["category"], $_POST["sort"]["order"])) {
            }
        }
    } else {
    }

    $scoresdata = array_slice($scoreslist, ($p -1) * 50, 50);
    $scorecount = count($scoreslist);
    $allp = intval(ceil($scorecount / 50));
?>
        <div class="container">
            <div class="row">
                <h1>スコア管理システム</h1>
                <div class="col-sm-8">
                    <h2><?= $titleText ?><small> - 全<?= $scorecount ?>件</small></h2>
                    <form method="POST">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select class="form-control" id="select" name="sort[category]">
<?php
    foreach($sortOrder as $key => $item):
        if(isset($_POST["sort"]["category"]) && $_POST["sort"]["category"] === $key) {
            $selectedItem = "selected";
        } else {
            $selectedItem = "";
        }
?>
                                    <option value="<?= $key ?>" <?= $selectedItem ?>><?= $item ?></option>

<?php
    endforeach;
?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-default" name="sort[order]" value="ASC"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></button>
                                        <button type="submit" class="btn btn-default" name="sort[order]" value="DESC"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <form method="POST">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="よみ検索" name="search[text]" value="<?= isset($searchText) ? $searchText : ""; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" name="search[submit]"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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