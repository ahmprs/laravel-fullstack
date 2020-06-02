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
    function PlgComments(ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        var _this = _super.call(this, ownerId, csrf_token) || this;
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
            if (cmn_text.trim() == "")
                return;
            $.post("./api/insert-new-comment", { cmn_text: cmn_text }, function (d, s) {
                console.log(d);
                if (d["ok"] == 1)
                    _this.txt_comment.val("");
                _this.reloadComments();
            });
        });
    };
    PlgComments.prototype.prepare = function () {
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
        this.div_comments.addClass("light");
        this.div_comments.addClass("round");
        this.div_comments.addClass("p-2");
        this.reloadComments();
    };
    PlgComments.prototype.reloadComments = function () {
        var _this = this;
        $.post("./api/get-user-comments", {}, function (d, s) {
            if (d["ok"] != 1)
                return;
            /*debugger;*/
            _this.div_comments.html("");
            var arr_recs = d["result"]["records"];
            var is_admin = d["result"]["is_admin"];
            for (var i = 0; i < arr_recs.length; i++) {
                var cmn = _this.make("div", _this.div_comments);
                cmn.addClass("round");
                cmn.addClass("bg-blue");
                cmn.addClass("p-2");
                cmn.css("color", "#123");
                cmn.css("margin", "1px");
                cmn.append($("<p></p>").text("✎" + arr_recs[i]["cmn_text"]));
                if (!is_admin)
                    continue;
                var btn_approve = _this.make("button", cmn);
                var approved = arr_recs[i]["cmn_approved"];
                var cmn_id = arr_recs[i]["cmn_id"];
                btn_approve.attr("approved", approved);
                btn_approve.attr("tag", cmn_id);
                btn_approve.text("✔ APPROVE");
                btn_approve.addClass("btn");
                btn_approve.addClass("mr-1");
                if (approved == 1)
                    btn_approve.addClass("btn-success");
                else
                    btn_approve.addClass("btn-secondary");
                btn_approve.click(function (event) {
                    var btn = $(event.target);
                    var cmn_id = btn.attr("tag");
                    var approved = parseInt(btn.attr("approved"));
                    var cmn_approved = 1 - approved;
                    $.post("./api/approve-comment", { cmn_id: cmn_id, cmn_approved: cmn_approved }, function (dd, ss) {
                        console.log(dd);
                        if (dd["result"]["cmn_approved"] == 1) {
                            btn.removeClass("btn-secondary");
                            btn.addClass("btn-success");
                            btn.attr("approved", 1);
                        }
                        else {
                            btn.removeClass("btn-success");
                            btn.addClass("btn-secondary");
                            btn.attr("approved", 0);
                        }
                    });
                });
                var btn_drop = _this.make("button", cmn);
                btn_drop.text("✘ DELETE");
                btn_drop.addClass("btn");
                btn_drop.addClass("btn-danger");
                btn_drop.attr("tag", arr_recs[i]["cmn_id"]);
                btn_drop.click(function (event) {
                    var btn = $(event.target);
                    var cmn_id = btn.attr("tag");
                    $.post("./api/delete-comment", { cmn_id: cmn_id }, function (dd, ss) {
                        if (dd["ok"] == 1) {
                            alert("comment removed");
                            btn.parent().fadeOut();
                        }
                    });
                });
            }
        });
    };
    PlgComments.init = function (ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        new PlgComments(ownerId, csrf_token);
    };
    return PlgComments;
}(Plg));
