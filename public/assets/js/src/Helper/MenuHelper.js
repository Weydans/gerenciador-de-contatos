import PersonController  from "../Controller/PersonController.js";
import ContactController from "../Controller/ContactController.js";

/**
 * Helper class responsible to add action to app menu
 * 
 * @author Weydans Barros
 */
class MenuHelper {
    /**
     * Add menu actions
     * 
     * @param {HTMLElement} rootElement app root element
     * @param {object} state app global state
     * @param {HTTPSClient} http client to make http calls
     */
	static addActions( rootElement, state, http ) {
		const personController  = new PersonController( rootElement, state, http );
		const contactController = new ContactController( rootElement, state, http );

		document.getElementById( 'btnLinkPeople' )
			.addEventListener( 'click', async () => await personController.onList() );

		document.getElementById( 'btnLinkPersonForm' )
			.addEventListener( 'click', () => personController.onCreate() );

		document.getElementById( 'btnLinkContacts' )
			.addEventListener( 'click', async () => await contactController.onList() );

		document.getElementById( 'btnLinkContactForm' )
			.addEventListener( 'click', () => contactController.onCreate() );
	}
}

export default MenuHelper;
