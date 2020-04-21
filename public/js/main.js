var sidebar_show = 0;

window.onresize = function () {
    adjustLayout();
};

function init() {
    // get a list of all links in #div_side_bar
    var div_side_bar = $("#div_side_bar");
    var arr = div_side_bar.children();
    var pnn = window.location.pathname.toLowerCase();

    // iterate over all tabs
    for (var i = 0; i < arr.length; i++) {
        var pn = arr[i]["pathname"];
        if (!pn) continue;
        pn = pn.toLowerCase();

        // finds the active tab
        if (pn == pnn) {
            $(arr[i]).addClass("active_tab");
        }
    }

    // ask for side bar state from backend
    $.post(root_url + "/api/get-side-bar-state", {}, function (d, s) {
        var sbs = d["result"]["side-bar"];

        // initiate global variable `sidebar_show`
        if (sbs) sidebar_show = 1;
        else sidebar_show = 0;

        // present side bar and adjust layout
        presentSidebar();
        adjustLayout();
    });
}

function presentSidebar() {
    var div_side_bar = $("#div_side_bar");

    if (sidebar_show == 0) {
        $("#btn_toggle_sidebar_1").fadeOut();
        $("#btn_toggle_sidebar_2").fadeIn();
        div_side_bar.hide();
    } else {
        div_side_bar.show();
        $("#btn_toggle_sidebar_1").fadeIn();
        $("#btn_toggle_sidebar_2").fadeOut();
    }
    adjustLayout();
}

function adjustLayout() {
    var div_body = document.getElementById("div_body");
    var div_header = document.getElementById("div_header");
    var div_side_bar = document.getElementById("div_side_bar");
    var stl = getComputedStyle(document.body);

    /* global css variable defined in main.css */
    var sidebar_width = stl.getPropertyValue("--sbw");
    var sbw = parseInt(sidebar_width.split("px").join(""));

    if (window.innerWidth > 600) {
        // with side bar
        div_side_bar.style.position = "fixed";
        div_side_bar.style.width = sidebar_width;
        div_header.style.position = "fixed";
        div_header.style.top = 0;
        div_body.style.marginTop = div_header.offsetHeight + "px";

        if (sidebar_show == 1) {
            div_side_bar.style.top = 0;
            div_side_bar.style.left = 0;
            div_body.style.marginLeft = sidebar_width;
            div_header.style.left = sbw + 5 + "px";
            div_header.style.width = window.innerWidth - sbw - 10 + "px";
        }

        // no side bar
        else {
            div_body.style.marginLeft = "0px";
            div_header.style.left = 5 + "px";
            div_header.style.width = window.innerWidth - 10 + "px";
        }
    }

    // small widow
    else {
        // with side bar
        div_body.style.marginTop = 0;
        div_side_bar.style.position = "relative";
        div_side_bar.style.width = "100%";
        div_body.style.marginLeft = 0;
        div_header.style.position = "relative";
        div_header.style.width = "100%";
        div_header.style.left = 0;
    }
}

function toggleSidebar() {
    sidebar_show = 1 - sidebar_show;
    presentSidebar();

    if (sidebar_show == 1) {
        $.post(root_url + "/api/show-side-bar", {}, function (d, s) {
            console.log({ d, s });
        });
    } else {
        $.post(root_url + "/api/hide-side-bar", {}, function (d, s) {
            console.log({ d, s });
        });
    }
}
