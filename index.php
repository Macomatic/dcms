<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>DCMS</title>
    </head>
    <body>
        <form action="testform" name="testform" method="post" action="">
            <p>
                <label for="name">Enter your name:</label>
                <input name="iname" type="text" id="iname"/><br/>
            </p>
            <p><input type="submit" name="bgreet" value="Greet" id="bgreet"/><br/><br/></p>
        </form>
        <?php
        if (isset($_POST['bgreet'])) {
            $name= $_POST['iname'];
            if (!empty($name)) {
                print "Hello Welcome ".$_POST['iname'];
            }
        }
        ?>
    </body>
</html>