<html>
    <body>

        <form action="loginpage.php" method="post">
            UBIT: <input type="text" name="name"><br>
            
            
            <input type="submit" name="btn">
        </form>
        
        <?php
            $ubit = $_GET['name'];
            $ubitlen = strlen($ubit);
            if(ctype_digit($ubit)){
                
                if($ubitlen>8){
                    echo "UBIT is too long";
                }
                elseif($ubitlen<8){
                    echo "ubit is too short";
                }
                else{
                    //header('Location: http://' . $_SERVER['HTTP_HOST'] . '/courses.php');
                    //exit;
                }
            }
            else{
                echo "not a valid ubit numeric string";
            }
        ?>
    </body>
</html>




