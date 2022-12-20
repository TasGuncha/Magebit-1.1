<!-- Magebit_Test variants -->
<?php
    /* ===== [ Galvenie iestatījumi ] ===== 
    include_once ('includes/Database.php');
     ===== [ Class ] ===== 
    class User{

        public $db;
        public function __construct() {
            // - [Savienojums ar serveri] - //
            $this->db = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
            // - [Ja nevar izveidot savienojumu] - //
            if(mysqli_connect_errno()) {
                echo "Kļūda: Nevarēja izveidot savienojumu ar datubāzi!";
                    exit;
            }
        }
         ===== [ Funkcija - reģistrācija ] ===== 
        public function register($name, $email, $password) {
            // - [Pārbauda, vai šāda ē-pasta adrese jau neatrodas datubāzē] - //
            $sql = "SELECT * FROM users WHERE email='$email'";
            $check =  $this->db->query($sql) ;
            $count_row = $check->num_rows;
            // - [Ja šāda ē-pasta adrese jau neatrodas datubāzē, tad tiek pievienots lietotājs] - //
            if ($count_row == 0) {
                $sql = "INSERT INTO users SET name='$name', email='$email', password='$password'";
                $result = mysqli_query($this->db, $sql) or die(mysqli_connect_errno()."Kļūda: nevarēja pievienot datubāzei!");
                $_SESSION['login'] = true;
                $_SESSION['id'] = $user_data['id'];
                return $result;
            }
            else {
                return false;
            }
        }
         ===== [ Funkcija - pieslēgšanās ] ===== 
        public function login($email, $password) {
            // - [Pārbauda, vai šāda ē-pasta adrese jau atrodas datubāzē] - //
            $sql = "SELECT id from users WHERE email='$email' and password='$password'";
            $result = mysqli_query($this->db, $sql);
            $user_data = mysqli_fetch_array($result);
            $count_row = $result->num_rows;
            // - [Ja šāda ē-pasta adrese jau atrodas datubāzē, tad izveido sesiju lietotājam] - //
            if ($count_row == 1) {
                $_SESSION['login'] = true;
                $_SESSION['id'] = $user_data['id'];
                return true;
            }
            else{
                return false;
            }
        }
         ===== [ Funkcija - vārds, uzvārds ] ===== 
        public function get_fullname($id) {
            // - [Pārbauda un atgriež lietotāja pilnu vārdu, uzvārdu, kad tiek novirzīts home.php lapā] - //
    		$sql = "SELECT name FROM users WHERE id='$id'";
	        $result = mysqli_query($this->db, $sql);
	        $user_data = mysqli_fetch_array($result);
	        echo $user_data['name'];
        }
         ===== [ Funkcija - pilns lietotāju saraksts ] ===== 
        public function fetch() {
            $data = null;
            $query = "SELECT * FROM users";
            if($sql = $this->db->query($query)) {
                while($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
            return $data;
        }
         ===== [ Funkcija - rediģēšana ] ===== 
        public function edit($id) {
            $data = null;
            $query = "SELECT * FROM users WHERE id='$id'";
            if($sql = $this->db->query($query)) {
                while($row = $sql->fetch_assoc()) {
                    $data = $row;
                }
            }
            return $data;
        }
         ===== [ Funkcija - atjaunošana ] ===== 
        public function update($name, $email, $password, $age, $sex, $occupation, $hobbies, $id) {
            $query = "UPDATE users SET name='$name', email='$email', password='$password', age='$age', sex='$sex', occupation='$occupation', hobbies='$hobbies' WHERE id='$id'";
            if($sql = $this->db->query($query)) {
                return true;
            }
            else {
                return false;
            }
        }
         ===== [ Funkcija - dzēšana ] ===== 
        public function delete($id) {
            $query = "DELETE FROM users WHERE id='$id'";
            if($sql = $this->db->query($query)) {
                return true;
            }
            else {
                return false;
            }
        }
         ===== [ Funkcija - sesijas pārbaude ] ===== 
        public function get_session(){
            return $_SESSION['login'];
        }
         ===== [ Funkcija - atslēgšanās no konta, sesijas nesaglabāšana ] ===== 
        public function user_logout() {
            $_SESSION['login'] = FALSE;
            session_destroy();
        }
    }*/
?>
<!-- Magebit_V2 variants -->
<?php
    /* ===== [ Galvenie iestatījumi ] ===== */
    /* ===== [MVC variants] ===== */
    class loginModel {
        function __construct($host, $uname, $pass, $db) {
            $this->localhsot = $host;
            $this->username = $uname;
            $this->password = $pass;
            $this->database = $db;
            /*// - [Savienojums ar serveri] - //
            $this->db = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
            // - [Ja nevar izveidot savienojumu] - //
            if(mysqli_connect_errno()) {
                echo "Kļūda: Nevarēja izveidot savienojumu ar datubāzi!";
                    exit;
            }*/
        }
        public function ConnectDb() {
            $this->conn = new mysqli($this->localhsot, $this->username, $this->password, $this->database);
            if($this->conn->connect_error) {
                echo "Kļūda: Nevarēja izveidot savienojumu ar datubāzi!";
            }
            else {
                echo "<h1>Savienojums izveidots sekmīgi!</h1>";
            }
        }
        public function CloseDb() {
            $this->conn->close();
        }
        public function register($name, $email, $password) {
            try {
                $this->ConnectDb();
                $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sss", $name, $email, $password);
                $stmt->execute();
                $res = $stmt->get_result();
                $last_id = $this->conn->insert_id;
                $stmt->close();
                $this->CloseDb();
                return $last_id;
            }
            catch (Exception $e) {
                throw $e;
            }
        }
        public function login($email, $password) {
            try {
                $query = "SELECT * FROM users WHERE email=? AND password=?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();
                $res = $stmt->get_result();
                $stmt->close();
                return $res->fetch_object();
            }
            catch (Exception $e) {
                throw $e;
            }
        }
        public function selectUserById($id) {
            try {
                $this->ConnectDb();
                $query = "SELECT * FROM users WHERE id=?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();
                $stmt->close();
                $this->CloseDb();
                return $res->fetch_object();
            }
            catch (Exception $e) {
                throw $e;
            }
        }
        public function get_fullname($id) {
            // - [Pārbauda un atgriež lietotāja pilnu vārdu, uzvārdu, kad tiek novirzīts home.php lapā] - //
    		$sql = "SELECT name FROM users WHERE id='$id'";
	        $result = mysqli_query($this->db, $sql);
	        $user_data = mysqli_fetch_array($result);
	        echo $user_data['name'];
        }
        /* ===== [ Funkcija - pilns lietotāju saraksts ] ===== */
        public function fetch() {
            $data = null;
            $query = "SELECT * FROM users";
            if($sql = $this->db->query($query)) {
                while($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
            return $data;
        }
    }
?>