import StateHelper from "../Helper/StateHelper.js";

/**
 * Controller class responsible to be a base controller and
 * group common methods shared to all subclasses
 * 
 * @author Weydans Barros
 */
class Controller {
    /**
     * Set initial attributes 
     * 
     * @param {HTMLElement} rootElement
     * @param {object} state app global state
     * @param {HTTPSClient} http client to make http calls
     */
	constructor( rootElement, state, http ) {
		this.rootElement = rootElement;
		this.state       = state;
		this.http        = http;
	}

    /**
     * "Abstract" method 
     */
	async onList() {
		throw new Error( "Method 'onList' must be implemented" );
	}
    
    /**
     * "Abstract" method 
     */
	async onView() {
		throw new Error( "Method 'onView' must be implemented" );
	}
    
    /**
     * "Abstract" method 
     */
	onCreate() {
		throw new Error( "Method 'onCreate' must be implemented" );
	}
    
    /**
     * "Abstract" method 
     */
	async onEdit() {
		throw new Error( "Method 'onEdit' must be implemented" );
	}

    /**
     * Make a call to store a given register on remote server
     * 
     * @param {object} data data to store
     * @param {string} resource end point to make a call 
     * @returns void
     */
	async onStore( data, resource ) {
		let response       = await this.http.post( resource, data );
		this.state.message = response.message;
		
		if ( response.message && response.httpCode == 201 ) {
			this.state.messageType = 'success';
			await this.onList();

		} else if ( response.message && response.httpCode >= 400 ) {
			this.state.messageType = 'danger';
			await this.onCreate( true );
		}
	}

    /**
     * Make a call to update a register on remote server
     * 
     * @param {object} data data to update
     * @param {int} id regiter id to update
     * @param {string} resource end point to make call
     * @returns void
     */
	async onUpdate( data, id, resource ) {
		let response       = await this.http.put( `${resource}/${id}`, data );
		this.state.message = response.message;
		
		if ( response.message && response.httpCode < 400 ) {
			this.state.messageType = 'success';
			await this.onList();
			this.state = StateHelper.resetState();

		} else if ( response.message && response.httpCode >= 400 ) {
			this.state.messageType = 'danger';
			this.onEdit( id );
		}
	}

    /**
     * Make a call to delete a register on remote server
     * 
     * @param {int} id register id to delete
     * @param {string} resource end point to make a call
     * @param {string} entity entity name beeing deleted
     * @returns {void} 
     */
	async onDelete( id, resource, entity ) {
		let response = await this.http.delete( `${ resource }/${ id }` );
		
		if ( response == 'Unexpected end of input' ) {
			this.state.message = `${ entity } removed with success`;
			this.state.messageType = 'success';

		} else if ( response.message && response.httpCode >= 400 ) {
			this.state.message     = response.message;
			this.state.messageType = 'danger';
		}

		await this.onList();
	}

    /**
     * Add menu navigation actions 
     * 
     * @param {string} entity entity name to replace on page
     * @param {string} resource remote server resource to make a call
     * @returns {void}
     */
	addListActions( entity, resource ) {
		document.querySelectorAll( `.btn${ entity }View` )
			.forEach( btnView => {
				btnView.addEventListener( 'click', async ( event ) => {
					event.preventDefault();
					const id = event.target.id.replace( `${ entity.toLowerCase() }_view_`, '');
					this.onView( id );	
				});
			});
		
		document.querySelectorAll( `.btn${ entity }Edit` )
			.forEach( btnEdit => {
				btnEdit.addEventListener( 'click', async ( event ) => {
					event.preventDefault();
					const id   = event.target.id.replace( `${ entity.toLowerCase() }_edit_`, '');
					this.state = StateHelper.resetState();
					this.onEdit( id );
				});
			});

		document.querySelectorAll( `.btn${ entity }Delete` )
			.forEach( btnDelete => {
				btnDelete.addEventListener( 'click', async ( event ) => {
					event.preventDefault();
					const id = event.target.id.replace( `${ entity.toLowerCase() }_delete_`, '');
					this.onDelete( id, resource, entity );
				});
			});
	}
}

export default Controller;
