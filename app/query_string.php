<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <?php 
        		$query__	= 	$_POST['query__'];

            include("app/exec/insert_query_string.php"); 
            
        ?>

        <form class="form-horizontal" action="" method="post" name="query" id="query" enctype="multipart/form-data" >

            <input type="hidden" id="old_code" name="old_code" value="<?php echo $ref ?>" >

            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORM KIRI -->
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label"></label>
                                <div class="col-10">
                                    <textarea id="query__" name="query__" rows="5" cols="50" ><?php echo $query__ ?></textarea>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">Upload File</label>
                                <div class="col-10">
                                    <input type="file" id="app_file" name="app_file" />
                                </div>
                            </div>

                            <div class="mb-12 row">
                                <label class="col-2 col-form-label">/app</label>
                                <div class="col-10">
                                    <input type="radio" id="app" name="main" class="ace" value="2"/><span class="lbl"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">/app/class</label>
                                <div class="col-10">
                                    <input type="radio" id="class" name="main" class="ace" value="3"/><span class="lbl"></span>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">/app/include</label>
                                <div class="col-10">
                                    <input type="radio" id="include" name="main" class="ace" value="4"/><span class="lbl"></span>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">/app/exec</label>
                                <div class="col-10">
                                    <input type="radio" id="exec" name="main" class="ace" value="5"/><span class="lbl"></span>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label">/mobile</label>
                                <div class="col-10">
                                    <input type="radio" id="mobile" name="main" class="ace" value="6"/><span class="lbl"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="col-md-offset-3 col-md-9" style="text-align: right;">
                                <input type="submit" name="submit" id="submit" class='btn btn-primary' value="Execute Query" />
				                        &nbsp;
				                        <input type="submit" name="submit" id="submit" class='btn btn-warning' value="Execute Select" />
				                        &nbsp;
				                        <input type="submit" name="submit" id="submit" class='btn btn-success' value="Upload File" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>