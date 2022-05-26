<?php 

require_once(dirname(__FILE__).'/../utils/config.php');
require_once(dirname(__FILE__).'/../utils/db.php');




class Review {


    private int $id;
    private string $publicated_at;
    private string $content;
    private string $title;
    private int $note;
    private int $id_users;
    private int $id_coaching;

    private object $pdo;


    public function __construct( string $content, string $title, int $note, int $id_users, int $id_coaching ) {
    
        $this->setContent($content);
        $this->setTitle($title);
        $this->setNote($note);
        $this->setId_users($id_users);
        $this->setId_coaching($id_coaching);

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

    public function setPublicated_at(string $publicated_at): void
    {
        $this->publicated_at = $publicated_at;
    }

    public function getPublicated_at(): string
    {
        return $this->publicated_at;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setNote(int $note): void
    {
        $this->note = $note;
    }

    public function getNote(): int
    {
        return $this->note;
    }

    public function setId_users(int $id_users): void
    {
        $this->id_users = $id_users;
    }

    public function getId_users(): int
    {
        return $this->id_users;
    }

    public function setId_coaching(int $id_coaching): void
    {
        $this->id_coaching = $id_coaching;
    }

    public function getId_coaching(): int
    {
        return $this->id_coaching;
    }


    public function create(): bool
    {

        try {
            
            $sql = 'INSERT INTO `reviews` (`content`, `title`, `note`, `id_users`, `id_coaching`) 
                VALUES (:content, :title, :note, :id_users, :id_coaching);';
    
            
    
            $sth = $this->pdo->prepare($sql);
            
            $sth->bindValue(':content', $this->getContent(), PDO::PARAM_STR);
            $sth->bindValue(':title', $this->getTitle(), PDO::PARAM_STR);
            $sth->bindValue(':note', $this->getNote(), PDO::PARAM_INT);
            $sth->bindValue(':id_users', $this->getId_users, PDO::PARAM_INT);
            $sth->bindValue(':id_coaching', $this->getId_coaching, PDO::PARAM_INT);
            
            
            return $sth->execute();
        } catch (PDOException $e) {
            
            return false;
        }
    }
        


}