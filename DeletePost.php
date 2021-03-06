<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php Confirm_Login(); ?>

<?php
$SearchQueryParameter = $_GET["id"];

//            taking existing contents from post
global $ConnectingDB;
$sql = "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
$stmt = $ConnectingDB ->query($sql);
while ($DataRows=$stmt->fetch()){
    $TitleToBeDeleted = $DataRows['title'];
    $CategoryToBeDeleted = $DataRows['category'];
    $ImageToBeDeleted = $DataRows['image'];
    $PostToBeDeleted = $DataRows['post'];
    //
    $ImageToBeDeleted2 = $DataRows['image2'];
    $PostToBeDeleted2 = $DataRows['post2'];
    //
    $ImageToBeDeleted3 = $DataRows['image3'];
    $PostToBeDeleted3 = $DataRows['post3'];
}

if(isset($_POST["Submit"])){
    //Query to delete post in database when everything is good
    global $ConnectingDB;
    $sql ="DELETE FROM posts WHERE id='$SearchQueryParameter'";
    $Execute =$ConnectingDB->query($sql);

    if($Execute){
        $Target_Path_To_DELETE_Image = "Uploads/$ImageToBeDeleted";
        unlink($Target_Path_To_DELETE_Image);
        //
        $Target_Path_To_DELETE_Image2 = "Uploads/$ImageToBeDeleted2";
        unlink($Target_Path_To_DELETE_Image2);
        //
        $Target_Path_To_DELETE_Image3 = "Uploads/$ImageToBeDeleted3";
        unlink($Target_Path_To_DELETE_Image3);
        //
        $_SESSION["SuccessMessage"]="post  DELETED Successfully";
        Redirect_to("Posts.php");
    }else{
        $_SESSION["ErrorMessage"]= "something went wrong. Try Again !";
        Redirect_to("Posts.php");
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/7f6ee3d237.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Delete Post</title>
</head>
<body>
<?php  ?>
<!--NAVBAR STARTS-->

<div class="navbar navbar-expand-lg navbar-dark bg-custom">
    <div class="container">
        <a href="#" class="navbar-brand " style= "color:aliceblue; font-family: mindsagacustom;">MindSaga</a>
        <button class="navbar-toggler ml-auto custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Rcollapse" aria-controls="Rcollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Rcollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" style= "color:white ; font-weight: bolder;">My Profile</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" style= "color:white ; font-weight: bolder;">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="Posts.php" class="nav-link" style= "color:white ; font-weight: bolder;">Posts</a>
                </li>
                <li class="nav-item">
                    <a href="Categories.php" class="nav-link" style= "color:white ; font-weight: bolder;">Categories</a>
                </li>

                <li class="nav-item">
                    <a href="Admins.php" class="nav-link" style= "color:white ; font-weight: bolder;">Manage-Admins</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" style= "color:white ; font-weight: bolder;">Comments</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link" style= "color:white ; font-weight: bolder;">GO Live</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="Logout.php" class="nav-link text-warning"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

    </div>
</div>

<!--NAVBAR ENDS-->

<!--HEADER STARTS-->
<header class="bg-dark text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fas fa-edit"></i> Delete Post</h1>
            </div>
        </div>
    </div>
</header>
<!--HEADER ENDS-->

<!--MAIN AREA-->
<section class="container py-2 mb-4">
    <div class="row">
        <div class="offset-lg-1 col-lg-10" style="min-height: 400px;">
            <?php
            echo ErrorMessage();
            echo SuccessMessage();
            ?>
            <form class="" action="DeletePost.php?id=<?php echo $SearchQueryParameter;?>" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                    <div class="card-body bg-dark">
                        <div class="form-group">
                            <label for="title"><span class="fieldinfo">Post Title :</span></label>
                            <input disabled class="form-control" type="text" name="PostTitle" placeholder="Type title here" value="<?php echo $TitleToBeDeleted; ?>">
                        </div>
                        <div class="form-group">
                            <span class="fieldinfo">Existing Category:</span>
                            <?php echo $CategoryToBeDeleted;?>
                            <br>
                        </div>
                        <!--primary content-->
                        <div class="form-group">
                            <span class="fieldinfo">Existing Image 1: </span>
                            <img class="mb-2"src="uploads/<?php echo $ImageToBeDeleted; ?>" width="170px"; height="70px";>
                        </div>
                        <div class="form-group">
                            <label for="Post"><span class="fieldinfo">Post :</span></label>
                            <textarea disabled class="form-control" name="PostDescription" cols="80" rows="8" id="Post">
                                <?php echo $PostToBeDeleted; ?>
                            </textarea>
                        </div>
                        <!--secondary content-->
                        <div class="form-group">
                            <span class="fieldinfo">Existing Image 2: </span>
                            <img class="mb-2"src="uploads/<?php echo $ImageToBeDeleted2; ?>" width="170px"; height="70px";>
                        </div>
                        <div class="form-group">
                            <label for="Post"><span class="fieldinfo">Post :</span></label>
                            <textarea disabled class="form-control" name="PostDescription2" cols="80" rows="8" id="Post">
                                <?php echo $PostToBeDeleted2; ?>
                            </textarea>
                        </div>
                        <!--tertiary content-->
                        <div class="form-group">
                            <span class="fieldinfo">Existing Image 3: </span>
                            <img class="mb-2"src="uploads/<?php echo $ImageToBeDeleted3; ?>" width="170px"; height="70px";>
                        </div>
                        <div class="form-group">
                            <label for="Post"><span class="fieldinfo">Post :</span></label>
                            <textarea disabled class="form-control" name="PostDescription3" cols="80" rows="8" id="Post">
                                <?php echo $PostToBeDeleted3; ?>
                            </textarea>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <a href="#" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to dashboard</a>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <button type="Submit" name="Submit" class="btn btn-danger btn-block">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!--FOOTER STARTS-->
<?php require_once ("Backendfooter.php");?>



