import TemplateView from "./TemplateView.js";

/**
 * View class responsible to generate person show view
 * 
 * @author Weydans Barros
 */
class PersonView extends TemplateView {
    /**
     * Create a new PersonView instance
     * 
     * @param {type} state app global state
     * @returns {PersonView}
     */
	constructor( state ) {
		super( state );
	}
    
    /**
     * Create a person show view with data 
     * 
     * @returns {String} HTML view
     */
	view() {
		const { person } = this.state;

		return (`
			<div>
				<h4 class="my-4">${person.name}</h4>
				<p><b>ID:</b> ${person.id}</p>
				<p><b>CPF:</b> ${person.cpf}</p>
			</div>
			<hr>
			<div>
				<h4 class="my-4">Contacts</h4>
				${ 
				person.contacts 
					? person.contacts.map( contact => `
						<p><b>Id:</b> ${ contact.id }</p>	
						<p><b>Type:</b> ${ contact.type == 0 ? 'E-mail' : 'Phone' }</p>	
						<p><b>Description:</b> ${ contact.description }</p>	
						<hr>
					`).join( '' )
					: `<p>No contacts found</p>`
				}
			</div>
		`);
	}
}

export default PersonView;
