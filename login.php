<?php


// Function to handle redirection after registration
function redirectToLandingPage() {
    header("Location: index.php");
    exit(); // Always exit after using the header function to stop further script execution
}


 // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, gender, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstName, $lastName, $gender, $email, $password);

       // Execute the query and check if successful
       if ($stmt->execute()) {
       
        // Registration successful, redirect to the landing page
        redirectToLandingPage();
        
    } else {
        echo "<script>alert('Registration failed. Please try again.');</script>";
    }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-center mb-6">Registration Form</h1>
        <form action="" method="post" class="space-y-4">
            <div>
                <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                <input
                    type="text"
                    id="firstName"
                    name="firstName"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required
                />
            </div>

            <div>
                <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input
                    type="text"
                    id="lastName"
                    name="lastName"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <div class="mt-2 flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="m" class="text-blue-600 border-gray-300 focus:ring-blue-500" required />
                        <span class="ml-2">Male</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="f" class="text-blue-600 border-gray-300 focus:ring-blue-500" required />
                        <span class="ml-2">Female</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="o" class="text-blue-600 border-gray-300 focus:ring-blue-500" required />
                        <span class="ml-2">Others</span>
                    </label>
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required
                />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required
                />
            </div>

            <div>
                <input type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 cursor-pointer" value="Register" />
            </div>
        </form>
    </div>
</body>
</html>
