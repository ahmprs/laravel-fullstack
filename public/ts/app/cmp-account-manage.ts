class CmpAccountManage extends Cmp {
    private div_change_password = null;
    private btn_show_change_password = null;
    private btn_update_email = null;
    private btn_change_password = null;
    private txt_user_name = null;
    private txt_user_email = null;
    private user_id = null;

    private txt_psw_current = null;
    private txt_psw_new = null;
    private txt_psw_confirm = null;

    constructor(ownerId, userId) {
        super(ownerId);

        this.user_id = userId;
        this.div_change_password = this.dlr("div_change_password");
        this.btn_show_change_password = this.dlr("btn_show_change_password");
        this.btn_change_password = this.dlr("btn_change_password");
        this.btn_update_email = this.dlr("btn_update_email");
        this.txt_user_name = this.dlr("txt_user_name");
        this.txt_user_email = this.dlr("txt_user_email");

        this.txt_psw_current = this.dlr("txt_psw_current");
        this.txt_psw_new = this.dlr("txt_psw_new");
        this.txt_psw_confirm = this.dlr("txt_psw_confirm");

        this.prepare();
        this.assignEventHandlers();
    }

    private prepare() {
        this.div_change_password.hide();
        this.div_change_password.removeClass("d-none");
    }

    private assignEventHandlers() {
        this.btn_show_change_password.click(() => {
            this.div_change_password.fadeToggle();
        });

        this.btn_update_email.click(() => {
            let user_email = this.txt_user_email.val().trim();
            if (user_email == "") {
                alert("Email field can not be empty");
                return;
            }

            $.post(
                "./api/update-user-email-address",
                { user_id: this.user_id, user_email },
                (d, s) => {
                    if (d["ok"] == 1) {
                        alert("EMAIL UPDATED");
                    }
                }
            );
        });

        this.btn_change_password.click(() => {
            // CHANGE PASSWORD
            let psw_current = this.txt_psw_current.val();
            let psw_new = this.txt_psw_new.val();
            let psw_confirm = this.txt_psw_confirm.val();

            // if (psw_new == psw_current) {
            //     alert("NEW PASSWORD IS LIKE OLD ONE");
            //     return;
            // }

            if (psw_new != psw_confirm) {
                alert("PASSWORD MISMATCH");
                return;
            }

            $.post("./api/get-login-token", {}, (d, s) => {
                if (d["ok"] == 1) {
                    let user_name = this.txt_user_name.val();
                    let login_token = d["result"];
                    let user_pass_hash = MD5TS.encrypt(psw_current);
                    let user_pass_hash_new = MD5TS.encrypt(psw_new);
                    let digest = MD5TS.encrypt(user_pass_hash + login_token);

                    $.post(
                        "./api/sign-in-inquiry",
                        {
                            digest,
                            user_pass_hash_new,
                            user_name,
                        },
                        (dd, ss) => {
                            console.log(dd);
                            if (dd["ok"] == 1) {
                                alert("PASSWORD CHANGED");
                                this.div_change_password.fadeOut();
                            }
                        }
                    );
                }
            });
        });
    }

    public static init(ownerId, userId) {
        new CmpAccountManage(ownerId, userId);
    }
}
