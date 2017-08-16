<!--The script cannot be used directly, the superglobal $_POST and $_GET have been accessed without any security concerns,
modify this security issue before using the script in your project.-->
<html>
    <head>
        <style>
            label{
                padding: 10px;
                text-align: left;
                display: block;            
            }            
            input{                
                                
            }
            div{
               // padding-right: 500px;
                border:1px solid black;
                margin-left: 450px;
                margin-right: 500px;
            }
            span{
                margin-left:10px;
            }
            select{
                width: 17em;
            }
            .error{
                color: red;
            }
            .success{
                color: green;
            }
        </style>
        <title>Required field form validation</title>
    </head>
    
    <body>
    <?php
    $missing_fields=array();
    
    first_display();
    //building the main
    if(!isset($_POST['submit']))
    {
        display_form($missing_fields);
    }  
    else
        process_form();    
    
    function process_form()
    {
        $required_fields=array('first_name','last_name','pass1','pass2','gender');
        $missing_fields=array_filter($required_fields, "is_field_set"); 
        display_form($missing_fields);
        if($missing_fields)
            display_form ($missing_fields);
        else
        {
            $success_message="<div class='success'><h3>Thanks for registering</h3><p>Your application has been received</p></div>";
            congrats ($success_message);
        }            
    }
    //placing unfilled fields into $missing_fields and filled fields $filled_fields
    function is_field_set($form_key)
    {
        //echo "I am here<br>";
        //echo $form_key;
        if(!isset($_POST[$form_key]) or !$_POST[$form_key])
        {
            return($form_key);             
        }
                                        
    }
        
    //for filling already filled fields which are filled by checking
    function set_check($field_name,$field_value)
    {    
        if(isset($_POST[$field_name]) && $field_value===$_POST[$field_name])
                echo 'checked="checked"';
    }
    //for filling already filled fields which are filled by selecting
    function set_selected($field_name,$field_name)
    {
        if(isset($_POST[$field_name])&& $field_value===$_POST[$field_name])
                echo 'selected="selected"';
    }
    //fill field with value user had entered
    function set_value($field_name)
    {
        if(isset($_POST[$field_name]))                
            echo $_POST[$field_name];   
    }   
    function first_display()
    {
       if(!isset($_POST['submit']))
       { ?>
        <p>Welcome to Noslac's registration page, enter your details and click submit. Fields marked in asterisk(*) are required</p>
        <?php 
       }
       else
       {
           if(isset($_POST['submit']))
           { ?>
            <p class="error">There were some problems with the form you submitted, refill forms highlighted and resend</p><?php
           }
           return true;
       }
    }

    function not_filled($field_name,$missing_fields)
    {
        if(in_array($field_name, $missing_fields))
            echo 'class="error"';
    }
        
    function button_value($missing_field)
    {
        if(isset($_POST['submit']))
            echo 'Resend details';
        else
            echo 'Send Details';
    }
    
    function congrats($success_message)
    {
        echo "$success_message";
    }
    
    function display_form($missing_fields)
    {?>
        <div>
            <form action="index.php" method="post">
                <label for="first_name" <?php not_filled('first_name', $missing_fields);?>>*First Name:</label>
                <input type="text" value="<?php set_value('first_name');?>" id="first_name" name="first_name">
                <label for="last_name" <?php not_filled('first_name', $missing_fields);?>>*Last Name:</label>
                <input type="text" value="<?php set_value('last_name') ?>" id="last_name" name="last_name">
                <label for="pass1" <?php not_filled('pass1', $missing_fields);?>>*Password:</label>
                <input type="password" value="" id="pass1" name="pass1" placeholder="Enter your password">
                <label for="pass2" <?php not_filled('pass2', $missing_fields);?>>*Re-enter password:</label>
                <input type="password" value="" id="pass2" name="pass2" placeholder="Re-enter password">
                <label for="widget">What's your favorite widget?</label>
                <select name="selected_widget[]" size="1">
                    <option <?php set_selected('selected_widget', 'mega_widget'); ?> value="mega_widget">Mega Widget</option>
                    <option <?php set_selected("selected_widget", 'dec_widget'); ?> value="dec_wideget">Deca Widget</option>
                    <option <?php set_selected('selected_widget', 'tera_widget'); ?> value="tera_widget">Tera Widget</option>
                    <option <?php set_selected('selected_widget', 'nano_widget'); ?> value="nano_widget">Nano Widget</option>
                </select> <br><br>
                <label for="gender">Your Gender:</label>
                <span>Male:</span><input type="radio" value="male" name="gender" <?php set_check("gender", "male"); ?> id="gender">
                <span>Female:</span><input type="radio" value="female" name="gender" <?php set_check("gender", "female") ?> id="gender"><br>   
                <label for="newsletter">Do you want to receive our <br> newsletter?</label>
                <input type="checkbox" name="newsletter" id="" value="yes" <?php set_check("newsletter", "yes") ?>>
                <label for="comments">Any comments?</label>
                <textarea name="comment" id="comment" value="<?php set_value('comment'); ?>" cols="50" rows="4" placeholder="In just few words, leave a comment">
                </textarea><br><br>
                <input type="submit" value=" <?php button_value($missing_fields); ?>" id="submit" name="submit">
            </form>
        </div>
    <?php 
    } ?>
        </body>
    </html>
    