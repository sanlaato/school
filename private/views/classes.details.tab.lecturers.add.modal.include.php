<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Lecturer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
            <form method="post" class="">
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

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>