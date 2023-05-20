import Controller     from "./Controller.js";
import PersonView     from "../View/PersonView.js";
import MenuHelper     from "../Helper/MenuHelper.js";
import StateHelper    from "../Helper/StateHelper.js";
import PersonListView from "../View/PersonListView.js";
import PersonFormView from "../View/PersonFormView.js";

class PersonController extends Controller {
	constructor( rootElement, state, http ) {
		super( rootElement, state, http );
	}

	async onList() {
		let response            = await this.http.get( '/persons' );
		let numRegistersFound   = Object.keys( response.data ).length;
		this.state.pageTitle    = 'People';
		this.state.personList   = response.data;
		this.state.personSearch = {};

		if ( !numRegistersFound ) {
			this.state.message     = `No registers found`;
			this.state.messageType = 'info';
		}

        let listView               = new PersonListView( this.state );
		this.rootElement.innerHTML = listView.render(); 
		this.state                 = StateHelper.resetState();

		this.addSearchAction();
		MenuHelper.addActions( this.rootElement, this.state, this.http );
		this.addListActions( 'Person', '/persons' );
	}

	onCreate( createError = false ) {
		if ( !createError ) {
			this.state = StateHelper.resetState();
		}

		this.state.pageTitle       = 'Person';
        let formView               = new PersonFormView( this.state );
		this.rootElement.innerHTML = formView.render();
		
		MenuHelper.addActions( this.rootElement, this.state, this.http );
		this.addPersonFormAction();
	}

	async onSearch() {
		const uri 			       = `/persons?field=${this.state.personSearch.field}&value=${this.state.personSearch.value}`;
		let response               = await this.http.get( uri );
		let numRegistersFound      = Object.keys( response.data ).length;
		this.state.pageTitle       = 'People';
		this.state.message         = `Your search returned ${ numRegistersFound } results`;
		this.state.messageType     = 'info';
		this.state.personList      = response.data;
		let listView               = new PersonListView( this.state );
		this.rootElement.innerHTML = listView.render(); 
		this.state                 = StateHelper.resetState();

		this.addSearchAction();
		MenuHelper.addActions( this.rootElement, this.state, this.http );
		this.addListActions( 'Person', '/persons' );
	}

	async onView( id ) {
		const uri                  = `/persons/${id}`;
		let response               = await this.http.get( uri );
		this.state.person          = response.data;
		this.state.pageTitle       = 'Person';
		let personView             = new PersonView( this.state );
		this.rootElement.innerHTML = personView.render(); 
		this.state                 = StateHelper.resetState();
		
		MenuHelper.addActions( this.rootElement, this.state, this.http );
	}

	async onEdit( id ) {
		if ( this.state.person.id != id ) {
			let response      = await this.http.get( `/persons/${id}` );
			this.state.person = response.data;
		}

		this.state.pageTitle       = 'Person';
		let personFormView         = new PersonFormView( this.state );
		this.rootElement.innerHTML = personFormView.render(); 
		
		this.addPersonFormAction( id );
		MenuHelper.addActions( this.rootElement, this.state, this.http );
	}

	addPersonFormAction( id = false ) {
		document.getElementById( 'personForm' )
			.addEventListener( 'submit', async ( event ) => {
				event.preventDefault();
				this.state.person = {
					name: event.target.name.value,
					cpf: event.target.cpf.value,
				};
				if ( id ) {
					this.onUpdate( this.state.person, id, '/persons' );
					return;
				}
				this.onStore( this.state.person, '/persons' );
			});
	}

	addSearchAction() {
		document.getElementById( 'formSearch' )
			.addEventListener( 'submit', async ( event ) => {
				event.preventDefault();
				this.state.personSearch.field = event.target.field.value;
				this.state.personSearch.value = event.target.value.value;
				this.onSearch();
			});
	}
}

export default PersonController;
