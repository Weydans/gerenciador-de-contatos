class HTTPClient {
	constructor( baseUrl ) {
		this.baseUrl = baseUrl;   
	}

    async get( uri ) {
        const response = 
			await fetch( `${this.baseUrl}${uri}`, {
				method: 'GET',
				mode: 'cors',
			})
			.then( response => response.json() )
			.catch( e => e.message );
		return response;
    }   

    async post( uri, body ) {
        const response = 
			await fetch( `${this.baseUrl}${uri}`, {
				method: 'POST',
				mode: 'cors',
				body: JSON.stringify( body ),
				headers: {
					'Accept':       'application/json',
					'Content-Type': 'application/json',
				}
			})
			.then( response => response.json() )
			.catch( e => e.message );
		return response;
    }   

    async put( uri, body ) {
        const response = 
			await fetch( `${this.baseUrl}${uri}`, {
				method: 'PUT',
				mode: 'cors',
				body: JSON.stringify( body ),
				headers: {
					'Accept':       'application/json',
					'Content-Type': 'application/json',
				}
			})
			.then( response => response.json() )
			.catch( e => e.message );
		return response;
    }   

    async delete( uri ) {
        const response = 
			await fetch( `${this.baseUrl}${uri}`, {
				method: 'DELETE',
				mode: 'cors',
			})
			.then( response => response.json() )
			.catch( e => e.message );
		return response;
    }   
}

export default HTTPClient;
