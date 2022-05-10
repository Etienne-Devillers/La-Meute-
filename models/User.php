<?php 

require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../utils/db.php');

class User{

    private int $id;
    private string $firstname;
    private string $lastname;
    private string $mail;
    private string $pwd;
    private string $username;
    private string $phoneNumber;
    private string $registered_at;
    private ?string $validated_at;
    private string $connected_at;
    private int $idRoles;

    private object $pdo;

    public function __construct( string $mail, string $pwd, string $username, int $idRoles = 3 ) {
    
        $this->setMail($mail);
        $this->setPwd($pwd);
        $this->setUsername($username);
        $this->setIdRoles($idRoles);

        $this->pdo = Database::dbConnect();

    }

//Création des set et get.

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setPwd(string $pwd): void
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    public function getPwd(): string
    {
        return $this->pwd;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function getMail(): string
    {
        return $this->mail;
    }
    
    public function setRegistered_at(string $registered_at): void
    {
        $this->registered_at = $registered_at;
    }

    public function getRegistered_at(): string
    {
        return $this->registered_at;
    }

    public function setValidated_at(string $validated_at): void
    {
        $this->validated_at = $validated_at;
    }

    public function getValidated_at(): string
    {
        return $this->validated_at;
    }

    public function setConnected_at(string $connected_at): void
    {
        $this->connected_at = $connected_at;
    }

    public function getConnected_at(): string
    {
        return $this->connected_at;
    }

    public function setIdRoles(string $idRoles): void
    {
        $this->idRoles = $idRoles;
    }

    public function getIdRoles(): int
    {
        return $this->idRoles;
    }

//Création du CRUD 

    public function add(): bool
    {

        try {
            //  requête avec des marqueurs nominatifs
            $sql = 'INSERT INTO `users` (`mail`, `pwd`, `username`, `id_roles`) 
                VALUES (:mail, :pwd, :username, :id_roles);';

            // On prépare la requête

            $sth = $this->pdo->prepare($sql);
            //Affectation des valeurs aux marqueurs nominatifs
            $sth->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
            $sth->bindValue(':pwd', $this->getPwd(), PDO::PARAM_STR);
            $sth->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
            $sth->bindValue(':id_roles', $this->getIdRoles(), PDO::PARAM_INT);
            
            // On retourne directement true si la requête s'est bien exécutée ou false dans le cas contraire
            return $sth->execute();
        } catch (PDOException $e) {
            // On retourne false si une exception est levée
            return false;
        }
}

public static function isMailExists(string $mail): bool
    {
        try {
            $sql = 'SELECT * FROM `users` WHERE `mail` = :mail';

            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':mail', $mail, PDO::PARAM_STR);
            $sth->execute();

            return empty($sth->fetchAll()) ? false : true;

        } catch (\PDOException $e) {
            return false;
        }
    }

public static function isUsernameExists(string $username): bool
    {
        try {
            $sql = 'SELECT * FROM `users` WHERE `username` = :username';

            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':username', $username, PDO::PARAM_STR);
            $sth->execute();
            return empty($sth->fetchAll()) ? false : true;

        } catch (\PDOException $e) {
            return false;
        }
    }

    public static function getByMail($mail): object
    {

        try {
            $pdo = Database::dbConnect();

            $sql = 'SELECT * FROM `users` WHERE `mail` = :mail ;';

            $sth = $pdo->prepare($sql);

            $sth->bindValue(':mail', $mail, PDO::PARAM_STR);

            $result = $sth->execute();
            
            if ($result === false) {
                //Erreur générale
                throw new PDOException();
            } else {
                $patient = $sth->fetch();
                if ($patient === false) {
                    //mail non trouvé
                    throw new PDOException();
                } else {
                    return $patient;
                }
            }
        } catch (\PDOException $ex) {
            return $ex;
        }
    }

    public static function getByUsername($username): object
    {

        try {
            $pdo = Database::dbConnect();

            $sql = 'SELECT * FROM `users` WHERE `username` = :username ;';

            $sth = $pdo->prepare($sql);
            $sth->bindValue(':username', $username, PDO::PARAM_STR);

            $result = $sth->execute();
            
            if ($result === false) {
                //Erreur générale
                throw new PDOException();
            } else {
                $patient = $sth->fetch();
                if ($patient === false) {
                    //username non trouvé
                    throw new PDOException();
                } else {
                    return $patient;
                }
            }
        } catch (\PDOException $ex) {
            return $ex;
        }
    }

    public static function login(string $mail) {

        $sql = 'SELECT * FROM `users` WHERE `mail` = :mail ;';

        try {

            $pdo = Database::dbConnect();
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':mail', $mail, PDO::PARAM_STR);
            $sth->execute();

            if ($sth ===false) {
                throw new PDOException();
            }
            return $sth->fetch();

        } catch (\PDOException $ex) {
        return $ex;
        }
    }
}