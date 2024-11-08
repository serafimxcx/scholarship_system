<div class="modal" id="modify_yearlevel_modal" style='<?php
    if(isset($_GET["program_id"]) && isset($_GET["modify_yearlevel"])){
        echo "display: flex;";

        $program_id = $_GET["program_id"];

        $result = $conn->query("select * from tb_program where id='$_GET[program_id]'");
        while($row = $result->fetch_assoc()){
            $program_name = openssl_decrypt($row["name"], $method, $key);

        }
    }else{
        echo "display: none;";

    }
?>'>
    <div id="modify_yearlevel_div">
        <table width="100%">
            <tr>
                <td><h4><span class="btn_closemodal"><i class="bi bi-x-lg"></i></span></h4></td>
                <td></td>
                
            </tr>
        </table><br>
        <div style="background-color: #ECECEC; border-radius: 10px; padding: 20px;">
        <h5 class="content_title">Year Level Management</h5><br>

        <div class="row">
            <div class="col-md-5">
                <div class="admin_container">
                    <div class="row">
                        <div class="col-lg-6">
                           <h4 class="modify_title2"><b>Add New Year Level</b></h4>

                        </div>
                        <div class="col-lg-6" style="text-align: right;">
                            <button type="button" class="btn btn-default" id="btn_cancel2" style="display: none">Cancel</button>
                            <button type="button" class="btn btn-danger" id="btn_save2" style="display: inline-block">Save</button>
                            <button type="button" class="btn btn-danger" id="btn_update2" style="display: none">Update</button>
                        </div>
                    
                    </div>
                    <input type="hidden" id="txt_yearlevel_id" class="txt_inpt">
                    <br>
                    <div class="row">
                        <div class="col-md-3" style="transform: translateY(25%);">
                            <label>Program: </label>
                        </div>
                        <div class="col-md-9">
                            <input type="hidden" id="program_id" value='<?php echo $program_id; ?>'>
                            <input type="text" class="form-control" value='<?php echo $program_name;?>' disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" style="transform: translateY(25%);">
                            <label>Year Level: </label>
                        </div>
                        <div class="col-md-9">
                            <select id="slct_yearlevel" class="form-control txt_inpt">
                                <option value="">Select...</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                                <option value="5th Year">5th Year</option>
                                <option value="6th Year">6th Year</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <label>Other Fees:</label><br><br>
                    <table>
                        <?php 
                            $result = $conn->query("select * from tb_fees");



                            while($row = $result->fetch_assoc()){
                                $fees_name = openssl_decrypt($row["name"], $method, $key);

                                echo "
                                <tr><td><input type=checkbox name=includedFees[] class='includedFees' id='fee$row[id]' value='$row[id]'><br></td>
                                <td>&nbsp;&nbsp; $fees_name<br></td>
                                </tr>
                            ";
                            }
                        
                        ?>
                    </table>
                    <input type="hidden" id="txt_fees" class="txt_inpt" disabled>
                </div>
            </div>
            <div class="col-md-7">
                
                <div class="admin_container">
                    <div class="yearlevel_output">
                            
                    </div>
                </div>
            
            </div>
        </div>
        </div>
    </div>
</div>