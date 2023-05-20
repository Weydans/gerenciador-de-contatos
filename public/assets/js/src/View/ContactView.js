import TemplateView from "./TemplateView.js";

class ContactView extends TemplateView {
	constructor( state ) {
		super( state );
	}

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
