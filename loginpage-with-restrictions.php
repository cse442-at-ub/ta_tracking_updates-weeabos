<html>
    <body>

        <form action="loginpage.php" method="post">
            UBIT: <input type="text" name="name"><br>
            
            
            <input type="submit" name="submit1">
        </form>
        
        <?php
        if(isset($_POST["submit1"])){
            $ubit = $_GET['name1'];
            $ubitlen = strlen($ubit);
            if(ctype_digit($ubit)){
                
                if($ubitlen>8){
                    echo "UBIT is too long";
                }
                elseif($ubitlen<8){
                    echo "ubit is too short";
                }
                else{
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/courses.php');
                }
            }
            else{
                echo "not a valid ubit numeric string";
            }
        }
        ?>
    </body>
</html>




