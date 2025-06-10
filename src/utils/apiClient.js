
import config from "./config.js"
const apiClient = {
    async send(url, method, data) {

        method = method || "GET"
        let options = {
            method,
            headers: {
                "content-type": "application/json"
            }
        }
        options.body = data ? JSON.stringify(data) : null
        let res = await fetch(config.api_URL + url, options)

         if(res.status == 404){
           throw new Error('404 Page not found')
         }

        let resData = await res.json()
        return resData
    },
    async get(url) {
        return this.send(url, "GET")
    },
    async post(url, data) {
        return this.send(url, "POST", data)
    },
    async put(url, data) {
        return this.send(url, "PUT", data)
    },
    async delete(url) {
        return this.send(url, "DELETE")
    }


}

export default apiClient