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
var PlgAdminDirect = /** @class */ (function (_super) {
    __extends(PlgAdminDirect, _super);
    function PlgAdminDirect(ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        var _this = _super.call(this, ownerId, csrf_token) || this;
        _this.ta_msg = null;
        _this.txt_sender = null;
        _this.btn_submit = null;
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    PlgAdminDirect.prototype.prepare = function () {
        var d = this.me;
        this.make("hr", d);
        var h = this.make("h4", d);
        h.text("Direct Contact to Manager (Admin)");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "orange");
        this.ta_msg = this.make("textarea", d);
        this.ta_msg.attr("placeholder", "Your Direct points to manager");
        this.ta_msg.addClass("form-control");
        this.ta_msg.addClass("col-md-12");
        this.ta_msg.addClass("mb-1");
        this.txt_sender = this.make("input", d);
        this.txt_sender.attr("type", "text");
        this.txt_sender.attr("placeholder", "Yor Nice Name or Email");
        this.txt_sender.addClass("form-control");
        this.txt_sender.addClass("col-md-4");
        this.txt_sender.addClass("mb-1");
        this.btn_submit = this.make("button", d);
        this.btn_submit.addClass("btn");
        this.btn_submit.addClass("btn-primary");
        this.btn_submit.text("SUBMIT");
    };
    PlgAdminDirect.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_submit.click(function () {
            var mng_sender = _this.txt_sender.val();
            var mng_message = _this.ta_msg.val();
            if (mng_message.trim() == "") {
                alert("empty message not allowed");
                return;
            }
            if (mng_sender.trim() == "") {
                alert("please supply an email or name");
                return;
            }
            $.post("./api/msg-to-admin", {
                mng_sender: mng_sender,
                mng_message: mng_message,
            }, function (d, s) {
                if (d["ok"] == 1) {
                    alert("Message sent to admin");
                    _this.txt_sender.val("");
                    _this.ta_msg.val("");
                    alert("message is sent to admin");
                }
            });
        });
    };
    PlgAdminDirect.init = function (ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        new PlgAdminDirect(ownerId, csrf_token);
    };
    return PlgAdminDirect;
}(Plg));
