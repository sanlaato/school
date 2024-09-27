<div class="card m-2 user-card" style="max-width: 14rem;min-width: 13rem;">
    <?php 
        $profilepicpath = ASSETS . ($row->gender == 'female' ? '/user_female.jpg' : '/user_male.jpg');
    ?>
    <img src="<?=$profilepicpath?>" class="card-img-top d-block mx-auto" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?=$row->firstname?> <?=$row->lastname?></h5>
        <p class="card-text"><?=str_replace("_", " ", ucwords($row->user_rank))?></p>
        <a href="<?=ROOT?>/profile/<?=$row->user_id?>" class="btn btn-primary">Profile</a>
        <button type="submit" name="selected" class="btn btn-danger float-end">Select</button>
    </div>
</div>