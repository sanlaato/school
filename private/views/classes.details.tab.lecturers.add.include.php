<form method="post" class="mt-4">
    <div style="text-align: center;">
        <h3>Add Lecturer</h3>
    </div>
    <div class="form-group row">
        <div class="form-group col-md-11">
            <input value="<?=get_var('name')?>" class="form-control" type="text" name="name" placeholder="Lecturer Name" />
        </div>
        <div class="form-group col-md-1">
            <button class="btn btn-primary float-end" type="submit" name="search">Search</button>
        </div>
    </div>    
</form>

<form method="post"  class="mt-4">
    <?php if($results): ?>    
        <div class="card-group justify-content-center">
            <?php foreach ($results as $row): ?>
                <?php include ($this->get_include_path('user.card')) ?>
            <?php endforeach;?>
        <div>
    <?php else: ?>
        <h4>No lecturer were found at this time</h4>    
    <?php endif; ?>
</form>