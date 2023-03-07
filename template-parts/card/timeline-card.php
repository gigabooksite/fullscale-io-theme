<div class="timeline">
    <h2 class="d-flex content-center items-center ml-4 pt-2 pb-2 px-4 bg-black-80 font-gotham text-xl text-uppercase rounded text-white timeline__heading">
        <?php echo $args['heading']; ?>
    </h2>
    
    <div class="timeline__body">
        <?php
            foreach ($args['timelines'] as $timeline) {
                ?>
                <div class="md:d-flex gap-4 timeline__item">
                    <div class="duration">
                        <span class="text-gray-50">
                            <?php echo date('M Y', strtotime($timeline['start_date'])); ?>
                            <span>-</span>
                            <?php echo date('M Y', strtotime($timeline['end_date'])); ?>
                        </span>
                    </div>
                    <div class="description">
                        <header class="mb-2">
                            <h3 class="font-gotham font-bold text-xl text-green">
                                <?php echo $timeline['job_title']; ?>
                            </h3>
                            <h4 class="font-gotham font-bold italic text-base text-black">
                                <?php echo $timeline['company_name']; ?>
                            </h4>
                        </header>
                        
                        <article class="text-sm leading-5">
                            <?php echo wpautop($timeline['description']); ?>
                        </article>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</div>