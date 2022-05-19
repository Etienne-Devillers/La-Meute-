<?php 

require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../utils/db.php');
require_once(dirname(__FILE__).'/../models/User.php');

class Coaching{


    private int $id;
    private string $date;
    private int $id_games;
    private int $id_user;
    private int $id_coach;
    private int $id_time_slots;

    private object $pdo;


    public function __construct( string $date, int $id_coach, int $id_time_slots) {
    
        $this->setDate($date);
        $this->setId_coach($id_coach);
        $this->setId_time_slots($id_time_slots);

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
    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setId_games(int $id_games): void
    {
        $this->id_games = $id_games;
    }

    public function getId_games(): int
    {
        return $this->id_games;
    }
    public function setId_user(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function getId_user(): int
    {
        return $this->id_user;
    }

    public function setId_time_slots(int $id_time_slots): void
    {
        $this->id_time_slots = $id_time_slots;
    }

    public function getId_time_slots(): int
    {
        return $this->id_time_slots;
    }

    public function setId_coach(int $id_coach): void
    {
        $this->id_coach = $id_coach;
    }

    public function getId_coach(): int
    {
        return $this->id_coach;
    }
    

//Création du CRUD 

public function create(): bool
{
    $coachInfo = User::getGame($this->getId_coach());

    try {
        //  requête avec des marqueurs nominatifs
        $sql = 'INSERT INTO `coaching` (`date`, `id_games`, `id_coach`, `id_time_slots`) 
            VALUES (:date, :id_games, :id_coach, :id_time_slots);';

        // On prépare la requête

        $sth = $this->pdo->prepare($sql);
        //Affectation des valeurs aux marqueurs nominatifs
        $sth->bindValue(':date', $this->getDate(), PDO::PARAM_STR);
        $sth->bindValue(':id_games', $coachInfo->id, PDO::PARAM_INT);
        $sth->bindValue(':id_coach', $this->getId_coach(), PDO::PARAM_INT);
        $sth->bindValue(':id_time_slots', $this->getId_time_slots(), PDO::PARAM_INT);
        
        // On retourne directement true si la requête s'est bien exécutée ou false dans le cas contraire
        return $sth->execute();
    } catch (PDOException $e) {
        // On retourne false si une exception est levée
        return false;
    }
}

public static function addUser($id_user, $id_coaching):bool {

        
        try {
            //  requête avec des marqueurs nominatifs
            $sql = 'INSERT INTO `users_coaching` (`id_coaching`, `id_users`)
            VALUES (:id_coaching, :id_user) ;';
    
            // On prépare la requête
    
            $sth = Database::dbConnect() -> prepare($sql);

            //Affectation des valeurs aux marqueurs nominatifs
            $sth->bindValue(':id_user', $id_user, PDO::PARAM_INT);
            $sth->bindValue(':id_coaching', $id_coaching, PDO::PARAM_STR);
            
            // On retourne directement true si la requête s'est bien exécutée ou false dans le cas contraire
            return $sth->execute();
        } catch (PDOException $e) {
            // On retourne false si une exception est levée
            return false;
        }
}

public static function isCoachingExists(string $date, int $id_coach, $id_time_slots  ): bool
    {
        try {
            $sql = 'SELECT * FROM `coaching` 
            WHERE `date` = :date 
            AND `id_coach` = :id_coach
            AND `id_time_slots` = :id_time_slots ;';

            $sth = Database::dbConnect()->prepare($sql);
            $sth->bindValue(':date', $date, PDO::PARAM_STR);
            $sth->bindValue(':id_coach', $id_coach, PDO::PARAM_STR);
            $sth->bindValue(':id_time_slots', $id_time_slots, PDO::PARAM_STR);
            $sth->execute();

            return empty($sth->fetchAll()) ? false : true;

        } catch (\PDOException $e) {
            return false;
        }
    }

    public static function coachingList(array $date, int $id_coach)
    {
        try {
            $sql = 'SELECT * FROM `coaching` 
            WHERE `id_coach` = :id_coach 
            AND (`date` = :date1
            OR `date` = :date2
            OR `date` = :date3
            OR `date` = :date4
            OR `date` = :date5
            OR `date` = :date6
            OR `date` = :date7)
            ;';

            $sth = Database::dbConnect()->prepare($sql);
            
            $sth->bindValue(':id_coach', $id_coach, PDO::PARAM_INT);
            $sth->bindValue(':date1', $date[0], PDO::PARAM_STR);
            $sth->bindValue(':date2', $date[1], PDO::PARAM_STR);
            $sth->bindValue(':date3', $date[2], PDO::PARAM_STR);
            $sth->bindValue(':date4', $date[3], PDO::PARAM_STR);
            $sth->bindValue(':date5', $date[4], PDO::PARAM_STR);
            $sth->bindValue(':date6', $date[5], PDO::PARAM_STR);
            $sth->bindValue(':date7', $date[6], PDO::PARAM_STR);
            
            $sth->execute();

            return $sth->fetchAll();

        } catch (\PDOException $e) {
            return false;
        }
    }


}