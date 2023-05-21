/**
 * Service class responsible to make HTTP requests
 * 
 * @author Weydans Barros
 */
class HTTPClient {
    /**
     * Create a new instance of HTTPClient
     * 
     * @param {string} baseUrl end point base to make all requests
     */
	constructor( baseUrl ) {
		this.baseUrl = baseUrl;   
	}

    /**
     * Make a GET HTTP request
     * 
     * @param {string} uri REST resource to make a request
     * @returns {HTTPClient.get.response.HTTPClientget#=>#13|HTTPClient.get.response.HTTPClientget#=>#26|HTTPClient.get.response}
     */
    async get( uri ) {
        const response = 
			await fetch( `${this.baseUrl}${uri}`, {
				method: 'GET',
				mode: 'cors'
			})
			.then( response => response.json() )
			.catch( e => e.message );
		return response;
    }   

    /**
     * Make a POST HTTP request
     * 
     * @param {string} uri REST resource to make a request
     * @param {object} body data do send
     * @returns {HTTPClient.post.response.HTTPClientpost#=>#48|HTTPClient.post.response.HTTPClientpost#=>#29|HTTPClient.post.response}
     */
    async post( uri, body ) {
        const response = 
			await fetch( `${this.baseUrl}${uri}`, {
				method: 'POST',
				mode: 'cors',
				body: JSON.stringify( body ),
				headers: {
					'Accept':       'application/json',
					'Content-Type': 'application/json'
				}
			})
			.then( response => response.json() )
			.catch( e => e.message );
		return response;
    }   

    /**
     * Make a PUT HTTP request
     * 
     * @param {string} uri REST resource to make a request
     * @param {object} body data do send
     * @returns {HTTPClient.put.response.HTTPClientput#=>#71|HTTPClient.put.response|HTTPClient.put.response.HTTPClientput#=>#45}
     */
    async put( uri, body ) {
        const response = 
			await fetch( `${this.baseUrl}${uri}`, {
				method: 'PUT',
				mode: 'cors',
				body: JSON.stringify( body ),
				headers: {
					'Accept':       'application/json',
					'Content-Type': 'application/json'
				}
			})
			.then( response => response.json() )
			.catch( e => e.message );
		return response;
    }   

    /**
     * Make a DELETE HTTP request
     * 
     * @param {string} uri REST resource to make a request
     * @returns {HTTPClient.delete.response|HTTPClient.delete.response.HTTPClientdelete#=>#89|HTTPClient.delete.response.HTTPClientdelete#=>#56}
     */
    async delete( uri ) {
        const response = 
			await fetch( `${this.baseUrl}${uri}`, {
				method: 'DELETE',
				mode: 'cors'
			})
			.then( response => response.json() )
			.catch( e => e.message );
		return response;
    }   
}

export default HTTPClient;
