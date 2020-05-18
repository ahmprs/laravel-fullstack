class PlgAdd extends Plg {
    private h1_title = null;
    private h2_title = null;
    private txt_a = null;
    private txt_b = null;
    private btn_add = null;
    private spn_result = null;

    constructor(ownerId) {
        super(ownerId);
        this.h1_title = this.make("h1");
        this.h2_title = this.make("h2");
        this.txt_a = this.make("input");
        this.txt_b = this.make("input");
        this.btn_add = this.make("button");
        this.make("br");
        this.spn_result = this.make("span");

        this.prepare();
        this.assignEventHandlers();
    }

    private prepare() {
        this.h1_title.text("SAMPLE PLUGIN");
        this.h2_title.text("Add Numbers");
        this.h2_title.css("font-style", "italic");

        this.txt_a.addClass("col-md-4");
        this.txt_a.addClass("form-control");
        this.txt_a.attr("type", "number");
        this.txt_a.val(0);
        this.txt_a.attr("placeholder", "A = ?");

        this.txt_b.addClass("col-md-4");
        this.txt_b.addClass("form-control");
        this.txt_b.attr("type", "number");
        this.txt_b.val(0);
        this.txt_b.attr("placeholder", "A = ?");

        this.btn_add.addClass("btn");
        this.btn_add.addClass("btn-secondary");
        this.btn_add.text("ADD");

        this.spn_result.text("RESULT");
    }

    private assignEventHandlers() {
        this.btn_add.on("click", () => {
            let a = parseInt(this.txt_a.val());
            let b = parseInt(this.txt_b.val());
            let c = a + b;

            this.spn_result.text(c);
        });
    }

    public static init(ownerId) {
        new PlgAdd(ownerId);
    }
}
