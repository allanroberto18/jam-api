import React from 'react';
import ReactDOM from 'react-dom';

import User from './components/user';

class App extends React.Component {
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
							key={id}
							title={userName}
							email={email}
						>
						</User>
					)
				)}
			</div>
		);
	}
}

ReactDOM.render(<App />, document.getElementById('root'));
