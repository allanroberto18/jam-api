import React from 'react';
import { BrowserRouter as Router, Route, NavLink, Switch } from "react-router-dom";
import Home from './components/home';
import Invitation from './components/invitation';

function main() {
	return (
		<Router>
			<nav className="navbar navbar-expand-lg navbar-light bg-light">
				<a className="navbar-brand" href="#"> MusicJam API Test </a>
				<div className="collapse navbar-collapse" id="navbarSupportedContent">
					<ul className="navbar-nav mr-auto">
						<li className="nav-item active">
							<NavLink className="nav-link" to="/">Home <span className="sr-only">(current)</span></NavLink>
						</li>
					</ul>
				</div>
			</nav>
			<Switch>
				<Route exact path="/" component={Home} />
				<Route path="/invitation/:id" component={Invitation} />
			</Switch>
		</Router>
	);
}

export default main;

