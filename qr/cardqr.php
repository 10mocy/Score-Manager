<?php
    require "./../api/Database.php";
    $Database = new mnmonzk\Database();

    $addresses = [
        [
            "screenname" => "mnmonzk",
            "name" => "Saigusa"
        ],
        [
            "screenname" => "iijima",
            "name" => "Iijima"
        ],
        [
            "screenname" => "scorer",
            "name" => "楽譜係"
        ],
        [
            "screenname" => "card1",
            "name" => "レンタルカード No.1"
        ],
        [
            "screenname" => "card2",
            "name" => "レンタルカード No.2"
        ],
        [
            "screenname" => "card3",
            "name" => "レンタルカード No.3"
        ],
        [
            "screenname" => "card4",
            "name" => "レンタルカード No.4"
        ],
        [
            "screenname" => "card5",
            "name" => "レンタルカード No.5"
        ],
        [
            "screenname" => "card6",
            "name" => "レンタルカード No.6"
        ],
        [
            "screenname" => "card7",
            "name" => "レンタルカード No.7"
        ]
    ];
    $carddata = array_slice($addresses, 0, 10);
    $rowdata = [];
    for($row = 0; $row < 5; $row++) {
        array_push($rowdata, array_slice($carddata, $row * 2, 2));
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            @page {
                size: A4;
                margin: 0;
              }
              @media print {
                body {
                  width: 210mm; /* needed for Chrome */
                }
              }
            body {
                margin: 0px;
                padding: 0px;
            }
            table.label {
                margin: 11mm 14mm;
                margin-bottom: 0mm;
            }
                table.label td {
                    margin: 0mm;
                        width: 91mm;
                        height: 54.5mm;
                        padding: 0mm;
                    text-align: center;
                }
            .content {
                font-size: 5mm;
            }
        </style>
    </head>
    <body>
        <table class="label">
            <tbody>
<?php
    foreach($rowdata as $item) {
?>
                <tr>
<?php
        foreach($item as $card) {
?>
                    <td>
                        <div class="content">
                            <b><i>スコア管理システム ログインカード</i></b><br />
                            登録名 : <b><?= $card["name"] ?></b><br />
                            (<?= $card["screenname"] ?>)
                        </div>
                        <img src="https://chart.googleapis.com/chart?cht=qr&chs=192x192&chl=https://uths.xyz/ukwo/login.php?screenName=<?= $card["screenname"] ?>" height="110px">
                    </td>
<?php
        }
?>
                </tr>
<?php
    }
?>
            </tbody>
        </table>
    </body>
</html>