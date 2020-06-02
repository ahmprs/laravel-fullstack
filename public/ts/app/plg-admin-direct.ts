class PlgAdminDirect extends Plg {
    private ta_msg = null;
    private txt_sender = null;
    private btn_submit = null;

    constructor(ownerId, csrf_token = "") {
        super(ownerId, csrf_token);

        this.prepare();
        this.assignEventHandlers();
    }

    private prepare() {
        let d = this.me;
        this.make("hr", d);

        let h = this.make("h4", d);
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
    }
    private assignEventHandlers() {
        this.btn_submit.click(() => {
            let mng_sender = this.txt_sender.val();
            let mng_message = this.ta_msg.val();

            if (mng_message.trim() == "") {
                alert("empty message not allowed");
                return;
            }

            if (mng_sender.trim() == "") {
                alert("please supply an email or name");
                return;
            }

            $.post(
                "./api/msg-to-admin",
                {
                    mng_sender,
                    mng_message,
                },
                (d, s) => {
                    if (d["ok"] == 1) {
                        alert("Message sent to admin");
                        this.txt_sender.val("");
                        this.ta_msg.val("");

                        alert("message is sent to admin");
                    }
                }
            );
        });
    }

    public static init(ownerId, csrf_token = "") {
        new PlgAdminDirect(ownerId, csrf_token);
    }
}
