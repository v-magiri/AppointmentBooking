<div class="dialog" id="profileDialog">
    <div class="dialog-content">
        <div class="dialog-header">
            <span class="dialog-title">Edit Doctor Profile</span>
            <span class="close" id="closeProfileBtn">&times;</span>
        </div>
        <div class="dialog-body">
            <form action='../../includes/update_doctor.inc.php' method='post' role='form' >
                <div id="updateProfileContainer">

                </div>
                <?php
                        try{
                            $query="SELECT speciality_id,speciality_name FROM tbl_speciality";
                            $stmt=$conn->query($query);
                            // $stmt->execute();
                        
                            $specialitiesResult= $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                <div class='btns-group mt-4 mb-2'>
                    <a href='#' class='closeBtn' id='hideProfileDialogBtn'>Close</a>
                    <input type='submit' value='Update' class='btn submit-Btn btn-primary ml-auto'>
                </div>
            </form>
        </div>
    </div>
</div>