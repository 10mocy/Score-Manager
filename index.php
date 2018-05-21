<?php

    /**
     * Created by PhpStorm.
     * User: nirot1r
     * Date: 2018/04/10
     * Time: 21:26
     */

    include "inc/header.php";
    require_once "api/API.php";
        $API = new nirot1r\API();

    if(isset($_GET["p"]) && $_GET["p"] !== "") {
        $p = intval($_GET["p"]);
        if($p <= 0) {
            $p = 1;
        }
    } else {
        $p = 1;
    }

    $scoresList = $API->getScoreList();
    $scoresID = array_slice($scoresList, ($p -1) * 50, 50);
    $scoresCount = count($scoresList);
    $allPages = intval(ceil($scoresCount / 50));

?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">楽譜発行管理システム</h1>
            </div>
        </div>

        <div class="container">
            <h2>登録されている楽譜 <small class="badge badge-secondary"><?= $scoresCount ?>件</small></h2>

            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="?p=<?= ($p - 1) > 0 ? $p-1 : 1; ?>">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="?p=<?= $p < $allPages ? $p + 1 : $allPages;?>">&raquo;</a></li>
            </ul>
            <p class="text-center"><?= $scoresCount ?>件中 <?= ($p -1) * 50 + 1 ?> 〜 <?= $p * 50 ?> 件</p>

            <table class="table table-responsive">
                <thead class="table table-sm">
                    <tr>
                        <th scope="row">#</th>
                        <th scope="row">曲名</th>
                        <th scope="row">格納場所</th>
                        <th scope="row">検索用</th>
                        <th scope="row">状態</th>
                        <th scope="row">所有団体</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($scoresID as $item):
                        $scoreData = $API->loadScoreInfo($item);
                ?>
                    <tr class="success">
                        <th scope="row"><?= $item ?></th>
                        <td><a href="./scores.php?scoreID=<?= $item ?>"><?= $scoreData["scoreName"] ?></a></td>
                        <td><?= $scoreData["scoreInitial"] ?></td>
                        <td><?= $scoreData["scoreKana"] ?></td>
                        <td>部室に格納済み</td>
                        <td>栃木県立宇都宮工業高等学校 音楽部</td>
                    </tr>

                <?php
                    endforeach;
                ?>
                </tbody>
            </table>

            <p class="text-center"><?= $scoresCount ?>件中 <?= ($p -1) * 50 + 1 ?> 〜 <?= $p * 50 ?> 件</p>
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="?p=<?= ($p - 1) > 0 ? $p-1 : 1; ?>">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="?p=<?= $p < $allPages ? $p + 1 : $allPages;?>">&raquo;</a></li>
            </ul>

        </div>
