class StateHelper {
	static createState() {
		return  {
			route: '/',
			pageTitle: '',
			personSearch: {
				field: '',
				value: '',
			},
			message: '',
			messageType: '',
			person: {},
			personList: {}, 
			contact: {},
			contactList: {},
		};
	}

	static resetState() {
		return this.createState();
	}
}

export default StateHelper;
