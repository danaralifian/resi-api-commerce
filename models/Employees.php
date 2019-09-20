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
            $query = 'SELECT * FROM '.$this->table.' WHERE employeeNumber = ? ';

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

        // CREATE Employee
        public function create()
        {
            // Create Query
            $query = 'INSERT INTO '.$this->table.'
                SET
                    employeeNumber = :employeeNumber,
                    lastName = :lastName,
                    firstName = :firstName,
                    extension = :extension,
                    email = :email,
                    officeCode = :officeCode,
                    reportsTo = :reportsTo,
                    jobTitle = :jobTitle';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->employeeNumber = htmlspecialchars(strip_tags($this->employeeNumber));
            $this->lastNmae = htmlspecialchars(strip_tags($this->lastName));
            $this->firstName = htmlspecialchars(strip_tags($this->firstName));
            $this->extension = htmlspecialchars(strip_tags($this->extension));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->officeCode = htmlspecialchars(strip_tags($this->officeCode));
            $this->reportsTo = htmlspecialchars(strip_tags($this->reportsTo));
            $this->jobTitle = htmlspecialchars(strip_tags($this->jobTitle));

            //Bind Data
            $stmt->bindParam(':employeeNumber', $this->employeeNumber);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':firstName', $this->firstName);        
            $stmt->bindParam(':extension', $this->extension);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':officeCode', $this->officeCode);
            $stmt->bindParam(':reportsTo', $this->reportsTo);
            $stmt->bindParam(':jobTitle', $this->jobTitle);

            if ($stmt->execute()) {
                return true;
            }

            //Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;          
        }

        // UPDATE Employee
        public function update()
        {
            // Create Query
            $query = 'UPDATE '.$this->table.'
                SET
                    employeeNumber = :employeeNumber,
                    lastName = :lastName,
                    firstName = :firstName,
                    extension = :extension,
                    email = :email,
                    officeCode = :officeCode,
                    reportsTo = :reportsTo,
                    jobTitle = :jobTitle
                WHERE
                    employeeNumber = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->employeeNumber = htmlspecialchars(strip_tags($this->employeeNumber));
            $this->lastNmae = htmlspecialchars(strip_tags($this->lastName));
            $this->firstName = htmlspecialchars(strip_tags($this->firstName));
            $this->extension = htmlspecialchars(strip_tags($this->extension));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->officeCode = htmlspecialchars(strip_tags($this->officeCode));
            $this->reportsTo = htmlspecialchars(strip_tags($this->reportsTo));
            $this->jobTitle = htmlspecialchars(strip_tags($this->jobTitle));
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind Data
            $stmt->bindParam(':employeeNumber', $this->employeeNumber);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':firstName', $this->firstName);        
            $stmt->bindParam(':extension', $this->extension);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':officeCode', $this->officeCode);
            $stmt->bindParam(':reportsTo', $this->reportsTo);
            $stmt->bindParam(':jobTitle', $this->jobTitle);
            $stmt->bindParam(':id', $this->id);

            if ($stmt->execute()) {
                return true;
            }

            //Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

    }