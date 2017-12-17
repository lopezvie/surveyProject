<?php

/*
 * Author: Omar Lopez Vie 
 *  */

class Database {

    private $admin = 'admin';
    private $adminPwd = '2525';
    private $host = '209.129.8.7';
    private $user = 'lopezvie';
    private $pass = 'Anthony1';
    private $dbname = 'lopezvie_48947';
    private $userT = 'users';
    private $quesT = 'question';
    private $ansT = 'answer';
    private $surveyT = 'survey';
    private $conn;

    public function __construct() {
        // Create connection
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        //Check connection
        if ($this->conn->connect_error) {
            die("Data Base Connection Failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        mysqli_close($this->conn);
    }

    public function insertDB($n, $e, $p, $u) {
        $query = "INSERT INTO " . $this->userT . "
                       (user_name,user_email,user_password,
                        user_initDate,user_alias) VALUES ('" . $n . "' , '" . $e . "' , '" . $p . "' , '" . date('Ymd') . "' , '" . $u . "');";
        if ($this->conn->query($query) === TRUE) {
            echo "<h1>User Registered in " . $this->dbname . "</h1>";
            header("Location: loginPage.html");
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function insertQuestion($i, $q, $t, $s) {
        $query = "INSERT INTO " . $this->quesT . "
                       (id_user,survey_question,topic,id_survey) VALUES ('" . $i . "' , '" . $q . "' , '" . $t . "','" . $s . "');";
        if ($this->conn->query($query) === TRUE) {
            
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function insertANS($iq, $u, $a, $s) {
        $query = "INSERT INTO " . $this->ansT . "
                       (id_question,id_user,answer,id_survey) VALUES ('" . $iq . "' , '" . $u . "' , '" . $a . "','" . $s . "');";
        if ($this->conn->query($query) === TRUE) {
            
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function insertSurvey($ui, $topic) {
        $query = "INSERT INTO " . $this->surveyT . "
                       (id_user,survey_topic) VALUES ('" . $ui . "' , '" . $topic . "');";
        if ($this->conn->query($query) === TRUE) {
            
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

    public function selectU($uid, $pwd) {
        $sql = "SELECT * FROM users WHERE user_name='$uid' AND user_password='$pwd'";
        $result = $this->conn->query($sql);

        if (!$row = $result->fetch_assoc()) {
            echo "Invalid User";
            header("Location: loginPage.html");
        } else {
            $_SESSION["id_user"] = $row["id_user"]; //****************** Redirect User to Home Page ->header("");
            header("Location: surveyHome.php");
        }
    }

    public function selectDB() {
        $query = "SELECT id_user, user_name, user_email, user_password, user_initDate, user_alias FROM " . $this->userT;
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Date</th><th>User Name</th><th>Update User</th><th>Delete User</th></tr>";
            // output data of each row
            while ($re = $result->fetch_assoc()) {
                echo "<tr><td>" . $re["id_user"] . "</td>";
                echo "<td>" . $re["user_name"] . "</td> ";
                echo "<td>" . $re["user_email"] . "</td>";
                echo "<td>" . $re["user_password"] . "</td>";
                echo "<td>" . $re["user_initDate"] . "/td";
                echo "<td>" . $re["user_alias"] . "</td>";
                echo '<td><form action="updateFirst.php" method="post"><div id="buttons"><button id="update" type="submit" name="submit" value="' . $re["id_user"] . '">update</button></div></form></td>';
                echo '<td><form action="delete.php" method="post"><div id="buttons"><button id="delete" type="submit" name="submit" value="' . $re["id_user"] . '">delete</button></div></form></td><tr>';
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    }

    public function display($id) {
        $query = "SELECT * FROM `lopezvie_48947`.`survey` AS `survey` WHERE `survey`.`id_user`='" . $id . "';";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            while ($re = $result->fetch_assoc()) {
                echo "<form action='displaySurvey.php' method='get'><button class='section' type='submit' name='submit' value='" . $re["id_survey"] . "'>" . $re["survey_topic"] . "</button></form>";
            }
        } else {
            echo "<br><br><h1>0 results</h1>";
        }
    }

    public function displaySurvey($ui, $si) {
        $query = "SELECT * FROM " . $this->quesT . " WHERE id_survey=" . $si . " AND id_user=" . $ui . ";";
        $result = $this->conn->query($query);
        $_SESSION['counter'] = 0;
        if ($result->num_rows > 0) {
            echo "<form action='results.php' method='get'><div id='buttons'>";
            echo "<table><tr><th>" . $_SESSION['username'] . "</th><tr>";
            while ($re = $result->fetch_assoc()) {
                $query2 = "SELECT * FROM " . $this->ansT . " WHERE id_survey=" . $si . " AND id_user=" . $ui . " AND id_question=".$re["id_question"].";";
                $result2 = $this->conn->query($query2);
                echo "<tr><th>".$re["survey_question"]."</th></tr>";
                $_SESSION['counter']++;
                if ($result2->num_rows > 0) {
                    while ($re2 = $result2->fetch_assoc()) {
                        echo "<tr><td><input type='radio' name='array".$_SESSION['counter']."' value='".$re2["answer"]."'>".$re2["answer"]."</td></tr>";
                    }
                }
            }
            echo "</table>";
            echo "<input class='btn 'type='submit' value='submit'></div></form>";
        } else {
            echo "0 results";
        }
    }

    public function getUserByID($user, $pass) {
        $query = "SELECT * FROM " . $this->userT . " WHERE user_name='" . $user . "' AND user_password='" . $pass . "';";
        $result = $this->conn->query($query);
        $row = mysqli_fetch_assoc($result);
        //echo $row['id_user'];
        return $row['id_user'];
    }

    public function getSurveyByID($user, $topic) {
        $query = "SELECT * FROM " . $this->surveyT . " WHERE id_user='" . $user . "' AND survey_topic='" . $topic . "';";
        $result = $this->conn->query($query);
        $row = mysqli_fetch_assoc($result);
        //echo $row['id_user'];
        return $row['id_survey'];
    }

    public function getQuestionByID($user, $q, $t) {
        $query = "SELECT * FROM " . $this->quesT . " WHERE id_user='" . $user . "' AND survey_question='" . $q . "' AND topic='" . $t . "';";
        $result = $this->conn->query($query);
        $row = mysqli_fetch_assoc($result);
        //echo $row['id_user'];
        return $row['id_question'];
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getadminPWD() {
        return $this->adminPwd;
    }

    public function creteTable($tableName) {
        $argUsers = "CREATE TABLE " . $tableName . "(
        id_user int(11) not null AUTO_INCREMENT PRIMARY KEY,
        user_name varchar(256) not null,
        user_email varchar(256) not null,
        user_password varchar(256) not null,
        user_initDate date not null,
        user_alias varchar(256) not null
        );";

        if ($this->conn->query($argUsers) === TRUE) {
            echo "Table Created Remotely";
        } else {
            echo "Error: Table was NOT Created " . $this->conn->error . "<br>";
        }
    }

    public function createDB($database) {
        $argUsers = "CREATE DATABASE " . $database . ";";

        if ($this->conn->query($argUsers) === TRUE) {
            echo "Database Created Remotely";
        } else {
            echo "Error: Database was NOT Created " . $this->conn->error . "<br>";
        }
    }

    public function deleteUser($user_id) {
        $argUsers = "DELETE FROM " . $this->userT . " WHERE id_user='" . $user_id . "';";

        if ($this->conn->query($argUsers) === TRUE) {
            echo "User Deleted";
            header("Location: admin.php");
        } else {
            echo "Error: " . $this->conn->error . "<br>";
        }
    }

    public function updateUser($user_id, $user_name, $user_email, $user_password, $user_alias) {
        $argUsers = "UPDATE " . $this->userT . " SET "
                . " user_name='" . $user_name . "',"
                . " user_email='" . $user_email . "',"
                . " user_password='" . $user_password . "',"
                . " user_alias='" . $user_alias . "'"
                . " WHERE id_user = '" . $user_id . "';";

        echo $argUsers;
        if ($this->conn->query($argUsers) === TRUE) {
            echo "User Updated";
            header("Location: admin.php");
        } else {
            echo "Error: " . $this->conn->error . "<br>";
        }
    }

    public function createUser($n, $e, $p, $u) {
        $query = "INSERT INTO " . $this->userT . "
                       (user_name,user_email,user_password,
                        user_initDate,user_alias) VALUES ('" . $n . "' , '" . $e . "' , '" . $p . "' , '" . date('Ymd') . "' , '" . $u . "');";
        if ($this->conn->query($query) === TRUE) {
            echo "<h1>User Registered in " . $this->dbname . "</h1>";
            header("Location: admin.php");
        } else {
            echo "Error: " . $query . "<br>" . $this->conn->error;
        }
    }

}

$db = new Database();

