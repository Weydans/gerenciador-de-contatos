import StateHelper from "../Helper/StateHelper.js";

class Controller {
	constructor( rootElement, state, http ) {
		this.rootElement = rootElement;
		this.state       = state;
		this.http        = http;
	}

	async onList() {
		throw new Error( "Method 'onList' must be implemented" );
	}

	async onView() {
		throw new Error( "Method 'onView' must be implemented" );
	}

	onCreate() {
		throw new Error( "Method 'onCreate' must be implemented" );
	}

	async onEdit() {
		throw new Error( "Method 'onEdit' must be implemented" );
	}

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

	async onDelete( id, resource, entity ) {
		let response = await this.http.delete( `${ resource }/${ id }` );
		
		if ( response == 'Unexpected end of input' ) {
			this.state.message = `${ entity } removed with success`;
			this.state.messageType = 'success'

		} else if ( response.message && response.httpCode >= 400 ) {
			this.state.message     = response.message
			this.state.messageType = 'danger'
		}

		await this.onList();
	}

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
