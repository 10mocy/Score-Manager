<?php
    require "./../api/Database.php";
    $Database = new mnmonzk\Database();

    $scores = $Database->getAllUKScores()["scores"];
    if(isset($_GET["page"]) && $_GET["page"] !== "") {
        $page = intval($_GET["page"]);
    } else {
        $page = 0;
    }
    $labeldata = array_slice($scores, 1 * $page * 21, 21);
    $rowdata = [];
    for($row = 0; $row < 7; $row++) {
        array_push($rowdata, array_slice($labeldata, 1 * $row * 3, 3));
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
                margin: 23.5mm 7mm;
                margin-bottom: 0mm;
                /*border: 1px #333 solid;*/
            }
                table.label td {
                    margin: 0cm;
                        width: 64mm;
                        height: 32.60mm;
                        /*border: 1px #333 solid;*/
                    text-align: center;
                }
            .song {
                font-size: 2mm;
            }
            .code {
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
        foreach($item as $score) {
?>
                    <td>
                        <b class="song"><?= $score["scoreName"] ?></b><br />
                        <img src="https://chart.googleapis.com/chart?cht=qr&chs=192x192&chl=https://uths.xyz/ukwo/manage.php?scoreID=<?= $score["scoreID"] ?>" height="64px"><br />
                        <b class="code"><?= $score["scoreInitial"] ?> - <?= $score["scoreID"] ?></b>
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