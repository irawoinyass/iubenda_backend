<?php

class People
{
    //DB;
    private $conn;
    private $table = 'people';

    // People Properties
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
    public $collaborators;
    public $collaborators2;


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






    //Update

    public function update()
    {
        //Starts

        //Query

        $query = 'UPDATE ' . $this->table . ' SET name = :name, email = :email, gender = :gender, date_of_birth = :date_of_birth WHERE people_id = :people_id';

        //Statment preperation
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->date_of_birth = htmlspecialchars(strip_tags($this->date_of_birth));


        //Binding

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':date_of_birth', $this->date_of_birth);
        $stmt->bindParam(':people_id', $this->people_id);



        //Executing Statement
        if ($stmt->execute()) {
            return true;
        }

        //Error Translator

        printf("Error: %s.\n", $stmt->error);


        return false;

        //End
    }



    //Password Reset

    public function password_reset()
    {
        //Query

        $query = 'SELECT  password FROM ' . $this->table . ' WHERE people_id = :people_id LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind ID
        $stmt->bindParam(':people_id', $this->people_id);

        //Execute Query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Properties

        $this->password = $row['password'];
    }


    //Update Password

    public function update_password()
    {
        //Starts

        //Query

        $query = 'UPDATE ' . $this->table . ' SET password = :password WHERE people_id = :people_id';

        //Statment preperation
        $stmt = $this->conn->prepare($query);

        $this->password = htmlspecialchars(strip_tags($this->password));

        //Binding
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':people_id', $this->people_id);



        //Executing Statement
        if ($stmt->execute()) {
            return true;
        }

        //Error Translator

        printf("Error: %s.\n", $stmt->error);


        return false;

        //End
    }



    //Fetch people by email

    public function fetch_users()
    {
        //Query
        $query = 'SELECT people_id, com_id FROM ' . $this->table . ' WHERE email IN (' . $this->collaborators . ')';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute($this->collaborators2);

        return $stmt;
    }





    //
}
