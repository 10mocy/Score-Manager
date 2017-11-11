<?php
    include "include.php";
    if(isset($_GET["id"]) && $_GET["id"] !== "") {
        $id = htmlspecialchars($_GET["id"]);
        require "account-api.php";
        require "tips-api.php";
        $account_api = new tips\account_api();
        $tips_api = new tips\tips_api();
        $isLink = false;

        $mcidtouuid = [
            "mnmonzk" => "206ff0ac-5a95-4d55-8bbf-e456b1fa9f61",
            "yululi"  => "9f317138-f088-4480-babb-fc91a6d0a5a8",
            "junT58"  => "7c47164c-6ec1-40bd-966a-f3242d06a048",
            "a"  => "7c47164c-6ec1-40bd-966a-f3242d06a048"
        ];
        if(array_key_exists($id, $mcidtouuid)) {
            $uuid = $mcidtouuid[$id];
            if($account_api->isLink($uuid)) {
                $isLink = true;
            } else {
                $isLink = false;
            }
            var_dump($tips_api->access("/player/staff_servers", ["UUID" => $uuid]));

        }

    } else {
        $_SESSION["status"] = [];
        $status = [
            "title" => "",
            "detail" => ""
        ];
        $_SESSION["status"] += $status;
        header("Location: ".$path);
    }
    $title = $id;
    include "header.php";
?>
        <div class="container">

            <div class="well well-lg">
                <h1>
                    <img src="https://minotar.net/avatar/<?= $id ?>" height="64px"> 
                    <?= $id ?>
                </h1>
                <h4>
                    <span class="label label-tipser">T!PS 運営チーム</span> 
<?php
    if($isLink) {
?>
                    <span class="label label-info">
                        <i class="fa fa-link" aria-hidden="true"></i> 
                        T!PS IDと連携済み
                    </span>

<?php
    }
?>
                </h4>
            </div>

            <ul class="nav nav-tabs">
                <li class="active"><a href="#user" data-toggle="tab" aria-expanded="true">ユーザー情報</a></li>
                <li class=""><a href="#server" data-toggle="tab" aria-expanded="false">所属サーバー</a></li>
                <li class=""><a href="#punishment" data-toggle="tab" aria-expanded="false">処罰履歴</a></li>
            </ul>

            <div id="myTabContent" class="tab-content">

                <div class="tab-pane fade active in" id="user">
                    <div class="row text-center margin-top">

                        <div class="col-sm-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">処罰数</h3>
                                </div>
                                <div class="panel-body">
                                    Panel content
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4"></div>
                        <div class="col-sm-4"></div>
                    </div>
                </div>

                <div class="tab-pane fade" id="server">
                    <h2>所属サーバー</h2>
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>名前</th>
                                <th>アドレス</th>
                                <th>有効？</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#1</td>
                                <td>mnm.g-second.net</td>
                                <td>がっこうぐらしサーバ</td>
                                <td>はい</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="punishment">
                    <h2>処罰履歴</h2>
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>理由</th>
                                <th>種類</th>
                                <th>サーバー</th>
                                <th>日時</th>
                                <th>有効？</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="/pid/1a2b3c4d5e">1a2b3c4d5e</a></td>
                                <td>Use Hack client - ぬべすこHax</td>
                                <td>グローバルBAN</td>
                                <td>がっこうぐらしサーバ</td>
                                <td>2017-09-20 08:17:25 JST</td>
                                <td>はい</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

<?php include "footer.php"; ?>