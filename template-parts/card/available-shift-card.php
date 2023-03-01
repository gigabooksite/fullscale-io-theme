<?php
if (!count($args['shifts']) > 0) {
    return;
}
?>

<div class="available-shifts rounded">
    <h4 class="font-gotham font-semibold text-uppercase available-shifts__heading">
        <?php echo $args['heading'] ?? 'Available Shifts'; ?>
    </h4>
    
    <div class="d-flex justify-center gap-4 p-2 shifts">
        <?php
            foreach ($args['shifts'] as $shift) {
                ?>
                <div>
                    <p class="text-sm mb-0">
                        <?php echo $shift[0] ?? ''; ?>
                    </p>
                    
                    <p class="text-sm mb-0">
                        <?php echo $shift[1] ?? ''; ?>
                    </p>
                </div>
                <?php
            }
        ?>
    </div>
</div>