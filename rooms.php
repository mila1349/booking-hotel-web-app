<?php include('partials/navbar.php') ?>
    
    <div class="room-page">
        <h1>ROOMS COLLECTION</h1>
        <form method="POST" class="search">
            <input type="text" placeholder="SEARCH" name="search">
            <button type="submit" name="submit-search">
                <img src="images/search.png"/>
            </button>
        </form>
            <?php
                if(isset($_SESSION['occupied'])){
                    echo $_SESSION['occupied'];
                    unset($_SESSION['occupied']);
                }
                if(isset($_SESSION['booking'])){
                    echo $_SESSION['booking'];
                    unset($_SESSION['booking']);
                }   
            ?>
        <!-------------BOOKING SECTION---------->
        <div class="booking">
            <form action="" method="POST">
                <div class="book">
                    <small>ARRIVAL</small>
                    <input type="date" name="check-in" required value="<?php if(isset($_SESSION['check-in'])){echo $_SESSION['check-in'];} ?>">
                </div>
                <div class="book">
                    <small>DEPARTURE</small>
                    <input type="date" name="check-out" required value="<?php if(isset($_SESSION['check-out'])){echo $_SESSION['check-out'];} ?>">
                </div>
                <div class="book">
                    <small>GUESTS</small>
                    <input type="number" name="guest" required max="5" value="<?php if(isset($_SESSION['guest'])){echo $_SESSION['guest'];} ?>">
                </div>
                <input type="submit" name="booking-rooms" value="SAVE THE DATE" class="btn" >  
            </form>
        </div>
    </div>
    <?php
    if(isset($_POST['booking-rooms'])){
        //get data turn it to session
        $_SESSION['check-in']=$_POST['check-in'];
        $_SESSION['check-out']=$_POST['check-out'];
        $_SESSION['guest']=$_POST['guest'];
        header("location:".SITEURL.'rooms.php');

    }
    ?>
    
    <!-------------ROOM SECTION---------->
    <div class="room">
        <div class="container">

    <?php
        if(!isset($_POST['submit-search'])){
            //IF USER DIDNT SEARCH ANYTHING DISPLAY ALL
            $sql="SELECT * FROM `tbl_type`;";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            if($count>0){
                while($rows=mysqli_fetch_assoc($res)){
                    $id=$rows['id'];
                    $name=$rows['name'];
                    $price=$rows['price'];
                    $img_name=$rows['img_name'];

                    ?>
                    <div class="box" id="box">
                    <a href="<?php echo SITEURL; ?>detail.php?id=<?php echo $id;?>"><img src="<?php echo SITEURL;?>/images/types/<?php echo $img_name;?>"></a>
                        <h2><?php echo $name; ?></h2>
                        <small>Rp. <?php echo $price; ?> /Night</small>
                    </div>  
                    <?php
                }
            }else{
                echo "Type not Available, Please Add Type";
            }
        }if(isset($_POST['submit-search'])){
            //IF USER SEARCH SMTH DISPLAY WHATEVER THEY SEARCH
            $search=$_POST['search'];
            $sql2="SELECT * FROM `tbl_type` WHERE `name` LIKE '%$search%' OR `description` LIKE '%$search%';";
            $res2=mysqli_query($conn,$sql2);
            $count2=mysqli_num_rows($res2);
            if($count2>0){
                while($rows2=mysqli_fetch_assoc($res2)){
                    $id=$rows2['id'];
                    $name=$rows2['name'];
                    $price=$rows2['price'];
                    $img_name=$rows2['img_name'];
                    ?>
                        <div class="box" id="box">
                        <a href="<?php echo SITEURL; ?>detail.php?id=<?php echo $id;?>"><img src="<?php echo SITEURL;?>/images/types/<?php echo $img_name;?>"></a>
                            <h2><?php echo $name; ?></h2>
                            <small>Rp. <?php echo $price; ?> /Night</small>
                        </div> 
                    <?php
                }
            }else{
                echo "Sorry, Room Not Found";
            }
        }
    ?>
    
        </div>
    </div>

    <!-------------ROOM SECTION----------
    <div class="room">
        <div class="container">
            <div class="box">
                <a href=""><img src="images/penthouse.jpg" alt=""></a>
                <h2>PENTHOUSE SUITE</h2>
                <small>Rp. 1.000.000 /Night</small>
            </div>
            <div class="box">
                <a href=""><img src="images/junior.jpg" alt=""></a>
                <h2>JUNIOR SUITE</h2>
                <small>Rp. 500.000 /Night</small>
            </div>
            <div class="box">
                <a href=""><img src="images/family.jpg" alt=""></a>
                <h2>FAMILY SUITE</h2>
                <small>Rp. 400.000 /Night</small>
            </div>
        </div>
    </div>
    ------->
</body>
</html>


