<div class="skill-scores">
    <ul class="ml-0 list-none">
        <?php
            foreach($args['skills'] as $skill) {
                ?>
                    <li class="-mb-2">
                        <div class="progress-wrap <?php echo $args['type'] ?? 'default' ?>">
                            <div class="lang"><?php echo $skill['name']; ?></div>
                            <div class="d-flex items-center justify-between">
                                <div class="progress">
                                    <div class="progress-bar" 
                                        style="
                                            width: <?php echo $skill['rate']; ?>%;
                                            <?php echo 'modern' == $args['type'] ? 'background-color:' . $skill['color'] : ''; ?>
                                        "></div>
                                </div>
                                <div class="percent">
                                    <div class="value">
                                        <?php echo $skill['rate']; ?> <span>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php
            }
        ?>
    </ul>    
</div>