<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

        <input id="classId" type="hidden" value="<?= $row->class_id ?>">

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
                        <a class="nav-link <?=$tab=='lecturers'? 'active' : ''?>" href="<?=ROOT?>/classes/<?=$row->class_id?>?tab=lecturers">Lecturers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$tab=='students'? 'active' : ''?>" href="<?=ROOT?>/classes/<?=$row->class_id?>?tab=students">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?=$tab=='tests'? 'active' : ''?>" href="<?=ROOT?>/classes/<?=$row->class_id?>?tab=tests">Tests</a>
                    </li>
                </ul>

                <?php
                    switch($tab)
                    {
                        case 'lecturers':
                            include ($this->get_include_path('classes.details.tab.lecturers'));
                            break;
                        case 'lecturers-add':
                            include ($this->get_include_path('classes.details.tab.lecturers.add'));
                            break;
                        case 'students':
                            include ($this->get_include_path('classes.details.tab.students'));
                            break;
                        case 'students-add':
                            include ($this->get_include_path('classes.details.tab.students.add'));
                            break;
                        case 'tests':
                            include ($this->get_include_path('classes.details.tab.tests'));
                            break;
                        case 'tests-add':
                            include ($this->get_include_path('classes.details.tab.tests.add'));
                            break;
                    }
                ?>

            </div>

        </div>

<?php $this->view('includes/footer') ?>

