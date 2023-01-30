<?php

class People
{
    //DB;
    private $conn;
    private $table = 'people';

    // Company Properties
    public $people_id;
    public $name;
    public $email;
    public $gender;
    public $date_of_birth;
    public $com_id;
    public $position;
    public $account_status;
    public $password;
    public $created_at;


    //Contruction with Database

    public function __construct($db)
    {
        $this->conn = $db;
    }







    //Create Company

    public function create()
    {
        //Starts

        //Query

        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, email = :email, gender = :gender, date_of_birth = :date_of_birth, com_id = :com_id, position = :position, account_status = :account_status, password = :password, created_at = :created_at';

        //Statment preperation
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));
        $this->com_id = htmlspecialchars(strip_tags($this->com_id));
        $this->position = htmlspecialchars(strip_tags($this->position));
        $this->account_status = htmlspecialchars(strip_tags($this->account_status));
        $this->password = htmlspecialchars(strip_tags($this->password));

        //Binding

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':date_of_birth', $this->date_of_birth);
        $stmt->bindParam(':com_id', $this->com_id);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':account_status', $this->account_status);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':created_at', $this->created_at);



        //Executing Statement
        if ($stmt->execute()) {
            return true;
        }

        //Error Translator

        printf("Error: %s.\n", $stmt->error);


        return false;

        //End
    }
}
