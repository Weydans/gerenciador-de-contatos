import Controller      from "./Controller.js";
import ContactView     from "../View/ContactView.js";
import MenuHelper      from "../Helper/MenuHelper.js";
import StateHelper     from "../Helper/StateHelper.js";
import ContactFormView from "../View/ContactFormView.js";
import ContactListView from "../View/ContactListView.js";

/**
 * Controller class responsible to manage contact actions
 * 
 * @author Weydans Barros
 */
class ContactController extends Controller {
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
     * Make a http call to recover all contacts and render it on browser
     * 
     * @returns {void}
     */
	async onList() {
		let response             = await this.http.get( '/contacts' );
		let numRegistersFound    = Object.keys( response.data ).length;
		this.state.pageTitle     = 'Contacts';
		this.state.contactList   = response.data;
		this.state.contactSearch = {};

		if ( !numRegistersFound ) {
			this.state.message     = `No registers found`;
			this.state.messageType = 'info';
		}

        let listView               = new ContactListView( this.state );
		this.rootElement.innerHTML = listView.render(); 
		this.state                 = StateHelper.resetState();

		MenuHelper.addActions( this.rootElement, this.state, this.http );
		this.addListActions( 'Contact', '/contacts' );
	}
    
    /**
     * Render contact form and make a http call to create contact
     * 
     * @param {boolean} createError verify if an error happend, true on error
     * @returns {void}
     */
	async onCreate( createError = false ) {
		if ( !createError ) {
			this.state = StateHelper.resetState();
		}

		let response               = await this.http.get( '/persons' );
		this.state.personList      = response.data;
		this.state.pageTitle       = 'Contact';
        let formView               = new ContactFormView( this.state );
		this.rootElement.innerHTML = formView.render();
		
		MenuHelper.addActions( this.rootElement, this.state, this.http );
		this.addContactFormAction();
	}
    
    /**
     * Make a http call to get a contact and render contact view 
     * 
     * @param {int} id contact id to request to remote server
     * @returns {void}
     */
	async onView( id ) {
		const uri                  = `/contacts/${id}`;
		let response               = await this.http.get( uri );
		this.state.contact         = response.data;
		this.state.pageTitle       = 'Contact';
		let contactView            = new ContactView( this.state );
		this.rootElement.innerHTML = contactView.render(); 
		this.state                 = StateHelper.resetState();
		
		MenuHelper.addActions( this.rootElement, this.state, this.http );
	}
    
    /**
     * Make a http call to get a contact and render contact form 
     * 
     * @param {int} id contact id to request to remote server
     * @returns {void}
     */
	async onEdit( id ) {
		if ( this.state.contact.id != id ) {
			let response       = await this.http.get( `/contacts/${id}` );
			this.state.contact = response.data;
		}

		this.state.pageTitle       = 'Contact';
		let responsePersonList     = await this.http.get( '/persons' );
		this.state.personList      = responsePersonList.data;
		let contactFormView        = new ContactFormView( this.state );
		this.rootElement.innerHTML = contactFormView.render(); 
		
		MenuHelper.addActions( this.rootElement, this.state, this.http );
		this.addContactFormAction( id );
	}

    /**
     * Add form event
     *  
     * @param {int} id contact id to request to remote server
     * @returns {void}
     */
	addContactFormAction( id = false ) {
		document.getElementById( 'contactForm' )
			.addEventListener( 'submit', async ( event ) => {
				event.preventDefault();
				this.state.contact = {
					personId: event.target.person_id.value,
					type: event.target.type.value == 1 ? true : false,
					description: event.target.description.value
				};
				if ( id ) {
					this.onUpdate( this.state.contact, id, '/contacts' );
					return;
				}
				this.onStore( this.state.contact, '/contacts' );
			});
	}
}

export default ContactController;
