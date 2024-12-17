<!DOCTYPE html>
<html lang="en">

<head>

    <title>Register User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap");


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto Condensed", sans-serif;


        }

        .navbar-fixed-top {
            background-color: #262626;
            color: white;
        }

        .navbar-right li {
            list-style: none;
        }

        .navbar-right {
            margin-right: 15px;
            color: white;
            margin-top: 15px;
            
        }

        .navbar-fixed-top a {
            color: white;
        }

        label {
            display: block;
            margin-bottom: 2px;
            text-align: left;
            margin-left: 10px;
          
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="number"],
        select {
            width: 95%;
            padding: 8px;
            margin-bottom: 7px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 12px;
            color: black;
            
        }

        input[type="submit"] {
            background-color: white;
            color: black;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 45%;
            
        }

        input[type="submit"]:hover {
            background-color: #4CAF50;
        }

        .gender {
            margin-bottom: 15px;
        }

        .gender label {
            margin-right: 15px;
        }

        .error {
            color: red;
            font-size: 0.8em;
        }

        #register {
            background-color: #262626;
            color: antiquewhite;
            width: 35%;
            margin-top: 5%;
            margin-bottom: 5%;
            padding: 20px;
            border-radius: 20px;
            
        }

        #register h3 {
            margin-top: 10px;
        }

    </style>


</head>

<body id="loginpage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <nav class="navbar navbar-default navbar-fixed-top">

       
        <a href="index.php"><img src="logo 2.png" alt="logo" height="45px" width="auto"></a>
        <a class="navbar-brand" href="index.php" style="color:white;">Kool 7 Car Aircon Services</a>

        <ul class="navbar-right">
            <li><a href="index.php"><i class="fa fa-home"></i>   HOME</a></li>
        </ul>

    </nav>

    <!--Register Page -->
    <div id="register" class="container-fluid text-left bg-light">
<center>
    
        <form action="registeruser.php" method="post" name="form1">
            <h3>Registration Form</h3>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <div class="gender">
                    <label for="gender">Gender:</label>
                    <label><input type="radio" name="gender" value="male" required>Male</label>
                    <label><input type="radio" name="gender" value="female" required>Female</label>
                </div>
            </div>


            <input type="submit" name="register" value="Register">
        </form>
        </center>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  

</body>

</html>