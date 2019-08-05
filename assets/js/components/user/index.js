import React, {Component} from 'react';
import { NavLink } from 'react-router-dom';

class User extends Component {

	constructor(props) {
		super(props);
	}

	redirectTo(id) {
		console.log(id);
	}

	render() {
		const { id, userName, email } = this.props;
		return (
			<div key={id} className="card col-md-12" style={{width:200}}>
				<div className="card-body">
					<h4 className="card-title">{userName}</h4>
					<p className="card-text">{email}</p>
					<NavLink to={"/invitation/" + id}>here</NavLink>
				</div>
			</div>

		);
	}
}
export default User;
