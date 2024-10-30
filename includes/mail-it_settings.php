<?php
if ( !defined( 'ABSPATH' ) ) exit;

include_once( plugin_dir_path(__FILE__) ."mail-it_fonts.php");

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
	
function mailIt_header(){
	
    global $mailIt_allowed_html;
    if( isset($_REQUEST['mailIt_header'] ) ){
        $mailIt_header =  wp_kses($_REQUEST['mailIt_header'], $mailIt_allowed_html);
    }else $mailIt_header = get_option( 'mailIt_header' );
    echo wp_editor( $mailIt_header, 'mailIt_header', array("wpautop" => true, "tabindex" => 1, "teeny" => true,'textarea_name' => 'mailIt_header','editor_height' => 425  ) );  
}



function mailIt_content(){
	
	global $mailIt_allowed_html;
    if( isset($_REQUEST['mailIt_content'] ) ){
        $mailIt_content =  wp_kses($_REQUEST['mailIt_content'], $mailIt_allowed_html);
    }else $mailIt_content = get_option( 'mailIt_content' );
    
    echo wp_editor( apply_filters( 'the_content',$mailIt_content), 'mailIt_content', array("wpautop" => true, "tabindex" => 1, "teeny" => true,'textarea_name' => 'mailIt_content', 'textarea_rows' => '20','editor_height' => 425)  ); 
    
}


function mailIt_footer(){
	
	global $mailIt_allowed_html;
    
    if( isset($_REQUEST['mailIt_content'] ) ){
        $mailIt_footer =  wp_kses($_REQUEST['mailIt_footer'], $mailIt_allowed_html);
    }else $mailIt_footer = get_option( 'mailIt_footer' );
    echo wp_editor( $mailIt_footer, 'mailIt_footer', array("wpautop" => true, "tabindex" => 1, "teeny" => true,'textarea_name' => 'mailIt_footer','editor_height' => 325)  );   
}



function mailIt_footer_background(){
    if( isset($_REQUEST['mailIt_footer_background'] ) ){
        $mailIt_footer_background =  sanitize_text_field($_REQUEST['mailIt_footer_background']);
    }else $mailIt_footer_background = get_option( 'mailIt_footer_background' );    
	?>
    	<input type="text" class='color' name="mailIt_footer_background" id="mailIt_footer_background" placeholder='<?php print esc_html__('Select Footer BG Color','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_footer_background); ?>"  />
    	
    <?php   
}

function mailIt_footer_color(){
    if( isset($_REQUEST['mailIt_footer_color'] ) ){
        $mailIt_footer_color =  sanitize_text_field($_REQUEST['mailIt_footer_color']);
    }else $mailIt_footer_color = get_option( 'mailIt_footer_color' );    
	?>
    	<input type="text" class='color' name="mailIt_footer_color" id="mailIt_footer_color" placeholder='<?php print esc_html__('Select Footer Color','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_footer_color); ?>"  />
    	
    <?php   
}

function mailIt_footer_alignment(){
    if( isset($_REQUEST['mailIt_footer_alignment'] ) ){
        $mailIt_footer_alignment =  sanitize_text_field($_REQUEST['mailIt_footer_alignment']);
    }else $mailIt_footer_alignment = get_option( 'mailIt_footer_alignment' );    
	?>
	<select  name="mailIt_footer_alignment" id="mailIt_footer_alignment" placeholder='<?php print esc_html__('Align','mail-it'); ?>' >
		<option value='' ><?php print esc_html__('Alignment','mail-it'); ?></option>
		<option value='left' <?php if($mailIt_footer_alignment === 'left') print "selected='selected'"; ?> ><?php print esc_html__('Left','mail-it'); ?></option>
		<option value='center' <?php if($mailIt_footer_alignment === 'center') print "selected='selected'"; ?> ><?php print esc_html__('Center','mail-it'); ?></option>
		<option value='right' <?php if($mailIt_footer_alignment === 'right') print "selected='selected'"; ?> ><?php print esc_html__('Right','mail-it'); ?></option>
	</select>
	    	
    <?php   
}
function mailIt_footer_font(){
	
	global $mailIt_Fonts;
    if( isset($_REQUEST['mailIt_footer_font'] ) ){
        $mailIt_footer_alignment =  sanitize_text_field($_REQUEST['mailIt_footer_font']);
    }else $mailIt_footer_font = get_option( 'mailIt_footer_font' );    
	?>
	<select  name="mailIt_footer_font" id="mailIt_footer_font" placeholder='<?php print esc_html__('Font','mail-it'); ?>' >
		<option value='' ><?php print esc_html__('Select','mail-it'); ?></option>
		<?php foreach($mailIt_Fonts as $font){ ?>
			<option value='<?php print esc_html($font); ?>' <?php if($mailIt_footer_font === esc_html($font)) print "selected='selected'"; ?> ><?php print esc_html($font); ?></option>
		<?php } ?>
	</select>
	    	
    <?php   
}

function mailIt_footer_size(){
    if( isset($_REQUEST['mailIt_footer_size'] ) ){
        $mailIt_footer_size =  sanitize_text_field($_REQUEST['mailIt_footer_size']);
    }else $mailIt_footer_size = get_option( 'mailIt_footer_size' );    
	?>
    <input type="number" min="0" name="mailIt_footer_size" id="mailIt_footer_size" placeholder='<?php print esc_html__('Font Size','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_footer_size); ?>"  /> <b>px</b>		   	
    <?php   
}

function mailIt_footer_padding(){
    if( isset($_REQUEST['mailIt_footer_padding'] ) ){
        $mailIt_footer_padding =  sanitize_text_field($_REQUEST['mailIt_footer_padding']);
    }else $mailIt_footer_padding = get_option( 'mailIt_footer_padding' );    
	?>
    <input type="number" min="0" name="mailIt_footer_padding" id="mailIt_footer_padding" placeholder='<?php print esc_html__('Padding','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_footer_padding); ?>"  /> <b>px</b>		 	
    <?php   
}



function mailIt_header_background(){
    if( isset($_REQUEST['mailIt_header_background'] ) ){
        $mailIt_header_background =  sanitize_text_field($_REQUEST['mailIt_header_background']);
    }else $mailIt_header_background = get_option( 'mailIt_header_background' );    
	?>
    	<input type="text" class='color' name="mailIt_header_background" id="mailIt_header_background" placeholder='<?php print esc_html__('Select Header BG Color','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_header_background); ?>"  />
    	
    <?php   
}
function mailIt_header_color(){
    if( isset($_REQUEST['mailIt_header_color'] ) ){
        $mailIt_header_color =  sanitize_text_field($_REQUEST['mailIt_header_color']);
    }else $mailIt_header_color = get_option( 'mailIt_header_color' );    
	?>
    	<input type="text" class='color' name="mailIt_header_color" id="mailIt_header_color" placeholder='<?php print esc_html__('Select Header Color','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_header_color); ?>"  />
    	
    <?php   
}

function mailIt_header_alignment(){
    if( isset($_REQUEST['mailIt_header_alignment'] ) ){
        $mailIt_header_alignment =  sanitize_text_field($_REQUEST['mailIt_header_alignment']);
    }else $mailIt_header_alignment = get_option( 'mailIt_header_alignment' );    
	?>
	<select  name="mailIt_header_alignment" id="mailIt_header_alignment" placeholder='<?php print esc_html__('Align','mail-it'); ?>' >
		<option value='' ><?php print esc_html__('Alignment','mail-it'); ?></option>
		<option value='left' <?php if($mailIt_header_alignment === 'left') print "selected='selected'"; ?> ><?php print esc_html__('Left','mail-it'); ?></option>
		<option value='center' <?php if($mailIt_header_alignment === 'center') print "selected='selected'"; ?> ><?php print esc_html__('Center','mail-it'); ?></option>
		<option value='right' <?php if($mailIt_header_alignment === 'right') print "selected='selected'"; ?> ><?php print esc_html__('Right','mail-it'); ?></option>
	</select>
	    	
    <?php   
}
function mailIt_header_font(){
	
	global $mailIt_Fonts;
    if( isset($_REQUEST['mailIt_header_font'] ) ){
        $mailIt_header_alignment =  sanitize_text_field($_REQUEST['mailIt_header_font']);
    }else $mailIt_header_font = get_option( 'mailIt_header_font' );    
	?>
	<select  name="mailIt_header_font" id="mailIt_header_font" placeholder='<?php print esc_html__('Font','mail-it'); ?>' >
		<option value='' ><?php print esc_html__('Select','mail-it'); ?></option>
		<?php foreach($mailIt_Fonts as $font){ ?>
			<option value='<?php print esc_html($font); ?>' <?php if($mailIt_header_font === esc_html($font)) print "selected='selected'"; ?> ><?php print esc_html($font); ?></option>
		<?php } ?>
	</select>
	    	
    <?php   
}

function mailIt_header_size(){
    if( isset($_REQUEST['mailIt_header_size'] ) ){
        $mailIt_header_size =  sanitize_text_field($_REQUEST['mailIt_header_size']);
    }else $mailIt_header_size = get_option( 'mailIt_header_size' );    
	?>
    <input type="number" min="0" name="mailIt_header_size" id="mailIt_header_size" placeholder='<?php print esc_html__('Font Size','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_header_size); ?>"  /> <b>px</b>		   	
    <?php   
}

function mailIt_header_padding(){
    if( isset($_REQUEST['mailIt_header_padding'] ) ){
        $mailIt_header_padding =  sanitize_text_field($_REQUEST['mailIt_header_padding']);
    }else $mailIt_header_padding = get_option( 'mailIt_header_padding' );    
	?>
    <input type="number" min="0" name="mailIt_header_padding" id="mailIt_header_padding" placeholder='<?php print esc_html__('Padding','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_header_padding); ?>"  /> <b>px</b>		   	
    <?php   
}

function mailIt_content_background(){
    if( isset($_REQUEST['mailIt_content_background'] ) ){
        $mailIt_content_background =  sanitize_text_field($_REQUEST['mailIt_content_background']);
    }else $mailIt_content_background = get_option( 'mailIt_content_background' );    
	?>
    	<input type="text" class='color' name="mailIt_content_background" id="mailIt_content_background" placeholder='<?php print esc_html__('Select Footer BG Color','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_content_background); ?>"  />
    	
    <?php   
}

function mailIt_content_color(){
    if( isset($_REQUEST['mailIt_content_color'] ) ){
        $mailIt_content_color =  sanitize_text_field($_REQUEST['mailIt_content_color']);
    }else $mailIt_content_color = get_option( 'mailIt_content_color' );    
	?>
    	<input type="text" class='color' name="mailIt_content_color" id="mailIt_content_color" placeholder='<?php print esc_html__('Select Footer Color','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_content_color); ?>"  />
    	
    <?php   
}

function mailIt_content_alignment(){
    if( isset($_REQUEST['mailIt_content_alignment'] ) ){
        $mailIt_content_alignment =  sanitize_text_field($_REQUEST['mailIt_content_alignment']);
    }else $mailIt_content_alignment = get_option( 'mailIt_content_alignment' );    
	?>
	<select  name="mailIt_content_alignment" id="mailIt_content_alignment" placeholder='<?php print esc_html__('Align','mail-it'); ?>' >
		<option value='' ><?php print esc_html__('Alignment','mail-it'); ?></option>
		<option value='left' <?php if($mailIt_content_alignment === 'left') print "selected='selected'"; ?> ><?php print esc_html__('Left','mail-it'); ?></option>
		<option value='center' <?php if($mailIt_content_alignment === 'center') print "selected='selected'"; ?> ><?php print esc_html__('Center','mail-it'); ?></option>
		<option value='right' <?php if($mailIt_content_alignment === 'right') print "selected='selected'"; ?> ><?php print esc_html__('Right','mail-it'); ?></option>
	</select>
	    	
    <?php   
}
function mailIt_content_font(){
	
	global $mailIt_Fonts;
    if( isset($_REQUEST['mailIt_content_font'] ) ){
        $mailIt_content_alignment =  sanitize_text_field($_REQUEST['mailIt_content_font']);
    }else $mailIt_content_font = get_option( 'mailIt_content_font' );    
	?>
	<select  name="mailIt_content_font" id="mailIt_content_font" placeholder='<?php print esc_html__('Font','mail-it'); ?>' >
		<option value='' ><?php print esc_html__('Select','mail-it'); ?></option>
		<?php foreach($mailIt_Fonts as $font){ ?>
			<option value='<?php print esc_html($font); ?>' <?php if($mailIt_content_font === esc_html($font)) print "selected='selected'"; ?> ><?php print esc_html($font); ?></option>
		<?php } ?>
	</select>
	    	
    <?php   
}

function mailIt_content_padding(){
    if( isset($_REQUEST['mailIt_content_padding'] ) ){
        $mailIt_content_padding =  sanitize_text_field($_REQUEST['mailIt_content_padding']);
    }else $mailIt_content_padding = get_option( 'mailIt_content_padding' );    
	?>
    <input type="number" min="0" name="mailIt_content_padding" id="mailIt_content_padding" placeholder='<?php print esc_html__('Padding','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_content_padding); ?>"  />

	<b>px</b>	    	
    <?php   
}

function mailIt_content_size(){
    if( isset($_REQUEST['mailIt_content_size'] ) ){
        $mailIt_content_size =  sanitize_text_field($_REQUEST['mailIt_content_size']);
    }else $mailIt_content_size = get_option( 'mailIt_content_size' );    
	?>
    <input type="number" min="0" name="mailIt_content_size" id="mailIt_content_size" placeholder='<?php print esc_html__('Font Size','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_content_size); ?>"  /> <b>px</b>		   	
    <?php   
}

function mailIt_to(){
    
    if( isset($_REQUEST['mailIt_to'] ) ){
        $mailIt_to =  sanitize_text_field($_REQUEST['mailIt_to']);
    }else $mailIt_to = get_option( 'mailIt_to' );
	?><input type="text"  name="mailIt_to" id="mailIt_to" placeholder='<?php print esc_html__('Mail Address','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_to); ?>"  />
    <?php
}



function mailIt_subject(){
    if( isset($_REQUEST['mailIt_subject'] ) ){
        $mailIt_subject =  sanitize_text_field($_REQUEST['mailIt_subject']);
    }else $mailIt_subject = get_option( 'mailIt_subject' );    
	?>
    	<input type="text"  name="mailIt_subject" id="mailIt_subject" placeholder='<?php print esc_html__('Email Subject','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_subject); ?>"  />
    	
    <?php   
}




function mailIt_css(){
    
    if( isset($_REQUEST['mailIt_css'] ) ){
        $mailIt_css =  sanitize_textarea_field($_REQUEST['mailIt_css']);
    }else $mailIt_css = get_option( 'mailIt_css' );    
	?>
	<textarea  rows="10" cols="50" name="mailIt_css" id="mailIt_css" placeholder='<?php print esc_html__('Add your Extra CSS here','mail-it'); ?>'
	><?php echo  esc_attr($mailIt_css); ?></textarea>
    <?php    
}

/*	SMTP SECTION */
function mailIt_fromName(){
    if( isset($_REQUEST['mailIt_fromName'] ) ){
        $mailIt_fromName =  sanitize_text_field($_REQUEST['mailIt_fromName']);
    }else $mailIt_fromName = get_option( 'mailIt_fromName' );    
	?>
    	<input type="text"  name="mailIt_fromName" id="mailIt_fromName" placeholder='<?php print esc_html__('From Name','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_fromName); ?>"  />
    	
    <?php   
}

function mailIt_fromEmail(){
    if( isset($_REQUEST['mailIt_fromEmail'] ) ){
        $mailIt_fromEmail =  sanitize_text_field($_REQUEST['mailIt_fromEmail']);
    }else $mailIt_fromEmail = get_option( 'mailIt_fromEmail' );    
	?>
    	<input type="email"  name="mailIt_fromEmail" id="mailIt_fromEmail" placeholder='<?php print esc_html__('SMTP Email','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_fromEmail); ?>"  />
    	
    <?php   
}

function mailIt_host(){
    if( isset($_REQUEST['mailIt_host'] ) ){
        $mailIt_host =  sanitize_text_field($_REQUEST['mailIt_host']);
    }else $mailIt_host = get_option( 'mailIt_host' );    
	?>
    	<input type="text"  name="mailIt_host" id="mailIt_host" placeholder='<?php print esc_html__('SMTP Host','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_host); ?>"  />
    	
    <?php   
}

function mailIt_auth(){
	if( isset($_REQUEST['mailIt_auth'] ) ){
        $mailIt_auth =  sanitize_text_field($_REQUEST['mailIt_auth']);
    }else $mailIt_auth = get_option( 'mailIt_auth' ); 
	?>
    	<input type="checkbox" name="mailIt_auth" id="mailIt_auth" value='true'  <?php if($mailIt_auth === 'true') print "checked"; ?> />
    <?php
}

function mailIt_port(){
    if( isset($_REQUEST['mailIt_port'] ) ){
        $mailIt_port =  sanitize_text_field($_REQUEST['mailIt_port']);
    }else $mailIt_port = get_option( 'mailIt_port' );    
	?>
    	<input type="number"  name="mailIt_port" id="mailIt_port" placeholder='<?php print esc_html__('SMTP Port','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_port); ?>"  />
    	
    <?php   
}

function mailIt_username(){
    if( isset($_REQUEST['mailIt_username'] ) ){
        $mailIt_username =  sanitize_text_field($_REQUEST['mailIt_username']);
    }else $mailIt_username = get_option( 'mailIt_username' );    
	?>
    	<input type="text"  name="mailIt_username" id="mailIt_username" placeholder='<?php print esc_html__('SMTP Username','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_username); ?>"  />
    	
    <?php   
}

function mailIt_password(){
    if( isset($_REQUEST['mailIt_password'] ) ){
        $mailIt_password =  sanitize_text_field($_REQUEST['mailIt_password']);
    }else $mailIt_password = get_option( 'mailIt_password' );    
	?>
    	<input type="password"  name="mailIt_password" id="mailIt_password" placeholder='<?php print esc_html__('SMTP Password','mail-it'); ?>' value="<?php echo  esc_attr($mailIt_password); ?>"  />
    	
    <?php   
}

function mailIt_encrypt(){
    if( isset($_REQUEST['mailIt_encrypt'] ) ){
        $mailIt_encrypt =  sanitize_text_field($_REQUEST['mailIt_encrypt']);
    }else $mailIt_encrypt = get_option( 'mailIt_encrypt' );   
	?>
	<select  name="mailIt_encrypt" id="mailIt_encrypt" placeholder='<?php print esc_html__('Encryption','mail-it'); ?>' >
		<option value='' ><?php print esc_html__('None','mail-it'); ?></option>
		<option value='SSL' <?php if($mailIt_encrypt === 'SSL') print "selected='selected'"; ?> >SSL</option>
		<option value='TLS' <?php if($mailIt_encrypt === 'TLS') print "selected='selected'"; ?> >TLS</option>
		
	</select>
	    	
    <?php   
}

function mailIt_now(){
	?>
    	<input type="checkbox" name="mailIt_now" id="mailIt_now" value='1' />
    <?php
}

/*	PANEL FIELDS */


function mailItint_panel_fields(){

	add_settings_section("mailIt-general", "", null, "mailIt-general-options");
	add_settings_section("mailIt-smtp", "", null, "mailIt-smtp-options");
	add_settings_section("mailIt-header", "", null, "mailIt-header-options");
	add_settings_section("mailIt-content", "", null, "mailIt-content-options");
	add_settings_section("mailIt-footer", "", null, "mailIt-footer-options");
	add_settings_section("mailIt-css", "", null, "mailIt-css-options");

	add_settings_field("mailIt_to", esc_html__('Mail To','mail-it'), "mailIt_to", "mailIt-general-options", "mailIt-general");
	add_settings_field("mailIt_subject", esc_html__('Mail Subject','mail-it'), "mailIt_subject", "mailIt-general-options", "mailIt-general");		
	add_settings_field("mailIt_fromName", esc_html__('From Name','mail-it'), "mailIt_fromName", "mailIt-general-options", "mailIt-general");
	add_settings_field("mailIt_fromEmail", esc_html__('From Email','mail-it'), "mailIt_fromEmail", "mailIt-general-options", "mailIt-general");
	add_settings_field("mailIt_now", "<div class='difCol'>".esc_html__('Send Email Now','mail-it'). "</div>", "mailIt_now", "mailIt-general-options", "mailIt-general");
	
	add_settings_field("mailIt_host", esc_html__('SMTP Host','mail-it'), "mailIt_host", "mailIt-smtp-options", "mailIt-smtp");
	add_settings_field("mailIt_auth", esc_html__('Authentication','mail-it'), "mailIt_auth", "mailIt-smtp-options", "mailIt-smtp");
	add_settings_field("mailIt_port", esc_html__('SMTP Port','mail-it'), "mailIt_port", "mailIt-smtp-options", "mailIt-smtp");
	add_settings_field("mailIt_username", esc_html__('SMTP Username','mail-it'), "mailIt_username", "mailIt-smtp-options", "mailIt-smtp");
	add_settings_field("mailIt_password", esc_html__('SMTP Password','mail-it'), "mailIt_password", "mailIt-smtp-options", "mailIt-smtp");
	add_settings_field("mailIt_encrypt", esc_html__('Encryption','mail-it'), "mailIt_encrypt", "mailIt-smtp-options", "mailIt-smtp");
		
	
    add_settings_field("mailIt_header_background", esc_html__('Header Background Color','mail-it'), "mailIt_header_background", "mailIt-header-options", "mailIt-header");
    add_settings_field("mailIt_header_color", esc_html__('Header Color','mail-it'), "mailIt_header_color", "mailIt-header-options", "mailIt-header");
	add_settings_field("mailIt_header_alignment", esc_html__('Header Alignment','mail-it'), "mailIt_header_alignment", "mailIt-header-options", "mailIt-header");
	add_settings_field("mailIt_header_font", esc_html__('Header Font','mail-it'), "mailIt_header_font", "mailIt-header-options", "mailIt-header");
	add_settings_field("mailIt_header_size", esc_html__('Font Size','mail-it'), "mailIt_header_size", "mailIt-header-options", "mailIt-header");
	add_settings_field("mailIt_header_padding", esc_html__('Header Padding','mail-it'), "mailIt_header_padding", "mailIt-header-options", "mailIt-header");
    add_settings_field("mailIt_header", esc_html__('Header','mail-it'), "mailIt_header", "mailIt-header-options", "mailIt-header");
    
   
   
    add_settings_field("mailIt_content_background", esc_html__('Content Background Color','mail-it'), "mailIt_content_background", "mailIt-content-options", "mailIt-content");
    add_settings_field("mailIt_content_color", esc_html__('Content Color','mail-it'), "mailIt_content_color", "mailIt-content-options", "mailIt-content");    
    add_settings_field("mailIt_content", esc_html__('Content','mail-it'), "mailIt_content", "mailIt-content-options", "mailIt-content");
	add_settings_field("mailIt_content_alignment", esc_html__('Content Alignment','mail-it'), "mailIt_content_alignment", "mailIt-content-options", "mailIt-content");
	add_settings_field("mailIt_content_font", esc_html__('Content Font','mail-it'), "mailIt_content_font", "mailIt-content-options", "mailIt-content");
	add_settings_field("mailIt_content_size", esc_html__('Font Size','mail-it'), "mailIt_content_size", "mailIt-content-options", "mailIt-content");
	add_settings_field("mailIt_content_padding", esc_html__('Content Padding','mail-it'), "mailIt_content_padding", "mailIt-content-options", "mailIt-content");
    
    add_settings_field("mailIt_footer_background", esc_html__('Footer Background Color','mail-it'), "mailIt_footer_background", "mailIt-footer-options", "mailIt-footer");
    add_settings_field("mailIt_footer_color", esc_html__('Footer Color','mail-it'), "mailIt_footer_color", "mailIt-footer-options", "mailIt-footer");
	add_settings_field("mailIt_footer", esc_html__('Footer','mail-it'), "mailIt_footer", "mailIt-footer-options", "mailIt-footer");
	add_settings_field("mailIt_footer_alignment", esc_html__('Footer Alignment','mail-it'), "mailIt_footer_alignment", "mailIt-footer-options", "mailIt-footer");
	add_settings_field("mailIt_footer_font", esc_html__('Footer Font','mail-it'), "mailIt_footer_font", "mailIt-footer-options", "mailIt-footer");
	add_settings_field("mailIt_footer_size", esc_html__('Font Size','mail-it'), "mailIt_footer_size", "mailIt-footer-options", "mailIt-footer");
	add_settings_field("mailIt_footer_padding", esc_html__('Footer Padding','mail-it'), "mailIt_footer_padding", "mailIt-footer-options", "mailIt-footer");
	
	add_settings_field("mailIt_css", esc_html__('Extra CSS','mail-it'), "mailIt_css", "mailIt-css-options", "mailIt-css");
	
	register_setting("mailIt-header", "mailIt_header");
	register_setting("mailIt-header", "mailIt_header_background");
	register_setting("mailIt-header", "mailIt_header_color");
	register_setting("mailIt-header", "mailIt_header_alignment");
	register_setting("mailIt-header", "mailIt_header_font");
	register_setting("mailIt-header", "mailIt_header_padding");
	register_setting("mailIt-header", "mailIt_header_size");
	register_setting("mailIt-content", "mailIt_content_background");
	register_setting("mailIt-content", "mailIt_content_color");
	register_setting("mailIt-content", "mailIt_content");
	register_setting("mailIt-content", "mailIt_content_alignment");
	register_setting("mailIt-content", "mailIt_content_font");
	register_setting("mailIt-content", "mailIt_content_size");
	register_setting("mailIt-content", "mailIt_content_padding");
	
	register_setting("mailIt-footer", "mailIt_footer");
	register_setting("mailIt-footer", "mailIt_footer_background");
	register_setting("mailIt-footer", "mailIt_footer_color");
	register_setting("mailIt-footer", "mailIt_footer_alignment");
	register_setting("mailIt-footer", "mailIt_footer_font");
	register_setting("mailIt-footer", "mailIt_footer_size");
	register_setting("mailIt-footer", "mailIt_footer_padding");
	
	register_setting("mailIt-general", "mailIt_subject");
	register_setting("mailIt-general", "mailIt_to");
	register_setting("mailIt-general", "mailIt_fromName");
	register_setting("mailIt-general", "mailIt_fromEmail");
	
	register_setting("mailIt-smtp", "mailIt_host");	
	register_setting("mailIt-smtp", "mailIt_auth");
	register_setting("mailIt-smtp", "mailIt_port");
	register_setting("mailIt-smtp", "mailIt_username");
	register_setting("mailIt-smtp", "mailIt_password");
	register_setting("mailIt-smtp", "mailIt_encrypt");
	
	register_setting("mailIt-general", "mailIt_now");
	register_setting("mailIt-css", "mailIt_css");	
}
add_action("admin_init", "mailItint_panel_fields");	


function mailIt_processData(){
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && current_user_can('administrator') && !isset($_REQUEST['mail-it_WOO'] ) ){
	
		check_admin_referer( 'mailIt' );
		check_ajax_referer('mailIt');

		global $mailIt_allowed_html;

		if( isset($_REQUEST['mailIt_header']) ){
		   $mailIt_header =  wp_kses($_REQUEST['mailIt_header'], $mailIt_allowed_html);
		   update_option('mailIt_header',$mailIt_header);
		}

		
	    if( isset($_REQUEST['mailIt_select_Template']) ){
	        $mailIt_select_Template = (int)$_REQUEST['mailIt_select_Template'];
	        update_option('mailIt_select_Template',$mailIt_select_Template);
	    }
		
		if( isset($_REQUEST['mailIt_content']) ){
		   $mailIt_content =  wp_kses($_REQUEST['mailIt_content'], $mailIt_allowed_html);
		   update_option('mailIt_content',$mailIt_content);
		}

		if( isset($_REQUEST['mailIt_footer']) ){
		    $mailIt_footer =  wp_kses($_REQUEST['mailIt_footer'], $mailIt_allowed_html);
		   update_option('mailIt_footer',$mailIt_footer);
		}	
		if( isset($_REQUEST['mailIt_content_background']) ){
		    $mailIt_content_background =  sanitize_text_field($_REQUEST['mailIt_content_background']);
		   update_option('mailIt_content_background',$mailIt_content_background);
		}
		if( isset($_REQUEST['mailIt_content_color']) ){
		    $mailIt_content_color =  sanitize_text_field($_REQUEST['mailIt_content_color']);
		   update_option('mailIt_content_color',$mailIt_content_color);
		}			
		if( isset($_REQUEST['mailIt_content_alignment']) ){
		    $mailIt_content_alignment =  sanitize_text_field($_REQUEST['mailIt_content_alignment']);
		   update_option('mailIt_content_alignment',$mailIt_content_alignment);
		}
		if( isset($_REQUEST['mailIt_content_font']) ){
		    $mailIt_content_font =  sanitize_text_field($_REQUEST['mailIt_content_font']);
		   update_option('mailIt_content_font',$mailIt_content_font);
		}	
		if( isset($_REQUEST['mailIt_content_size']) ){
		    $mailIt_content_size =  sanitize_text_field($_REQUEST['mailIt_content_size']);
		   update_option('mailIt_content_size',$mailIt_content_size);
		}	
		if( isset($_REQUEST['mailIt_content_padding']) ){
		    $mailIt_content_padding =  sanitize_text_field($_REQUEST['mailIt_content_padding']);
		   update_option('mailIt_content_padding',$mailIt_content_padding);
		}			
		
		if( isset($_REQUEST['mailIt_header_background']) ){
		    $mailIt_header_background =  sanitize_text_field($_REQUEST['mailIt_header_background']);
		   update_option('mailIt_header_background',$mailIt_header_background);
		}
		
		
		if( isset($_REQUEST['mailIt_header_color']) ){
		    $mailIt_header_color =  sanitize_text_field($_REQUEST['mailIt_header_color']);
		   update_option('mailIt_header_color',$mailIt_header_color);		   
		}

		if( isset($_REQUEST['mailIt_header_alignment']) ){
		    $mailIt_header_alignment =  sanitize_text_field($_REQUEST['mailIt_header_alignment']);
		   update_option('mailIt_header_alignment',$mailIt_header_alignment);
		}
		if( isset($_REQUEST['mailIt_header_font']) ){
		    $mailIt_header_font =  sanitize_text_field($_REQUEST['mailIt_header_font']);
		   update_option('mailIt_header_font',$mailIt_header_font);
		}	
		if( isset($_REQUEST['mailIt_header_size']) ){
		    $mailIt_header_size =  sanitize_text_field($_REQUEST['mailIt_header_size']);
		   update_option('mailIt_header_size',$mailIt_header_size);
		}	
		if( isset($_REQUEST['mailIt_header_padding']) ){
		    $mailIt_header_padding =  sanitize_text_field($_REQUEST['mailIt_header_padding']);
		   update_option('mailIt_header_padding',$mailIt_header_padding);
		}		

		if( isset($_REQUEST['mailIt_footer_background']) ){
		    $mailIt_footer_background =  sanitize_text_field($_REQUEST['mailIt_footer_background']);
		   update_option('mailIt_footer_background',$mailIt_footer_background);
		}
		if( isset($_REQUEST['mailIt_footer_color']) ){
		    $mailIt_footer_color =  sanitize_text_field($_REQUEST['mailIt_footer_color']);
		   update_option('mailIt_footer_color',$mailIt_footer_color);
		}
		if( isset($_REQUEST['mailIt_footer_alignment']) ){
		    $mailIt_footer_alignment =  sanitize_text_field($_REQUEST['mailIt_footer_alignment']);
		   update_option('mailIt_footer_alignment',$mailIt_footer_alignment);
		}
		if( isset($_REQUEST['mailIt_footer_font']) ){
		    $mailIt_footer_font =  sanitize_text_field($_REQUEST['mailIt_footer_font']);
		   update_option('mailIt_footer_font',$mailIt_footer_font);
		}	
		if( isset($_REQUEST['mailIt_footer_size']) ){
		    $mailIt_footer_size =  sanitize_text_field($_REQUEST['mailIt_footer_size']);
		   update_option('mailIt_footer_size',$mailIt_footer_size);
		}	
		if( isset($_REQUEST['mailIt_footer_padding']) ){
		    $mailIt_footer_padding =  sanitize_text_field($_REQUEST['mailIt_footer_padding']);
		   update_option('mailIt_footer_padding',$mailIt_footer_padding);
		}
		
	    if( isset($_REQUEST['mailIt_to']) ){
	        $mailIt_to = sanitize_text_field($_REQUEST['mailIt_to']);
	        update_option('mailIt_to',$mailIt_to);
	    }
	

	    if( isset($_REQUEST['mailIt_subject']) ){
	        $mailIt_subject = sanitize_textarea_field($_REQUEST['mailIt_subject']);
	        update_option('mailIt_subject',$mailIt_subject);
	    }
		
	    if( isset($_REQUEST['mailIt_css']) ){
	        $mailIt_css = sanitize_textarea_field($_REQUEST['mailIt_css']);
	        update_option('mailIt_css',$mailIt_css);
	    }
		

		/*smpt save settings*/
	    if( isset($_REQUEST['mailIt_fromName']) ){
	        $mailIt_fromName = sanitize_textarea_field($_REQUEST['mailIt_fromName']);
	        update_option('mailIt_fromName',$mailIt_fromName);
	    }
	    if( isset($_REQUEST['mailIt_fromEmail']) ){
	        $mailIt_fromEmail = sanitize_textarea_field($_REQUEST['mailIt_fromEmail']);
	        update_option('mailIt_fromEmail',$mailIt_fromEmail);
	    }
	    if( isset($_REQUEST['mailIt_host']) ){
	        $mailIt_host = sanitize_textarea_field($_REQUEST['mailIt_host']);
	        update_option('mailIt_host',$mailIt_host);
	    }
	    if( isset($_REQUEST['mailIt_auth']) && !empty($_REQUEST['mailIt_auth']) ){
	        $mailIt_auth = sanitize_textarea_field($_REQUEST['mailIt_auth']);
	        update_option('mailIt_auth',$mailIt_auth);
			
	    }else update_option('mailIt_auth','');
		
	    if( isset($_REQUEST['mailIt_port']) ){
	        $mailIt_port = sanitize_textarea_field($_REQUEST['mailIt_port']);
	        update_option('mailIt_port',$mailIt_port);
	    }
	    if( isset($_REQUEST['mailIt_username']) ){
	        $mailIt_username = sanitize_textarea_field($_REQUEST['mailIt_username']);
	        update_option('mailIt_username',$mailIt_username);
	    }
	    if( isset($_REQUEST['mailIt_password']) ){
	        $mailIt_password = sanitize_textarea_field($_REQUEST['mailIt_password']);
	        update_option('mailIt_password',$mailIt_password);
	    }
	    if( isset($_REQUEST['mailIt_encrypt']) ){
	        $mailIt_encrypt = sanitize_textarea_field($_REQUEST['mailIt_encrypt']);
	        update_option('mailIt_encrypt',$mailIt_encrypt);
	    }		
		

		if( isset($_REQUEST['mailIt_now']) && sanitize_text_field($_REQUEST['mailIt_now']) ==='1' ){
		    mailIt_Action(); 
		}
	}
}

// SMTP Authentication
add_action( 'phpmailer_init', 'mailIt_smtpConfig' );
function mailIt_smtpConfig( $phpmailer ) {

	$phpmailer->isSMTP();
	$phpmailer->IsHTML(true);
	if(!empty(get_option('mailIt_fromName'))){
		$phpmailer->FromName   = esc_html(get_option('mailIt_fromName'));
	}else $phpmailer->FromName = esc_html(get_bloginfo('name'));

	if(!empty(get_option('mailIt_fromEmail'))){
		$phpmailer->From   = esc_html(get_option('mailIt_fromEmail'));
	}else $phpmailer->From = esc_html(get_bloginfo('admin_email'));
	
	
	if(!empty(get_option('mailIt_host'))){
		$phpmailer->Host   = esc_html(get_option('mailIt_host'));
	}

	if(!empty(get_option('mailIt_auth'))){
		$phpmailer->SMTPAuth   = true;
	}

	if(!empty(get_option('mailIt_port'))){
		$phpmailer->Port   = (int)get_option('mailIt_port');
	}

	if(!empty(get_option('mailIt_username'))){
		$phpmailer->Username   = esc_html(get_option('mailIt_username'));
	}

	if(!empty(get_option('mailIt_password'))){
		$phpmailer->Password   = esc_html(get_option('mailIt_password'));
	}
	
	if(!empty(get_option('mailIt_encrypt'))){
		$phpmailer->SMTPSecure   = esc_html(strtolower(get_option('mailIt_encrypt')));
	}
}