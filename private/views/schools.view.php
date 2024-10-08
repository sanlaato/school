<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

        <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
            <?php $this->view('includes/crumbs', ['crumbs'=>$crumbs]) ?>
            <div class="card-group justify-content-center">
            <table class="table table-striped">
                <tr>
                    <th>

                    </th>
                    <th>
                        School
                    </th>
                    <th>
                        Created by
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        <a href="<?=ROOT?>/schools/add">
                            <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
                        </a>
                    </th>
                </tr>
        

        
                <?php if($rows): ?>
                    <?php foreach ($rows as $row): ?>
                        <?php 
                            $creator = "Not specified";
                            if(isset($row->user)) {
                                $creator = $row->user->firstname . " " . $row->user->lastname;
                            }
                        ?>
                        <tr>
                            <td>
                                <a href="<?=ROOT?>/schools/<?=$row->id?>">
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i></button>
                                </a>
                            </td>
                            <td>
                                <?=$row->school?>
                            </td>
                            <td>
                                <?=$creator?>
                            </td>
                            <td>
                                <?=get_date($row->date)?>
                            </td>
                            <td>
                                <a href="<?=ROOT?>/schools/edit/<?=$row->id?>">
                                    <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></button>
                                </a>

                                <a href="<?=ROOT?>/schools/delete/<?=$row->id?>">
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                                </a>

                                <a href="<?=ROOT?>/users/switch_school/<?=$row->id?>">
                                    <button class="btn btn-sm btn-success">Switch to<i class="fa fa-chevron-right"></i></button>
                                </a>
                                <?php if($row->school_id == $_SESSION['USER']->school_id): ?>
                                    <span class="btn btn-sm btn-info text-white" disabled>Super Admin</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <h4>No schools were found at this time</h4>    
                <?php endif;?>
            </table>
        <div>
    </div>

<?php $this->view('includes/footer') ?>

