<!-- Magebit_Test variants -->
<?php
    /* ===== [ Galvenie iestatījumi ] ===== 
    session_start();
    include ('models/User.php');
    $user = new User();
     ===== [ Ja lietotājs spiež "Login" pogu ] ===== 
    if (isset($_REQUEST['submit']) AND $_REQUEST['submit'] == "LoginBtn") {
        extract($_REQUEST);
        $login = $user->login($email, $password);
        if ($login) {
            // - [Pieslēgšanās veiksmīga, tiek novirzīts uz home.php ] - //
            echo "<script>alert('Pieslēgšanās veiksmīga!');</script>";
            echo "<script>window.location.href='home.php';</script>";
        }
        else {
            // - [Pieslēgšanās neizdevās, tiek atgriezts atpakaļ galvenajā lapā] - //
            echo "<script>alert('Kļūda: Nepareizs e-pasts un/vai parole!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }
     ===== [ Ja lietotājs spiež "Sign Up" pogu ] ===== 
    if (isset($_REQUEST['submit']) AND $_REQUEST['submit'] == "RegisterBtn") {
        extract($_REQUEST);
        $register = $user->register($name, $email, $password);
        if ($register) {
            // - [Reģistrācija veiksmīga, tiek novirzīts uz home.php ] - //
            echo "<script>alert('Reģistrēšanās veiksmīga!');</script>";
            echo "<script>window.location.href='home.php';</script>";
        }
        else {
            // - [Reģistrācija neveiksmīga, tiek atgriezts atpakaļ galvenajā lapā] - //
            echo "<script>alert('Kļūda: Reģistrācija neizdevās! E-pasts jau atrodas datubāzē.');</script>";
            echo "<script>window.location.href='index.php';</script>";
        }
    }*/
?>
<!-- Magebit_V2 variants -->
<?php
    session_start();
    require 'models/User.php';
    require_once 'includes/Database.php';

    class userController {
        function __construct() {
            $this->conset = new Config();
            $this->userobj = new loginModel($this->conset->localhost, $this->conset->username, $this->conset->password, $this->conset->database);
        }

        public function Operations() {
            $op = isset($_GET['op']) ? $_GET['op'] : NULL;
            switch ($op) {
                case 'register':
                    $this->register();
                    break;
                case 'login':
                    $this->login();
                    break;
                case 'logout':
                    $this->logout();
                    break;
                case NULL:
                    if(isset($_SESSION['id'])) {
                        $user = $this->userobj->selectUserById($_SESSION['id']);
                        include 'views/home.php';
                    }
                    else {
                        include 'views/index.php';
                    }
                    break;
                default:
            }
        }

        public function logout() {
            session_destroy();
            $this->redirect("index.php");
        }
        public function redirect($location) {
            header('Location:'.$location);
        }
        public function register() {
            if(isset($_SESSION['id'])) {
                $user = $this->userobj->selectUserById($_SESSION['id']);
                include 'view/home.php';
            }
            elseif (isset($_POST['RegisterBtn'])) {//(isset($_POST['RegisterBtn'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = $this->userobj->register($name, $email, $password);
                $_SESSION['id'] = $user;
                $user = $this->userobj->selectUserById($_SESSION['id']);
                include 'view/home.php';
            }
            else {
                echo "blank";
            }
        }
        public function login() {
            if(isset($_SESSION['id'])) {
                $user = $this->userobj->selectUserById($_SESSION['id']);
                include 'view/home.php';
                //echo "<script>alert('Pieslēgšanās veiksmīga!');</script>";
                //echo "<script>window.location.href='view/home.php';</script>";
            }
            elseif (isset($_POST['LoginBtn'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = $this->userobj->login($email, $password);
                if($user) {
                    $_SESSION['id'] = $user->id;
                    include 'view/home.php';
                    //echo "<script>window.location.href='index.php';</script>";
                }
            }
            else {
                echo "Wrong admin name/password";
                // "<script>alert('Kļūda: Nepareizs e-pasts un/vai parole!');</script>";
                //echo "<script>window.location.href='view/index.php';</script>";
            }
        }
    }
?>