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
var CmpAccountManage = /** @class */ (function (_super) {
    __extends(CmpAccountManage, _super);
    function CmpAccountManage(ownerId, userId) {
        var _this = _super.call(this, ownerId) || this;
        _this.div_change_password = null;
        _this.btn_show_change_password = null;
        _this.btn_update_email = null;
        _this.btn_change_password = null;
        _this.txt_user_name = null;
        _this.txt_user_email = null;
        _this.user_id = null;
        _this.txt_psw_current = null;
        _this.txt_psw_new = null;
        _this.txt_psw_confirm = null;
        _this.user_id = userId;
        _this.div_change_password = _this.dlr("div_change_password");
        _this.btn_show_change_password = _this.dlr("btn_show_change_password");
        _this.btn_change_password = _this.dlr("btn_change_password");
        _this.btn_update_email = _this.dlr("btn_update_email");
        _this.txt_user_name = _this.dlr("txt_user_name");
        _this.txt_user_email = _this.dlr("txt_user_email");
        _this.txt_psw_current = _this.dlr("txt_psw_current");
        _this.txt_psw_new = _this.dlr("txt_psw_new");
        _this.txt_psw_confirm = _this.dlr("txt_psw_confirm");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpAccountManage.prototype.prepare = function () {
        this.div_change_password.hide();
        this.div_change_password.removeClass("d-none");
    };
    CmpAccountManage.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_show_change_password.click(function () {
            _this.div_change_password.fadeToggle();
        });
        this.btn_update_email.click(function () {
            var user_email = _this.txt_user_email.val().trim();
            if (user_email == "") {
                alert("Email field can not be empty");
                return;
            }
            $.post("./api/update-user-email-address", { user_id: _this.user_id, user_email: user_email }, function (d, s) {
                if (d["ok"] == 1) {
                    alert("EMAIL UPDATED");
                }
            });
        });
        this.btn_change_password.click(function () {
            // CHANGE PASSWORD
            var psw_current = _this.txt_psw_current.val();
            var psw_new = _this.txt_psw_new.val();
            var psw_confirm = _this.txt_psw_confirm.val();
            // if (psw_new == psw_current) {
            //     alert("NEW PASSWORD IS LIKE OLD ONE");
            //     return;
            // }
            if (psw_new != psw_confirm) {
                alert("PASSWORD MISMATCH");
                return;
            }
            $.post("./api/get-login-token", {}, function (d, s) {
                if (d["ok"] == 1) {
                    var user_name = _this.txt_user_name.val();
                    var login_token = d["result"];
                    var user_pass_hash = MD5TS.encrypt(psw_current);
                    var user_pass_hash_new = MD5TS.encrypt(psw_new);
                    var digest = MD5TS.encrypt(user_pass_hash + login_token);
                    $.post("./api/sign-in-inquiry", {
                        digest: digest,
                        user_pass_hash_new: user_pass_hash_new,
                        user_name: user_name,
                    }, function (dd, ss) {
                        console.log(dd);
                        if (dd["ok"] == 1) {
                            alert("PASSWORD CHANGED");
                            _this.div_change_password.fadeOut();
                        }
                    });
                }
            });
        });
    };
    CmpAccountManage.init = function (ownerId, userId) {
        new CmpAccountManage(ownerId, userId);
    };
    return CmpAccountManage;
}(Cmp));
