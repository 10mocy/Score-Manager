<?php
    namespace mnmonzk;
    class Database {

        function countAllScores() {
            $sqli = $this->connectMySQL();
            $query = 'SELECT * FROM scores WHERE 1';
            if($result = $sqli->query($query)) {
                $count = $result->num_rows;
            }
            return $count;
        }

        function getAllScores() {
            $sqli = $this->connectMySQL();
            $query = 'SELECT * FROM scores WHERE 1';
            if($result = $sqli->query($query)) {
                $count = $result->num_rows;
                $data = ["count" => 0, "scores" => []];
                $data += ["count" => $count];
                while($row = $result->fetch_assoc()) {
                    array_push($data["scores"], [
                        "scoreID" => $row["scoreID"],
                        "scoreName" => $row["scoreName"],
                        "scoreInitial" => $row["scoreInitial"],
                        "scoreKana" => $row["scoreKana"],
                        "schoolID" => $row["schoolID"]
                    ]);
                }
            }
            return $data;
        }

        function getAllUKScores() {
            $sqli = $this->connectMySQL();
            $query = 'SELECT * FROM scores WHERE schoolID = 1';
            if($result = $sqli->query($query)) {
                $count = $result->num_rows;
                $data = ["count" => 0, "scores" => []];
                $data += ["count" => $count];
                while($row = $result->fetch_assoc()) {
                    array_push($data["scores"], [
                        "scoreID" => $row["scoreID"],
                        "scoreName" => $row["scoreName"],
                        "scoreInitial" => $row["scoreInitial"],
                        "scoreKana" => $row["scoreKana"],
                        "schoolID" => $row["schoolID"]
                    ]);
                }
            }
            return $data;
        }

        function getScoreInfo($_ID) {
            $sqli = $this->connectMySQL();
            $query = 'SELECT * FROM scores WHERE scoreID = ?';
            if($stmt = $sqli->prepare($query)) {
                $stmt->bind_param("i", $_ID);
                $stmt->execute();
                
                $stmt->bind_result($scoreID, $scoreName, $scoreInitial, $scoreKana, $schoolID);
                $data = [];
                while ($stmt->fetch()) {
                    $data["scores"] = [
                        "scoreID" => $scoreID,
                        "scoreName" => $scoreName,
                        "scoreInitial" => $scoreInitial,
                        "scoreKana" => $scoreKana,
                        "schoolID" => $schoolID
                    ];
                }
                $stmt->close();
            }
            return $data;
        }

        function searchScores($_KANA) {
            $sqli = $this->connectMySQL();
            $query = 'SELECT * FROM scores WHERE scoreKana LIKE ?';
            if($stmt = $sqli->prepare($query)) {
                $kana = "%".$_KANA."%";
                $stmt->bind_param("s", $kana);
                $stmt->execute();

                $stmt->bind_result($scoreID, $scoreName, $scoreInitial, $scoreKana, $schoolID);
                $data = ["scores" => []];
                while ($stmt->fetch()) {
                    array_push($data["scores"], [
                        "scoreID" => $scoreID,
                        "scoreName" => $scoreName,
                        "scoreInitial" => $scoreInitial,
                        "scoreKana" => $scoreKana,
                        "schoolID" => $schoolID
                    ]);
                }
                $stmt->close();
            }
            return $data;
        }

        function writeLog($_ID, $_CLASS, $_USER) {
            $sqli = $this->connectMySQL();
            $query = "INSERT INTO logs (scoreID, logClass, timestamp, screenName) VALUES (?, ?, ?, ?)";
            if($stmt = $sqli->prepare($query)) {
                $stmt->bind_param("iiis", $_ID, $_CLASS, time(), $_USER);
                $stmt->execute();
                $stmt->close();
            }
        }

        function getLogs($_ID) {
            $sqli = $this->connectMySQL();
            $query = "SELECT * FROM logs WHERE scoreID = ? ORDER BY logID DESC";
            if($stmt = $sqli->prepare($query)) {
                $stmt->bind_param("i", $_ID);
                $stmt->execute();
                $stmt->bind_result($logID, $scoreID, $logClass, $timestamp, $screenName);
                $data = ["logs" => []];
                while ($stmt->fetch()) {
                    array_push($data["logs"], [
                        "logID" => $logID,
                        "scoreID" => $scoreID,
                        "logClass" => $logClass,
                        "timestamp" => $timestamp,
                        "screenName" => $screenName
                    ]);
                }
                $stmt->close();
            }
            return $data;
        }

        function getAllLogs() {
            $sqli = $this->connectMySQL();
            $query = "SELECT * FROM logs WHERE 1 ORDER BY logID DESC";
            if($stmt = $sqli->prepare($query)) {
                $stmt->bind_param("i", $_ID);
                $stmt->execute();
                $stmt->bind_result($logID, $scoreID, $logClass, $timestamp, $screenName);
                $data = ["logs" => []];
                while ($stmt->fetch()) {
                    array_push($data["logs"], [
                        "logID" => $logID,
                        "scoreID" => $scoreID,
                        "logClass" => $logClass,
                        "timestamp" => $timestamp,
                        "screenName" => $screenName
                    ]);
                }
                $stmt->close();
            }
            return $data;
        }

        function getLatestLog($_ID) {
            $sqli = $this->connectMySQL();
            $query = "SELECT * FROM logs WHERE scoreID = ? ORDER BY logID DESC LIMIT 1";
            if($stmt = $sqli->prepare($query)) {
                $stmt->bind_param("i", $_ID);
                $stmt->execute();
                $stmt->bind_result($logID, $scoreID, $logClass, $timestamp, $screenName);
                $data = null;
                while ($stmt->fetch()) {
                    $data = [
                        "logID" => $logID,
                        "scoreID" => $scoreID,
                        "logClass" => $logClass,
                        "timestamp" => $timestamp
                    ];
                }
                $stmt->close();
            }
            return $data;
        }

        function getSchool($_ID) {
            $sqli = $this->connectMySQL();
            $query = "SELECT * FROM schools WHERE schoolID = ?";
            if($stmt = $sqli->prepare($query)) {
                $stmt->bind_param("i", $_ID);
                $stmt->execute();
                $stmt->bind_result($schoolID, $schoolName);
                $data = [];
                while ($stmt->fetch()) {
                    $data["schools"] = [
                        "schoolID" => $schoolID,
                        "schoolName" => $schoolName
                    ];
                }
                $stmt->close();
            }
            return $data;
        }

        function classID2className($_ID) {
            $_ID = intval($_ID);
            switch($_ID) {
                case 0: $result = "格納未登録"; break;
                case 1: $result = "部室に格納済み"; break;
                case 2: $result = "持ち出し・貸し出し中"; break;
                case 3: $result = "破棄・返却済み"; break;
                case 4: $result = "紛失"; break;
                default: $result = " - "; break;
            }
            return $result;
        }
         
        function connectMySQL() {
            $sqli = new \mysqli('localhost', 'ukwo', '', 'ukwo_score_manage');
            if ($sqli->connect_error) {
                echo $sqli->connect_error;
                exit();
            } else {
                $sqli->set_charset("utf8");
            }
            return $sqli;
        }

    }