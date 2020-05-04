class CmpCalendar extends Cmp {
    private div_modal = null;
    private div_modal_title = null;
    private tbl_calendar = null;
    private btn_cancel = null;
    private btn_ok = null;
    private txt_date = null;
    private btn_next_month = null;
    private btn_prev_month = null;
    private arr_btn = [];

    constructor(ownerId) {
        super(ownerId);

        this.div_modal = this.dlr("div_modal");
        this.div_modal_title = this.dlr("div_modal_title");
        this.tbl_calendar = this.dlr("tbl_calendar");
        this.btn_cancel = this.dlr("btn_cancel");
        this.btn_ok = this.dlr("btn_ok");
        this.txt_date = this.dlr("txt_date");

        this.btn_next_month = this.dlr("btn_next_month");
        this.btn_prev_month = this.dlr("btn_prev_month");

        let indx = 0;
        for (let i = 0; i < 7; i++) {
            for (let j = 0; j < 7; j++) {
                // debugger;
                this.arr_btn.push(this.dlr("btn_" + indx));
                indx++;
            }
        }

        this.assignEventHandlers();
    }

    private assignEventHandlers() {
        let self = this;

        this.btn_next_month.on("click", () => {
            alert("NEXT");
        });

        this.btn_prev_month.on("click", () => {
            alert("PREV");
        });

        this.btn_ok.on("click", () => {
            alert("OK");
        });

        this.btn_cancel.on("click", () => {
            alert("CANCEL");
        });

        for (let i = 0; i < this.arr_btn.length; i++) {
            this.arr_btn[i].on("click", () => {
                let btn = self.applyPath(window, "event/target");
                let gdp = self.applyPath(btn, "attributes/gdp/value");
                let jal = self.applyPath(btn, "attributes/jal/value");
                let greg = self.applyPath(btn, "attributes/greg/value");

                self.txt_date.val(jal + "-" + greg);
                self.txt_date.attr("gdp", gdp);
                self.txt_date.attr("jal", jal);
                self.txt_date.attr("greg", greg);

                console.log({ gdp, jal, greg });
            });
        }
    }

    public static init(ownerId) {
        new CmpCalendar(ownerId);
    }
}
