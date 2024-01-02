<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
<form method="post">
    Enter Name:<br>
    <input type="text" name="postsname" placeholder="Name" class="form-control my-3 bg-dark text-white text-center"> <br>
    Enter Author:<br>
    <input type="text" name="postsauthor" placeholder="Author" class="form-control my-3 bg-dark text-white text-center"> <br>
    Text eingeben:<br>
    <textarea name="postcontent" class="form-control my-3 bg-dark text-white" cols="30" rows="10"></textarea>
    <button type="submit" class="btn btn-dark" name="new_post">Add Post</button>
</form>


    <?php
     $servername= "localhost";
     $user = "root";
     $pw = "";
     $db = "niklas_stadie";
 
     try{$conn = new PDO("mysql:host=$servername;dbname=$db",$user,$pw);
//Error reporting, throw exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       echo "Connection Successful";
//Fehler abfangen
            } catch(PDOException $e) {
                echo "Connection Failed" . "<br>" . $e->getMessage();
                    } 

if(isset($_POST['new_post'])){
    $postname = $_POST['postsname'];
    $postcontent = $_POST['postcontent'];
    $postauthor = $_POST['postsauthor'];
    
//Überprüfung Textboxen
if(empty($postname) || empty($postcontent) || empty($postauthor)) {
    echo  "<br>You Have To Fill in All Boxes";
}else{

//neue Datensätze, insert
    $insert = $conn->prepare("INSERT INTO posts(name, text, author) 
    VALUES (:name, :text, :author)");

//Bindet einen Parameter an den angegebenen Variablennamen
    $insert->bindParam(':name',$postname);
    $insert->bindParam(':text',$postcontent);
    $insert->bindParam(':author',$postauthor);

//Führt externes Programm aus
    $insert->execute();
    echo "<br>Data Successfully Arrived";

    	}
    }

    ?>
</body>
</html>