<div class="dialog" id="doctorModal">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Create Doctor</span>
            <span class="close" id="closeBtn">&times;</span>
        </div>
        <div class="dialog-body">
            <form action="../../includes/doctors.inc.php" method="post" role="form">
                <div class="form-group my-1">
                    <label for="fullName" class="my-1">Name:</label>
                    <input type="text" class="form-control" name="fullName" placeholder="John Doe" >
                </div>
                <div class="form-group my-1">
                    <label for="emailAddress" class="my-1">Email Address:</label>
                    <input type="text" class="form-control" name="emailAddress" placeholder="johnDoe@gmail.com" required>
                </div>
                <div class="form-group my-1">
                    <label for="phoneNumber" class="my-1">Phone Number:</label>
                    <input type="text" class="form-control" name="phoneNumber" placeholder="0722000000" required>
                </div>
                <?php
                    try{
                        $query="SELECT speciality_id,speciality_name FROM tbl_speciality";
                        $stmt=$conn->query($query);
                        // $stmt->execute();
                    
                        $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }catch(PDOException $e){
                        echo $e->getMessage();
                    }
                    if($result){
                ?>
                <div class="form-group my-1 categorySelect">
                    <label for="speciality" class="my-1">Doctor Speciality</label>
                    <select name="speciality" class="form-select" id="speciality">
                        

                            <option selected>Choose Doctor Speciality</option> 
                            <?php
                                foreach($result as $row){
                                    echo '<option value="'.$row['speciality_id'].'">'.$row['speciality_name'].'</option>';
                                }
                            ?>

                    </select>
                </div>
                <?php
                    }else{
                        echo '<option>No Speciality Found</option>';
                    }
                ?>
                <div class="btns-group mt-4 mb-2">
                    <a href="#" class="closeBtn" id="closeDialogBtn">Close</a>
                    <input type="submit" value="Create" class="btn submit-Btn btn-primary ml-auto">
              </div>
            </form>
        </div>
    </div>
</div>