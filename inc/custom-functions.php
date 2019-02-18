<?php
/**
 * @package SKT Yogi
 * Setup the WordPress core custom functions feature.
 *
*/

add_action('skt_yogi_optionsframework_custom_scripts', 'skt_yogi_optionsframework_custom_scripts');
function skt_yogi_optionsframework_custom_scripts() { ?>
	<script type="text/javascript">
    jQuery(document).ready(function() {
    
        jQuery('#example_showhidden').click(function() {
            jQuery('#section-example_text_hidden').fadeToggle(400);
        });
        
        if (jQuery('#example_showhidden:checked').val() !== undefined) {
            jQuery('#section-example_text_hidden').show();
        }
        
    });
    </script><?php
}

// get_the_content format text
function get_the_content_format( $str ){
	$raw_content = apply_filters( 'the_content', $str );
	$content = str_replace( ']]>', ']]&gt;', $raw_content );
	return $content;
}
// the_content format text
function the_content_format( $str ){
	echo get_the_content_format( $str );
}

function is_google_font( $font ){
	$notGoogleFont = array( 'Arial', 'Comic Sans MS', 'FreeSans', 'Georgia', 'Lucida Sans Unicode', 'Palatino Linotype', 'Symbol', 'Tahoma', 'Trebuchet MS', 'Verdana' );
	if( in_array($font, $notGoogleFont) ){
		return false;
	}else{
		return true;
	}
}

// subhead section function
function sub_head_section( $more ) {
	$pgs = 0;
	do {
		$pgs++;
	} while ($more > $pgs);
	return $pgs;
}

//[clear]
function clear_func() {
	$clr = '<div class="clear"></div>';
	return $clr;
}
add_shortcode( 'clear', 'clear_func' );

//[separator height="20"]
function separator_shortcode_func($atts ) {
	extract( shortcode_atts( array(
		'height' => '20',
	), $atts ) );
	$sptr = '<div style="clear:both; min-height:20px; height:'.$height.'px; background:url('.get_template_directory_uri().'/images/hr_double.png) no-repeat center center transparent;"></div>';
	return $sptr;
}
add_shortcode( 'separator', 'separator_shortcode_func' );

//[blankspace height="20"]
function blankspace_shortcode_func($atts ) {
	extract( shortcode_atts( array(
		'height' => '20',
	), $atts ) );
	$sptr = '<div class="custom-height" style="height:'.$height.'px;"></div>';
	return $sptr;
}
add_shortcode( 'blankspace', 'blankspace_shortcode_func' );


//[column_content]Your content here...[/column_content]
function column_content_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => '',
		'animation' => '',
	), $atts ) );
	$colPos = strpos($type, '_last');
	if($colPos === false){
		$cnt = '<div class="'.$type.' '.$animation.'">'.do_shortcode($content).'</div>';
	}else{
		$type = substr($type,0,$colPos);
		$cnt = '<div class="'.$type.' '.$animation.' last_column">'.do_shortcode($content).'</div>';
	}
	return $cnt;
}
add_shortcode( 'column_content', 'column_content_func' );


//[hr]
function hrule_func() {
	$hrule = '<div class="clear hrule"></div>';
	return $hrule;
}
add_shortcode( 'hr', 'hrule_func' );


//[hr_top]
function hr_top_func() {
	$hr_top = '<div class="clear linktotop"><a title="Top of Page" href="#top">Back to Top</a></div><div class="clear hrule"></div>';
	return $hr_top;
}
add_shortcode( 'hr_top', 'hr_top_func' );


// [searchform]
function searchform_shortcode_func( $atts ){
	return get_search_form( false );
}
add_shortcode( 'searchform', 'searchform_shortcode_func' );

// accordion
function accordion_func( $atts, $content = null ) {
	$acc = '<div style="margin-top:10px;">'.get_the_content_format( do_shortcode($content) ).'<div class="clear"></div></div>';
	return $acc;
}
add_shortcode( 'accordion', 'accordion_func' );
function accordion_content_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Accordion Title',
	), $atts ) );
	$content = wpautop(trim($content));
	$acn = '<div class="accordion-box"><h2>'.$title.'</h2>
			<div class="acc-content">'.$content.'</div><div class="clear"></div></div>';
	return $acn;
}
add_shortcode( 'accordion_content', 'accordion_content_func' );


// remove excerpt more
function new_excerpt_more( $more ) {
	return '... ';
}
add_filter('excerpt_more', 'new_excerpt_more');

// get post categories function
function getPostCategories(){
	$categories = get_the_category();
	$catOut = '';
	$separator = ', ';
	$catOutput = '';
	if($categories){
		foreach($categories as $category) {
			$catOutput .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'skt-yogi-pro' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
		}
		$catOut = 'Categories: '.trim($catOutput, $separator);
	}
	return $catOut;
}

// replace last occurance of a string.
function str_lreplace($search, $replace, $subject){
	$pos = strrpos($subject, $search);
	if($pos !== false){
		$subject = substr_replace($subject, $replace, $pos, strlen($search));
	}
	return $subject;
}
function price_column_header_func( $atts, $content = null ) {
	$pheader = '<div class="th">'.strip_tags($content).'</div>';
    return $pheader;
}
add_shortcode( 'price_header', 'price_column_header_func' );

function price_column_footer_func( $atts, $content = null ) {
   extract( shortcode_atts( array(
		'link' => '#',
	), $atts ) );
	$pfooter = '<div class="tf"><a href="'.$link.'">'.strip_tags($content).'</a></div>';
    return $pfooter;
}
add_shortcode( 'price_footer', 'price_column_footer_func' );

function price_row_footer_func( $atts, $content = null ) {
	$prow = '<div class="td">'.$content.'</div>';
    return $prow;
}
add_shortcode( 'price_row', 'price_row_footer_func' );



// custom post type for Testimonials
function my_custom_post_testimonials() {
	$labels = array(
		'name'               => __( 'Testimonials','skt-yogi-pro'),
		'singular_name'      => __( 'Testimonials','skt-yogi-pro'),
		'add_new'            => __( 'Add Testimonials','skt-yogi-pro'),
		'add_new_item'       => __( 'Add New Testimonial','skt-yogi-pro'),
		'edit_item'          => __( 'Edit Testimonial','skt-yogi-pro'),
		'new_item'           => __( 'New Testimonial','skt-yogi-pro'),
		'all_items'          => __( 'All Testimonials','skt-yogi-pro'),
		'view_item'          => __( 'View Testimonial','skt-yogi-pro'),
		'search_items'       => __( 'Search Testimonial','skt-yogi-pro'),
		'not_found'          => __( 'No Testimonial found','skt-yogi-pro'),
		'not_found_in_trash' => __( 'No Testimonial found in the Trash','skt-yogi-pro'), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Testimonials'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Testimonials',
		'public'        => true,
		'menu_icon'		=> 'dashicons-format-quote',
		'menu_position' => null,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true,
	);
	register_post_type( 'testimonials', $args );	
}
add_action( 'init', 'my_custom_post_testimonials' );


// add meta box to testimonials
add_action( 'admin_init', 'my_testimonial_admin_function' );
function my_testimonial_admin_function() {
    add_meta_box( 'testimonial_meta_box',
        'Testimonial Info',
        'display_testimonial_meta_box',
        'testimonials', 'normal', 'high'
    );
}
// add meta box form to team
function display_testimonial_meta_box( $testimonial ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $possition = esc_html( get_post_meta( $testimonial->ID, 'possition', true ) ); 
	
    ?>
    <table width="100%">       
        <tr>
            <td width="20%">Designation </td>
            <td width="80%"><input size="80" type="text" name="possition" value="<?php echo $possition; ?>" /></td>
        </tr>       
    </table>
    <?php    
}
// save testimonial meta box form data
add_action( 'save_post', 'add_testimonial_fields_function', 10, 2 );
function add_testimonial_fields_function( $testimonial_id, $testimonial ) {
    // Check post type for testimonials
    if ( $testimonial->post_type == 'testimonials' ) {
        // Store data in post meta table if present in post data		 
        if ( isset($_POST['possition']) ) {
            update_post_meta( $testimonial_id, 'possition', $_POST['possition'] );
        }       
    }
}



//Testimonials function
function testimonials_output_func( $atts ){
	$testimonialoutput = '<div id="testimonials"><div class="quotes">
            <ul>';
	wp_reset_query();
	query_posts('post_type=testimonials');
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();		
		$possition = esc_html( get_post_meta( get_the_ID(), 'possition', true ) );
			$testimonialoutput .= '
  			 <li>			 
			    <div class="tm_thumb">
				'.get_the_post_thumbnail( get_the_ID(), array(80,80) ).'
				<h6> '.get_the_title().'</h6>
				<span>'.$possition.'</span>
				</div>
							 	
				<div class="tm_description">
				  '.content( of_get_option('testimonialsexcerptlenth') ).'				  
				</div>								
              </li>
			';
		endwhile;
		 $testimonialoutput .= '</ul></div></div>';
	else:
	  $testimonialoutput = '<div id="testimonials">
          <div class="quotes">
            <ul>
              <li> 			  
			      <div class="tm_thumb">
				    <img src="'.get_template_directory_uri()."/images/testimonial.jpg".'" alt="" />
				     <h6>Jane Deo</h6>
				    <span>Ex Student Yogasana</span>
				  </div> 
				  				                  
                  <div class="tm_description">
				   <p>Aliquam et varius orci, ut ornare justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque augue metus, blandit vel nibh sed, sollicitudin placerat quam. Quisque id scelerisque nibh. Phasellus in orci et felis tristique finibus non quis erat. Quisque nec congue nunc, sagittis aliquet orci. Quisque pulvinar feugiat sodales. Nam fermentum tempus odio sed euismod Quisque pulvinar feugiat sodales. Nam fermentum tempus odio sed euismod.</p>                   
				  </div> 				  			              
              </li>
			  
              <li>                 
                <div class="tm_thumb">
				    <img src="'.get_template_directory_uri()."/images/testimonial.jpg".'" alt="" />
				     <h6>Eficitur Sodale</h6>
				    <span>Ex Student Yogasana</span>
				  </div> 
				  				                  
                  <div class="tm_description">
				   <p>Aliquam et varius orci, ut ornare justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque augue metus, blandit vel nibh sed, sollicitudin placerat quam. Quisque id scelerisque nibh. Phasellus in orci et felis tristique finibus non quis erat. Quisque nec congue nunc, sagittis aliquet orci. Quisque pulvinar feugiat sodales. Nam fermentum tempus odio sed euismod Quisque pulvinar feugiat sodales. Nam fermentum tempus odio sed euismod.</p>                   
				  </div>
              </li>  
			  
			   <li>                 
                <div class="tm_thumb">
				    <img src="'.get_template_directory_uri()."/images/testimonial.jpg".'" alt="" />
				     <h6>Eficitur Sodale</h6>
				    <span>Ex Student Yogasana</span>
				  </div> 
				  				                  
                  <div class="tm_description">
				   <p>Aliquam et varius orci, ut ornare justo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque augue metus, blandit vel nibh sed, sollicitudin placerat quam. Quisque id scelerisque nibh. Phasellus in orci et felis tristique finibus non quis erat. Quisque nec congue nunc, sagittis aliquet orci. Quisque pulvinar feugiat sodales. Nam fermentum tempus odio sed euismod Quisque pulvinar feugiat sodales. Nam fermentum tempus odio sed euismod.</p>                   
				  </div>
              </li>  
			           
            </ul>         
    </div>  
  </div> ';			
	  endif;  
	wp_reset_query();
	$testimonialoutput .= '</div>';
	
	return $testimonialoutput;
}
add_shortcode( 'testimonials', 'testimonials_output_func' );


/*Latest news Function*/
function footer_recent_posts_func( $atts ){
   extract( shortcode_atts( array(
		'show' =>'',
		'catid' => '',
	), $atts ) );
	$frp = '';
	wp_reset_query();
	$n = 0;
	query_posts(  array( 'posts_per_page'=>$show, 'car'=>$catid, 'post__not_in' => get_option('sticky_posts') )  );
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			$n++;
			if( $n%2==0 ) 
			$nomgn = 'last';
			else
			$nomgn = ' ';
			if ( has_post_thumbnail()) {
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
				$imgUrl = $large_image_url[0];
			}else{
				$imgUrl = get_template_directory_uri().'/images/img_404.png';
			} 
			
			$frp .= '<div class="recent-post '.$nomgn.'">
							 <a href="'.get_the_permalink().'"><img src="'.$imgUrl.'" alt="" /></a>						 
							 <a href="'.get_the_permalink().'"><h6>'.get_the_title().'</h6></a>	
							 <p>'.wp_trim_words( get_the_content(), of_get_option('footerpostlength'), '' ).'</p>
							<div class="clear"></div>
                        </div>';		
		endwhile;
	endif;
	wp_reset_query();
	$frp .= '<div class="clear"></div>';
	
	return $frp;
}
add_shortcode( 'footer-posts', 'footer_recent_posts_func' );


//custom post type for Our Team
function my_custom_post_team() {
	$labels = array(
		'name'               => __( 'Our Team', 'skt-yogi-pro' ),
		'singular_name'      => __( 'Our Team', 'skt-yogi-pro' ),
		'add_new'            => __( 'Add New', 'skt-yogi-pro' ),
		'add_new_item'       => __( 'Add New Team Member', 'skt-yogi-pro' ),
		'edit_item'          => __( 'Edit Team Member', 'skt-yogi-pro' ),
		'new_item'           => __( 'New Member', 'skt-yogi-pro' ),
		'all_items'          => __( 'All Members', 'skt-yogi-pro' ),
		'view_item'          => __( 'View Members', 'skt-yogi-pro' ),
		'search_items'       => __( 'Search Team Members', 'skt-yogi-pro' ),
		'not_found'          => __( 'No Team members found', 'skt-yogi-pro' ),
		'not_found_in_trash' => __( 'No Team members found in the Trash', 'skt-yogi-pro' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Our Team'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Team',
		'public'        => true,
		'menu_position' => null,
		'menu_icon'		=> 'dashicons-groups',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'rewrite' => array('slug' => 'our-team'),
		'has_archive'   => true,
	);
	register_post_type( 'team', $args );
}
add_action( 'init', 'my_custom_post_team' );

// add meta box to team
add_action( 'admin_init', 'my_team_admin_function' );
function my_team_admin_function() {
    add_meta_box( 'team_meta_box',
        'Member Info',
        'display_team_meta_box',
        'team', 'normal', 'high'
    );
}
// add meta box form to team
function display_team_meta_box( $team ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $designation = esc_html( get_post_meta( $team->ID, 'designation', true ) );
    ?>
    <table width="100%">
        <tr>
            <td width="20%">Designation </td>
            <td width="80%"><input type="text" name="designation" value="<?php echo $designation; ?>" /></td>
        </tr>
    </table>
    <?php   
}
// save team meta box form data
add_action( 'save_post', 'add_team_fields_function', 10, 2 );
function add_team_fields_function( $team_id, $team ) {
    // Check post type for testimonials
    if ( $team->post_type == 'team' ) {
        // Store data in post meta table if present in post data
        if ( isset($_POST['designation']) ) {
            update_post_meta( $team_id, 'designation', $_POST['designation'] );
        }
    }
}

function ourteamposts_func( $atts ) {
   extract( shortcode_atts( array(
		'show' => '',
	), $atts ) );
	  extract( shortcode_atts( array( 'show' => '',), $atts ) ); $postoutput = ''; wp_reset_query();
	$bposts = '<div class="section-teammember">';
	$args = array( 'post_type' => 'team', 'posts_per_page' => $show, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
	$n = 0;
	if ( have_posts() ) {
		while ( have_posts() ) { 
			the_post();
			$n++; if( $n%4 == 0 ) $nomargn = ' last'; else $nomargn = '';
			$designation = esc_html( get_post_meta( get_the_ID(), 'designation', true ) );
			 $bposts .= '<div class="ourclasses_col '.$nomargn.'">';	
			$bposts .= '<div class="ourclasses_thumb"><a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), array( 270, 275 )) : '<img src="'.get_template_directory_uri().'/images/img_404.png" width="270" height="180" />' ).'</a></div>';
			$bposts .= '<div class="title_day_time"><a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a>';
			$bposts .= '<div class="day_time">';
			$bposts .= '<span class="member-desination">'.$designation.'</span>';
			$bposts .= '</div></div></div>';
			$bposts .= ''.(($n%4==0) ? '<div class="clear"></div>' : '');	
 
		}
	}else{
		$bposts .= '
		
		<div class="ourclasses_col ">
        <div class="ourclasses_thumb"><a href="#"><img alt="ourteam-1" src="'.get_template_directory_uri().'/images/ourteam-1.jpg"></a></div>
		<div class="title_day_time">
        <a href="#"><h3>John Doe</h3></a>
        <div class="day_time"><span class="member-desination">Fitness Trainer</span></div>
        </div>
    </div>
    
	<div class="ourclasses_col ">
        <div class="ourclasses_thumb"><a href="#"><img alt="ourteam-1" src="'.get_template_directory_uri().'/images/ourteam-2.jpg"></a></div>
		<div class="title_day_time">
        <a href="#"><h3>Martin Doe</h3></a>
        <div class="day_time"><span class="member-desination">Fitness Trainer</span></div>
        </div>
    </div>
    
    <div class="ourclasses_col ">
        <div class="ourclasses_thumb"><a href="#"><img alt="ourteam-1" src="'.get_template_directory_uri().'/images/ourteam-3.jpg"></a></div>
		<div class="title_day_time">
        <a href="#"><h3>Jane Doe</h3></a>
        <div class="day_time"><span class="member-desination">Yoga Trainer</span></div>
        </div>
    </div>
    
    <div class="ourclasses_col last">
        <div class="ourclasses_thumb"><a href="#"><img alt="ourteam-1" src="'.get_template_directory_uri().'/images/ourteam-4.jpg"></a></div>
		<div class="title_day_time">
        <a href="#"><h3>Martina Doe</h3></a>
        <div class="day_time"><span class="member-desination">Yoga Trainer</span></div>
        </div>
    </div>
		
		
		';
	}
	wp_reset_query();
	$bposts .= '</div>';
    return $bposts;
}
add_shortcode( 'ourteam', 'ourteamposts_func' );


// custom post type for Our Classes
function my_custom_post_ourclasses() {
	$labels = array(
		'name'               => __( 'Our Classes','skt-yogi-pro'),
		'singular_name'      => __( 'Our Classes','skt-yogi-pro'),
		'add_new'            => __( 'Add Our Classes','skt-yogi-pro'),
		'add_new_item'       => __( 'Add New Our Classes','skt-yogi-pro'),
		'edit_item'          => __( 'Edit Our Classes','skt-yogi-pro'),
		'new_item'           => __( 'New Our Classes','skt-yogi-pro'),
		'all_items'          => __( 'All Our Classess','skt-yogi-pro'),
		'view_item'          => __( 'View Our Classes','skt-yogi-pro'),
		'search_items'       => __( 'Search Our Classes','skt-yogi-pro'),
		'not_found'          => __( 'No Our Classes found','skt-yogi-pro'),
		'not_found_in_trash' => __( 'No Our Classes found in the Trash','skt-yogi-pro'), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Our Classes'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Our Classess',
		'public'        => true,
		'menu_icon'		=> 'dashicons-welcome-learn-more',
		'menu_position' => null,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
// 		'rewrite' => array('slug' => 'classes'),
		'has_archive'   => true,
	);
	register_post_type( 'ourclasses', $args );	
}
add_action( 'init', 'my_custom_post_ourclasses' );


function skt_yogi_custom_ourclasses($atts) {
	 extract( shortcode_atts( array(
		'col' => '',
	), $atts ) );
	 extract( shortcode_atts( array( 'show' => '',), $atts ) ); $postoutput = ''; wp_reset_query();
	$return_string = '';	 
   $args = array( 'post_type' => 'ourclasses', 'posts_per_page' => $show, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
	query_posts( $args );
   if ( have_posts() ) : 
   $n = 0;
   
   
       while ( have_posts() ) : the_post();
	   $n++;
			if( $n%4==0 ) 
			$nomgn = 'last';
			else
			$nomgn = ' ';
			$return_string .= '<div class="ourclasses_col '.$nomgn.'">';	
			$return_string .= '<div class="ourclasses_thumb"><a href="'.get_permalink().'" title="'.get_the_title().'">'.( (get_the_post_thumbnail( get_the_ID(), 'thumbnail') != '') ? get_the_post_thumbnail( get_the_ID(), array( 270, 180 )) : '<img src="'.get_template_directory_uri().'/images/img_404.png" width="270" height="180" />' ).'</a></div>';
			$return_string .= '<div class="title_day_time"><a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a>';
			$return_string .= '<div class="day_time">';
			$return_string .= ''.wp_trim_words( get_the_content(), of_get_option('classesboxexcerptlength'), '' ).'';
			$return_string .= '<a class="rdmore" href="'.get_permalink().'" title="'.get_the_title().'">'.of_get_option('classbxreadmore').'</a>';
			$return_string .= '</div></div></div>'; 	
	  endwhile;		 
	  else:
	  $return_string .= '
	  
<div class="ourclasses_col  ">
	<div class="ourclasses_thumb"><a title="Yoga Mantra" href="#"><img  src="'.get_template_directory_uri().'/images/ourclass-1.jpg"></a></div>
    <div class="title_day_time">
        <a href="#"><h3>Yoga Mantra</h3></a>
        <div class="day_time">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec massa sodales, mattis lorem et,
             pharetra nulla. Sed a metus hendrerit,</p>
            <a href="#" class="rdmore">Read More</a>
        </div>
    </div>
</div>


<div class="ourclasses_col ">
	<div class="ourclasses_thumb"><a title="Yoga Mantra" href="#"><img  src="'.get_template_directory_uri().'/images/ourclass-2.jpg"></a></div>
    <div class="title_day_time">
        <a href="#"><h3>Meditation</h3></a>
        <div class="day_time">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec massa sodales, mattis lorem et,
             pharetra nulla. Sed a metus hendrerit,</p>
            <a href="#" class="rdmore">Read More</a>
        </div>
    </div>
</div>

<div class="ourclasses_col ">
	<div class="ourclasses_thumb"><a title="Yoga Mantra" href="#"><img  src="'.get_template_directory_uri().'/images/ourclass-3.jpg"></a></div>
    <div class="title_day_time">
        <a href="#"><h3>Deep Release</h3></a>
        <div class="day_time">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec massa sodales, mattis lorem et,
             pharetra nulla. Sed a metus hendrerit,</p>
            <a href="#" class="rdmore">Read More</a>
        </div>
    </div>
</div>


<div class="ourclasses_col last">
	<div class="ourclasses_thumb"><a title="Yoga Mantra" href="#"><img  src="'.get_template_directory_uri().'/images/ourclass-4.jpg"></a></div>
    <div class="title_day_time">
        <a href="#"><h3>Reltaxation</h3></a>
        <div class="day_time">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec massa sodales, mattis lorem et,
             pharetra nulla. Sed a metus hendrerit,</p>
            <a href="#" class="rdmore">Read More</a>
        </div>
    </div>
</div>
	  
	  ';			
	  endif;  
	  $return_string .= '';	
   wp_reset_query();
   return $return_string;
}
add_shortcode( 'ourclasses', 'skt_yogi_custom_ourclasses' );




// shortcode for custom width
function skt_yogi_custom_width_func($atts, $content = null){
		extract(shortcode_atts(array(
			'width'		=> 'width',						
			'class'		=> null
		), $atts));
		return '<div class="'.$class.'" style="width:'.$width.';">'.do_shortcode($content).'</div>';		
}

add_shortcode('area','skt_yogi_custom_width_func');


// Social Icon Shortcodes

function skt_yogi_social_area($atts,$content = null){
  return '<div class="social-icons">'.do_shortcode($content).'</div>';
 }
add_shortcode('social_area','skt_yogi_social_area');

function skt_yogi_social($atts){
 extract(shortcode_atts(array(
  'icon' => '',
  'link' => ''
 ),$atts));
  return '<a href="'.$link.'" target="_blank" class="fa fa-'.$icon.' fa-1x" title="'.$icon.'"></a>';
 }
add_shortcode('social','skt_yogi_social');


function contactform_func( $atts ) {
    $atts = shortcode_atts( array(
        'to_email' => get_bloginfo('admin_email'),
		'title' => 'Contact enquiry - '.home_url( '/' ),
    ), $atts );

	$cform = "<div class=\"main-form-area\" id=\"contactform_main\">";

	$cerr = array();
	if( isset($_POST['c_submit']) && $_POST['c_submit']=='Submit' ){
		$name 			= trim( $_POST['c_name'] );
		$email 			= trim( $_POST['c_email'] );
		$phone 			= trim( $_POST['c_phone'] );
		$website		= trim( $_POST['c_website'] );
		$comments 		= trim( $_POST['c_comments'] );
		$captcha 		= trim( $_POST['c_captcha'] );
		$captcha_cnf	= trim( $_POST['c_captcha_confirm'] );

		if( !$name )
			$cerr['name'] = 'Please enter your name.';
		if( ! filter_var($email, FILTER_VALIDATE_EMAIL) ) 
			$cerr['email'] = 'Please enter a valid email.';
		if( !$phone )
			$cerr['phone'] = 'Please enter your phone number.';
		if( !$comments )
			$cerr['comments'] = 'Please enter your message.';
		if( !$captcha || (md5($captcha) != $captcha_cnf) )
			$cerr['captcha'] = 'Please enter the correct answer.';

		if( count($cerr) == 0 ){
			$subject = $atts['title'];
			$headers = "From: ".$name." <" . strip_tags($email) . ">\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

			$message = '<html><body>
							<table>
								<tr><td>Name: </td><td>'.$name.'</td></tr>
								<tr><td>Email: </td><td>'.$email.'</td></tr>
								<tr><td>Phone: </td><td>'.$phone.'</td></tr>
								<tr><td>Website: </td><td>'.$website.'</td></tr>
								<tr><td>Message: </td><td>'.$comments.'</td></tr>
							</table>
						</body>
					</html>';
			mail( $atts['to_email'], $subject, $message, $headers);
			$cform .= '<div class="success_msg">Thank you! A representative will get back to you very shortly.</div>';
			unset( $name, $email, $phone, $website, $comments, $captcha );
		}else{
			$cform .= '<div class="error_msg">';
			$cform .= implode('<br />',$cerr);
			$cform .= '</div>';
		}
	}

	$capNum1 	= rand(1,4);
	$capNum2 	= rand(1,5);
	$capSum		= $capNum1 + $capNum2;
	$sumStr		= $capNum1." + ".$capNum2 ." = ";

	$cform .= "<form name=\"contactform\" action=\"#contactform_main\" method=\"post\">
			<p><input type=\"text\" name=\"c_name\" value=\"". ( ( empty($name) == false ) ? $name : "" ) ."\" placeholder=\"Name\" /></p>
			<p><input type=\"email\" name=\"c_email\" value=\"". ( ( empty($email) == false ) ? $email : "" ) ."\" placeholder=\"Email\" /></p>
			<p><input type=\"tel\" name=\"c_phone\" value=\"". ( ( empty($phone) == false ) ? $phone : "" ) ."\" placeholder=\"Phone\" /></p>
			<p><input type=\"url\" name=\"c_website\" value=\"". ( ( empty($website) == false ) ? $website : "" ) ."\" placeholder=\"Website with prefix http://\" /></p><div class=\"clear\"></div>
			<p><textarea name=\"c_comments\" placeholder=\"Message\">". ( ( empty($comments) == false ) ? $comments : "" ) ."</textarea></p><div class=\"clear\"></div>";
	$cform .= "<p><span class=\"capcode\">$sumStr</span><input style=\"width:200px;\" type=\"text\" placeholder=\"Captcha\" value=\"". ( ( empty($captcha) == false ) ? $captcha : "" ) ."\" name=\"c_captcha\" /><input type=\"hidden\" name=\"c_captcha_confirm\" value=\"". md5($capSum)."\"></p><div class=\"clear\"></div>";
	$cform .= "<p class=\"sub\"><input type=\"submit\" name=\"c_submit\" value=\"Submit\" class=\"search-submit\" /></p>
		</form>
	</div>";

    return $cform;
}
add_shortcode( 'contactform', 'contactform_func' );

//custom post type for Our photogallery
function my_custom_post_photogallery() {
	$labels = array(
		'name'               => __( 'Photo Gallery','skt-yogi-pro' ),
		'singular_name'      => __( 'Photo Gallery','skt-yogi-pro' ),
		'add_new'            => __( 'Add New','skt-yogi-pro' ),
		'add_new_item'       => __( 'Add New Image','skt-yogi-pro' ),
		'edit_item'          => __( 'Edit Image','skt-yogi-pro' ),
		'new_item'           => __( 'New Image','skt-yogi-pro' ),
		'all_items'          => __( 'All Images','skt-yogi-pro' ),
		'view_item'          => __( 'View Image','skt-yogi-pro' ),
		'search_items'       => __( 'Search Images','skt-yogi-pro' ),
		'not_found'          => __( 'No images found','skt-yogi-pro' ),
		'not_found_in_trash' => __( 'No images found in the Trash','skt-yogi-pro' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Photo Gallery'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Manage Photo Gallery',
		'public'        => true,
		'menu_icon'		=> 'dashicons-format-image',
		'menu_position' => null,
		'supports'      => array( 'title', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'photogallery', $args );
}
add_action( 'init', 'my_custom_post_photogallery' );


//  register gallery taxonomy
register_taxonomy( "gallerycategory", 
	array("photogallery"), 
	array(
		"hierarchical" => true, 
		"label" => "Gallery Category", 
		"singular_label" => "Photo Gallery", 
		"rewrite" => true
	)
);

add_action("manage_posts_custom_column",  "photogallery_custom_columns");
add_filter("manage_edit-photogallery_columns", "photogallery_edit_columns");
function photogallery_edit_columns($columns){
	$columns = array(
		"cb" => '<input type="checkbox" />',
		"title" => "Gallery Title",
		"pcategory" => "Gallery Category",
		"view" => "Image",
		"date" => "Date",
	);
	return $columns;
}
function photogallery_custom_columns($column){
	global $post;
	switch ($column) {
		case "pcategory":
			echo get_the_term_list($post->ID, 'gallerycategory', '', ', ','');
		break;
		case "view":
			the_post_thumbnail('thumbnail');
		break;
		case "date":

		break;
	}
}


//[photogallery filter="false"]
function photogallery_shortcode_func( $atts ) {
	extract( shortcode_atts( array(
		'show' => -1,
		'filter' => 'true'
	), $atts ) );
	$pfStr = '';

	$pfStr .= '<div class="photobooth">';
	if( $filter == 'true' ){
		$pfStr .= '<div class="filter-gallery"><ul class="clean" id="filter"><li class="current"><a href="javascript:void(0)">All</a></li>';
		$categories = get_categories( array('taxonomy' => 'gallerycategory') );
		foreach ($categories as $category) {
			$pfStr .= '<li><a href="javascript:void(0)">'.$category->name.'</a></li>';
		}
		$pfStr .= '</ul></div>';
	}

	$pfStr .= '<div class="gallery"><ul class="clean" id="portfolio">';
	$j=0;
	query_posts('post_type=photogallery&posts_per_page='.$show); 
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$j++;
		$videoUrl = get_post_meta( get_the_ID(), 'video_file_url', true);
		$imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), array(270, 200));
		$terms = wp_get_post_terms( get_the_ID(), 'gallerycategory', array("fields" => "all"));
		$slugAr = array();
		foreach( $terms as $tv ){
			$slugAr[] = $tv->slug;
		}
		if ( $imgSrc[0]!='' ) {
			$imgUrl = $imgSrc[0];
		}else{
			$imgUrl = get_template_directory_uri().'/images/img_404.png';
		}
		$pfStr .= '<li class="'.implode(' ', $slugAr).'" '.( ($j%4==0) ? 'style="margin-right:0"' : '' ).'>
                <strong>'.get_the_title().'</strong>                
 <a href="'.( ($videoUrl) ? $videoUrl : $imgSrc[0] ).'" rel="prettyPhoto[pp_gal]"><img src="'.$imgSrc[0].'"/></a>
            </li>';
		unset( $slugAr );
	endwhile; else: 
		$pfStr .= '<p>Sorry, photo gallery is empty.</p>';
	endif; 
	wp_reset_query();
	$pfStr .= '</ul></div>';
	$pfStr .= '<div class="clear"></div></div>';
	return $pfStr;
}
add_shortcode( 'photogallery', 'photogallery_shortcode_func' );

/*toggle function*/
function toggle_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Click here to toggle content',
	), $atts ) );
	$tog_content = "<div class=\"toggle_holder\"><h3 class=\"slide_toggle\"><a href=\"#\">{$title}</a></h3>
					<div class=\"slide_toggle_content\">".get_the_content_format( $content )."</div></div>";

	return $tog_content;
}
add_shortcode( 'toggle_content', 'toggle_func' );

function tabs_func( $atts, $content = null ) {
	$tabs = '<div class="tabs-wrapper"><ul class="tabs">'.do_shortcode($content).'</ul></div>';
	return $tabs;
}
add_shortcode( 'tabs', 'tabs_func' );

function tab_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Tab Title',
	), $atts ) );
	$rand = rand(100,999);
	$tab = '<li><a rel="tab'.$rand.'" href="javascript:void(0)"><span>'.$title.'</span></a><div id="tab'.$rand.'" class="tab-content">'.get_the_content_format($content).'</div></li>';
	return $tab;
}
add_shortcode( 'tab', 'tab_func' );

function gradient_button_func( $atts ) {
	extract( shortcode_atts( array(
		'size' => 'small',
		'bg_color' => '#636b74',
		'color' => '#fff',
		'text' => 'More',
		'title' => 'Click',
		'url' => '',
		'position' => 'center',
	), $atts ) );
	$btn  = "<div class=\"clear\"></div>";
	$btn .= "<a href=\"{$url}\" "; 
	$btn .= ($title != "") ? " title=\"{$title}\" " : "";
	$btn .= "class=\"grad-btn-{$size} btn-align-{$position}\" style=\"background-color:{$bg_color}; color:{$color}\">";
	$btn .= "{$text}</a>";
	$btn  .= "<div class=\"clear\"></div>";

	return $btn;
}
add_shortcode( 'gradient_button', 'gradient_button_func' );

function simple_button_func( $atts ) {
	extract( shortcode_atts( array(
		'size' => 'small',
		'bg_color' => '#636b74',
		'color' => '#fff',
		'text' => 'More',
		'title' => 'Click',
		'url' => '',
		'position' => 'left',
	), $atts ) );
	$btn  = "<div class=\"clear\"></div>";
	$btn .= "<a href=\"{$url}\" ";  
	$btn .= ($title != "") ? " title=\"{$title}\" " : "";
	$btn .= "class=\"simple-btn-{$size} btn-align-{$position}\" style=\"background-color:{$bg_color}; color:{$color}\">";
	$btn .= "{$text}</a>";
	$btn  .= "<div class=\"clear\"></div>";

	return $btn;
}
add_shortcode( 'simple_button', 'simple_button_func' );

function round_button_func( $atts ) {
	extract( shortcode_atts( array(
		'style' => 'dark',
		'text' => 'More',
		'title' => 'Click',
		'url' => '',
		'position' => 'left',
	), $atts ) );
	$btn  = "<div class=\"clear\"></div>";
	$btn .= "<a href=\"{$url}\" ";
	$btn .= ($title != "") ? " title=\"{$title}\" " : ""; 
	$btn .= "class=\"round-btn-{$style} round-btn btn-align-{$position}\">";
	$btn .= "<span>{$text}</span></a>";
	$btn  .= "<div class=\"clear\"></div>";

	return $btn;
}
add_shortcode( 'round_button', 'round_button_func' );

function msg_box_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'info',
		'bg_color' => '#f6f6f6',
		'color' => '#333',
		'start_color' => "#fff",
		'end_color' => "#eee",
		'border' => "#ccc",
		'align' => '',
		'width' => '100%',
	), $atts ) );
	$msg = '';

	if($type == 'success'){
		$msg  = '<div class="msg-success"><div class="msg-box-icon">';
		$msg .= ($content == '') ? "This is a sample of the 'success' style message box shortcode. To use this style use the following shortcode" : $content;
		$msg .= '</div></div>';
	}elseif($type == 'error'){
		$msg  = '<div class="msg-error"><div class="msg-box-icon">';
		$msg .= ($content == '') ? "This is a sample of the 'error' style message box shortcode. To use this style use the following shortcode." : $content;
		$msg .= '</div></div>';
	}elseif($type == 'warning'){
		$msg  = '<div class="msg-warning"><div class="msg-box-icon">';
		$msg .= ($content == '') ? "This is a sample of the 'warning' style message box shortcode. To use this style use the following shortcode." : $content;
		$msg .= '</div></div>';
	}elseif($type == 'info'){
		$msg  = '<div class="msg-info"><div class="msg-box-icon">';
		$msg .= ($content == '') ? "This is a sample of the 'info' style message box shortcode. To use this style use the following shortcode." : $content;
		$msg .= '</div></div>';
	}elseif($type == 'about'){
		$msg  = '<div class="msg-about"><div class="msg-box-icon">';
		$msg .= ($content == '') ? "This is a sample of the 'about' style message box shortcode. To use this style use the following shortcode." : $content;
		$msg .= '</div></div>';
	}elseif($type == 'custom'){
		$msg  = "<div style=\"width:{$width};\" class=\"msg-align-{$align}\"><div class=\"msg-custom\" style=\"background-color:{$end_color}; background: -moz-linear-gradient(center top , {$start_color}, {$end_color}); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from({$start_color}), to({$end_color})); background: -webkit-linear-gradient(top, {$start_color}, {$end_color}); background: -ms-linear-gradient(top, {$start_color}, {$end_color}); background: -o-linear-gradient(top, {$start_color}, {$end_color}); border:1px {$border} solid; color:{$color};\">";
		$msg .= ($content == '') ? "This is a sample of the 'simple' style message box shortcode." : $content;
		$msg .= '</div></div><div class="clear"></div>';
	}elseif($type == 'simple'){
		$msg  = "<div class=\"msg-simple\" style=\"background-color:{$bg_color}; color:{$color};\">";
		$msg .= ($content == '') ? "This is a sample of the 'simple' style message box shortcode." : $content;
		$msg .= '</div>';
	}
	return $msg;
}
add_shortcode( 'message', 'msg_box_func' );


function unorderedlist_func( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'style' => 'list-1',
	), $atts ) );
	$content = wpautop(trim($content));
	$ulist = '<ul class="'.$style.'">'.$content.'</ul>';
	return $ulist;
}
add_shortcode( 'unordered_list', 'unorderedlist_func' );


function heading_title_func( $atts, $content = null ) {
   extract( shortcode_atts( array(	
	'underline'	=> '',
	'align'		=> ''	
	), $atts ) ); 
	$hdntitle = '<h2 class="heading '.( (strtolower($underline) == 'yes') ? 'underline' : '' ).'" '.( ($align!='') ? 'style="text-align:'.$align.' !important;"' : '' ) .'>'.do_shortcode( $content ) .'</h2>'; 
    return $hdntitle;
}
add_shortcode( 'heading', 'heading_title_func' );

/*clients function*/
function skt_client_logos($atts, $content = null){
	return '<div class="owl-carousel">'.do_shortcode($content).'</div>';
	}
add_shortcode('client_lists','skt_client_logos');

function skt_client($atts){
	extract(shortcode_atts(array(
	'image'	=> '',
	'link'	=> '#',
	'clear'	=> ''
	), $atts));
	return '<div class="item '.$clear.'"><a href="'.$link.'" target="_blank"><img src="'.$image.'" /></a></div>';
	}
add_shortcode('client','skt_client');


// Latest Post
function latestpostsoutput_func( $atts ){
   extract( shortcode_atts( array(
		'show' => '',
		'catid' => '',
	), $atts ) );
	$postoutput = '';
	wp_reset_query();
	$n = 0;
	query_posts(  array( 'posts_per_page'=>$show, 'cat'=>$catid, 'post__not_in' => get_option('sticky_posts') )  );
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			$n++;
			if( $n%3==0 )  $nomgn = 'last';	else $nomgn = ' ';
			if ( has_post_thumbnail()) {
				$large_imgSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				$imgUrl = $large_imgSrc[0];
			}else{
				$imgUrl = get_template_directory_uri().'/images/img_404.png';
			}
			$postoutput .= '<div class="news-box '.$nomgn.'">
								<div class="news-thumb">
									<a href="'.get_the_permalink().'"><img src="'.$imgUrl.'" alt="" /></a>
								</div>
								<div class="news">
									<a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a>
									<div class="date-news">
										<span class="byadmin-home">Posted By <a href="'. esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>&nbsp;</span>
										<span>Posted On '.get_the_time('d-M-Y').'</span>
										
									</div>
									<p>'.wp_trim_words( get_the_content(), of_get_option('hmblogpostsexcerptlength'), '' ).'</p>
									 <a href="'.get_permalink().'" class="linkreadmore">'.of_get_option('latestpostsmoreinfo').'</a>
								</div>
                        </div>';	
						$postoutput .= ''.(($n%3==0) ? '<div class="clear"></div>' : '');	
		endwhile;
	endif;
	wp_reset_query();
	return $postoutput;
}
add_shortcode( 'latestposts', 'latestpostsoutput_func' );

define('SKT_THEME_DOC','http://sktthemesdemo.net/documentation/skt-yogi-doc/');