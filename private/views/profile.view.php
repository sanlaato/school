<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>


        <div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
            <?php $this->view('includes/crumbs') ?>

            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <img src="<?=ASSETS?>/<?=($row->gender == 'female' ? 'user_female.jpg' : 'user_male.jpg')?>" class="d-block mx-auto rounded-circle border border-primary" style="width:150px">
                    <h3 class="text-center"><?=$row->firstname?> <?=$row->lastname?></h3>
                </div>
                <div class="col-sm-8 col-md-9 bg-light p-2">
                    <table class="table table-hover table-striped table-bordered">
                        <tr><th>First Name:</th><td><?=$row->firstname?></td></tr>
                        <tr><th>Last Name:</th><td><?=$row->lastname?></td></tr>
                        <tr><th>Email:</th><td><?=$row->email?></td></tr>
                        <tr><th>Gender:</th><td><?=ucfirst($row->gender)?></td></tr>
                        <tr><th>Date Created:</th><td><?=get_date($row->date)?></td></tr>
                    </table>
                </div>
            </div>
            
            <br>

            <div class="container-fluid">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Basic Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tests</a>
                    </li>
                </ul>
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
                            </div>  
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" />
                        </div>
                    </form>
                </nav>
            </div>

        </div>

<?php $this->view('includes/footer') ?>

