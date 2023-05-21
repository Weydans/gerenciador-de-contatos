import TemplateView from "./TemplateView.js";

/**
 * View class responsible to generate contact show view
 * 
 * @author Weydans Barros
 */
class ContactView extends TemplateView {
    /**
     * Create a new ContactView instance
     * 
     * @param {type} state app global state
     * @returns {ContactView}
     */
	constructor( state ) {
		super( state );
	}
    
    /**
     * Create a contact show view with data 
     * 
     * @returns {String} HTML view
     */
	view() {
		const { contact } = this.state;

		return (`
			<div>
				<h4 class="my-4">${ contact.type == false ? 'E-mail' : 'Phone'}</h4>
				<p><b>Id:</b> ${contact.id}</p>
				<p><b>Description:</b> ${contact.description}</p>
				<p><b>Owner:</b> ${contact.person.name}</p>
			</div>
		`);
	}
}

export default ContactView;
