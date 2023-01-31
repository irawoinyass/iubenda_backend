<?php

class Collaborator
{
    //DB;
    private $conn;
    private $table = 'collaborators';


    // Company Properties
    public $collaborator_id;
    public $t_id;
    public $p_id;
    public $c_id;
    public $created_at;



    //Contruction with Database

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Create
    public function create()
    {
        //Starts

        //Query

        $query = 'INSERT INTO ' . $this->table . ' SET t_id = :t_id, p_id = :p_id, c_id = :c_id, created_at = :created_at';

        //Statment preperation
        $stmt = $this->conn->prepare($query);

        //Binding
        $stmt->bindParam(':t_id', $this->t_id);
        $stmt->bindParam(':p_id', $this->p_id);
        $stmt->bindParam(':c_id', $this->c_id);
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



    //Delete

    public function delete()
    {

        //Query
        $query = 'DELETE FROM ' . $this->table . ' WHERE t_id = :t_id';

        //Prepare

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':t_id', $this->t_id);

        if ($stmt->execute()) {
            return true;
        }

        //Communicate Error;

        printf("Error: %s.\n", $stmt->error);


        return false;
    }







    ///
}
