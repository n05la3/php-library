<html>
    <head>
        <style>
            label{
                padding: 10px;
                text-align: left;
                display: block;            
            }            
            input{                
               // width: default;                
            }
            div{
               // padding-right: 500px;
                border:1px solid black;
                margin-left: 450px;
                margin-right: 500px;
            }
            
        </style>
        <title>handling multi form values</title>
    </head>
    <div>
        <form action="index.php" method="post">
            <label for="f_user_name">First Name:</label>
            <input type="text" value="" id="f_user_name">
            <label for="l_user_name">Last Name:</label>
            <input type="text" value="" id="l_user_name">
            <label for="pass1">Password:</label>
            <input type="password" value="" id="pass1">
            <label for="pass2">Re-enter password:</label>
            <input type="password" value="" id="pass2">
            <label for="gender">Your Gender:</label>
            Male:<input type="radio" value="male">
            Female:<input type="radio" value="female"><br><br>            
            <input type="submit" value="submit_form" id="submit">
        </form>
    </div>
</html>