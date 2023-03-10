<div class="item mb-4">
    <div class="inner bg-white">
        <div class="text-center avatar">
            <img src="<?php echo esc_url($args['avatar_url']) ?>" alt="" />
        </div>
        
        <div class="talent-details">
            <div class="d-flex justify-center">
                <div class="d-flex rounded meta">
                    <h3 class="mb-0 font-gotham name">
                        <?php echo esc_attr($args['name']); ?>
                    </h3>
                    <div class="bg-green text-white role">
                        <?php echo esc_attr($args['role']); ?>
                    </div>
                </div>
            </div>
            
            <div class="mb-4 excerpt">
                <?php
                    $skills = $args['hackerRank'] ?? [];

                    // if there are more than 3 hacker rank result , get only the latest 3
                    if (count($skills) > 3) {
                        $skills = array_slice($skills, 0, 3);
                    }

                    // display skils
                    get_template_part(
                        'template-parts/card/skill',
                        'card',
                        [
                            'skills' => $skills,
                            'type'   => 'modern'   // modern | default
                        ]
                    );
                ?>
            </div>
            <div class="d-flex mb-4 tags">
                <?php 
                $tags = $args['skills'] ?? [];
                
                // if there are more than 5 skills , get only the latest 5
                if (count($tags) > 5) {
                    $tags = array_slice($tags, 0, 5);
                }
                
                foreach($tags as $tag) { ?>
                    <a 
                        href="<?php echo home_url(); ?>/<?php echo $tag; ?>/" 
                        class="mr-2 mb-2 btn btn-ghost no-underline green"
                        title="Hire <?php echo $tag; ?> Developer"
                    >
                        <?php echo $tag; ?>
                    </a>    
                <?php } ?>
            </div>
            
            <div>
                <a href="javascript: void(0);" 
                    class="btn btn-primary text-uppercase no-underline btn-profile"
                    data-id="<?php echo $args['id']; ?>"
                >
                    View Profile
                </a>
            </div>
        </div>
    </div>
</div>