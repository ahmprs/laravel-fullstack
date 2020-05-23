var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var PlgComments = /** @class */ (function (_super) {
    __extends(PlgComments, _super);
    function PlgComments(ownerId) {
        var _this = _super.call(this, ownerId) || this;
        _this.h3_title = null;
        _this.txt_comment = null;
        _this.btn_submit = null;
        _this.div_comments = null;
        _this.h3_title = _this.make("h3");
        _this.txt_comment = _this.make("textarea");
        _this.btn_submit = _this.make("button");
        _this.div_comments = _this.make("div");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    PlgComments.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_submit.click(function () {
            var cmn_text = _this.txt_comment.val();
            $.post("./api/insert-new-comment", { cmn_text: cmn_text }, function (d, s) {
                console.log(d);
            });
        });
    };
    PlgComments.prototype.prepare = function () {
        var _this = this;
        this.h3_title.text("Leave us a comment ...");
        this.h3_title.css("font-family", '"Times New Roman", Times, serif');
        this.h3_title.css("font-style", "italic");
        this.h3_title.addClass("center");
        this.h3_title.addClass("light");
        this.h3_title.addClass("round");
        this.txt_comment.addClass("form-control");
        this.txt_comment.addClass("col-md-12");
        this.txt_comment.addClass("p-3");
        this.txt_comment.attr("rows", "5");
        this.btn_submit.addClass("btn");
        this.btn_submit.addClass("btn-success");
        this.btn_submit.addClass("form-control");
        this.btn_submit.addClass("col-md-2");
        this.btn_submit.text("SUBMIT");
        this.div_comments.addClass("dark");
        this.div_comments.addClass("round");
        this.div_comments.addClass("p-2");
        $.post("./api/get-user-comments", {}, function (d, s) {
            if (d["ok"] != 1)
                return;
            /*debugger;*/
            _this.div_comments.html("");
            var arr_recs = d["result"];
            for (var i = 0; i < arr_recs.length; i++) {
                var cmn = _this.make("p", _this.div_comments);
                cmn.addClass("round");
                cmn.addClass("bg-blue");
                cmn.addClass("p-2");
                cmn.addClass("md-1");
                cmn.css("color", "#123");
                cmn.text(arr_recs[i]["cmn_text"]);
            }
        });
    };
    PlgComments.init = function (ownerId) {
        new PlgComments(ownerId);
    };
    return PlgComments;
}(Plg));
