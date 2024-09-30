<nav class="navbar navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i>&nbsp</span>
            </div>  
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" />
        </div>
    </form>
    <a href="<?=ROOT?>/classes/<?=$row->class_id?>?tab=lecturers-add">
        <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add Lecturer</button>
    </a>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Lecturer Modal
    </button>
</nav>

<div  id="lecturersContainer" class="mt-4" style="min-height: 400px;">

</div>

<?php include($this->get_include_path('classes.details.tab.lecturers.add.modal')) ?>

