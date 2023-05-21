/**
 * App entry point file
 * Responsible to load dependencies and call initial controller
 * 
 * @author Weydans Barros
 */

import HTTPClient       from "./Service/HTTPClient.js";
import StateHelper      from "./Helper/StateHelper.js";
import PersonController from "./Controller/PersonController.js"

const rootElement = document.getElementById( 'root' );
const http        = new HTTPClient( 'http://localhost:8000/api/v0' );
let state 		  = StateHelper.createState();

const controller = new PersonController( rootElement, state, http );
controller.onList();
