class PlgComments extends Plg {
    private h3_title = null;
    private txt_comment = null;
    private btn_submit = null;
    private div_comments = null;
    constructor(ownerId) {
        super(ownerId);

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
            $.post("./api/insert-new-comment", { cmn_text }, (d, s) => {
                console.log(d);
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

        this.div_comments.addClass("dark");
        this.div_comments.addClass("round");
        this.div_comments.addClass("p-2");

        $.post("./api/get-user-comments", {}, (d, s) => {
            if (d["ok"] != 1) return;

            /*debugger;*/
            this.div_comments.html("");
            let arr_recs = d["result"];

            for (let i = 0; i < arr_recs.length; i++) {
                let cmn = this.make("p", this.div_comments);
                cmn.addClass("round");
                cmn.addClass("bg-blue");
                cmn.addClass("p-2");
                cmn.addClass("md-1");
                cmn.css("color", "#123");
                cmn.text(arr_recs[i]["cmn_text"]);
            }
        });
    }
    public static init(ownerId) {
        new PlgComments(ownerId);
    }
}
