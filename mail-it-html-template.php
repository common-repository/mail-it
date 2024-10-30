<?php
/*
 * Plugin Name: MailIt! - HTML WordPress Email Template
 * Description: Send HTML Emails, use HTML Mail Template for WordPress, WooCommerce, Contact7, Ninja, WP Forms
 * Version: 3.0
 * Author: extendWP
 * Author URI: https://extend-wp.com
 *
 * WC requires at least: 2.2
 * WC tested up to: 5.4
 * 
 * License: GPL2
 * Created On: 01-04-2019
 * Updated On: 23-03-2021
 * Text Domain:       mail-it
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /lang 
 */
if ( !defined( 'ABSPATH' ) ) exit;

include_once( plugin_dir_path(__FILE__) ."includes/mail-it_settings.php");


add_action('plugins_loaded', 'mailIt_translate');
function mailIt_translate() {
	load_plugin_textdomain( 'mailIt', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}

function mailIt_scripts(){
    
    wp_enqueue_style( 'mailIt_style', plugins_url( '/css/mailIt_style.css', __FILE__  ) );	
	wp_enqueue_style( 'mailIt_style');

	wp_enqueue_style( 'mailIt_ui_style', plugins_url( '/css/jquery-ui.css', __FILE__  ) );	
	if( ! wp_script_is( "mailIt_fa", 'enqueued' ) ) {
		wp_enqueue_style( "mailIt_fa", plugins_url( '/css/font-awesome.min.css', __FILE__ ));
	}
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'mailIt_script', plugins_url( '/js/mailIt_script.js', __FILE__  ) , array('jquery','jquery-ui-tabs','jquery-ui-accordion','wp-color-picker') , null, true);
    

    $mailIt = array( 
        'noticeOk' => esc_html__("Once you save the Email, email will be sent to ","mail-it"),
         'noticeNotOk' => esc_html__("Dont forget to insert an Email Address","mail-it"),
		 'emailCopied' => esc_html__("Emails Copied Successfully","mail-it"),
		 'replaceEmails' => esc_html__("Place these emails in the 'Mail TO' field?","mail-it"),
		 'sendNow' => esc_html__("You want to send it now?","mail-it"),
		 'fontsCss' => plugins_url( '/css/fonts.css', __FILE__  ),
		 'showLess' => esc_html__("Minimize Preview","mail-it"),
		 'showMore' => esc_html__('Expand Preview','mail-it')
    );
    wp_localize_script( 'mailIt_script', 'mailIt', $mailIt );
	wp_enqueue_script( 'mailIt_script');
}
add_action('admin_enqueue_scripts', 'mailIt_scripts');


register_activation_hook( __FILE__, 'mailItActivation' );

function mailItActivation(){
	require_once(ABSPATH .'/wp-admin/includes/plugin.php');
	$pro = "/mailit-html-mail-template-woocommerce/mailit-html-mail-template-woocommerce.php";
	deactivate_plugins($pro);	
}

add_filter('widget_text', 'do_shortcode');


add_action( 'admin_menu', 'mailIt_menu_page' );
function mailIt_menu_page() {
  add_menu_page(esc_html__( 'Mail It Configuration', 'mail-it' ),esc_html__("Mail It!","mail-it"), 'administrator', 'mail-it', 'mailIt_settings', 'dashicons-email-alt','50');
  add_submenu_page( 'mail-it', esc_html__("All Emails","mail-it"), esc_html__("All Emails *","mail-it"), 'manage_options', 'admin.php?page=mail-it&allmails', NULL );
  add_submenu_page( 'mail-it', esc_html__("New Email","mail-it"), esc_html__("New Email * ","mail-it"), 'manage_options', 'admin.php?page=mail-it&addnew', NULL );
}


add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'mailIt_links' );

function mailIt_links ( $links ) {
 $links[] =  '<a href="' . esc_url( admin_url( 'admin.php?page=mail-it' ) ) . '">Settings</a>';
 return $links;
}



function mailIt_settings() {
	?>
	<div class="mailIt_wrap">

	
	<img  src='<?php echo esc_url( plugins_url( 'images/mailit-landscape.jpg', __FILE__ ) ); ?>'  />

	<div class='clearfix'>
	<div class='column-23'>
	
        <div id="tabs">
            <ul>
                <li><a class='mailIt_generalTab' href="#mailIt_general"><span><?php print esc_html__('Mail It!','mail-it'); ?></span></a></li>
                <li><a class='mailIt_htmlTemplate' href="#htmlTemplate"><span><?php print esc_html__('HTML Template','mail-it'); ?></span></a></li>
				<li><a class='mailIt_hideSubmit' href="#mailIt_instr"><span><?php print esc_html__('Knowledge Base','mail-it'); ?></span></a></li>				
				<li><a class='mailIt_hideSubmit   mailItModalpRO' href="#mailIt_woocusts"><span><?php print esc_html__('WooCommerce Customers','mail-it'); ?></span></a></li>				
				
				<li><a class='mailIt_hideSubmit  mailItModalpRO proUrl ' href="#mailIt_woocusts"><span><?php print esc_html__('GoPro!','mail-it'); ?></span></a></li>
            </ul>			
			
			<div id="mailIt_woocusts"></div>

			<form method="post" id='mailItint_form'  action= "<?php echo esc_url( admin_url( "admin.php?page=mail-it" ) ); ?>">
				
				<div id="mailIt_general">
					
					<div class="subtabs">
						<ul>
							<li><a class='mailIt_send' href="#mailIt_send"><span><?php print esc_html__('General','mail-it'); ?></span></a></li>
							<li><a href="#mailIt_smtp"><span><?php print esc_html__('SMTP','mail-it'); ?></span></a></li>
						</ul>

						<div id="mailIt_send">
							<?php
							settings_fields( 'mailIt-general-options' );
							do_settings_sections( 'mailIt-general-options' );
							?>               
						</div>
						<div id="mailIt_smtp">
							<?php
							settings_fields( 'mailIt-smtp-options' );
							do_settings_sections( 'mailIt-smtp-options' );
							?>               
						</div>						
					</div>
					
				</div>			
				
				<div id="htmlTemplate">
				
					<div class="subtabs firstCol ">
						<ul>
							<li><a href="#mailIt_tab-2"><span><?php print esc_html__('Header','mail-it'); ?></span></a></li>
							<li><a href="#mailIt_tab-3"><span><?php print esc_html__('Content','mail-it'); ?></span></a></li>
							<li><a href="#mailIt_tab-4"><span><?php print esc_html__('Footer','mail-it'); ?></span></a></li>
							<li><a href="#mailIt_tab-5"><span><?php print esc_html__('Extra CSS','mail-it'); ?></span></a></li>
						</ul>
						
						<table class="form-table ">
							<tbody>
								<tr>
									<th>
									<label><?php print esc_html__('Do not Use Template with Other Plugins - default','sendEmail'); ?></label>
									<small><?php print esc_html__('Toggle in pro version','sendEmail'); ?></small>
									</th>
									<td>
									<input type="checkbox"  disabled name="mailItHtml_useTemplatePlugins" id="mailItHtml_useTemplatePlugins" value='true' />
									</td>
								</tr>
							</tbody>
						</table>

						
						<div id="mailIt_tab-2" >
							<?php
								settings_fields( 'mailIt-header-options' );
								do_settings_sections( 'mailIt-header-options' );
							?>
						</div>
						<div id="mailIt_tab-3" >
							<?php
								settings_fields( 'mailIt-content-options' );
								do_settings_sections( 'mailIt-content-options' );
							?>               
						</div>
						<div id="mailIt_tab-4" >
							<?php
								settings_fields( 'mailIt-footer-options' );
								do_settings_sections( 'mailIt-footer-options' );
							?>               
						</div>   
						
						<div id="mailIt_tab-5" >
							<blockquote>
								<?php esc_html_e("Classes you can use for the email template: .emailWrapper, .emailHeader, .emailContent, .emailFooter","mail-it"); ?>
							</blockquote>
							<?php
								settings_fields( 'mailIt-css-options' );
								do_settings_sections( 'mailIt-css-options' );
							?>               
						</div>

					</div>
					<div class="subtabs secCol">
						<ul>
							<li><a class='mailIt_preview' href="#mailIt_temPreview"><span><?php print esc_html__('Expand Preview','mail-it'); ?></span></a></li>
						</ul>
						
						<div id="mailIt_temPreview">
							<?php
							   mailIt_preview() ;
							?>               
						</div>
										
					</div>
				</div>
				 
				<div id="mailIt_instr">

				   <h3>
					   <?php esc_html_e('SCOPE','mail-it'); ?>
				   </h3>				   
				    <p>
						<b><?php esc_html_e('The purpose of this plugin is to: ','mail-it'); ?></b>
					</p>
						<p> - <?php esc_html_e('Send HTML Email Instantly','mailIt'); ?></p>
						<p> - <?php esc_html_e('Create a Header and Footer Template along with customizing Colors and Backgrounds Globally on your site on the Emails sent from other plugins','mail-it'); ?></p>
						<p> -- <?php esc_html_e('LIVE Preview of how the template will look like.','mail-it'); ?></p>
						<p> - <?php esc_html_e('SMTP configuration to make sure things will work properly','mail-it'); ?></p>
						
				   <h3>
					   <?php esc_html_e('HOW TO','mail-it'); ?>
				   </h3>
				   
					<div id="accordion">
						
						<h3><?php esc_html_e('How to send an email?','mail-it'); ?></h3>
						<div>
							 <p><?php esc_html_e('You navigate to the configuration screen, select HTML TEMPLATE ','mail-it'); ?></p>
							 <p><?php esc_html_e('Define header, content and footer along with styling customization','mail-it'); ?></p>
							 <p><?php esc_html_e('Header and footer are globally defined','mail-it'); ?></p>
							 <p><?php esc_html_e('You use the Content Editor in configuation screen fonr the actual body of your email.','mail-it'); ?></p>
							 <p><?php esc_html_e('Then navigate to "Mail it!" tab and add all the necessary info along with the email address where you want to email.','mail-it'); ?></p>
							 <p><?php esc_html_e('Select "Subject", "From Name", "From Email"  and  ','mail-it'); ?></p>
							 <p><?php esc_html_e('finally, press "Send Email Now". ','mail-it'); ?></p>
						</div>	

						<h3><?php esc_html_e('How does HTML Template Works?','mail-it'); ?></h3>
						<div>
							 <p><?php esc_html_e('Once you define HEADER and FOOTER on Configuration / HTML TEMPLATE,','mail-it'); ?></p>
							 <p><?php esc_html_e('these will be the default header and footer that will be used on email sent either from the plugin or ','mail-it'); ?></p>
							 <p><?php esc_html_e('from other popupal that send emails','mail-it'); ?></p>
						</div>	

						<h3><?php esc_html_e('With which plugins is Mail It Compatible','mail-it'); ?></h3>
						<div>
							 <p><?php esc_html_e('The plugin has been tested and is compatible with:','mail-it'); ?></p>
							 <p>-<?php esc_html_e('WooCommerce','mail-it'); ?></p>
							 <p>-<?php esc_html_e('Contact 7','mail-it'); ?></p>
							 <p>-<?php esc_html_e('Ninja Forms','mail-it'); ?></p>
						     <p>-<?php esc_html_e('WP Forms','mail-it'); ?></p>
							 <p><?php esc_html_e('It overrides the template of these plugins by adding header and footer, styling the content (background-color-padding-font-alignment)','mail-it'); ?></p>
							 <p><?php esc_html_e('It also overrides contact forms created with custom PHP code using wp_mail function.','mail-it'); ?></p>
						</div>	

						<h3><?php esc_html_e('How can I email my WooCommerce Customers?','mail-it'); ?></h3>
						<div>
							 <p class='bottomToUp'>
								<?php esc_html_e('This feature is availabe in the ','mail-it'); ?>
								<a target='_blank' class='proUrl' href='https://extend-wp.com/product/mail-it-html-mail-template-wordpress-woocommerce-customers/'><?php esc_html_e('PRO VERSION','mail-it'); ?></a>
							 </p>
							 <p>
								<?php esc_html_e('Get it ','mail-it'); ?>
								<a target='_blank' class='proUrl' href='https://extend-wp.com/product/mail-it-html-mail-template-wordpress-woocommerce-customers/'><?php esc_html_e('here','mail-it'); ?></a>
							 </p>
						</div>

						<h3><?php esc_html_e('How to use SMTP?','mail-it'); ?></h3>
						<div>
							 <p><?php esc_html_e('Go to Configuration / SMTP','mail-it'); ?></p>
							 <p><?php esc_html_e('Define:','mail-it'); ?></p>
							 <ul>
								<li><?php esc_html_e('Host','mail-it'); ?></li>
								<li><?php esc_html_e('Authentication','mail-it'); ?></li>
								<li><?php esc_html_e('Port','mail-it'); ?></li>
								<li><?php esc_html_e('Username','mail-it'); ?></li>
								<li><?php esc_html_e('Password','mail-it'); ?></li>
								<li><?php esc_html_e('Encryption','mail-it'); ?></li>
							 </ul>
						</div>
						
						<h3><?php esc_html_e('Can I send Email in BULK?','mail-it'); ?></h3>
						<div>
							 <p class='bottomToUp'>
								<?php esc_html_e('This feature is availabe in the ','mail-it'); ?>
								<a target='_blank' class='proUrl' href='https://extend-wp.com/product/mail-it-html-mail-template-wordpress-woocommerce-customers/'><?php esc_html_e('PRO VERSION','mail-it'); ?></a>
							 </p>
							 <p>
								<?php esc_html_e('Get it ','mail-it'); ?>
								<a target='_blank' class='proUrl' href='https://extend-wp.com/product/mail-it-html-mail-template-wordpress-woocommerce-customers/'><?php esc_html_e('here','mail-it'); ?></a>
							 </p>
						</div>					
					</div>

				</div>

				
				<?php wp_nonce_field('mailIt'); ?>	
				<p><?php submit_button(); ?></p>
			
			</form>	
		
        </div>

		<div class='sendMailResult'><?php mailIt_processData(); ?></div>
		
		</div>
		
		<div class='column-13 rightToLeft'>
				<div class='proRight'>
				
					<center>
						<a target='_blank' href=''>
							<img style='width:90%' src='<?php echo esc_url( plugins_url( 'images/mailIt-pro.png', __FILE__ ) ); ?>' style='width:100%' />
							</a>
							<h3><?php esc_html_e('Go PRO for more features!','mail-it'); ?></h3>
					</center>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Choose to Override other plugins Template or not','mail-it'); ?></p>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Post Type for writing and storing email to send','mail-it'); ?></p>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Choose between a template from the template ot the content editor for your email body.','mail-it'); ?></p>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Send Emails in Bulk instantly','mail-it'); ?></p>					
					<p><i class='fa fa-check'></i> <?php esc_html_e('Search WooCommerce Customers Emails and Send','mail-it'); ?></p>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Google Fonts included in the Customization','mail-it'); ?></p>
					<p class='bottomToUp'><center><a target='_blank' class='proUrl' href='https://extend-wp.com/product/mail-it-html-mail-template-wordpress-woocommerce-customers/'><?php esc_html_e('GET IT HERE','mail-it'); ?></a></p>

				</div>
		</div>	
		
		</div>	
		<?php mailItAdminFooter(); ?>
	</div>

	<?php  
	
}

function mailItAllowedHtml() {
	
$mailIt_allowed_html = array(
            'a' => array(
                'style' => array(),
                'href' => array(),
                'title' => array(),
                'class' => array(),
                'id'=>array()                   
            ),
            'br' => array('style' => array(),'class' => array(),'id'=>array() ),
            'em' => array('style' => array(),'class' => array(),'id'=>array() ),
            'strong' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h1' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h2' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h3' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h4' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h5' => array('style' => array(),'class' => array(),'id'=>array() ),
            'h6' => array('style' => array(),'class' => array(),'id'=>array() ),
            'img' => array('style' => array(),'class' => array(),'id'=>array() ),
            'p' => array('style' => array(),'class' => array(),'id'=>array() ),
            'div' => array('style' => array(),'class' => array(),'id'=>array() ),
            'section' => array('style' => array(),'class' => array(),'id'=>array() ), 
            'ul' => array('style' => array(),'class' => array(),'id'=>array() ),
            'li' => array('style' => array(),'class' => array(),'id'=>array() ),
            'ol' => array('style' => array(),'class' => array(),'id'=>array() ),
            'video' => array('style' => array(),'class' => array(),'id'=>array() ),
            'blockquote' => array('style' => array(),'class' => array(),'id'=>array() ),
            'figure' => array('style' => array(),'class' => array(),'id'=>array() ),
            'figcaption' => array('style' => array(),'class' => array(),'id'=>array() ),
            'style' => array(),
            'iframe' => array(
                'height' => array(),
                'src' => array(),
                'width' => array(),
                'allowfullscreen' => array(),
                'style' => array(),
                'class' => array(),
                'id'=>array()                
            ),             
            'img' => array(
                'alt' => array(),
                'src' => array(),
                'title' => array(),
                'style' => array(),
                'class' => array(),
                'id'=>array()
            ), 
            'video' => array(
                'width' => array(),
                'height' => array(),
                'controls'=>array(),
                'class' => array(),
                'id'=>array()
            ),  
            'source' => array(
                'src' => array(),
                'type' => array(),
                'class' => array(),
                'id'=>array()
            ),             
        );
		return $mailIt_allowed_html;
}

function mailIt_Action(){

			$allowed_html = mailItAllowedHtml();
			
			
            $to = esc_html(get_option('mailIt_to'));
			
			if(!empty(get_option('mailIt_subject'))){
				$subject = esc_html(get_option('mailIt_subject'));
			}else $subject = esc_html(get_bloginfo('name') . " Email");

			if(!empty(get_option('mailIt_fromName'))){
				$FromName   = esc_html(get_option('mailIt_fromName'));
			}else $FromName = esc_html(get_bloginfo('name'));

			if(!empty(get_option('mailIt_fromEmail'))){
				$From   = esc_html(get_option('mailIt_fromEmail'));
			}else $From = esc_html(get_bloginfo('admin_email') );
	
			$mailIt_content = do_shortcode( get_option('mailIt_content') );
			
        	ob_start();			
					if( get_option('mailIt_select_Template')  && get_option('mailIt_select_Template') !=='' ){ ?>
                        <?php $templateContent = apply_filters('the_content', get_post_field('post_content', esc_html(get_option('mailIt_select_Template') ) ) ); ?>
                        <?php print $templateContent; ?>
                     <?php }else{ ?>
            	        <?php print $mailIt_content; ?>                     
                     <?php } 

        	$body = ob_get_clean();
		   
           $headers = array("Content-Type: text/html; charset=UTF-8; From: ".$FromName." <".$From.">");
		   $to = explode(",",$to);
		   		   
				   
				
		   foreach($to as $t){
				$sent_message = wp_mail( $t, $subject, wp_kses($body, $allowed_html)  , $headers );

				if ( $sent_message ) {
				?>
					<div class="notice notice-success is-dismissible">
						<p><?php esc_html_e( "Email sent to ".esc_html($t), 'mail-it' ); ?></p>
					</div> 
				<?php
				} else {
				?>
					<div class="notice notice-error is-dismissible">
						<p><?php esc_html_e( "Email not sent to ".esc_html($t), 'mail-it' ); ?></p>
					</div> 
				<?php
				}
							
		   } 
		   
}


function mailIt_style(){
	
	global $mailIt_safeWebFonts;
	?>
                <style>
                    .aligncenter{text-align:center;}
                    .alignleft{text-align:left;}
                    .alignright{text-align:right;}
                    
                    .mailItWrapper{
                        max-width:100%;
                        position:relative;
                    }
                    .mailItHeader,.mailItContent,.mailItFooter{
                        padding:10px;
                        box-sizing:border-box;                        
                    }
                    
                    .mailItWrapper img, .mailItWrapper iframe, .mailItWrapper video{
                        max-width:100% !important;
                        height:auto !important;
                    }
                    					
                    .mailItHeader{
                            <?php if( get_option('mailIt_header_background') ){ ?>
                                background:  <?php print esc_html(get_option('mailIt_header_background')); ?> !important;
                            <?php } ?>
                            <?php if( get_option('mailIt_header_color') ){ ?>
                                color:  <?php print esc_html(get_option('mailIt_header_color')); ?> !important;
                            <?php } ?>  
                            <?php if( get_option('mailIt_header_padding') ){ ?>
                                padding:  <?php print esc_html(get_option('mailIt_header_padding')); ?>px !important;
                            <?php } ?>	
                            <?php if( get_option('mailIt_header_alignment') ){ ?>
                                text-align:  <?php print esc_html(get_option('mailIt_header_alignment')); ?> !important;
                            <?php } ?>	
                            <?php if( get_option('mailIt_header_font') ){ ?>
                                font-family:  '<?php print esc_html(get_option('mailIt_header_font')); ?>' !important;
                            <?php } ?>		
                            <?php if( get_option('mailIt_header_size') ){ ?>
                                font-size:  <?php print esc_html(get_option('mailIt_header_size')); ?>px !important;
                            <?php } ?>								
                    }
					.mailItContent > *{
                            <?php if( get_option('mailIt_header_size') ){ ?>
                                font-size:  <?php print esc_html(get_option('mailIt_header_size')); ?>px !important;
                            <?php } ?>						
					}						
					
                    
                    .mailItContent{
                            <?php if( get_option('mailIt_content_background') ){ ?>
                            background:  <?php print esc_html(get_option('mailIt_content_background')); ?> !important;
                             <?php } ?>
                            <?php if( get_option('mailIt_content_color') ){ ?>
                            color:  <?php print esc_html(get_option('mailIt_content_color')); ?> !important;
                             <?php } ?>   
                            <?php if( get_option('mailIt_content_padding') ){ ?>
                                padding:  <?php print esc_html(get_option('mailIt_content_padding')); ?>px !important;
                            <?php } ?>	
                            <?php if( get_option('mailIt_content_alignment') ){ ?>
                                text-align:  <?php print esc_html(get_option('mailIt_content_alignment')); ?> !important;
                            <?php } ?>
                            <?php if( get_option('mailIt_content_font') ){ ?>
                                font-family:  '<?php print esc_html(get_option('mailIt_content_font')); ?>' !important;
                            <?php } ?>	
                            <?php if( get_option('mailIt_content_size') ){ ?>
                                font-size:  <?php print esc_html(get_option('mailIt_content_size')); ?>px !important;
                            <?php } ?>	
													
                    }  
					.mailItContent>*{
                            <?php if( get_option('mailIt_content_size') ){ ?>
                                font-size:  <?php print esc_html(get_option('mailIt_content_size')); ?>px !important;
                            <?php } ?>	
                            <?php if( get_option('mailIt_content_background') ){ ?>
                            background:  <?php print esc_html(get_option('mailIt_content_background')); ?> !important;
                             <?php } ?>
                            <?php if( get_option('mailIt_content_color') ){ ?>
                            color:  <?php print esc_html(get_option('mailIt_content_color')); ?> !important;
                             <?php } ?>  
                            <?php if( get_option('mailIt_content_font') ){ ?>
                                font-family:  '<?php print esc_html(get_option('mailIt_content_font')); ?>' !important;
                            <?php } ?>	                             
					}					

					#x_wrapper, .mailItContent table,.mailItContent table #template_container , .mailItContent table #wrapper, .mailItContent table table td, .mailItContent table table tr, .mailItContent table div,
					.mailItContent tr,.emailContent td,.emailContent tbody td,.emailContent thead,.emailContent div, .emailContent p , .emailContent a , .emailContent #template_header, .emailContent #template_body,
					.mailItContent h1, .mailItContent p,.mailItContent #body_content_inner, .mailItContent #body_content_inner h1, .mailItContent #body_content_inner th, .mailItContent #body_content_inner p,.mailItContent #body_content_inner h2,.mailItContent .address,.mailItContent #addresses{
                        <?php if( get_option('mailIt_content_background') ){ ?>
                           background:  <?php print esc_html(get_option('mailIt_content_background')); ?> !important;
                        <?php } ?>
                        <?php if( get_option('mailIt_content_color') ){ ?>
                            color:  <?php print esc_html(get_option('mailIt_content_color')); ?> !important;
                        <?php } ?>                         
						margin-top:10px !important;
						margin-bottom:10px !important;
						padding-top:10px !important;
						padding-bottom:10px !important;	
                            <?php if( get_option('mailIt_content_font') ){ ?>
                                font-family:  '<?php print esc_html(get_option('mailIt_content_font')); ?>' !important;
                            <?php } ?>							
					}
					.mailItContent #wrapper{
						padding-top:0px !important;
						padding-bottom:0px !important;						
					}
                    
                    .mailItFooter{
                            <?php if( get_option('mailIt_footer_background') ){ ?>
                            background:  <?php print esc_html(get_option('mailIt_footer_background')); ?> !important;
                             <?php } ?>
                            <?php if( get_option('mailIt_footer_color') ){ ?>
                            color:  <?php print esc_html(get_option('mailIt_footer_color')); ?> !important;
                             <?php } ?> 
                            <?php if( get_option('mailIt_footer_padding') ){ ?>
                                padding:  <?php print esc_html(get_option('mailIt_footer_padding')); ?>px !important;
                            <?php } ?>	
                            <?php if( get_option('mailIt_footer_alignment') ){ ?>
                                text-align:  <?php print esc_html(get_option('mailIt_footer_alignment')); ?> !important;
                            <?php } ?>
                            <?php if( get_option('mailIt_footer_font') ){ ?>
                                font-family:  '<?php print esc_html(get_option('mailIt_footer_font')); ?>' !important;
                            <?php } ?>	
                            <?php if( get_option('mailIt_footer_size') ){ ?>
                                font-size:  <?php print esc_html(get_option('mailIt_footer_size')); ?>px !important;
                            <?php } ?>								
                    }
					.mailItFooter > *{
                            <?php if( get_option('mailIt_footer_size') ){ ?>
                                font-size:  <?php print esc_html(get_option('mailIt_footer_size')); ?>px !important;
                            <?php } ?>							
					}
                    
                     
                     <?php if( get_option('mailIt_css') ){ ?>
                        <?php print esc_html(get_option('mailIt_css')); ?>
                     <?php } ?>
                    
                </style> 	
<?php	
}

function mailIt_preview(){
            $mailIt_header = do_shortcode( get_option('mailIt_header') );
            $mailIt_content = do_shortcode( get_option('mailIt_content') );
            $mailIt_footer = do_shortcode( get_option('mailIt_footer') );

			$allowed_html = mailItAllowedHtml();
			
			
			
        	mailIt_style();
				
			print "<div class='mailItWrapper'>
			<div class='mailItHeader'>".wp_kses($mailIt_header, $allowed_html)."</div>
			<div class='mailItContent'>";
				print wp_kses($mailIt_content, $allowed_html);			
			print "</div>
			<div class='mailItFooter'>".wp_kses($mailIt_footer, $allowed_html)."</div>
			</div>";


			
					
}

function mailIt_template($args){
			
			$allowed_html = mailItAllowedHtml();
            $mailIt_header = wp_kses(  do_shortcode( get_option('mailIt_header') ) , $allowed_html);
            $mailIt_content = wp_kses(  do_shortcode( get_option('mailIt_content') ) , $allowed_html);
            $mailIt_footer = wp_kses(  do_shortcode( get_option('mailIt_footer') ) , $allowed_html);
			
        	ob_start(); 
			
        	mailIt_style();
			
		$style= ob_get_contents(); 
		
			ob_end_clean();				

		$args['message'] = $style. "
		<div class='mailItWrapper' style='max-width: 100%; position: relative; '>
			<div class='mailItHeader' 
			style='background:  ".esc_html(get_option('mailItHtml_header_background'))."  !important; 
			color:  ".esc_html(get_option('mailIt_header_color'))."  !important; 
            text-align:  ".esc_html(get_option('mailIt_header_alignment'))." !important; 
			font-family:  ".esc_html(get_option('mailIt_header_font'))."  !important; 
            font-size:  ".esc_html(get_option('mailIt_header_size'))."px  !important; 
			padding:  ".esc_html(get_option('mailIt_header_padding'))."px  !important; 
			box-sizing:border-box;	'
			 >".$mailIt_header."</div>
			<div class='mailItContent' 
			style='background:  ".esc_html(get_option('mailIt_content_background'))."  !important; 
			color:  ".esc_html(get_option('mailIt_content_color'))."  !important; 
            text-align:  ".esc_html(get_option('mailIt_content_alignment'))." !important; 
			font-family:  ".esc_html(get_option('mailIt_content_font'))."  !important;	 
            font-size:  ".esc_html(get_option('mailIt_content_size'))."px  !important; 	
			padding:  ".esc_html(get_option('mailIt_content_padding'))."px  !important; 
			box-sizing:border-box;	'
			>
			".$args['message'] . "</div>
			<div class='mailItFooter' 
			style='background:  ".esc_html(get_option('mailIt_footer_background'))."  !important; 
			color:  ".esc_html(get_option('mailIt_footer_color'))."  !important; 
            text-align:  ".esc_html(get_option('mailIt_footer_alignment'))." !important; 
			font-family:  ".esc_html(get_option('mailIt_footer_font'))."  !important; 	
            font-size:  ".esc_html(get_option('mailIt_footer_size'))."px  !important;	 
			padding:  ".esc_html(get_option('mailIt_footer_padding'))."px  !important; 
			box-sizing:border-box;	'	
			
			>".$mailIt_footer."</div>
			</div>";	
	
		return $args;
		
		
		
}
add_filter('wp_mail', 'mailIt_template');


add_action("admin_footer", "mailIt_proModal" );
function  mailIt_proModal(){ ?>
		<div id="mailItModal">
		  <div class="modal-content">
			<div class='clearfix'><span class="close">&times;</span></div>
			<div class='clearfix verticalAlign'>
				<div class='columns2'>
					<center>
						<img style='width:90%' src='<?php echo esc_url( plugins_url( 'images/mailIt-pro.png', __FILE__ ) ); ?>'  />
					</center>
				</div>
				
				<div class='columns2'>
					<center>
						<h3><?php esc_html_e('Go PRO for more features!','mail-it'); ?></h3>
					</center>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Choose to Override other plugins Template or not','mail-it'); ?></p>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Post Type for writing and storing email to send','mail-it'); ?></p>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Choose between a template from the template ot the content editor for your email body.','mail-it'); ?></p>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Send Emails in Bulk instantly','mail-it'); ?></p>					
					<p><i class='fa fa-check'></i> <?php esc_html_e('Search WooCommerce Customers Emails and Send','mail-it'); ?></p>
					<p><i class='fa fa-check'></i> <?php esc_html_e('Google Fonts included in the Customization','mail-it'); ?></p>

					<p class='bottomToUp'><center><a target='_blank' class='proUrl' href='https://extend-wp.com/product/mail-it-html-mail-template-wordpress-woocommerce-customers/'><?php esc_html_e('GET IT HERE','mail-it'); ?></a></center></p>
				</div>
			</div>
		  </div>
		</div>		
		<?php
}

function mailItAdminFooter(){ ?>	
		
	<hr>
	<br/>
	<a target='_blank' class='webLogo' href='https://webdeveloping.gr/product-category/wordpress-plugins/'>
		<img  src='<?php echo plugins_url( 'images/extendwp.png', __FILE__ ); ?>' alt='Get more plugins by webdeveloping.gr' title='Get more plugins by webdeveloping.gr' />
	</a>
	<center><a target='_blank' class='proUrl' href='https://extend-wp.com/product/mail-it-html-mail-template-wordpress-woocommerce-customers/'><?php esc_html_e('GET PRO VERSION','mail-it'); ?></a></center>
	<?php 
}