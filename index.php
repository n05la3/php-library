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
        </style>
        <title>Required field form validation</title>
    </head>
    
    <body>
    <?php
    //verifying the submit button has been clicked for form submission
    function check_if_submitted($submit_button)
    {
        if(isset($_POST[$submit_button])||isset($_GET[$submit_button]))
            return true;
    }
    
    $required_fields=array('first_name','last_name','pass1','pass2','gender');
    global $missing_fields;
    $missing_fields=array();
    $filled_fields=array();
    
    //placing unfilled fields into $missing_fields and filled fields $filled_fields
    function is_field_set($form_key)
    {
        //echo "I am here<br>";
        if(!isset($_POST[$form_key]) or !$_POST[$form_key])
        {
            //echo "yah me here";
            global $missing_fields;
            if($form_key!=='pass1' or $form_key!=='pass2')
                $missing_fields[]=$form_key."<br>";           
        }
        else
            return($form_key & 1);        
    }
    
    function validate_form($required_fields)
    {
        global $filled_fields;
        $filled_fields=array_filter($required_fields, "is_field_set"); 
        global $missing_fields;
        if($missing_fields)
            return true;//missing fields exist
        else 
            return false;//form was correctly filled.
    }
    
    //for filling already filled fields which are filled by checking
    function set_check($missing_fields,$field_to_check)
    {    
        if(in_array($field_to_check,$missing_fields, true))
                echo 'checked="checked"';
    }
    //for filling already filled fields which are filled by selecting
    function set_select($missing_fields,$field_to_check)
    {
        if(in_array($field_to_check,$missing_fields, true))
                echo 'selected="selected"';
    }
    ?>
    <?php
    function first_display($missing_fields)
    {
       if(check_if_submitted('submit')!=='true')
       {?>
        <p>Welcome to Noslac's registration page, enter your details and click submit. Fields marked in asterisk(*) are required</p>
        <?php 
       }
       else
       {
           if(check_if_submitted('submit')===true && $missing_field)
           {?>
            <p class="refill">There were some problems with the form you submitted, refill forms highlighted and resend</p><?php
           }
           return true;
       }
    }

    function marked_fields($missing_fields)
    {
        if(check_if_submitted('submit')===true && $missing_field)
            echo 'class="error"';
    }?>
    
    <?php
    function resend_button()
    {
        if(check_if_submitted('submit')===true && $missing_field)
            echo 'value="Resend details"';
        else
            echo 'value="Send Details"';
    }
    
    function display_form($missing_fields)
    {?>
        <div>
            <form action="index.php" method="post">
                <label <?php marked_fields($missing_fieldsg)?> for="first_name">*First Name:</label>
                <input  type="text" value="" id="first_name" name="first_name">
                <label <?php marked_fields($missing_fieldsg)?>  for="last_name">*Last Name:</label>
                <input type="text" value="" id="last_name" name="last_name">
                <label <?php marked_fields($missing_fieldsg)?>  for="pass1">*Password:</label>
                <input type="password" value="" id="pass1" name="pass1" placeholder="Enter your password">
                <label <?php marked_fields($missing_fieldsg)?>  for="pass2">*Re-enter password:</label>
                <input type="password" value="" id="pass2" name="pass2" placeholder="Re-enter password">
                <label <?php marked_fields($missing_fieldsg)?>  for="widget">What's your favorite widget?</label>
                <select name="select_form" size="3" multiple="multiple">
                    <option value="mega_widget">Mega Widget</option>
                    <option value="dec_wideget">Deca Widget</option>
                    <option value="tera_widget">Tera Widget</option>
                    <option value="nano_widget">Nano Widget</option>
                </select> <br><br>
                <label for="gender">Your Gender:</label>
                <span>Male:</span><input type="radio" value="male" name="gender" id="gen">
                <span>Female:</span><input type="radio" value="female" name="gender" id="gen"><br>   
                <label for="newsletter">Do you want to receive our <br> newsletter?</label>
                <input type="checkbox" name="newsletter" id="" value="yes">
                <label for="comments">Any comments?</label>
                <textarea name="comment" id="comment" value="" cols="50" rows="5" placeholder="Just in few words, leave your comment"></textarea><br><br>
                <input type="submit" value="submit" id="submit" name="submit">
            </form>
        </div>
        </body>
    </html>