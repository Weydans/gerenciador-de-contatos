import Controller     from "./Controller.js";
import PersonView     from "../View/PersonView.js";
import MenuHelper     from "../Helper/MenuHelper.js";
import StateHelper    from "../Helper/StateHelper.js";
import PersonListView from "../View/PersonListView.js";
import PersonFormView from "../View/PersonFormView.js";

/**
 * Controller class responsible to manage person actions
 * 
 * @author Weydans Barros
 */
class PersonController extends Controller {
    /**
     * Set initial attributes 
     * 
     * @param {HTMLElement} rootElement
     * @param {object} state app global state
     * @param {HTTPSClient} http client to make http calls
     */
	constructor( rootElement, state, http ) {
		super( rootElement, state, http );
	}
    
    /**
     * Make a http call to recover all people and render it on browser
     * 
     * @returns {void}
     */
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
    
    /**
     * Render person form and make a http call to create contact
     * 
     * @param {boolean} createError verify if an error happend, true on error
     * @returns {void}
     */
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

    /**
     * Make a http call to serach people and render results
     * 
     * @returns {void}
     */
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
    
    /**
     * Make a http call to get a person and render person view 
     * 
     * @param {int} id person id to request to remote server
     * @returns {void}
     */
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
    
    /**
     * Make a http call to get a person and render person form 
     * 
     * @param {int} id person id to request to remote server
     * @returns {void}
     */
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

    /**
     * Add form event
     *  
     * @param {int} id person id to request to remote server
     * @returns {void}
     */
	addPersonFormAction( id = false ) {
		document.getElementById( 'personForm' )
			.addEventListener( 'submit', async ( event ) => {
				event.preventDefault();
				this.state.person = {
					name: event.target.name.value,
					cpf: event.target.cpf.value
				};
				if ( id ) {
					this.onUpdate( this.state.person, id, '/persons' );
					return;
				}
				this.onStore( this.state.person, '/persons' );
			});
	}

    /**
     * Add search form event
     *  
     * @returns {void}
     */
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
