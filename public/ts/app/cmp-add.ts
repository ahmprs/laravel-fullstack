class CmpAdd extends Cmp {
    public perform(e) {
        let owner = this.applyPath(e, "target/attributes/owner/value");
        if (owner == null) return;
        owner += "_";

        let x = parseFloat(this.getVal(owner + "txt_x"));
        let y = parseFloat(this.getVal(owner + "txt_y"));
        let z = x + y;
        this.setVal(owner + "spn_result", z);

        $(this.elm(owner + "txt_x")).on("change", function () {
            console.log("JQUERY HERE");
        });
    }

    public static run(e) {
        let cmp = new CmpAdd();
        cmp.perform(e);
    }
}
