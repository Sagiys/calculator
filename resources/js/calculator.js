import API from './api'

const validInput = "0123456789".split("")
const operators = ["+", "-", "*", "/", "^"];
const brackets = ["(", ")"];
const specialChars = ["SC", "AC", "=", ".", "<", ">"];


export default class Calculator {
    constructor() {
        this.api = new API("api")
        this.equation = "";
        this.keys = document.querySelector(".calculator-keys")

        this.handleKeyHandler = this.handleKey.bind(this);
        this.keys.addEventListener("click", this.handleKeyHandler)

    }

    async handleKey(e) {
        const char = e.target.value;

        if (![...validInput, ...operators, ...brackets, ...specialChars].includes(char)) {
            return;
        }

        if (char === "AC") {
            this.equation = "";
            this.refreshScreen();
            return;
        }

        if (char === "SC") {
            this.equation = this.equation.slice(0, -1)
            console.log("usuwam")
            this.refreshScreen();
            return;
        }

        if (char === "=") {
            const response = await this.result();
            if (response.errors) {
                let errors = response.errors.equation.join("\n");
                window.alert(errors);
                return;
            }
            this.equation = response.result;
            this.refreshScreen();
            return;
        }

        this.equation = this.equation + char;
        this.refreshScreen();
    }

    async result() {
        return await this.api.post('calculate', {'equation': this.equation})
    }

    refreshScreen() {
        document.querySelector(".calculator-screen").setAttribute("value", this.equation)
    }
}
