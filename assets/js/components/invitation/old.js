import React, {Component} from 'react';

class User extends Component {

	constructor(props) {
		super(props);

		this.state = {
			display: false,
			invitationsSent: [],
			invitationsReceived: []
		}
	}

	getInvitationSent(id) {
		this.setState({
			display: false,
			invitationsSent: [],
			invitationsReceived: []
		});

		fetch('http://127.0.0.1:8000/api/invitations/sender/' + id)
			.then(response => response.json())
			.then(invitationsSent => {
				this.setState({
					display: true,
					invitationsReceived: [],
					invitationsSent
				});
			});
	};

	getInvitationReceived(id) {
		this.setState({
			display: false,
			invitationsSent: [],
			invitationsReceived: []
		});

		fetch('http://127.0.0.1:8000/api/invitations/invited/' + id)
			.then(response => response.json())
			.then(invitationsReceived => {
				this.setState({
					display: true,
					invitationsSent: [],
					invitationsReceived
				});
			});
	};

	mountInvitationSent(id) {
		if (this.state.invitationsSent.length > 0) {
			return (
				<table className={"mt-3 table"}>
					<thead>
					<tr>
						<th width={"50%"}>Invitation Sent</th>
						<th width={"50%"}>state</th>
					</tr>
					</thead>
					<tbody>
					{this.state.invitationsSent.map(
						({ id, userInvited, state }) => (
							<tr key={ id }>
								<td>{ userInvited.userName }</td>
								<td>{ this.mountState(state) }</td>
							</tr>
						)
					)}
					</tbody>
				</table>
			);
		}
	}

	updateState(id, state) {
		fetch('http://127.0.0.1:8000/api/invitations/' + id, {
			method: 'put',
			headers: { 'Content-Type': 'application/json'},
			body: JSON.stringify({ 'state': state })
		}).then(response => { console.log(status, response.status)});
		;
	}

	mountInvitationReceived(id) {
		if (this.state.invitationsReceived.length > 0) {
			return (
				<table className={"mt-3 table"}>
					<thead>
					<tr>
						<th width={"50%"}>Invitation Received</th>
						<th width={"30%"}>state</th>
						<th width={"20%"}>option</th>
					</tr>
					</thead>
					<tbody>
					{this.state.invitationsReceived.map(
						({ id, userSender, state }) => (
							<tr key={ id }>
								<td>{ userSender.userName }</td>
								<td>{ this.mountState(state) }</td>
								<td>
									<div className="btn-group" role="group" aria-label="Basic example">
										<button type="button" className="btn btn-secondary" onClick={() => this.updateState(id, 1)}>Accept</button>
										<button type="button" className="btn btn-secondary" onClick={() => this.updateState(id, 2)}>Refuse</button>
									</div>
								</td>
							</tr>
						)
					)}
					</tbody>
				</table>
			);
		}
	}

	mountState(state) {
		switch (state) {
			case 0:
				return <span className="badge badge-warning">Waiting</span>;
			case 1:
				return <span className="badge badge-success">Accepted</span>;
			case 2:
				return <span className="badge badge-secondary">Refused</span>;
			default:
				return <span className="badge badge-pill badge-dark">Undefined</span>;
		}
	}

	render() {
		const { id, userName, email } = this.props;
		return (
			<div key={id} className="card col-md-12" style={{width:200}}>
				<div className="card-body">
					<h4 className="card-title">{userName}</h4>
					<p className="card-text">{email}</p>
					<div className="btn-group" role="group" aria-label="Basic example">
						<button className="btn btn-primary" role="button" onClick={() => this.getInvitationSent(id)}>Check the invitations sent</button>
						<button className="btn btn-primary" role="button" onClick={() => this.getInvitationReceived(id)}>Check the invitations received</button>
					</div>
					{this.mountInvitationSent(id)}
					{this.mountInvitationReceived(id)}
				</div>
			</div>
		);
	}
}
export default User;
