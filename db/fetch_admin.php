<?php
        session_start();
        // Assuming you have established a database connection
        include "connect.php";
        $query1 = $conn->query('SELECT * FROM login;');
        $query1->setFetchMode(PDO::FETCH_ASSOC);
        $query1 = $query1->fetchAll(PDO::FETCH_ASSOC);

        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            // Use the username and password values as needed in your PHP logic
            // For example, you can perform database operations or validate the credentials
            // You can also redirect to another page based on the result of your logic
            $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
            $stmt->execute([$username]);
            $query1 = $stmt->fetch(PDO::FETCH_ASSOC);
            // Example: Checking if username and password match a specific condition
            if ($username === $query1['username'] && $password === $query1['password']) {
                
                if ($query1['is_admin'] == 1) {
                    // Redirect to admin page or perform admin-related actions
                    header("Location: ../index.php");
                    exit;
                } else {
                    // Redirect to a regular user page or perform regular user actions
                    header("Location: ../std.php");
                }
            } else {
                // Redirect to an error page or display an error message
                
                //after insert or update 
                $_SESSION['status'] = "Try again.";
                header("Location: ../login.php");
            }
        } 
        ?>