function init() {
    // get a list of all links in #div_side_bar
    var div_side_bar = $("#div_side_bar");
    var arr = div_side_bar.children();
    var pnn = window.location.pathname.toLowerCase();
    for (var i = 0; i < arr.length; i++) {
        var pn = arr[i]["pathname"];
        if (!pn) continue;
        pn = pn.toLowerCase();
        if (pn == pnn) {
            $(arr[i]).addClass("active_tab");
        }
    }

    $.post("/api/get-side-bar-state", {}, function (d, s) {
        console.log("side-bar", d);

        var sbs = d["result"]["side-bar"];
        if (sbs) sidebar_show = 1;
        else sidebar_show = 0;
        presentSidebar();
    });
}

function presentSidebar() {
    var div_side_bar = $("#div_side_bar");
    var div_body = document.getElementById("div_body");
    var stl = getComputedStyle(document.body);
    var sidebar_width = stl.getPropertyValue("--sbw");

    if (sidebar_show == 0) {
        div_side_bar.fadeOut(function () {
            div_body.style["marginLeft"] = 0;
            $("#btn_toggle_sidebar_1").fadeOut();
            $("#btn_toggle_sidebar_2").fadeIn();
        });
    } else {
        div_side_bar.fadeIn();
        div_body.style["marginLeft"] = sidebar_width;
        $("#btn_toggle_sidebar_1").fadeIn();
        $("#btn_toggle_sidebar_2").fadeOut();
    }
}

function toggleSidebar() {
    sidebar_show = 1 - sidebar_show;
    presentSidebar();
    if (sidebar_show == 1) {
        $.post("/api/show-side-bar", {}, function (d, s) {
            console.log({ d, s });
        });
    } else {
        $.post("/api/hide-side-bar", {}, function (d, s) {
            console.log({ d, s });
        });
    }
}
