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
    public $company_name;
    public $password;
    public $created_at;
    public $count;


    //Contruction with Database

    public function __construct($db)
    {
        $this->conn = $db;
    }



    //Login

    public function login()
    {


        //Query

        $query = 'SELECT people_id, name, email, gender, date_of_birth, com_id, position, account_status, password, created_at FROM ' . $this->table . ' WHERE email = :email LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        // $this->password = htmlspecialchars(strip_tags($this->password));

        //Bind ID
        $stmt->bindParam(':email', $this->email);
        // $stmt->bindParam(':password', $this->password);

        //Execute Query
        $stmt->execute();

        $rowCount = $stmt->rowCount();

        //echo json_encode($rowCount);

        if ($rowCount > 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Properties

            $this->people_id = $row['people_id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->gender = $row['gender'];
            $this->date_of_birth = $row['date_of_birth'];
            $this->com_id = $row['com_id'];
            $this->position = $row['position'];
            $this->account_status = $row['account_status'];
            $this->password = $row['password'];
            $this->created_at = $row['created_at'];
            $this->count = 1;
        } else {

            $this->count = 0;
        }



        ////
    }


    //
}
