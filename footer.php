<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Yogi
 */
?>
<div id="footer-wrapper">
    	<div class="container">
        	
        	<?php if(!dynamic_sidebar('footer-1')) : ?>  
             <div class="cols-3 widget-column-1">            	
               <h5><?php if( of_get_option('aboutustitle') != '') { echo of_get_option('aboutustitle'); } ; ?></h5>
               <?php if( of_get_option('aboutdescription') != '') { echo of_get_option('aboutdescription'); } ; ?>
                <div class="clear"></div>    
              </div>                  
			<?php  endif; ?>
           
            
           
            <?php if(!dynamic_sidebar('footer-2')) : ?> 
             <div class="cols-3 widget-column-2">          
            	<h5><?php if( of_get_option('frptitle') != '') { echo of_get_option('frptitle'); } ; ?></h5>
               	<?php echo do_shortcode( '[footer-posts show="2" catid=""]') ;?>         
              </div>             
            <?php endif; ?>
          
            <?php if(!dynamic_sidebar('footer-3')) : ?>
              <div class="cols-3 widget-column-3">                
				<h5><?php if( of_get_option('usefullinktitle') != ''){ echo of_get_option('usefullinktitle');}; ?></h5>
               <a class="twitter-timeline" data-chrome="nofooter noheader noborders noscroll noscrollbar transparent" data-tweet-limit="1" data-link-color="#fff"  data-theme="dark" data-dnt="true" href="https://twitter.com/sktthemes"  data-widget-id="353086898853531648">Tweets by @sktthemes</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
</script>
               </div>
            <?php endif; ?>
            
            <?php if(!dynamic_sidebar('footer-4')) : ?>
              <div class="cols-3 widget-column-4">                
				<h5><?php if( of_get_option('contacttitle') != ''){ echo of_get_option('contacttitle');}; ?></h5>
                <p class="parastyle"><?php if( of_get_option('address',true) != '') { echo of_get_option('address',true) ; } ; ?><br />
                  <?php if( of_get_option('address2',true) != '') { echo of_get_option('address2',true) ; } ; ?></p>
                <div class="phone-no">
                	<p><?php if( of_get_option('phone',true) != ''){ ?>
                		<?php _e('Phone:','skt-yogi-pro'); ?> <?php echo of_get_option('phone'); ?>
                    <?php } ?><br />
                    <?php if( of_get_option('email',true) != '' ) { ?>
                    <?php _e('E-mail:','skt-yogi-pro'); ?> <a href="mailto:<?php echo of_get_option('email',true); ?>"> <?php echo of_get_option('email',true) ; ?></a>
                    <?php } ?><br />
                    <?php if( of_get_option('weblink',true) != ''){ ?>
                    <?php _e('Website:','skt-yogi-pro'); ?><a href="<?php echo of_get_option('weblink',true); ?>" target="_blank"> <?php echo of_get_option('weblink',true); ?></a>
                    <?php } ?></p>
                </div>   
                
                <div class="clear"></div>                
                <?php if( of_get_option('footersocialicons') != ''){ echo do_shortcode(of_get_option('footersocialicons', true));}; ?>
                
               </div>
            <?php endif; ?>
            
            <div class="clear"></div>
        </div><!--end .container-->
        
        <div class="copyright-wrapper">
        	<div class="container">
            	<div class="copyright-txt"><?php if( of_get_option('copytext',true) != ''){ echo of_get_option('copytext',true); }; ?> <?php if( of_get_option('ftlink', true) != ''){echo of_get_option('ftlink',true);}; ?></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php wp_footer(); ?>
<script>
	jQuery.fn.firstWord = function() {
	  var text = this.text().trim().split(" ");
	  var first = text.shift();
	  this.html((text.length > 0 ? "<span>"+ first + "</span> " : first) + text.join(" "));
	};
	jQuery(".widget-column-1 h5").firstWord();
</script>

<script>
	jQuery.fn.firstWord = function() {
	  var text = this.text().trim().split(" ");
	  var first = text.shift();
	  this.html((text.length > 0 ? "<span>"+ first + "</span> " : first) + text.join(" "));
	};
	jQuery(".widget-column-2 h5").firstWord();
</script>

<script>
	jQuery.fn.firstWord = function() {
	  var text = this.text().trim().split(" ");
	  var first = text.shift();
	  this.html((text.length > 0 ? "<span>"+ first + "</span> " : first) + text.join(" "));
	};
	jQuery(".widget-column-3 h5").firstWord();
</script>

<script>
	jQuery.fn.firstWord = function() {
	  var text = this.text().trim().split(" ");
	  var first = text.shift();
	  this.html((text.length > 0 ? "<span>"+ first + "</span> " : first) + text.join(" "));
	};
	jQuery(".widget-column-4 h5").firstWord();
</script>
</body>
</html>