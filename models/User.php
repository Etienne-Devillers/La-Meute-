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
            $sql = 'INSERT INTO `users` (`mail`, `pwd`, `username`, `id_role`) 
                VALUES (:mail, :pwd, :username, :id_role);';

            // On prépare la requête

            $sth = $this->pdo->prepare($sql);
            //Affectation des valeurs aux marqueurs nominatifs
            $sth->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
            $sth->bindValue(':pwd', $this->getPwd(), PDO::PARAM_STR);
            $sth->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
            $sth->bindValue(':id_role', $this->getIdRoles(), PDO::PARAM_INT);
            
            // On retourne directement true si la requête s'est bien exécutée ou false dans le cas contraire
            return $sth->execute();
        } catch (PDOException $e) {
            // On retourne false si une exception est levée
            return false;
        }
}

public static function getAll(string $search='', int $limit=25, int $offset=0): array
    {
        
        try {
            // Si la limite n'est pas définie, il faut tout lister
            $sql = "SELECT `users`.`id`,
                    `roles`.`role`,
                    `lastname`,
                    `firstname`,
                    `mail`,
                    `username`,
                    `phonenumber`,
                    DATE_FORMAT(`registered_at`, '%d-%m-%Y') AS `registered_at`,
                    `validated_at`,
                    DATE_FORMAT(`connected_at`, '%d-%m-%Y') AS `connected_at`
                    FROM `users`, `roles` 
                    WHERE (`archivated_at` IS  NULL)
                    AND (`users`.`id_role` = `roles`.`id`)
                    AND
                    (`lastname` LIKE :search
                    OR `firstname` LIKE :search
                    OR `roles`.`role` LIKE :search
                    OR `mail` LIKE :search
                    OR `registered_at` LIKE :search
                    OR `username` LIKE :search
                    OR `phonenumber` LIKE :search) 
                    " ;
        
        if(!is_null($limit)){
                $sql .= ' LIMIT :limit OFFSET :offset';
        }
            
            $sql .= ';';

            $sth = Database::dbConnect()->prepare($sql);


            $sth->bindValue(':search','%'.$search.'%',PDO::PARAM_STR);

            if(!is_null($limit)){
                $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
                $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
            }

            $result = $sth->execute();

            if($result === false){
                throw new PDOException();
            } else {
                return($sth->fetchAll());
            }
            
        }
        catch(PDOException $ex){
            return [];
        }


        // try {

        //     // On créé la requête
        //     $sql = 'SELECT * FROM `patients`';

        //     // On exécute la requête
        //     $sth = Database::dbConnect()->query($sql);

        //     if ($sth === false) {
        //         throw new PDOException();
        //     } else {
        //         return $sth->fetchAll();
        //     }
        // } catch (PDOException $ex) {
        //     return [];
        // }

    }

    public static function getCoach( int $game ): array
    {
        
        try {
            // Si la limite n'est pas définie, il faut tout lister
            $sql = "SELECT
            `users`.`id`,
            `mail`,
            `username`
            FROM `users`
            INNER JOIN `users_games` ON `users`.`id` = `users_games`.`id_users`
            INNER JOIN `games` ON `games`.`id` = `users_games`.`id_games`
            WHERE `games`.`id` = :game
            ;" ;

            $sth = Database::dbConnect()->prepare($sql);


            $sth->bindValue(':game', $game, PDO::PARAM_INT);


            $result = $sth->execute();

            if($result === false){
                throw new PDOException();
            } else {
                return($sth->fetchAll());
            }
            
        }
        catch(PDOException $ex){
            return ['test' => "test"];
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

            $sql = "SELECT `users`.`id`,
            `users`.`id_role`,
            `roles`.`role`,
            `lastname`,
            `firstname`,
            `mail`,
            `username`,
            `phonenumber`,
            DATE_FORMAT(`registered_at`, '%d-%m-%Y à %H:%i') AS `registered_at`,
            DATE_FORMAT(`connected_at`, '%d-%m-%Y à %H:%i') AS `connected_at`, 
            DATE_FORMAT(`validated_at`, '%d-%m-%Y à %H:%i') AS `validated_at` 
            FROM `users`, `roles` WHERE `mail` = :mail AND `users`.`id_role` = `roles`.`id` ;";

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

        $sql = "SELECT * FROM `users` WHERE `mail` = :mail AND `archivated_at` IS NULL ; ";

        $sql2 = 'UPDATE `users`
        SET `connected_at` = :connected_at
        WHERE `mail` = :mail ;';


        try {

            $pdo = Database::dbConnect();

            $sth = $pdo->prepare($sql);

            $sth2 = $pdo->prepare($sql2);

            $sth->bindValue(':mail', $mail, PDO::PARAM_STR);
            $sth2->bindValue(':mail', $mail, PDO::PARAM_STR);
            $sth2->bindValue(':connected_at', date('Y-m-d H:i:s'));
            $sth->execute();
            $sth2->execute();

            if ($sth === false) {
                
                throw new PDOException();
            }
            return $sth->fetch();

        } catch (\PDOException $ex) {
        return $ex;
        }
    }

    public static function validate($mail) {

        $sql = 'UPDATE `users`
                SET `validated_at` =:validated_at
                WHERE `mail` = :mail ;' ;

        $sth = Database::dbconnect()->prepare($sql);
        $sth->bindValue(':validated_at', date('Y-m-d H:i:s'));
        $sth->bindValue(':mail', $mail);
        return $sth->execute();

    }

    public static function update($username, $mail, $lastname, $firstname, $phoneNumber) {

        $sql = 'UPDATE `users`
                SET `username` = :username,
                    `lastname` = :lastname,
                    `firstname` = :firstname,
                    `phonenumber` = :phonenumber
                WHERE `mail` = :mail;' ;

        $sth = Database::dbConnect()->prepare($sql);

        $sth->bindValue(':username', $username);
        $sth->bindValue(':lastname', $lastname);
        $sth->bindValue(':firstname', $firstname);
        $sth->bindValue(':phonenumber', $phoneNumber);
        $sth->bindValue(':mail', $mail);

        return $sth->execute();
    }

    public static function delete($id) { // On ne supprime pas mais on archive simplement le compte

        $sql = 'UPDATE `users`
                SET `archivated_at` =:archivated_at
                WHERE `id` = :id ;' ;

        $sth = Database::dbconnect()->prepare($sql);
        $sth->bindValue(':archivated_at', date('Y-m-d H:i:s'));
        $sth->bindValue(':id', $id);
        return $sth->execute();

    }

    public static function count(string $search): int{

        try {

            $sql = 'SELECT COUNT(`users`.`id`) FROM `users`, `roles`
                    WHERE `archivated_at` IS  NULL
                    AND (`users`.`id_role` = `roles`.`id`)
                    AND (`lastname` LIKE :search
                    OR `firstname` LIKE :search
                    OR `mail` LIKE :search
                    OR `roles`.`role` LIKE :search
                    OR `username` LIKE :search
                    OR `registered_at` LIKE :search
                    OR `phonenumber` LIKE :search) ';

            $sth = Database::dbconnect()->prepare($sql);
            $sth->bindValue(':search','%'.$search.'%',PDO::PARAM_STR);
            $result = $sth->execute();
            if($result === false){
                throw new PDOException();
            } else {
                $count = $sth->fetchColumn();
                if($count === false){
                    return 0;
                } else {
                    return $count;
                }
            }
        
        } catch (\PDOException $ex) {
            return 0;
        }
        

    }

    public static function updatePwd(string $mail, string $pwd):bool {
        try {

            $sql = 'UPDATE `users`
                SET `pwd` = :pwd
                WHERE `mail` = :mail ;' ;

            $sth = Database::dbconnect()->prepare($sql);
            $sth->bindValue(':pwd', $pwd, PDO::PARAM_STR);
            $sth->bindValue(':mail', $mail, PDO::PARAM_STR);

            $result = $sth->execute();

            if($result === false){
                throw new PDOException();
            } else {
                
                return true;
            }
        
        } catch (\PDOException $ex) {
            return false;
        }

    }
}