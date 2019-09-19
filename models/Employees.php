<?php
    class Employees{
        // DBStuff
        private $conn;
        private $table = 'employees';

        // Employees Properties
        public $employeeNumber;
        public $lastName;
        public $firstName;
        public $extension;
        public $email;
        public $officeCode;
        public $reportsTo;
        public $jobTitle;

        // Constructor With DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        // GET All Employee
        public function read()
        {
            // Create Query
            $query = 'SELECT * FROM '.$this->table.' LIMIT 0,20';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt;
        }

        // GET Single Employee
        public function read_single()
        {
            // Create Query
            $query = 'SELECT * FROM '.$this->table.' WHERE employeeNumber = 1002 ';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->employeeNumber);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->lastName = $row['lastName'];
            $this->firstName = $row['firstName'];
            $this->extension = $row['extension'];
            $this->email = $row['email'];
            $this->officeCode = $row['officeCode'];
            $this->reportsTo = $row['reportsTo'];
            $this->jobTitle = $row['jobTitle'];
        }
    }