<?php get_header(); ?>

<div class="container">
  <?php while ( have_posts() ) { the_post(); ?>

            space

            <h1><?php the_title(); ?></h1>
            <?php the_post_thumbnail( 'full' );  ?>
            <?php the_content(); ?>

            <table class="table">
                <thead>
                    <th>Room size</th>
                    <th>Seating Capacity</th>
                    <th>Standing Capacity</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php the_field( "room_size" ); ?> <?php the_field( "room_size_unit" ); ?></td>
                        <td><?php the_field( "seating_capacity" ); ?> <?php the_field( "seating_unit" ); ?></td>
                        <td><?php the_field( "standing_capacity" ); ?> <?php the_field( "standing_unit" ); ?></td>
                    </tr>
                </tbody>
            </table>

            <?php

            // check if the repeater field has rows of data
            if( have_rows('amenities') ):

             	  // loop through the rows of data

                echo '<h3>Amenities</h3>';
                echo '<ul>';
                while ( have_rows('amenities') ) : the_row();

                    // display a sub field value
                    echo '<li>';
                    the_sub_field('amenity_title');
                    echo '</li>';

                endwhile;
                echo '</ul>';

            else :

                // no rows found

            endif;
            ?>
  <?php } ?>
</div>

<?php get_footer(); ?>
