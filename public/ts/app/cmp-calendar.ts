class CmpCalendar extends Cmp {
    private div_modal = null;
    private div_modal_title = null;
    private div_brief = null;
    private h4_greg_date = null;
    private h4_jal_date = null;
    private h3_jal_date_str = null;
    private h3_greg_date_str = null;

    private tbl_calendar = null;
    private btn_cancel = null;
    private btn_ok = null;
    private txt_date = null;
    private btn_next_month = null;
    private btn_prev_month = null;
    private arr_btn = [];

    private server_gdp = 0;
    private gdp = 0;

    constructor(ownerId) {
        super(ownerId);

        this.div_modal = this.dlr("div_modal");
        this.div_modal_title = this.dlr("div_modal_title");
        this.div_brief = this.dlr("div_brief");
        this.h4_greg_date = this.dlr("h4_greg_date");
        this.h4_jal_date = this.dlr("h4_jal_date");
        this.h3_jal_date_str = this.dlr("h3_jal_date_str");
        this.h3_greg_date_str = this.dlr("h3_greg_date_str");
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

        this.present();
        this.prepare();
        this.assignEventHandlers();
    }

    private present() {
        let gdp = parseInt(this.txt_date.attr("gdp"));
        let server_gdp = parseInt(this.txt_date.attr("server_gdp"));
        let diff = server_gdp - gdp;

        let c = new Calendar();
        let jal = c.getJalDateFromGdp(gdp);
        let ds = jal["DateString"];
        let pst = "";
        if (diff == 0) pst = " today";
        else if (diff == 1) pst = "yesterday";
        else if (diff == -1) pst = "tomorrow";
        else if (diff > 0) pst = diff + " days ago";
        else pst = "in " + -diff + " days";

        this.txt_date.val(ds + "    " + "(" + pst + ")");
    }

    private prepare() {
        let btn = null;
        let spn = null;
        let sub = null;
        let spn2 = null;

        this.server_gdp = parseInt(this.txt_date.attr("server_gdp"));
        this.gdp = parseInt(this.txt_date.attr("gdp"));

        let c = new Calendar();
        let jal = c.getJalDateFromGdp(this.gdp);
        let greg = c.getGregDateFromGdp(this.gdp);

        let d = jal["DayOfMonth"];
        //--
        this.h4_greg_date.text(greg["DateString"]);
        this.h4_greg_date.attr("gdp", this.gdp);
        this.h4_greg_date.attr("jal", jal["DateString"]);
        this.h4_greg_date.attr("greg", greg["DateString"]);
        this.h4_jal_date.text(jal["DateString"]);
        this.h4_jal_date.attr("gdp", this.gdp);
        this.h4_jal_date.attr("jal", jal["DateString"]);
        this.h4_jal_date.attr("jal", jal["DateString"]);

        this.h3_jal_date_str.text(
            jal["DayOfMonth"] + " " + jal["MonthTitle"] + " " + jal["Year"]
        );
        this.h3_greg_date_str.text(
            greg["DayOfMonth"] + " " + greg["MonthTitle"] + " " + greg["Year"]
        );
        //--

        let g = this.gdp - d + 1;
        let jal_base = c.getJalDateFromGdp(g);
        let w = jal_base["DayOfWeek"];
        let m = jal_base["Month"];

        for (let i = 0; i < this.arr_btn.length; i++) {
            // assign a name for current button
            btn = this.arr_btn[i];
            spn = $(btn.children()[0]);
            sub = $(btn.children()[1]);
            spn2 = $(btn.children()[2]);
            spn2.hide();

            // apply the first day of week
            if (i < w) {
                btn.hide();
                spn.text("");
                sub.text("");
                btn.attr("gdp", 0);
                spn.attr("gdp", 0);
                sub.attr("gdp", 0);
                spn2.attr("gdp", 0);
                continue;
            }

            btn.fadeIn();
            jal = c.getJalDateFromGdp(g);
            greg = c.getGregDateFromGdp(g);

            // if we get at the end of month
            if (m != jal["Month"]) {
                for (let j = i; j < this.arr_btn.length; j++) {
                    btn = this.arr_btn[j];
                    spn = $(btn.children()[0]);
                    sub = $(btn.children()[1]);
                    spn2 = $(btn.children()[2]);

                    btn.hide();
                    spn.text("");
                    sub.text("");
                    btn.attr("gdp", 0);
                    spn.attr("gdp", 0);
                    sub.attr("gdp", 0);
                    spn2.attr("gdp", 0);
                }
                break;
            }

            // set day of month and gdp
            spn.text(jal["DayOfMonth"]);
            sub.text(greg["DayOfMonth"]);

            if (jal["DayOfWeek"] >= 5) {
                btn.removeClass("btn-primary");
                btn.addClass("btn-success");
            } else {
                btn.removeClass("btn-success");
                btn.addClass("btn-primary");
            }

            if (greg["DayOfMonth"] == 1) {
                spn2.text(greg["MonthTitle"]);
                spn2.fadeIn();
                sub.hide();
            } else {
                spn2.text("");
                sub.show();
            }

            btn.attr("gdp", g);
            spn.attr("gdp", g);
            sub.attr("gdp", g);
            spn2.attr("gdp", g);
            g++;
        }
    }

    private assignEventHandlers() {
        let self = this;

        this.btn_next_month.on("click", () => {
            let c = new Calendar();
            let jal = c.getJalDateFromGdp(self.gdp);
            let y = jal["Year"];
            let m = jal["Month"];
            if (m < 12) m++;
            else {
                m = 1;
                y++;
            }
            self.gdp = c.jalDateToGdp(y, m, 1);
            self.txt_date.attr("gdp", self.gdp);
            self.prepare();
        });

        this.btn_prev_month.on("click", () => {
            let c = new Calendar();
            let jal = c.getJalDateFromGdp(self.gdp);
            let y = jal["Year"];
            let m = jal["Month"];
            if (m > 1) m--;
            else {
                m = 12;
                y--;
            }
            self.gdp = c.jalDateToGdp(y, m, 1);
            self.txt_date.attr("gdp", self.gdp);
            self.prepare();
        });

        this.btn_ok.on("click", () => {
            self.txt_date.attr("gdp", self.h4_greg_date.attr("gdp"));
            self.txt_date.attr("jal", self.h4_greg_date.attr("jal"));
            self.txt_date.attr("greg", self.h4_greg_date.attr("greg"));
            self.present();
        });

        this.btn_cancel.on("click", () => {
            // alert("CANCEL");
        });

        for (let i = 0; i < this.arr_btn.length; i++) {
            this.arr_btn[i].on("click", () => {
                let btn = $(self.applyPath(window, "event/target"));
                let gdp = btn.attr("gdp");

                let c = new Calendar();
                let jal = c.getJalDateFromGdp(gdp);
                let greg = c.getGregDateFromGdp(gdp);

                self.h4_greg_date.text(greg["DateString"]);
                self.h4_greg_date.attr("gdp", gdp);
                self.h4_greg_date.attr("jal", jal["DateString"]);
                self.h4_greg_date.attr("greg", greg["DateString"]);

                self.h4_jal_date.text(jal["DateString"]);
                self.h4_jal_date.attr("gdp", gdp);
                self.h4_jal_date.attr("jal", jal["DateString"]);
                self.h4_jal_date.attr("jal", jal["DateString"]);

                self.h3_jal_date_str.text(
                    jal["DayOfMonth"] +
                        " " +
                        jal["MonthTitle"] +
                        " " +
                        jal["Year"]
                );
                self.h3_greg_date_str.text(
                    greg["DayOfMonth"] +
                        " " +
                        greg["MonthTitle"] +
                        " " +
                        greg["Year"]
                );
            });
        }
    }

    public static init(ownerId) {
        new CmpCalendar(ownerId);
    }
}
