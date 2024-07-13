jQuery.noConflict(), window.addEvent("domready", function () {
    var e = "li:first";
    jQuery(".row-fluid").length && (e = "div.control-group:first"), jQuery(".source_field").each(function () {
        "none" != jQuery(this).parents(e).css("display") && (jQuery(this).change(function () {
            var i = this.id.replace("jform_params_", "");
            jQuery(this).find("option").each(function () {
                jQuery("." + i + "_" + this.value).each(function () {
                    jQuery(this).parents(e).hide()
                })
            }), jQuery("." + i + "_" + jQuery(this).find("option:selected").val()).each(function () {
                jQuery(this).parents(e).fadeIn(600)
            })
        }), jQuery(this).change())
    });
		
});
jQuery('.conditional').conditionize();
