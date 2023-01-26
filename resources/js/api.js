export default class API {
    constructor(url) {
        this.url = url;
    }

    async post(url, data) {
        try {
            const response = await fetch(`${this.url}/${url}`, {
                method: "POST",
                headers: {"Content-Type": "application/json", "Accept": "application/json"},
                body: JSON.stringify(data)
            })
            return response.json();
        } catch (error) {
            throw new Error(error)
        }
    }
}
