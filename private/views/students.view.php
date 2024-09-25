<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
        <?php $this->view('includes/crumbs') ?>
        <nav class="navbar navbar-light bg-light">
            <form class="form-inline">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
                    </div>  
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" />
                </div>
            </form>
            <a href="<?=ROOT?>/students/add">
                <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
            </a>
        </nav>
        
        <div class="card-group justify-content-center">
            <?php if($rows): ?>
                <?php foreach ($rows as $row): ?>
                <div class="card m-2" style="max-width: 14rem;min-width: 13rem;">
                    <?php 
                        $profilepicpath = ASSETS . ($row->gender == 'female' ? '/user_female.jpg' : '/user_male.jpg');
                    ?>
                    <img src="<?=$profilepicpath?>" class="card-img-top d-block mx-auto" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?=$row->firstname?> <?=$row->lastname?></h5>

                        <?php
                            $school = "Not specified"; 
                            if(isset($row->school) && $row->school) {
                                $school = $row->school->school;
                            }
                        ?>
                        <p class="card-text"><?=$school?></p>
                        
                        <p class="card-text"><?=str_replace("_", " ", $row->user_rank)?></p>
                        <a href="<?=ROOT?>/profile/<?=$row->user_id?>" class="btn btn-primary">Profile</a>
                    </div>
                </div>
                <?php endforeach;?>
            <?php else: ?>
                <h4>No users were found at this time</h4>    
            <?php endif;?>
        <div>
    </div>

<?php $this->view('includes/footer') ?>

