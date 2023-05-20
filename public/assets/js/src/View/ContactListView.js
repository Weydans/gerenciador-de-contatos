import TemplateView from "./TemplateView.js";

class ContactListView extends TemplateView {
	constructor( state ) {
		super( state );
	}

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
