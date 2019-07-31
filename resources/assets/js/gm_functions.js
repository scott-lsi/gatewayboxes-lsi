/*!
	Zoom 1.7.18
	license: MIT
	http://www.jacklmoore.com/zoom
*/
(function (o) { var t = { url: !1, callback: !1, target: !1, duration: 120, on: "mouseover", touch: !0, onZoomIn: !1, onZoomOut: !1, magnify: 1 }; o.zoom = function (t, n, e, i) { var u, c, a, r, m, l, s, f = o(t), h = f.css("position"), d = o(n); return t.style.position = /(absolute|fixed)/.test(h) ? h : "relative", t.style.overflow = "hidden", e.style.width = e.style.height = "", o(e).addClass("zoomImg").css({ position: "absolute", top: 0, left: 0, opacity: 0, width: e.width * i, height: e.height * i, border: "none", maxWidth: "none", maxHeight: "none" }).appendTo(t), { init: function () { c = f.outerWidth(), u = f.outerHeight(), n === t ? (r = c, a = u) : (r = d.outerWidth(), a = d.outerHeight()), m = (e.width - c) / r, l = (e.height - u) / a, s = d.offset() }, move: function (o) { var t = o.pageX - s.left, n = o.pageY - s.top; n = Math.max(Math.min(n, a), 0), t = Math.max(Math.min(t, r), 0), e.style.left = t * -m + "px", e.style.top = n * -l + "px" } } }, o.fn.zoom = function (n) { return this.each(function () { var e = o.extend({}, t, n || {}), i = e.target && o(e.target)[0] || this, u = this, c = o(u), a = document.createElement("img"), r = o(a), m = "mousemove.zoom", l = !1, s = !1; if (!e.url) { var f = u.querySelector("img"); if (f && (e.url = f.getAttribute("data-src") || f.currentSrc || f.src), !e.url) return } c.one("zoom.destroy", function (o, t) { c.off(".zoom"), i.style.position = o, i.style.overflow = t, a.onload = null, r.remove() }.bind(this, i.style.position, i.style.overflow)), a.onload = function () { function t(t) { f.init(), f.move(t), r.stop().fadeTo(o.support.opacity ? e.duration : 0, 1, o.isFunction(e.onZoomIn) ? e.onZoomIn.call(a) : !1) } function n() { r.stop().fadeTo(e.duration, 0, o.isFunction(e.onZoomOut) ? e.onZoomOut.call(a) : !1) } var f = o.zoom(i, u, a, e.magnify); "grab" === e.on ? c.on("mousedown.zoom", function (e) { 1 === e.which && (o(document).one("mouseup.zoom", function () { n(), o(document).off(m, f.move) }), t(e), o(document).on(m, f.move), e.preventDefault()) }) : "click" === e.on ? c.on("click.zoom", function (e) { return l ? void 0 : (l = !0, t(e), o(document).on(m, f.move), o(document).one("click.zoom", function () { n(), l = !1, o(document).off(m, f.move) }), !1) }) : "toggle" === e.on ? c.on("click.zoom", function (o) { l ? n() : t(o), l = !l }) : "mouseover" === e.on && (f.init(), c.on("mouseenter.zoom", t).on("mouseleave.zoom", n).on(m, f.move)), e.touch && c.on("touchstart.zoom", function (o) { o.preventDefault(), s ? (s = !1, n()) : (s = !0, t(o.originalEvent.touches[0] || o.originalEvent.changedTouches[0])) }).on("touchmove.zoom", function (o) { o.preventDefault(), f.move(o.originalEvent.touches[0] || o.originalEvent.changedTouches[0]) }).on("touchend.zoom", function (o) { o.preventDefault(), s && (s = !1, n()) }), o.isFunction(e.callback) && e.callback.call(a) }, a.src = e.url }) }, o.fn.zoom.defaults = t })(window.jQuery);

$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '+5d',
        //daysOfWeekDisabled: [0,6],
    });

    enquire.register("screen and (min-width:975px)", function () {
        var imageWidth = $('#product-main-image img').width();
        $('#product-main-image, #product-main-image img').width(imageWidth).height(imageWidth);
        $('#product-main-image img').wrap('<span class="img-zoom-wrapper" style="position: absolute; overflow: hidden;" />')
            .css('display', 'block')
            .parent()
            .zoom();
    });

    $('#product-main-image a').click(function (e) {
        e.preventDefault();
    });

    $('#product-thumbnails a').click(function (e) {
        e.preventDefault();
        var imgSrc = $(this).find('img').attr('src');
        var delay = 400;

        $('#product-main-image img').fadeOut(0, function () {
            setTimeout(delay, $(this).attr('src', imgSrc));
        }).fadeIn(delay, function () {
            setTimeout(delay, $('#product-main-image').css('backgroundImage', 'url(' + imgSrc + ')').css('backgroundSize', 'cover'));
        });
    });

    // lightbox (https://ashleydw.github.io/lightbox/)
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
});

// ...but not on mobile
enquire.register("screen and (max-width:974px)", function () {
    $('#product-main-image img').wrap('<div class="img-zoom-wrapper" />')
        .css('display', 'block');
});
