import TemplateView from "./TemplateView.js";

/**
 * View class responsible to generate person list view
 * 
 * @author Weydans Barros
 */
class PersonListView extends TemplateView {
    /**
     * Create a new PersonListView instance
     * 
     * @param {type} state app global state
     * @returns {PersonListView}
     */
    constructor( state ) {
		super( state );
	}

    /**
     * Create a person list view with data 
     * 
     * @returns {String} HTML view
     */
	view() {
		const { personList, personSearch } = this.state;

		return (`
			<form id="formSearch">
				<div class="form-row pb-3">
					<div class="col-5">
						<input name="field" 
							   type="text" 
							   class="form-control" 
							   placeholder="Field name" 
							   value="${personSearch.field ? personSearch.field : ''}">
					</div>
					<div class="col-5">
						<input name="value" 
							   type="text" 
							   class="form-control" 
							   placeholder="Value"
							   value="${personSearch.value ? personSearch.value : ''}">
					</div>
					<div class="col-2">
						<button class="btn col-12 btn-success">Search</button>	
					</div>
				</div>
			</form>
			<table class="table table-hover">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Name</th>
						<th scope="col">CPF</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					${ 
					Object.keys( personList ).length 
					? 
						personList.map( person => `<tr>
							<td>${person.id}</td>
							<td>${person.name}</td>
							<td>${person.cpf}</td>
							<td>
								<button id="person_view_${person.id}" class="btnPersonView btn btn-success btn-sm">View</button>
								<button id="person_edit_${person.id}" class="btnPersonEdit btn btn-primary btn-sm">Edit</button>
								<button id="person_delete_${person.id}" class="btnPersonDelete btn btn-danger btn-sm">Delete</button>
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

export default PersonListView;
