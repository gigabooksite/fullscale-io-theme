<?php
    $lang   = $args['lang'] ?? '';
    $talent = $args['talent'] ?? [];
?>

<div class="item mb-4">
    <div class="inner bg-white">
        <div class="text-center avatar">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/avatar-placeholder.png" alt="" />
        </div>
        
        <div class="talent-details">
            <div class="d-flex justify-center">
                <div class="d-flex items-center rounded meta">
                    <h3 class="mb-0 font-gotham name">
                        <?php echo esc_attr($talent['first_name']); ?>
                    </h3>
                    <div class="bg-green text-white role">
                        <?php echo esc_attr($talent['role']); ?>
                    </div>
                </div>
            </div>
            
            <div class="mb-4 excerpt">
                <?php
                    $hackerRanks = !empty($talent['hackerRank'])
                                    ? $talent['hackerRank']
                                    : $talent['skills'];
                    
                    // if there are more than 3 hackerrank result , get only the latest 3
                    if (count($hackerRanks) > 3) {
                        $hackerRanks = array_slice($hackerRanks, 0, 3);
                    }
                    
                    // display skils
                    get_template_part(
                        'template-parts/card/skill',
                        'card',
                        [
                            'skills' => $hackerRanks,
                            'type'   => 'modern'   // modern | default
                        ]
                    );
                ?>
            </div>
            <div class="d-flex mb-4 tags">
                <?php 
                $tags = $talent['skills'] ?? [];
                
                // if there are more than 5 skills , get only the latest 5
                if (count($tags) > 5) {
                    $tags = array_slice($tags, 0, 5);
                }
                
                foreach($tags as $tag) { ?>
                    <a 
                        href="<?php echo home_url(); ?>/<?php echo $tag['name']; ?>/" 
                        class="mr-2 mb-2 btn btn-ghost no-underline green"
                        title="Hire <?php echo $tag['name']; ?> Developer"
                    >
                        <?php echo $tag['name']; ?>
                    </a>
                <?php } ?>
            </div>
            
            <div class="btn-profile-wrap">
                <a href="javascript: void(0);" 
                    class="btn btn-primary text-uppercase no-underline btn-profile"
                    data-id="<?php echo $talent['id']; ?>"
                    data-uid="<?php echo $talent['unique_str']; ?>"
                    data-lang="<?php echo $lang; ?>"
                >
                    View Profile
                </a>
            </div>
        </div>
    </div>
</div>