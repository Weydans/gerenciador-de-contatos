class TemplateView {
	constructor( state ) {
		this.state = state;
	}

	view() {
		throw new Error( 'Method "view" must be implemented' );
	}

	render() {
		return (`
			<div class="container">
				<div class="content">
					<div class="card my-5">
						<div class="card-body">
							<div class="row mb-3">
								<div class="col-4">
									<h5 class="card-title mb-4">${this.state.pageTitle}</h5>
								</div>
								<div class="col-8 text-right">
									<button id="btnLinkPeople" class="btn btn-sm btn-primary">People</button> 
									<button id="btnLinkPersonForm" class="btn btn-sm btn-primary">People Form</button>
									<button id="btnLinkContacts" class="btn btn-sm btn-primary">Contacts</button> 
									<button id="btnLinkContactForm" class="btn btn-sm btn-primary">Contact Form</button>
								</div>
							</div>
							${ 
							this.state.message 
							? `<div class="alert alert-${ this.state.messageType }">${ this.state.message }</div>`
							: ''
							}
							${ this.view() }
						</div>
					</div>
				</div>
			</div>
		`);
	}
}

export default TemplateView;
