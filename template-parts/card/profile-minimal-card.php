<?php
    $talent         = $args['talent'] ?? [];
?>

<div class="relative bg-white item item-listing w-full h-full">
    <div class="elementor-widget-wrap h-full">
        <div class="elementor-element">

            <div class="text-center avatar">
                <?php
                    $avatarUrl = fs_get_talent_avatar_url($talent['avatar_url']);
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

                        // display only the latest 5 items
                        if (count($hackerRanks) > 5) {
                            $hackerRanks = array_slice($hackerRanks, 0, 5);
                        }

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