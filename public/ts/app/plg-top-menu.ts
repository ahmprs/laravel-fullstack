class PlgTopMenu extends Plg {
    private btn_products = null;
    private btn_contacts = null;
    private btn_orders = null;
    private btn_customer = null;
    private btn_offers = null;

    private div_products = null;
    private div_contacts = null;
    private div_orders = null;
    private div_customer = null;
    private div_offers = null;

    private div_products_inner = null;
    private div_contacts_inner = null;
    private div_orders_inner = null;
    private div_customer_inner = null;
    private div_offers_inner = null;

    private div_products_btn_close = null;
    private div_contacts_btn_close = null;
    private div_orders_btn_close = null;
    private div_customer_btn_close = null;
    private div_offers_btn_close = null;

    private arr_div = [];
    private arr_div_inner = [];
    private arr_btn = [];
    private arr_btn_close = [];

    constructor(ownerId, csrf_token = "") {
        super(ownerId, csrf_token);

        this.btn_products = this.make("button");
        this.btn_contacts = this.make("button");
        this.btn_orders = this.make("button");
        this.btn_customer = this.make("button");
        this.btn_offers = this.make("button");

        this.div_products = this.make("div");
        this.div_contacts = this.make("div");
        this.div_orders = this.make("div");
        this.div_customer = this.make("div");
        this.div_offers = this.make("div");

        this.div_products_inner = this.make("div", this.div_products);
        this.div_contacts_inner = this.make("div", this.div_contacts);
        this.div_orders_inner = this.make("div", this.div_orders);
        this.div_customer_inner = this.make("div", this.div_customer);
        this.div_offers_inner = this.make("div", this.div_offers);

        this.div_products_btn_close = this.make(
            "button",
            this.div_products_inner
        );
        this.div_contacts_btn_close = this.make(
            "button",
            this.div_contacts_inner
        );
        this.div_orders_btn_close = this.make("button", this.div_orders_inner);
        this.div_customer_btn_close = this.make(
            "button",
            this.div_customer_inner
        );
        this.div_offers_btn_close = this.make("button", this.div_offers_inner);

        this.arr_div = [
            this.div_products,
            this.div_contacts,
            this.div_orders,
            this.div_customer,
            this.div_offers,
        ];

        this.arr_div_inner = [
            this.div_products_inner,
            this.div_contacts_inner,
            this.div_orders_inner,
            this.div_customer_inner,
            this.div_offers_inner,
        ];

        this.arr_btn = [
            this.btn_products,
            this.btn_contacts,
            this.btn_orders,
            this.btn_customer,
            this.btn_offers,
        ];

        this.arr_btn_close = [
            this.div_products_btn_close,
            this.div_contacts_btn_close,
            this.div_orders_btn_close,
            this.div_customer_btn_close,
            this.div_offers_btn_close,
        ];

        this.prepare();
        this.assignEventHandlers();
    }

    private prepare() {
        this.div_products_inner.hide();
        this.div_contacts_inner.hide();
        this.div_orders_inner.hide();
        this.div_customer_inner.hide();
        this.div_offers_inner.hide();

        this.div_products.hide();
        this.div_contacts.hide();
        this.div_orders.hide();
        this.div_customer.hide();
        this.div_offers.hide();

        this.prepareProducts();
        this.prepareCustomer();
        this.prepareContacts();
        this.prepareOrders();
        this.prepareOffers();

        this.arr_btn_close.forEach((v) => {
            v.text("×");
            v.addClass("btn");
            v.addClass("btn-danger");
            v.addClass("float-right");
        });

        this.arr_btn.forEach((btn) => {
            btn.css("padding-left", "10px");
            btn.css("padding-right", "10px");
            btn.css("padding-top", "10px");
            btn.css("padding-bottom", "10px");

            btn.css("background-color", "white");
            btn.css("border", "solid");
            btn.css("border-color", "red");
            btn.css("border-width", "0px");

            btn.addClass("round-top-left");
            btn.addClass("round-top-right");

            btn.hover((event) => {
                let t = $(event["target"]);
                t.css("color", "orange");
                t.css("background-color", "#3f3f3f");
                t.css("border", "solid");
                t.css("border-color", "red");
                t.css("border-top-width", "3px");
                t.css("border-bottom-width", "0px");
                t.css("border-left-width", "0px");
                t.css("border-right-width", "0px");

                /* Clear all other tab buttons */
                for (let i = 0; i < this.arr_btn.length; i++) {
                    let b = this.arr_btn[i];
                    if (b.text() === t.text()) continue;
                    this.clearButton(b);
                }
            });

            btn.mouseleave((event) => {
                let t = $(event["target"]);
                t.css("color", "black");
                t.css("background-color", "white");
                t.css("border-top-width", "0px");
            });
        });

        this.btn_products.text("▼ PRODUCTS");
        this.btn_contacts.text("CONTACTS");
        this.btn_orders.text("ORDERS");
        this.btn_customer.text("CUSTOMER");
        this.btn_offers.text("▼ OFFERS");
    }

    private assignEventHandlers() {
        this.btn_products.hover(() => {
            this.present(this.div_products);
        });
        this.btn_contacts.hover(() => {
            this.present(this.div_contacts);
        });
        this.btn_orders.hover(() => {
            this.present(this.div_orders);
        });
        this.btn_customer.hover(() => {
            this.present(this.div_customer);
        });
        this.btn_offers.hover(() => {
            this.present(this.div_offers);
        });

        this.div_products_btn_close.click(() => {
            this.clearButton(this.btn_products);
            this.div_products.fadeOut();
        });
        this.div_contacts_btn_close.click(() => {
            this.clearButton(this.btn_contacts);
            this.div_contacts.fadeOut();
        });
        this.div_orders_btn_close.click(() => {
            this.clearButton(this.btn_orders);
            this.div_orders.fadeOut();
        });
        this.div_customer_btn_close.click(() => {
            this.clearButton(this.btn_customer);
            this.div_customer.fadeOut();
        });
        this.div_offers_btn_close.click(() => {
            this.clearButton(this.btn_offers);
            this.div_offers.fadeOut();
        });

        this.div_products_inner.hover(() => {
            let d = this.btn_products;
            d.css("color", "orange");
            d.css("background-color", "#3f3f3f");
            d.css("border-top-width", "3px");
        });

        this.div_customer_inner.hover(() => {
            let d = this.btn_customer;
            d.css("color", "orange");
            d.css("background-color", "#3f3f3f");
            d.css("border-top-width", "3px");
        });

        this.div_contacts_inner.hover(() => {
            let d = this.btn_contacts;
            d.css("color", "orange");
            d.css("background-color", "#3f3f3f");
            d.css("border-top-width", "3px");
        });

        this.div_orders_inner.hover(() => {
            let d = this.btn_orders;
            d.css("color", "orange");
            d.css("background-color", "#3f3f3f");
            d.css("border-top-width", "3px");
        });

        this.div_offers_inner.hover(() => {
            let d = this.btn_offers;
            d.css("color", "orange");
            d.css("background-color", "#3f3f3f");
            d.css("border-top-width", "3px");
        });
    }

    private present(div) {
        for (let i = 0; i < this.arr_div.length; i++) {
            if (div == this.arr_div[i]) {
                div.show();
                this.arr_div_inner[i].slideDown();
            } else {
                this.arr_div_inner[i].hide();
                this.arr_div[i].hide();
            }
        }
    }

    private prepareProducts() {
        let d = null;
        let h = null;
        let p = null;
        let sp = null;
        let a = null;
        let div_foot = null;

        /* -------------------------------------------------- */
        d = this.div_products_inner;

        d.css("cursor", "pointer");
        d.css("background-color", "#3f3f3f");
        d.css("color", "#eff");
        d.css("border-bottom-left-radius", "5px");
        d.css("border-bottom-right-radius", "5px");
        d.addClass("p-2");

        h = this.make("h4", d);
        h.text("Real Estate Company System (R.E.C.S)");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text(
            "A desktop application for real estate activities with the following main features"
        );
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");

        this.make("br", d);

        sp = this.make("span", d);
        sp.text("Mortgage | Rent | Purchase | Sell");
        sp.css("font-family", "Times New Roman");
        sp.css("font-style", "italic");
        sp.css("color", "#f39ea2");
        this.make("hr", d);

        /* -------------------------------------------------- */
        h = this.make("h4", d);
        h.text("Document Archive System (D.A.S)");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text("A desktop application for archiving documents providing:");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");

        this.make("br", d);

        sp = this.make("span", d);
        sp.text(
            "Instant Content Search | Versioning | Document History | Document Distribution | Group Collaboration"
        );
        sp.css("font-family", "Times New Roman");
        sp.css("font-style", "italic");
        sp.css("color", "#f39ea2");
        this.make("hr", d);
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("Bazaar");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text(
            "Useful accountant app for small and medium stores with tens of cool features"
        );
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");

        this.make("br", d);

        sp = this.make("span", d);
        sp.text(
            "Accounting | Warehousing | Barcode Support | Automatic Update | SMS To Customers | Cost-Benefit Analysis | Report Center"
        );
        sp.css("font-family", "Times New Roman");
        sp.css("font-style", "italic");
        sp.css("color", "#f39ea2");
        this.make("hr", d);
        /* -------------------------------------------------- */

        div_foot = this.make("div", d);
        div_foot.css("text-align", "right");

        a = this.make("a", div_foot);
        a.text("more products ...");
        a.attr("href", "./products");
        a.attr("target", "_blank");
        a.css("color", "#f39ef3");
        a.css("font-size", "1.5em");
        a.css("text-align", "center");
        a.css("font-style", "italic");
    }

    private prepareCustomer() {
        let d = null;
        let h = null;
        let p = null;
        let sp = null;
        let a = null;
        let div_foot = null;

        d = this.div_customer_inner;
        d.css("cursor", "pointer");
        d.css("background-color", "#3f3f3f");
        d.css("color", "#eff");
        d.addClass("round");
        d.addClass("p-2");
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("The Kuzestan Province Judiciary");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text("Product: Judge Training System");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");
        this.make("hr", d);
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("Ahwaz city real estate companies");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text("Product: Real Estate Company System (R.E.C.S)");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");
        this.make("hr", d);
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("Ahwaz city taxi service agencies");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text("Product: Taxi Service");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");
        this.make("hr", d);
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("Ahwaz city physician office");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");
        p = this.make("span", d);
        p.text("Product: Patient Reservation System (P.R.S)");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");
        this.make("hr", d);
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("Ahwaz city malls, shops, and stores");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");
        p = this.make("span", d);
        p.text("Product: Comprehensive Warehousing System");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");
        this.make("hr", d);

        div_foot = this.make("div", d);
        div_foot.css("text-align", "right");

        a = this.make("a", div_foot);
        a.text("more customers");
        a.attr("href", "./customer-service");
        a.attr("target", "_blank");
        a.css("color", "#f39ef3");
        a.css("font-size", "1.5em");
        a.css("text-align", "center");
        a.css("font-style", "italic");
        a.css("font-decoration", "none");
    }

    private prepareContacts() {
        let d = null;
        let h = null;
        let ta_msg = null;
        let btn_submit = null;
        let txt_sender = null;
        let _token = this.csrf_token;
        let phone = null;
        let address = null;
        let email = null;

        /* -------------------------------------------------- */
        d = this.div_contacts_inner;

        d.css("cursor", "pointer");
        d.css("background-color", "#3f3f3f");
        d.css("color", "#eff");
        d.addClass("round");
        d.addClass("p-2");

        h = this.make("h4", d);
        h.text("You can always call us on:");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        phone = this.make("span", d)
            .text("PHONE: (+98)6132233015")
            .css("color", "yellow");
        $.post("./api/get-phone", { _token }, (d, s) => {
            if (d["ok"] == 1) {
                phone.text("PHONE: " + d["result"]["stg_val"]);
            }
        });

        this.make("br", d);

        address = this.make("span", d)
            .text(
                "ADDRESS: No.1 Alvand Building, Shariati Bulvard, Ahvaz, Iran"
            )
            .css("color", "yellow");

        $.post("./api/get-address", { _token }, (d, s) => {
            if (d["ok"] == 1) {
                address.text("ADDRESS: " + d["result"]["stg_val"]);
            }
        });

        this.make("br", d);

        email = this.make("span", d)
            .text("EMAIL: info@alvandsofts.com")
            .css("color", "yellow");

        $.post("./api/get-email", { _token }, (d, s) => {
            if (d["ok"] == 1) {
                email.text("EMAIL: " + d["result"]["stg_val"]);
            }
        });

        this.make("br");

        this.make("hr", d);

        h = this.make("h4", d);
        h.text("Direct Contact to Manager");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "orange");

        ta_msg = this.make("textarea", d);
        ta_msg.attr("placeholder", "Your Direct points to manager");
        ta_msg.addClass("form-control");
        ta_msg.addClass("col-md-12");
        ta_msg.addClass("mb-1");

        txt_sender = this.make("input", d);
        txt_sender.attr("type", "text");
        txt_sender.attr("placeholder", "Yor Nice Name or Email");
        txt_sender.addClass("form-control");
        txt_sender.addClass("col-md-4");
        txt_sender.addClass("mb-1");

        btn_submit = this.make("button", d);
        btn_submit.addClass("btn");
        btn_submit.addClass("btn-primary");
        btn_submit.text("SUBMIT");

        btn_submit.click(() => {
            let mng_sender = txt_sender.val();
            let mng_message = ta_msg.val();

            $.post(
                "./api/msg-to-admin",
                {
                    mng_sender,
                    mng_message,
                },
                (d, s) => {
                    if (d["ok"] == 1) {
                        alert("Message sent to admin");
                        txt_sender.val("");
                        ta_msg.val("");
                    }
                }
            );
        });

        this.make("hr");
    }

    private prepareOrders() {
        let d = null;
        let h = null;
        let p = null;
        let ta = null;
        let a = null;
        let cmb = null;
        let op = null;
        let btn_submit = null;

        d = this.div_orders_inner;
        d.css("cursor", "pointer");
        d.css("background-color", "#3f3f3f");
        d.css("color", "#eff");
        d.addClass("p-2");
        d.addClass("round");

        $.post(
            "./api/current-user",
            {
                _token: this.csrf_token,
            },
            (dt, s) => {
                if (dt["ok"] == 1) {
                    /* SHOW ORDER FORM */
                    let user_name = dt["result"]["user_name"];

                    h = this.make("h4", d);
                    h.text(
                        "Dear " +
                            user_name +
                            " Please let us know about your software requirements."
                    );
                    h.css("font-family", "Times New Roman");
                    h.css("font-style", "italic");
                    h.css("color", "#07db12");

                    p = this.make("span", d);
                    p.text("I need a ");
                    p.css("font-family", "Times New Roman");
                    p.css("font-style", "italic");
                    p.css("color", "#91b9e0");
                    p.css("font-size", "1.5em");

                    cmb = this.make("select", d);
                    cmb.addClass("btn");
                    cmb.addClass("btn-secondary");

                    op = this.make("option", cmb);
                    op.attr("value", "Web");
                    op.text("Web");

                    op = this.make("option", cmb);
                    op.attr("value", "Desktop");
                    op.text("Desktop");

                    op = this.make("option", cmb);
                    op.attr("value", "Smartphone");
                    op.text("Smartphone");

                    p = this.make("span", d);
                    p.text("app which could satisfy the following needs:");
                    p.css("font-family", "Times New Roman");
                    p.css("font-style", "italic");
                    p.css("color", "#91b9e0");
                    p.css("font-size", "1.5em");

                    this.make("br", d);

                    ta = this.make("textarea", d);
                    ta.attr(
                        "placeholder",
                        "Please name the software requirements here."
                    );
                    ta.addClass("form-control");
                    ta.addClass("col-md-12");
                    ta.addClass("mb-1");
                    ta.addClass("mt-1");
                    ta.attr("rows", "10");

                    btn_submit = this.make("button", d);
                    btn_submit.addClass("btn");
                    btn_submit.addClass("btn-primary");
                    btn_submit.text("SUBMIT");
                } else {
                    /* SHOW LOGIN FIRST */

                    d.addClass("center");

                    h = this.make("h4", d);
                    h.text("It seems that you are not logged in yet");
                    h.css("font-family", "Times New Roman");
                    h.css("font-style", "italic");
                    h.css("color", "#07db12");

                    p = this.make("span", d);
                    p.text("please login first");
                    p.css("font-family", "Times New Roman");
                    p.css("font-style", "italic");
                    p.css("color", "#91b9e0");
                    p.css("font-size", "1.5em");

                    this.make("br", d);

                    a = this.make("a", d);
                    a.attr("href", "./sign-in");
                    a.attr("target", "_blank");
                    a.text("SIGN IN HERE");
                    a.addClass("btn");
                    a.addClass("btn-secondary");
                    a.addClass("mr-1");

                    a = this.make("a", d);
                    a.attr("href", "./sign-up");
                    a.attr("target", "_blank");
                    a.text("SIGN-UP HERE");
                    a.addClass("btn");
                    a.addClass("btn-warning");

                    this.make("hr", d);
                }
            }
        );
    }

    private prepareOffers() {
        let d = null;
        let h = null;
        let p = null;
        let sp = null;
        let a = null;
        let div_foot = null;

        /* -------------------------------------------------- */
        d = this.div_offers_inner;

        d.css("cursor", "pointer");
        d.css("background-color", "#3f3f3f");
        d.css("color", "#eff");
        d.css("border-bottom-left-radius", "5px");
        d.css("border-bottom-right-radius", "5px");
        d.addClass("p-2");

        h = this.make("h3", d);
        h.text(
            "Alvand Engineering company offers a variety of software according to customers' occupation and their activities."
        );
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#078ddb");
        h.addClass("center");
        this.make("hr", d);
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("Special offer for students");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text("Improve your memory with our G5 app");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");
        this.make("hr", d);
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("Business man?");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text("Try owr Bazaar app");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");
        this.make("hr", d);
        /* -------------------------------------------------- */

        h = this.make("h4", d);
        h.text("Dealing with document archiving?");
        h.css("font-family", "Times New Roman");
        h.css("font-style", "italic");
        h.css("color", "#07db12");

        p = this.make("span", d);
        p.text("Use our Document Archive System (D.A.S)");
        p.css("font-family", "Times New Roman");
        p.css("font-style", "italic");
        p.css("color", "#91b9e0");
        this.make("hr", d);
        /* -------------------------------------------------- */

        div_foot = this.make("div", d);
        div_foot.css("text-align", "right");

        a = this.make("a", div_foot);
        a.text("more");
        a.attr("href", "./offers");
        a.attr("target", "_blank");
        a.css("color", "#f39ef3");
        a.css("font-size", "1.5em");
        a.css("text-align", "center");
        a.css("font-style", "italic");
    }

    private clearButton(btn) {
        btn.css("color", "black");
        btn.css("background-color", "white");
        btn.css("border-top-width", "0px");
    }

    public static init(ownerId, csrf_token = "") {
        new PlgTopMenu(ownerId, csrf_token);
    }
}
