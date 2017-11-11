<?php
    require "./../api/Database.php";
    $Database = new mnmonzk\Database();
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
            }
                table.label td {
                    margin: 0mm;
                        width: 91mm;
                        height: 55mm;
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
                <tr>
                    <td>
                        <div class="content">
                            スコア管理システム ログインカード<br />
                            登録名 : <b>Tomotada Saigusa</b>(mnmonzk)
                        </div>
                        <img src="https://chart.googleapis.com/chart?cht=qr&chs=192x192&chl=https://uths.xyz/ukwo/login.php?name=mnmonzk" height="64px">
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>