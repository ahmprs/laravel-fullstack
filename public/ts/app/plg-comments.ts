class PlgComments extends Plg {
    private h3_title = null;
    private txt_comment = null;
    private btn_submit = null;
    private div_comments = null;
    constructor(ownerId, csrf_token = "") {
        super(ownerId, csrf_token);

        this.h3_title = this.make("h3");
        this.txt_comment = this.make("textarea");
        this.btn_submit = this.make("button");
        this.div_comments = this.make("div");

        this.prepare();
        this.assignEventHandlers();
    }

    private assignEventHandlers() {
        this.btn_submit.click(() => {
            let cmn_text = this.txt_comment.val();
            if (cmn_text.trim() == "") return;

            $.post("./api/insert-new-comment", { cmn_text }, (d, s) => {
                console.log(d);
                if (d["ok"] == 1) this.txt_comment.val("");
                this.reloadComments();
            });
        });
    }

    private prepare() {
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
    }

    private reloadComments() {
        $.post("./api/get-user-comments", {}, (d, s) => {
            if (d["ok"] != 1) return;

            /*debugger;*/
            this.div_comments.html("");
            let arr_recs = d["result"]["records"];
            let is_admin = d["result"]["is_admin"];

            for (let i = 0; i < arr_recs.length; i++) {
                let cmn = this.make("div", this.div_comments);
                cmn.addClass("round");
                cmn.addClass("bg-blue");
                cmn.addClass("p-2");
                cmn.css("color", "#123");
                cmn.css("margin", "1px");
                cmn.append($("<p></p>").text("✎" + arr_recs[i]["cmn_text"]));

                if (!is_admin) continue;

                let btn_approve = this.make("button", cmn);
                let approved = arr_recs[i]["cmn_approved"];
                let cmn_id = arr_recs[i]["cmn_id"];

                btn_approve.attr("approved", approved);
                btn_approve.attr("tag", cmn_id);

                btn_approve.text("✔ APPROVE");
                btn_approve.addClass("btn");
                btn_approve.addClass("mr-1");

                if (approved == 1) btn_approve.addClass("btn-success");
                else btn_approve.addClass("btn-secondary");

                btn_approve.click((event) => {
                    let btn = $(event.target);
                    let cmn_id = btn.attr("tag");
                    let approved = parseInt(btn.attr("approved"));
                    let cmn_approved = 1 - approved;

                    $.post(
                        "./api/approve-comment",
                        { cmn_id, cmn_approved },
                        (dd, ss) => {
                            console.log(dd);

                            if (dd["result"]["cmn_approved"] == 1) {
                                btn.removeClass("btn-secondary");
                                btn.addClass("btn-success");
                                btn.attr("approved", 1);
                            } else {
                                btn.removeClass("btn-success");
                                btn.addClass("btn-secondary");
                                btn.attr("approved", 0);
                            }
                        }
                    );
                });

                let btn_drop = this.make("button", cmn);
                btn_drop.text("✘ DELETE");
                btn_drop.addClass("btn");
                btn_drop.addClass("btn-danger");
                btn_drop.attr("tag", arr_recs[i]["cmn_id"]);
                btn_drop.click((event) => {
                    let btn = $(event.target);
                    let cmn_id = btn.attr("tag");
                    $.post("./api/delete-comment", { cmn_id }, (dd, ss) => {
                        if (dd["ok"] == 1) {
                            alert("comment removed");
                            btn.parent().fadeOut();
                        }
                    });
                });
            }
        });
    }

    public static init(ownerId, csrf_token = "") {
        new PlgComments(ownerId, csrf_token);
    }
}
