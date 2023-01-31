<?php

class Task
{
    //DB;
    private $conn;
    private $table = 'tasks';


    // Company Properties
    public $task_id;
    public $headline;
    public $description;
    public $due_date;
    public $collaborators;
    public $col_draft;
    public $solved;
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

        $query = 'INSERT INTO ' . $this->table . ' SET headline = :headline, description = :description	, due_date = :due_date, collaborators = :collaborators, solved = :solved, col_draft = :col_draft, created_at = :created_at';

        //Statment preperation
        $stmt = $this->conn->prepare($query);

        $this->headline = htmlspecialchars(strip_tags($this->headline));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->due_date = htmlspecialchars(strip_tags($this->due_date));
        $this->solved = htmlspecialchars(strip_tags($this->solved));
        $this->collaborators = htmlspecialchars(strip_tags($this->collaborators));
        $this->col_draft = htmlspecialchars(strip_tags($this->col_draft));
        //Binding

        $stmt->bindParam(':headline', $this->headline);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':collaborators', $this->collaborators);
        $stmt->bindParam(':solved', $this->solved);
        $stmt->bindParam(':col_draft', $this->col_draft);
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


    //Counting all - 

    public function count_all()
    {
        //Query
        $query = 'SELECT * FROM ' . $this->table;

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;
    }
}
