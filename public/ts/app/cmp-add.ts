class CmpAdd extends Cmp {
    public perform(e) {
        let owner = this.applyPath(e, "target/attributes/owner/value");
        if (owner == null) return;
        owner += "_";

        let x = parseFloat(this.getVal(owner + "txt_x"));
        let y = parseFloat(this.getVal(owner + "txt_y"));
        let z = x + y;
        this.setVal(owner + "spn_result", z);
    }

    public static run(e) {
        let bbb = new CmpAdd();
        bbb.perform(e);
    }
}
