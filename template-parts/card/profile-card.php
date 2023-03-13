<?php
    $lang           = $args['lang'] ?? '';
    $talent         = $args['talent'] ?? [];
    $isListing      = $args['is_listing'] ?? false;
?>

<div class="relative bg-white item <?php echo $isListing ? 'item-listing w-full' : ''; ?>">
    <div class="elementor-widget-wrap h-full">
        <div class="elementor-element">

            <div class="text-center avatar">
                <?php
                    if (false === filter_var($talent['avatar_url'], FILTER_VALIDATE_URL)) {
                        $avatarUrl = (strcmp('prod', WP_ENV) !== 0 || strcmp('staging', WP_ENV) !== 0)
                                        ? get_stylesheet_directory_uri() . '/images/avatar-placeholder.png'
                                        : APP_URL . '/assets/img/'. $talent['avatar_url'];
                    } else {
                        $avatarUrl = $talent['avatar_url'];
                    }
                ?>
                <img src="<?php echo esc_url($avatarUrl); ?>" alt="<?php echo esc_attr($talent['first_name']); ?>" />
            </div>
            
            <div class="talent-details">
                
                <div class="w-full text-center rounded meta">
                    <h3 class="mb-0 font-gotham name">
                        <?php
                            echo $talent['initial'] 
                                ?? esc_attr($talent['first_name']) . ' ' . esc_attr($talent['last_name']) 
                                ?? '';
                        ?>.
                    </h3>
                    <div class="bg-green text-white role">
                        <?php echo esc_attr($talent['role']); ?>
                    </div>
                </div>
                
                <div class="mb-4 excerpt hacker-ranks">
                    <?php
                        $hackerRanks = !empty($talent['hackerRank'])
                                        ? $talent['hackerRank']
                                        : $talent['skills'];
                        
                        $hackerRanksFormatted = fs_move_item_to_first($hackerRanks, $lang);
                        
                        // if there are more than 3 hackerrank result , get only the latest 3
                        if (count($hackerRanksFormatted) > 3) {
                            $hackerRanksFormatted = array_slice($hackerRanksFormatted, 0, 3);
                        }
                        
                        // display skills
                        get_template_part(
                            'template-parts/card/skill',
                            'card',
                            [
                                'skills' => $hackerRanksFormatted,
                                'type'   => 'modern'   // modern | default
                            ]
                        );
                    ?>
                </div>
                
                <div class="mb-4 tags clearfix">
                    <?php 
                    $tags = $talent['skills'] ?? [];
                    
                    // remove garbage returned skills
                    $tags = array_filter($tags);
                    
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
                
                <div class="w-full btn-profile-wrap">
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
</div>