/*!

=========================================================
* Argon Dashboard - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2018 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
"use strict";

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var map,
    lat,
    lng,
    Datepicker = function () {
    var a = $(".datepicker");a.length && a.each(function () {
        $(this).datepicker({ disableTouchKeyboard: !0, autoclose: !1 });
    });
}(),
    CopyIcon = function () {
    var a,
        e = ".btn-icon-clipboard",
        t = $(e);t.length && ((a = t).tooltip().on("mouseleave", function () {
        a.tooltip("hide");
    }), new ClipboardJS(e).on("success", function (a) {
        $(a.trigger).attr("title", "Copied!").tooltip("_fixTitle").tooltip("show").attr("title", "Copy to clipboard").tooltip("_fixTitle"), a.clearSelection();
    }));
}(),
    FormControl = function () {
    var a = $(".form-control");a.length && a.on("focus blur", function (a) {
        $(this).parents(".form-group").toggleClass("focused", "focus" === a.type || 0 < this.value.length);
    }).trigger("blur");
}(),
    $map = $("#map-canvas"),
    color = "#5e72e4";function initMap() {
    map = document.getElementById("map-canvas"), lat = map.getAttribute("data-lat"), lng = map.getAttribute("data-lng");var a = new google.maps.LatLng(lat, lng),
        e = { zoom: 12, scrollwheel: !1, center: a, mapTypeId: google.maps.MapTypeId.ROADMAP, styles: [{ featureType: "administrative", elementType: "labels.text.fill", stylers: [{ color: "#444444" }] }, { featureType: "landscape", elementType: "all", stylers: [{ color: "#f2f2f2" }] }, { featureType: "poi", elementType: "all", stylers: [{ visibility: "off" }] }, { featureType: "road", elementType: "all", stylers: [{ saturation: -100 }, { lightness: 45 }] }, { featureType: "road.highway", elementType: "all", stylers: [{ visibility: "simplified" }] }, { featureType: "road.arterial", elementType: "labels.icon", stylers: [{ visibility: "off" }] }, { featureType: "transit", elementType: "all", stylers: [{ visibility: "off" }] }, { featureType: "water", elementType: "all", stylers: [{ color: color }, { visibility: "on" }] }] };map = new google.maps.Map(map, e);var t = new google.maps.Marker({ position: a, map: map, animation: google.maps.Animation.DROP, title: "Hello World!" }),
        o = new google.maps.InfoWindow({ content: '<div class="info-window-content"><h2>Argon Dashboard</h2><p>A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</p></div>' });google.maps.event.addListener(t, "click", function () {
        o.open(map, t);
    });
}$map.length && google.maps.event.addDomListener(window, "load", initMap);var Navbar = function () {
    var e = $(".navbar-nav, .navbar-nav .nav"),
        t = $(".navbar .collapse"),
        a = $(".navbar .dropdown");t.on({ "show.bs.collapse": function showBsCollapse() {
            var a;(a = $(this)).closest(e).find(t).not(a).collapse("hide");
        } }), a.on({ "hide.bs.dropdown": function hideBsDropdown() {
            var a, e;a = $(this), (e = a.find(".dropdown-menu")).addClass("close"), setTimeout(function () {
                e.removeClass("close");
            }, 200);
        } });
}(),
    NavbarCollapse = function () {
    $(".navbar-nav");var a = $(".navbar .collapse");a.length && (a.on({ "hide.bs.collapse": function hideBsCollapse() {
            a.addClass("collapsing-out");
        } }), a.on({ "hidden.bs.collapse": function hiddenBsCollapse() {
            a.removeClass("collapsing-out");
        } }));
}(),
    noUiSlider = function () {
    if ($(".input-slider-container")[0] && $(".input-slider-container").each(function () {
        var a = $(this).find(".input-slider"),
            e = a.attr("id"),
            t = a.data("range-value-min"),
            o = a.data("range-value-max"),
            n = $(this).find(".range-slider-value"),
            r = n.attr("id"),
            l = n.data("range-value-low"),
            i = document.getElementById(e),
            s = document.getElementById(r);noUiSlider.create(i, { start: [parseInt(l)], connect: [!0, !1], range: { min: [parseInt(t)], max: [parseInt(o)] } }), i.noUiSlider.on("update", function (a, e) {
            s.textContent = a[e];
        });
    }), $("#input-slider-range")[0]) {
        var a = document.getElementById("input-slider-range"),
            e = document.getElementById("input-slider-range-value-low"),
            t = document.getElementById("input-slider-range-value-high"),
            o = [e, t];noUiSlider.create(a, { start: [parseInt(e.getAttribute("data-range-value-low")), parseInt(t.getAttribute("data-range-value-high"))], connect: !0, range: { min: parseInt(a.getAttribute("data-range-value-min")), max: parseInt(a.getAttribute("data-range-value-max")) } }), a.noUiSlider.on("update", function (a, e) {
            o[e].textContent = a[e];
        });
    }
}(),
    Popover = function () {
    var a = $('[data-toggle="popover"]'),
        t = "";a.length && a.each(function () {
        !function (a) {
            a.data("color") && (t = "popover-" + a.data("color"));var e = { trigger: "focus", template: '<div class="popover ' + t + '" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>' };a.popover(e);
        }($(this));
    });
}(),
    ScrollTo = function () {
    var a = $(".scroll-me, [data-scroll-to], .toc-entry a");a.length && a.on("click", function (a) {
        var e, t, o, n;e = $(this), t = e.attr("href"), o = e.data("scroll-to-offset") ? e.data("scroll-to-offset") : 0, n = { scrollTop: $(t).offset().top - o }, $("html, body").stop(!0, !0).animate(n, 600), event.preventDefault();
    });
}(),
    Tooltip = function () {
    var a = $('[data-toggle="tooltip"]');a.length && a.tooltip();
}(),
    Charts = function () {
    var a,
        e = $('[data-toggle="chart"]'),
        t = "light",
        o = { base: "Open Sans" },
        n = { gray: { 100: "#f6f9fc", 200: "#e9ecef", 300: "#dee2e6", 400: "#ced4da", 500: "#adb5bd", 600: "#8898aa", 700: "#525f7f", 800: "#32325d", 900: "#212529" }, theme: { default: "#172b4d", primary: "#5e72e4", secondary: "#f4f5f7", info: "#11cdef", success: "#2dce89", danger: "#f5365c", warning: "#fb6340" }, black: "#12263F", white: "#FFFFFF", transparent: "transparent" };function r(a, e) {
        for (var t in e) {
            "object" != _typeof(e[t]) ? a[t] = e[t] : r(a[t], e[t]);
        }
    }function l(a) {
        var e = a.data("add"),
            t = $(a.data("target")).data("chart");a.is(":checked") ? function a(e, t) {
            for (var o in t) {
                Array.isArray(t[o]) ? t[o].forEach(function (a) {
                    e[o].push(a);
                }) : a(e[o], t[o]);
            }
        }(t, e) : function a(e, t) {
            for (var o in t) {
                Array.isArray(t[o]) ? t[o].forEach(function (a) {
                    e[o].pop();
                }) : a(e[o], t[o]);
            }
        }(t, e), t.update();
    }function i(a) {
        var e = a.data("update"),
            t = $(a.data("target")).data("chart");r(t, e), function (a, e) {
            if (void 0 !== a.data("prefix") || void 0 !== a.data("prefix")) {
                var r = a.data("prefix") ? a.data("prefix") : "",
                    l = a.data("suffix") ? a.data("suffix") : "";e.options.scales.yAxes[0].ticks.callback = function (a) {
                    if (!(a % 10)) return r + a + l;
                }, e.options.tooltips.callbacks.label = function (a, e) {
                    var t = e.datasets[a.datasetIndex].label || "",
                        o = a.yLabel,
                        n = "";return 1 < e.datasets.length && (n += '<span class="popover-body-label mr-auto">' + t + "</span>"), n += '<span class="popover-body-value">' + r + o + l + "</span>";
                };
            }
        }(a, t), t.update();
    }return window.Chart && r(Chart, (a = { defaults: { global: { responsive: !0, maintainAspectRatio: !1, defaultColor: n.gray[600], defaultFontColor: n.gray[600], defaultFontFamily: o.base, defaultFontSize: 13, layout: { padding: 0 }, legend: { display: !1, position: "bottom", labels: { usePointStyle: !0, padding: 16 } }, elements: { point: { radius: 0, backgroundColor: n.theme.primary }, line: { tension: .4, borderWidth: 4, borderColor: n.theme.primary, backgroundColor: n.transparent, borderCapStyle: "rounded" }, rectangle: { backgroundColor: n.theme.warning }, arc: { backgroundColor: n.theme.primary, borderColor: n.white, borderWidth: 4 } }, tooltips: { enabled: !1, mode: "index", intersect: !1, custom: function custom(o) {
                        var a = $("#chart-tooltip");if (a.length || (a = $('<div id="chart-tooltip" class="popover bs-popover-top" role="tooltip"></div>'), $("body").append(a)), 0 !== o.opacity) {
                            if (o.body) {
                                var e = o.title || [],
                                    n = o.body.map(function (a) {
                                    return a.lines;
                                }),
                                    r = "";r += '<div class="arrow"></div>', e.forEach(function (a) {
                                    r += '<h3 class="popover-header text-center">' + a + "</h3>";
                                }), n.forEach(function (a, e) {
                                    o.labelColors[e].backgroundColor;var t = 1 < n.length ? "justify-content-left" : "justify-content-center";r += '<div class="popover-body d-flex align-items-center ' + t + '"><span class="badge badge-dot"><i class="bg-primary"></i></span>' + a + "</div>";
                                }), a.html(r);
                            }var t = $(this._chart.canvas),
                                l = (t.outerWidth(), t.outerHeight(), t.offset().top),
                                i = t.offset().left,
                                s = a.outerWidth(),
                                d = a.outerHeight(),
                                c = l + o.caretY - d - 16,
                                p = i + o.caretX - s / 2;a.css({ top: c + "px", left: p + "px", display: "block", "z-index": "100" });
                        } else a.css("display", "none");
                    }, callbacks: { label: function label(a, e) {
                            var t = e.datasets[a.datasetIndex].label || "",
                                o = a.yLabel,
                                n = "";return 1 < e.datasets.length && (n += '<span class="badge badge-primary mr-auto">' + t + "</span>"), n += '<span class="popover-body-value">' + o + "</span>";
                        } } } }, doughnut: { cutoutPercentage: 83, tooltips: { callbacks: { title: function title(a, e) {
                            return e.labels[a[0].index];
                        }, label: function label(a, e) {
                            var t = "";return t += '<span class="popover-body-value">' + e.datasets[0].data[a.index] + "</span>";
                        } } }, legendCallback: function legendCallback(a) {
                    var o = a.data,
                        n = "";return o.labels.forEach(function (a, e) {
                        var t = o.datasets[0].backgroundColor[e];n += '<span class="chart-legend-item">', n += '<i class="chart-legend-indicator" style="background-color: ' + t + '"></i>', n += a, n += "</span>";
                    }), n;
                } } } }, Chart.scaleService.updateScaleDefaults("linear", { gridLines: { borderDash: [2], borderDashOffset: [2], color: n.gray[300], drawBorder: !1, drawTicks: !1, lineWidth: 0, zeroLineWidth: 0, zeroLineColor: n.gray[300], zeroLineBorderDash: [2], zeroLineBorderDashOffset: [2] }, ticks: { beginAtZero: !0, padding: 10, callback: function callback(a) {
                if (!(a % 10)) return a;
            } } }), Chart.scaleService.updateScaleDefaults("category", { gridLines: { drawBorder: !1, drawOnChartArea: !1, drawTicks: !1 }, ticks: { padding: 20 }, maxBarThickness: 10 }), a)), e.on({ change: function change() {
            var a = $(this);a.is("[data-add]") && l(a);
        }, click: function click() {
            var a = $(this);a.is("[data-update]") && i(a);
        } }), { colors: n, fonts: o, mode: t };
}(),
    OrdersChart = function () {
    var a,
        e,
        t = $("#chart-orders");$('[name="ordersSelect"]');t.length && (a = t, e = new Chart(a, { type: "bar", options: { scales: { yAxes: [{ ticks: { callback: function callback(a) {
                            if (!(a % 10)) return a;
                        } } }] }, tooltips: { callbacks: { label: function label(a, e) {
                        var t = e.datasets[a.datasetIndex].label || "",
                            o = a.yLabel,
                            n = "";return 1 < e.datasets.length && (n += '<span class="popover-body-label mr-auto">' + t + "</span>"), n += '<span class="popover-body-value">' + o + "</span>";
                    } } } }, data: { labels: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], datasets: [{ label: "Sales", data: [25, 20, 30, 22, 17, 29] }] } }), a.data("chart", e));
}(),
    SalesChart = function () {
    var a,
        e,
        t = $("#chart-sales");t.length && (a = t, e = new Chart(a, { type: "line", options: { scales: { yAxes: [{ gridLines: { color: Charts.colors.gray[900], zeroLineColor: Charts.colors.gray[900] }, ticks: { callback: function callback(a) {
                            if (!(a % 10)) return "$" + a + "k";
                        } } }] }, tooltips: { callbacks: { label: function label(a, e) {
                        var t = e.datasets[a.datasetIndex].label || "",
                            o = a.yLabel,
                            n = "";return 1 < e.datasets.length && (n += '<span class="popover-body-label mr-auto">' + t + "</span>"), n += '<span class="popover-body-value">$' + o + "k</span>";
                    } } } }, data: { labels: ["May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], datasets: [{ label: "Performance", data: [0, 20, 10, 30, 15, 40, 20, 60, 60] }] } }), a.data("chart", e));
}();
function count() {
    var maxLength = 1000;
    var txtVal = $('textarea').val();
    var chars = txtVal.length;

    if (chars > maxLength) {
        $('#counter').html("You've reached the maximum character limit.");
        $('#submit').prop('disabled', true);
    } else {
        $('#counter').html(chars + '/' + maxLength);
        $('#submit').prop('disabled', false);
    }
}
count();

//used for steam api key
function togglePassword(id) {
    var password = $("#" + id);
    password.attr("type", password.attr("type") === "password" ? "text" : "password");
}

$('textarea').on('keyup propertychange paste', function () {
    count();
});

$('document').ready(function () {
    $("#color").spectrum({
        containerClassName: 'color-picker',
        cancelText: '',
        chooseText: 'close',
        preferredFormat: "hex",
        showInput: true,
        move: function move(color) {
            $("#color").val(color.toHexString());
            var hexColor = "transparent";
            if (color) {
                hexColor = color.toHexString();
            }
            $("#fontAwesomeIcon").css("color", hexColor);
        }
    });
});
