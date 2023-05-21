import TemplateView from "./TemplateView.js";

/**
 * View class responsible to generate person form view
 * 
 * @author Weydans Barros
 */
class PersonFormView extends TemplateView {
    /**
     * Create a new PersonFormView instance
     * 
     * @param {type} state app global state
     * @returns {PersonFormView}
     */
	constructor( state ) {
		super( state );
	}

    /**
     * Create a person form view with data 
     * 
     * @returns {String} HTML view
     */
	view() {
		const { person } = this.state;

		return (`
			<form id="personForm">
				<div class="form pb-3">
					<div class="form-group">
						<label>Name</label>
						<input name="name" 
							   type="text" 
							   class="form-control" 
							   placeholder="Field name" 
							   value="${person.name ? person.name : ''}">
					</div>
					<div class="form-group">
						<label>CPF</label>
						<input name="cpf" 
							   type="text" 
							   class="form-control" 
							   placeholder="Value"
							   value="${person.cpf ? person.cpf : ''}">
					</div>
					<div class="form-group">
						<button class="btn btn-success">Send</button>	
					</div>
				</div>
			</form>
		`);
	}
}

export default PersonFormView;
