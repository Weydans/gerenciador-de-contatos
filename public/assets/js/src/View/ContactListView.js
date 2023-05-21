import TemplateView from "./TemplateView.js";

/**
 * View class responsible to generate contact list view
 * 
 * @author Weydans Barros
 */
class ContactListView extends TemplateView {
    /**
     * Create a new ContactListView instance
     * 
     * @param {type} state app global state
     * @returns {ContactListView}
     */
	constructor( state ) {
		super( state );
	}

    /**
     * Create a contact list view with data 
     * 
     * @returns {String} HTML view
     */
	view() {
		const { contactList, contactSearch } = this.state;

		return (`
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Type</th>
						<th scope="col">Description</th>
						<th scope="col">Owner</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					${ 
					Object.keys( contactList ).length 
					? 
						contactList.map( contact => `<tr>
							<td>${ contact.id }</td>
							<td>${ contact.type == false ? 'E-mail' : 'Phone' }</td>
							<td>${ contact.description }</td>
							<td>${ contact.person.name }</td>
							<td>
								<button id="contact_view_${ contact.id }" class="btnContactView btn btn-success btn-sm">View</button>
								<button id="contact_edit_${ contact.id }" class="btnContactEdit btn btn-primary btn-sm">Edit</button>
								<button id="contact_delete_${ contact.id }" class="btnContactDelete btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
						`).join('')
					:
					''
					}
				</tbody>
			</table>
		`);
	}
}

export default ContactListView;
