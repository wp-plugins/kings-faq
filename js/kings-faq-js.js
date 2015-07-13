jQuery(document).ready(function() {
    
    $dd = jQuery('#kingsrrf_faq dd');
        
    jQuery('#kingsrrf_faq dt').click(function(){
        $dd.removeClass('displayblock');
        jQuery(this).next($dd).addClass('displayblock');
    });
});