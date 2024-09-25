<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

       <div class="container-fluid p-4 shadow mx-auto" style="max-width:1000px;">
            <?php $this->view('includes/crumbs') ?>

            <div class="row">
                <div class="bg-light p-2">
                    <table class="table table-hover table-striped table-bordered">
                        <tr><th>Class Name:</th><td><?=$row->class?></td></tr>
                        <tr><th>Created by:</th><td><?=$row->user->firstname?> <?=$row->user->lastname?></td></tr>
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

