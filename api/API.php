<?php
    namespace nirot1r;
    class API {

        /* スコアリスト取得 */
            function findScoreList() {
                /* return: Array(Int scoreID) */
            }
        /* スコア情報取得 */
            function loadScoreInfo($scoreID) {
                /* return: Object Score */
            }
        /* スコア情報作成 */
            function createScore() {
                /* return: Boolean */
            }

        /* ログ取得 */
            function loadLog($scoreID) {
                /* return: $classID, $userID, timestamp */
            }
        /* ログ書き込み */
            function writeLog($scoreID, $classID, $userID) {
                /* return: void */
            }

        /* 管理団体情報取得 */
            function getSchool() {
                /* return: Object School  */
            }

        /* ユーザ情報取得 */
            function getUserInfo($userID) {
                /* return: Obejct User */
            }
        
    }

?>