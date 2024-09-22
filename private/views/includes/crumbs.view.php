<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">

        <?php if(isset($crumbs)): ?>
            <?php for($i = 0; $i < count($crumbs) - 1; $i++): ?>
                <li class="breadcrumb-item"><a href="<?=$crumbs[$i][1]?>"><?=$crumbs[$i][0]?></a></li>
            <?php endfor; ?>
            <li class="breadcrumb-item active"><?=$crumbs[count($crumbs)-1][0]?></li>
        <?php endif; ?>
       </ol>
</nav>