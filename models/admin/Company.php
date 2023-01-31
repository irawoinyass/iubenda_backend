<?php

class Company
{
    //DB;
    private $conn;
    private $table = 'company';

    // Company Properties
    public $company_id;
    public $company_name;
    public $company_email;
    public $company_phone;
    public $company_address;
    public $company_website;
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

        $query = 'INSERT INTO ' . $this->table . ' SET company_name = :company_name, company_email = :company_email, company_phone = :company_phone, company_address = :company_address, company_website = :company_website	, created_at = :created_at';

        //Statment preperation
        $stmt = $this->conn->prepare($query);

        $this->company_name = htmlspecialchars(strip_tags($this->company_name));
        $this->company_email = htmlspecialchars(strip_tags($this->company_email));
        $this->company_address = htmlspecialchars(strip_tags($this->company_address));
        $this->company_phone = htmlspecialchars(strip_tags($this->company_phone));
        $this->company_website = htmlspecialchars(strip_tags($this->company_website));
        //Binding

        $stmt->bindParam(':company_name', $this->company_name);
        $stmt->bindParam(':company_email', $this->company_email);
        $stmt->bindParam(':company_address', $this->company_address);
        $stmt->bindParam(':company_phone', $this->company_phone);
        $stmt->bindParam(':company_website', $this->company_website);
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








    //Update Company

    public function update()
    {
        //Starts

        //Query

        $query = 'UPDATE ' . $this->table . ' SET company_name = :company_name, company_email = :company_email, company_phone = :company_phone, company_address = :company_address, company_website = :company_website WHERE company_id = :company_id';

        //Statment preperation
        $stmt = $this->conn->prepare($query);

        $this->company_name = htmlspecialchars(strip_tags($this->company_name));
        $this->company_email = htmlspecialchars(strip_tags($this->company_email));
        $this->company_address = htmlspecialchars(strip_tags($this->company_address));
        $this->company_phone = htmlspecialchars(strip_tags($this->company_phone));
        $this->company_website = htmlspecialchars(strip_tags($this->company_website));

        //Binding

        $stmt->bindParam(':company_name', $this->company_name);
        $stmt->bindParam(':company_email', $this->company_email);
        $stmt->bindParam(':company_address', $this->company_address);
        $stmt->bindParam(':company_phone', $this->company_phone);
        $stmt->bindParam(':company_website', $this->company_website);
        $stmt->bindParam(':company_id', $this->company_id);



        //Executing Statement
        if ($stmt->execute()) {
            return true;
        }

        //Error Translator

        printf("Error: %s.\n", $stmt->error);


        return false;

        //Ends
    }




    public function delete()
    {

        //Query
        $query = 'DELETE FROM ' . $this->table . ' WHERE company_id = :company_id';

        //Prepare

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':company_id', $this->company_id);

        if ($stmt->execute()) {
            return true;
        }

        //Communicate Error;

        printf("Error: %s.\n", $stmt->error);


        return false;
    }




    ///List

    public function list()
    {

        //Query
        $query = 'SELECT company_id, company_name, company_email, company_phone, company_address, company_website, company.created_at, COUNT(DISTINCT people_id) as people FROM ' . $this->table . ' LEFT JOIN people ON company_id = com_id GROUP BY company_id ORDER BY company_id DESC';

        //Prepare statement

        $stmt = $this->conn->prepare($query);

        //Execute Query

        $stmt->execute();

        return $stmt;



        //
    }







    //Class Ends here //
}
