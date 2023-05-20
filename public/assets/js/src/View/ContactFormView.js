import TemplateView from "./TemplateView.js";

class ContactFormView extends TemplateView {
	constructor( state ) {
		super( state );
	}

	view() {
		const { contact, personList } = this.state;

		return (`
			<form id="contactForm">
				<div class="form pb-3">
					<div class="form-group">
						<label>Type</label>
						<select name="type" class="form-control">
							<option value="0" ${ contact != undefined && contact.type == 0 ? 'selected' : '' }>E-mail</option>
							<option value="1" ${ contact != undefined && contact.type == 1 ? 'selected' : '' }>Phone</option>
						</select>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input name="description" 
							   type="text" 
							   class="form-control" 
							   value="${ contact && contact.description ? contact.description : '' }">
					</div>
					<div class="form-group">
						<label>Person</label>
						<select name="person_id" class="form-control">
							${ personList.map( person => `
							<option value="${ person.id }" ${ contact != undefined && contact.person?.id == person.id ? 'selected' : '' }>
									 ${ person.name }
							</option>
							`).join( '' )}
						</select>
					</div>
					<div class="form-group">
						<button class="btn btn-success">Send</button>	
					</div>
				</div>
			</form>
		`);
	}
}

export default ContactFormView;
