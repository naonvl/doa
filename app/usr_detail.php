 <div class="card-body">
    <div class="table-responsive py-4">
        <table class="table table-bordered verticle-middle table-responsive-sm">
            <thead class="thead-light">
                <tr>
                    <th>Menu</th> 
                    <th align="center">Pilih</th> 
                    <th align="center">Input</th> 
                    <th align="center">Edit</th> 
                    <th align="center">Delete</th>
                    <th align="center">Level</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                    $sql=$select->list_usrfrm();
                    $jmldata = $sql->rowCount();
                    
                    $no = 0;                    
                    while($row_usrfrm=$sql->fetch(PDO::FETCH_OBJ)) { 
                    $no++;
                    
                ?>

                    <tr>
                        <input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
                    
                        <input type="hidden" id="usr_frmcde_<?php echo $no; ?>" name="usr_frmcde_<?php echo $no; ?>" value="<?php echo $row_usrfrm->frmcde; ?>">

                        <td width="200"><?php echo $row_usrfrm->frmnme; ?></td>
                            <td align="center">
                                <input type="checkbox" class="form-check-input" id="usr_slc_<?php echo $no; ?>" name="usr_slc_<?php echo $no; ?>" value="1">
                            </td>
                            <td align="center">
                                <input type="checkbox" class="form-check-input" id="usr_add_<?php echo $no; ?>" name="usr_add_<?php echo $no; ?>" value="1">
                            </td>
                            <td align="center">
                                <input type="checkbox" class="form-check-input" id="usr_edt_<?php echo $no; ?>" name="usr_edt_<?php echo $no; ?>" value="1">
                            </td>
                            <td align="center">
                                <input type="checkbox" class="form-check-input" id="usr_dlt_<?php echo $no; ?>" name="usr_dlt_<?php echo $no; ?>" value="1">
                            </td>
                            <td>
                                <select id="usr_lvl_<?php echo $no; ?>" name="usr_lvl_<?php echo $no; ?>" class="destroy-selector" >
                                    <option value="0" selected>Pilih Level</option>
                                    <?php select_level(""); ?>
                                </select>
                            </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>