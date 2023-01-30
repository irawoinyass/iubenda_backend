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




    //Creating Company

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

        //Ends
    }








    //Class Ends here //
}
