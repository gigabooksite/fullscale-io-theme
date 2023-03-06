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
           
                <div class=" mb-4 tags clearfix">
                    <?php 
                    $tags = $talent['skills'] ?? [];
                    
                    // if there are more than 6 skills , get only the latest 6
                    if (count($tags) > 6) {
                        $tags = array_slice($tags, 0, 6);
                    }
                    
                    foreach($tags as $tag) {
                        $tagSlug    = array_search($tag['name'], fs_get_tech_stack());

                        if ($tagSlug === false) {
                            $class = 'btn btn-ghost no-underline green';
                        } else {
                            $class = 'btn btn-ghost no-underline green';
                            $href  = site_url('/') . 'hire-expert-' . $tagSlug . '-developers';
                            $title = 'Hire ' . $tag['name'] . ' Developer';

                            // append current ENV
                            // $href = add_query_arg( 
                            //     [
                            //         'env' => $_GET['env'] ?? WP_ENV ?? ''
                            //     ],
                            //     $href
                            // );
                        }
                        ?>
                        <a class="mr-2 mb-2 <?php echo $class; ?>"
                            <?php if ($tagSlug !== false) { ?>
                                href="<?php echo $href; ?>"
                                title="<?php echo $title; ?>"
                            <?php } ?>
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