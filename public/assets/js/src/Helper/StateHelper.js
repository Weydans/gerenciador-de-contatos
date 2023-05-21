/**
 * Helper class responsible to manage app state
 * 
 * @author Weydans Barros
 */
class StateHelper {
    /**
     * Create a new app state
     * 
     * @returns {StateHelper.createState.StateHelperAnonym$0}
     */
	static createState() {
		return  {
			route: '/',
			pageTitle: '',
			personSearch: {
				field: '',
				value: ''
			},
			message: '',
			messageType: '',
			person: {},
			personList: {}, 
			contact: {},
			contactList: {}
		};
	}

    /**
     * Clear a new state returning a new state
     * 
     * @returns {StateHelper.createState.StateHelperAnonym$0}
     */
	static resetState() {
		return this.createState();
	}
}

export default StateHelper;
