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
            .title {
                font-size: 10mm;
            }
        </style>
    </head>
    <body>
        <table class="label">
            <tbody>
                <tr>
                    <td>
                        <div class="title">スコア管理システム ログインカード</div>
                        <div class="content">スコア管理システム ログインカード</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>