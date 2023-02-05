<?php

class Tasks
{
    //DB;
    private $conn;
    private $table = 'tasks';


    // Task Properties
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


    public function list()
    {

        //Query
        $query = 'SELECT task_id, headline, description, due_date, collaborators, col_draft, solved, created_at FROM ' . $this->table . ' ORDER BY task_id DESC';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;



        //
    }
}
