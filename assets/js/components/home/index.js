import React, { Component } from 'react';
import User from '../user';

class Home extends Component {
	constructor() {
		super();

		this.state = {
			users: []
		};
	}

	componentDidMount() {
		fetch('http://127.0.0.1:8000/api/users/')
			.then(response => response.json())
			.then(users => {
				this.setState({
					users
				});
			});
	}

	render() {
		return (
			<div className="row">
				{this.state.users.map(
					({ id, userName, email }) => (
						<User
							key={ id }
							id={ id }
							title={ userName }
							email={ email }
						>
						</User>
					)
				)}
			</div>
		);
	}
}

export default Home;
