<?php
    class Admin{


        public function __construct (private PDO $pdo) {}


        public function getAdmins() {
            $query = "SELECT * FROM immobilis.admins";
            $stmt = $this->pdo->query($query);
            return $stmt->fetchAll();
        }


        public function createAdmin(){
            $firstname = "Ricardo";
            $lastname = "Dias";
            $email = "ricardo@dias.com";
            $password = password_hash("rico", PASSWORD_BCRYPT);

            $query = "INSERT INTO immobilis.admins(firstname, lastname, email, password)
                        VALUES(?, ?, ?, ?)
                    ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$firstname, $lastname, $email, $password]);

        }


        public function getAdminByEmail(string $email){

            $query = "SELECT * FROM immobilis.admins WHERE email = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$email]);
            return $stmt->fetch();
        }

    }
?>