/***************************************************************************************************
LoadingOverlay - A flexible loading overlay jQuery plugin
    Author          : Gaspare Sganga
    Version         : 1.4.1
    License         : MIT
    Documentation   : http://gasparesganga.com/labs/jquery-loading-overlay/
****************************************************************************************************/
(function($, undefined){
    // Default Settings
    var _defaults = {
        color           : "rgba(255, 255, 255, 0.8)",
        custom          : "",
        fade            : true,
        fontawesome     : "",
        imagePosition   : "center center",
        maxSize         : "100px",
        minSize         : "20px",
        resizeInterval  : 50,
        size            : "50%",
        zIndex          : undefined
    };
    
    $.LoadingOverlaySetup = function(settings){
    };
    
    $.LoadingOverlay = function(action, options){
    };
    
    $.fn.LoadingOverlay = function(action, options){
    };
    
    
    function _Show(container, settings){
        container = $(container);
        var wholePage   = container.is("body");
        var count       = container.data("LoadingOverlayCount");
        if (count === undefined) count = 0;
        if (count == 0) {
            var overlay = $("<div>", {
                class   : "loadingoverlay",
                css     : {
                    "background-color"  : settings.color,
                    "display"           : "flex",
                    "flex-direction"    : "column",
                    "align-items"       : "center",
                    "justify-content"   : "center"
                }
            });
            if (settings.zIndex !== undefined) overlay.css("z-index", settings.zIndex);
            if (settings.image) overlay.css({
                "background-image"      : "url(" + settings.image + ")",
                "background-position"   : settings.imagePosition,
                "background-repeat"     : "no-repeat"
            });
            if (settings.fontawesome) $("<div>", {
                class   : "loadingoverlay_fontawesome " + settings.fontawesome
            }).appendTo(overlay);
            if (settings.custom) $(settings.custom).appendTo(overlay);
            if (wholePage) {
                overlay.css({
                    "position"  : "fixed",
                    "top"       : 0,
                    "left"      : 0,
                    "width"     : "100%",
                    "height"    : "100%"
                });
            } else {
                overlay.css("position", (container.css("position") == "fixed") ? "fixed" : "absolute");
            }
            _Resize(container, overlay, settings, wholePage);
            if (settings.resizeInterval > 0) {
                var resizeIntervalId = setInterval(function(){
                    _Resize(container, overlay, settings, wholePage);
                }, settings.resizeInterval);
                container.data("LoadingOverlayResizeIntervalId", resizeIntervalId);
            }
            if (!settings.fade) {
                settings.fade = [0, 0];
            } else if (settings.fade === true) {
                settings.fade = [400, 200];
            } else if (typeof settings.fade == "string" || typeof settings.fade == "number") {
                settings.fade = [settings.fade, settings.fade];
            }
            container.data({
                "LoadingOverlay"                : overlay,
                "LoadingOverlayFadeOutDuration" : settings.fade[1]
            });
            overlay
                .hide()
                .appendTo("body")
                .fadeIn(settings.fade[0]);
        }
        count++;
        container.data("LoadingOverlayCount", count);
    }

    function _Hide(container, force){
        container = $(container);
        var count = container.data("LoadingOverlayCount");
        if (count === undefined) return;
        count--;
        if (force || count <= 0) {
            var resizeIntervalId = container.data("LoadingOverlayResizeIntervalId");
            if (resizeIntervalId) clearInterval(resizeIntervalId);
            container.data("LoadingOverlay").fadeOut(container.data("LoadingOverlayFadeOutDuration"), function(){
                $(this).remove()
            });
            container.removeData(["LoadingOverlay", "LoadingOverlayCount", "LoadingOverlayFadeOutDuration", "LoadingOverlayResizeIntervalId"]);
        } else {
            container.data("LoadingOverlayCount", count);
        }
    }
    
    function _Resize(container, overlay, settings, wholePage){
        if (!wholePage) {
            var x = (container.css("position") == "fixed") ? container.position() : container.offset();
            overlay.css({
                top     : x.top + parseInt(container.css("border-top-width"), 10),
                left    : x.left + parseInt(container.css("border-left-width"), 10),
                width   : container.innerWidth(),
                height  : container.innerHeight()
            });
        }
        var c    = wholePage ? $(window) : container;
        var size = "auto";
        if (settings.size && settings.size != "auto") {
            size = Math.min(c.innerWidth(), c.innerHeight()) * parseFloat(settings.size) / 100;
            if (settings.maxSize && size > parseInt(settings.maxSize, 10)) size = parseInt(settings.maxSize, 10) + "px";
            if (settings.minSize && size < parseInt(settings.minSize, 10)) size = parseInt(settings.minSize, 10) + "px";
        }
        overlay.css("background-size", size);
        overlay.children(".loadingoverlay_fontawesome").css("font-size", size);
    }
    
}(jQuery));