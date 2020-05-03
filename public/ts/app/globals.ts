class Globals {
    public static getVal(elementId: string) {
        let element = <HTMLInputElement>document.getElementById(elementId);
        return element.value;
    }

    public static setVal(elementId: string, value: any) {
        let element = <HTMLElement>document.getElementById(elementId);
        element.innerText = "" + value;
    }
}

export { Globals };
