function init() {
    console.log("INIT NOW");
    // get a list of all links in #div_side_bar

    var div_side_bar = $("#div_side_bar");
    var arr = div_side_bar.children();
    // console.log(arr);

    // console.log(window.location.pathname);
    var pnn = window.location.pathname.toLowerCase();
    for (var i = 0; i < arr.length; i++) {
        var pn = arr[i]["pathname"];
        if (!pn) continue;
        pn = pn.toLowerCase();
        if (pn == pnn) {
            $(arr[i]).addClass("active_tab");
        }
        // console.log(pn);
    }

    // arr.foreach((v, i, a) => {
    //     // console.log(v["pathname"]);
    //     console.log(v);
    // });

    // get the current path

    // if the current path and the href of a given link are the same
    // add class .active_tab to that link
}

function btnAddClick() {
    var x = parseFloat($("#txtA").val());
    var y = parseFloat($("#txtB").val());

    $.post("./api/add-numbers", { x, y }, (d, s) => {
        console.log(d);
        $("#spnC").text(d["result"]);
    });
}

function search() {
    var txt = $("#txtSearch").val();
    // alert("LOOKING FOR: " + txt);
    $("#div_search_results")
        .html("")
        .append($("<a href='/about-us'></a>").text("ABOUT US"));
}
