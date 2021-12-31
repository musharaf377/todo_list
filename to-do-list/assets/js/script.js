
jQuery(function(){

    jQuery(document).on("click",".btn",function(){
        // console.log('click success.')
        var para = "action=custom_plugin&param=get_message";
        $.post(ajaxurl, para,function(response){})
    });

    jQuery("#basic_form").validate();
    
  });