<div class="content-wrapper">
    <section class="content-header">
        <h1>
            NewsLetter

        </h1>
        <a class="btn btn-primary" href="#" onClick="return sendNewsletter();"><i class="fa fa-plus-circle"></i> Send Newsletter</a>
    </section>
    <section class="content">
        <div class="row" id="page-msg" style="display: none;"></div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            <div class="box-body">
                <div id="table-div">
                    <?php
                    if ($newletters) {
                        ?>
                        <table id="row-list" class="table table-bordered table-striped custom-table-head">
                            <thead>
                            <tr>
                                <td style="width:5%;background-color:086eac;font-weight:bold;">Select All<br><input type="checkbox" id="selectall" value="">
                                <th>S.No.</th>
                                <th>Email</th>
                                <th>Created Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($newletters as $newletter) {
                                ?>
                                <tr>
                                    <td class="activecheck<?php echo $newletter->Id;?>"><input type="checkbox" name="details[]" class="checkselect"  value="<?php echo $newletter->email;?>" id="<?php echo  $i;?>"/></td>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $newletter->email; ?></td>
                                    <td><?php echo $newletter->createOn; ?></td>

                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        ?>
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td class="dataTables_empty">No Records Found.</td>
                            </tr>
                            </tbody>
                        </table>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>



</div>
<?php $this->load->view('model/send-newsletter')?>