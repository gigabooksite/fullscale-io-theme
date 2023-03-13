<?php
    $talent         = $args['talent'] ?? [];
?>

<div class="relative bg-white item item-listing w-full">
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

                        // display skills
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
            </div>

        </div>
    </div>
</div>